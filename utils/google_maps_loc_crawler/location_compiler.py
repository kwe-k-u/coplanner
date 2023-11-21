import os
import json


def save_file(filename,data):
	print("saving file")
	with open(filename+".json", 'a') as file:
		json.dump(data, file, indent=4)
	if filename == "error":
		with open(filename+".json", 'a') as file:
			file.write("\n")







folder_path = os.getcwd()+"/json_data"
no_duplicates = {}
num_locations, num_duplicates,num_entries = 0,0,0

# Iterate through each file in the folder
for filename in os.listdir(folder_path):
    file_path = os.path.join(folder_path, filename)

    if filename.endswith(".json"):  # Check if the file is a JSON file
        print(f"Reading data from file: {filename}")

        with open(file_path, 'r') as file:
            try:
                # Load JSON data from the file
                json_data = json.load(file)

                # Iterate through each entry in the JSON data and print
                for key in json_data:
                    data = json_data[key]
                    place_id = data["place_id"]
                    if(place_id not in no_duplicates.keys()):
                        no_duplicates[place_id] = data
                        num_locations +=1
                    else:
                         num_duplicates +=1

                    num_entries +=1

            except json.JSONDecodeError as e:
                print(f"Error reading JSON from file {filename}: {e}")
                continue

print("Total number of Entries",num_entries)
print("Total number of Duplicates",num_duplicates)
print("Total number of Added locations",num_locations)
save_file("all_destinations",no_duplicates)
