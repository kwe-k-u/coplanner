import ast

file_path = "utils/google_maps_loc_crawler/tuples/all_destinations.json"
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


print(len(data_list))
print(len(unique_place_ids))
print("Good names",good)

