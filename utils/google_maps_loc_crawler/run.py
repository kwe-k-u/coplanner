import ast
import os
import json
import pandas as pd


def save_file(filename,data):
	# print("saving file")
	# print(filename+".json",data)
	# return 0
	with open(filename+".json", 'w') as file:
		json.dump(data, file, indent=4)
file_path = os.getcwd() +"/tuples/destination_tuples.json"
# file_path = "utils/google_maps_loc_crawler/tuples/destination_tuples.json"

unique_place_ids = {}
data_list = []
with open(file_path, 'r') as file:
	file_content = file.read()
	file_list = ast.literal_eval(file_content)
	data_list.extend(file_list)

good = 0
# input()
for e in data_list:
	# print(e)
	for k in e[1].keys():
		map_result = e[1][k]
		if(map_result != {} and map_result["user_ratings_total"] > 20):
			# print(map_result["name"])
			unique_place_ids[map_result["place_id"]] =map_result
			# good +=1

save_file("final_list",unique_place_ids)
# for _ in unique_place_ids.values():
# 	print(_["name"])

print(len(data_list))
print(len(unique_place_ids))
# print("Good names",good)




# Read the JSON file
with open('final_list.json', 'r') as file:
    json_data = json.load(file)

# Extracting relevant attributes
data = []
for place_id, place_data in json_data.items():
    place_name = place_data.get('name', '')
    ratings = place_data.get('rating', 0)
    number = place_data.get('user_ratings_total', 0)

    data.append({
        'Place Id': place_id,
        'Place Name': place_name,
        'Status': "Not called",
        'Ratings': ratings,
        'Number': "",
        'Comments': ""
    })

# Create a DataFrame from the extracted data
df = pd.DataFrame(data)

# Write DataFrame to an Excel file
df.to_excel('output.xlsx', index=False)
