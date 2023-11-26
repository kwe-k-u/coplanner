


# {type: [user_choice][itinerary_option]}
similarity_matrix = {
		"type" : [[10,5,1],[5,10,5],[1,5,10]],
		"activities" : [[10,8,5,1,1,1,8,1],[8,10,6,1,1,1,1,1],
				  #outdoors
				  [5,3,10,7,1,5,3,8],[1,1,5,10,1,3,1,1],[1,3,5,1,10,1,1,1],[1,1,4,1,1,10,1,1],[8,1,5,1,1,1,10,1],[3,1,8,1,1,2,1,10]],
		"budget": [[10,6,1],[6,10,6],[1,6,10]],
		"room" : [[10,1],[1,10]],
		"day" : [[10,7,1],[5,10,3],[1,3,10]]
}

category_weights = {
	"type" : 2,
	"activities" : 2,
	"budget": 2,
	"room" : 2,
	"day" : 2
}


itinerary_options = {
	"Accra Travels" : {
		"type" : "3",
		"activities" : ["8","4"],
		"budget": "2",
		"room" : "2",
		"day" : "3"
	},
	"Si krom wo ha" : {
		"type" : "1",
		"activities" : ["4","3","1"],
		"budget": "2",
		"room" : "1",
		"day" : "3"
	},
	"Just work it out" : {
		"type" : "2",
		"activities" : ["8","6","5"],
		"budget": "2",
		"room" : "2",
		"day" : "3"
	},
	"Mamprobi & More" : {
		"type" : "1",
		"activities" : ["4","6"],
		"budget": "3",
		"room" : "2",
		"day" : "1"
	},
	"Volta Travels" : {
		"type" : "2",
		"activities" : ["1","2","3","4","5"],
		"budget": "2",
		"room" : "1",
		"day" : "2"
	},
	"Accra Exploration" : {
		"type" : "1",
		"activities" : ["2","8","4","5","7"],
		"budget": "1",
		"room" : "1",
		"day" : "1"
	},
	"Heritage Tour" : {
		"type" : "3",
		"activities" : ["1","5","7"],
		"budget": "3",
		"room" : "1",
		"day" : "2"
	}
}

activity_map = {
	1 : "Beaches",
	2 : "Relaxation",
	3 : "Outdoors",
	4 : "Nightlife",
	5 : "Shopping",
	6 : "Festivals",
	7 : "Swimming",
	8 : "Hiking"
}
type_map = {
	1 : "Single's tour",
	2 : "Couple's tour",
	3 : "Group's tour"
}
day_map = {
	1 : "Single",
	2 : "Two to Three Days",
	3 : "About a week"
}

room_map = {
	1 : "Individual accommodation",
	2 : "Shared accommodation"
}
budget_map = {
	1 : "Under GHS 500",
	2 : "GHS 500 - GHS 1500",
	3 : "GHS 1500 - GHS 3000"
}





type_choice = input("""
What type of tour do you want
1. Single's tour
2. Couple's tour
3. Group's tour
\n""")#m

day_choice = input("""
How long would you like the trip to be?
1. Single
2. Two to Three Days
3. About a week
\n""")#m

room_choice = input("""
What kind of accommodation are you interested in
1. Individual accommodation
2. Shared accommodation
\n""")#h

activity_choice = input("""
What activities are you interested in? (Separated by commas)
1. Beaches
2. Relaxation
3. Outdoors
4. Nightlife
5. Shopping
6. Festivals
7. Swimming
8. Hiking
\n""").split(",")#m


budget_choice = input("""
What is your subject?
1. Under GHS 500
2. GHS 500 - GHS 1500
3. GHS 1500 - GHS 3000
\n""")#m

choice_map = {
	"type" : type_choice,
	"activities" : activity_choice,
	"budget": budget_choice,
	"room" : room_choice,
	"day" : day_choice
}



def get_option_value(user,itinerary_value,matrix):
	return matrix[int(user)-1][int(itinerary_value)-1]

def get_recommendations(user_choices,itinerary_options, num_choices = 3):
	itinerary_values = {}

	# for every itinerary option, compare the user's selections and generating similarity weights
	for i_name in itinerary_options.keys():
		itinerary = itinerary_options[i_name]
		for key in user_choices.keys():
			value = user_choices[key]
			if key == "activities":
				result = 0
				for activity in value: # for every possible activity calculate the similarity value
					for itinerary_activity in itinerary[key]:
						result += get_option_value(activity,itinerary_activity,similarity_matrix[key])
			else:
				# print("first")
				result = get_option_value(value,itinerary[key],similarity_matrix[key])
		itinerary_values[i_name] = result * category_weights[key]

	return sorted(itinerary_values, key=lambda x: itinerary_values[x], reverse=True)[:num_choices]




def show_itinerary_information(key,value):

	if key == "activities":
		print("Activities", end="= ")
		for _ in value:
			print(activity_map[int(_)],end=",")
		print()
	elif key == "budget":
		print("Budget=",budget_map[value])
	elif key == "room":
		print("Accommodation=",room_map[value])
	elif key == "day":
		print("Number of days=",day_map[value])
	elif key == "type":
		print("Type of tour=",type_map[value])
	else:
		print("Failed key", key)


recommendations = get_recommendations(choice_map,itinerary_options)
print("Showing the recommendations based on your choices")
_ = 0
for option in recommendations:
	_+=1
	itinerary = itinerary_options[option]
	print("Option",_)
	print("Itinerary name",option)
	for key in itinerary.keys():
		value = itinerary[key]
		if type(value) == list:
			show_itinerary_information(key,value)
		else:
			show_itinerary_information(key,int(value))

	print("\n")