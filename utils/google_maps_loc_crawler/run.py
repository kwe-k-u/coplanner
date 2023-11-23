import ast

file_path = "all_destinations.json"
unique_place_ids = {}
data_list = None
with open(file_path, 'r') as file:
	file_content = file.read()
	data_list = ast.literal_eval(file_content)
good = 0
for e in list(data_list.keys()):
	if(data_list[e]["user_ratings_total"] > 20):
		print(data_list[e]["name"])
		good +=1
# for key in data_list:
# 	print(key)
# 	break;
	# Dictionary to track unique place_ids

	# Extract data and organize by main keys
	# for sublist in data_list:
	# 	print(sublist)
	# 	break

			# if main_key in all_entries:
			# 	all_entries[main_key].extend(unique_json_data)
			# else:
			# 	all_entries[main_key] = unique_json_data


print(len(data_list))
print(len(unique_place_ids))
print("Good names",good)

