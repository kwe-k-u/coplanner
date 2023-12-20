import sys
import os
import json

try:
    user_selection = sys.argv[1]
    template_path = sys.argv[2]

    # Function to check if a file is JSON
    def is_json_file(file):
        return file.lower().endswith('.json')

    # Function to read JSON files from a directory
    def read_json_files(directory):
        json_files = []
        for filename in os.listdir(directory):
            filepath = os.path.join(directory, filename)
            if os.path.isfile(filepath) and is_json_file(filename):
                with open(filepath, 'r') as file:
                    content = json.load(file)
                    build matrix and run comparisons 
                    json_files.append(filename)
        return json_files

    # Search for JSON files in the provided template_path
    files_contents = read_json_files(template_path)

    # Encode the array of file contents to JSON for return
    json_result = json.dumps(files_contents)

    print(json_result)  # Output the JSON-encoded array

except Exception as e:
    print("An error occurred:", e)
