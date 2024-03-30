import sys
import os
import json

# Function to check if a file is JSON
def is_json_file(file):
	return file.lower().endswith('.json')

# Function to read JSON files from a directory
def read_json_files(directory):
	json_files = {}
	for filename in os.listdir(directory):
		filepath = os.path.join(directory, filename)
		if os.path.isfile(filepath) and is_json_file(filename):
			with open(filepath, 'r') as file:
				content = json.load(file)
				# build matrix and run comparisons
				json_files[filename]= content
	return json_files



def budget_similarity(user_budget, itinerary_cost, max_diff_percent=100):
    """
    Calculate the similarity score based on the user's budget and itinerary cost using only standard libraries.

    :param user_budget: User's entered budget.
    :param itinerary_cost: Cost of the itinerary.
    :param max_diff_percent: Maximum considered difference in percentage between budget and cost for a score above 1.
    :return: Similarity score ranging from 1 to 5.
    """
    # Calculate the absolute percentage difference between the user's budget and itinerary cost
    percent_diff = abs(user_budget - itinerary_cost) / itinerary_cost * 100

    # Scale the difference to fall within the range of 0 to max_diff_percent
    scaled_diff = min(max(percent_diff, 0), max_diff_percent)

    # Calculate similarity using an exponential decay function
    # This ensures that the similarity score decreases as the difference increases
    similarity = 5 - 4 * (2.718281828459045 ** (-scaled_diff / (max_diff_percent / 5)))

    # Ensure the similarity score is within the range of 1 to 5
    similarity = max(min(similarity, 5), 1)

    return similarity

#calculates a single number value to rate the similarity of the passed template to the
#users choice selections based on the template values and the category weights
def calculate_similarity(user,template,system):
	similarity_matrix = system["similarity_matrix"]
	category_weights = system["category_weights"]
	choice_index = system["choice_indexes"]
	score_val = 0
	# for every category of user answers, take its simialrity score and check with the template answers
	for key in user:
		if key == "vibe":
			user_activities = user[key]
			template_activities = template[key]
			# add weight salt to increase score value when the activities are an exact match
			if user_activities == template_activities:
				score_val = 80
			for user_choice in user_activities:
				for template_choice in template_activities:
					template_index = choice_index[key].index(template_choice)
					user_index = choice_index[key].index(user_choice)
					score_val += similarity_matrix[key][user_index][template_index] * category_weights[key]
		elif key == "budget":
			template_choice = template[key]
			user_choice = user[key]
			score_val += budget_similarity(int(template_choice), int(user_choice)) * category_weights[key]
		else:
			template_choice = template[key]
			user_choice = user[key]
			#take similarity of user choice to template choice
			template_index = choice_index[key].index(template_choice)
			user_index = choice_index[key].index(user_choice)
			score_val += similarity_matrix[key][user_index][template_index] * category_weights[key]

	return score_val


def sort_files_by_score(data):
	result = []
	# Sort the dictionary items based on the scores
	sorted_files = sorted(data.items(), key=lambda x: x[1],reverse=True)
	for names in sorted_files:
		result.append(names[0])

	return result
	# return sorted_filenames

#retrieve user selection and template paths from args
user_selection = sys.argv[1]
with open(user_selection,"r") as file:
	user_selection = json.load(file)
template_path = sys.argv[2]
#get system values for selection weights
with open("../utils/recommender/system_values.json","r") as file:
	system_values = json.load(file)
recommendations = {}

# Search for JSON files in the provided template_path
file_content_pair = read_json_files(template_path)
# Encode the array of file contents to JSON for return
# print(file_content_pair)
for file_name in file_content_pair:
	template_value = file_content_pair[file_name]
	score = calculate_similarity(user_selection,template_value,system_values)
	recommendations[file_name] = score

# print( sort_files_by_score(recommendations))
for i in sort_files_by_score(recommendations):
# 	# print(i,  recommendations[i])
	print(i,  end=" ")
