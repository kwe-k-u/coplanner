import os
import ast
import json

# Directory path containing TXT files
directory_path = os.getcwd()+"/tuples"

# List to store all json entries
all_entries = {}

# Iterate through files in the directory
for filename in os.listdir(directory_path):
    if filename.endswith('.txt'):
        file_path = os.path.join(directory_path, filename)
        with open(file_path, 'r') as file:
            file_content = file.read()
            try:
                data_list = ast.literal_eval(file_content)

                # Dictionary to track unique place_ids
                unique_place_ids = {}

                # Extract data and organize by main keys
                for sublist in data_list:
                    main_key = sublist[0]
                    json_data = [list(data.values()) for data in sublist[1:] if data] # Exclude the key to the json
                    if json_data:
                        unique_json_data = []
                        for entry in json_data:
                            place_id = entry[0].get('place_id')  # Assuming 'place_id' is in the first position
                            if place_id and place_id not in unique_place_ids:
                                unique_place_ids[place_id] = True
                                unique_json_data.append(entry)

                        if main_key in all_entries:
                            all_entries[main_key].extend(unique_json_data)
                        else:
                            all_entries[main_key] = unique_json_data
            except SyntaxError as e:
                print(f"Error in file {file_path}: {e}")
                # Handle syntax errors if any

# Write unique entries to all-entries.json file
with open("all-entries.json", 'w') as file:
    json.dump(all_entries, file, indent=4)
for key, value in all_entries.items():
    print(f"Main key: {key}, Data count: {len(value)}")
# # Check if total sizes match
# total_entries = sum(len(sublist) for sublist in all_entries)
# print(f"Total entries in sublists: {total_entries}")
# print(f"Total entries in combined list: {len(all_entries)}")
# if total_entries == len(all_entries):
#     print("Total sizes match")
# else:
#     print("Total sizes do not match")

# while True:
#     query = input("Command: ")
#     eval(query)