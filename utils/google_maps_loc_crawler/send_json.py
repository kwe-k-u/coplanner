import requests
import json

# URL of the endpoint where you want to send the data
endpoint_url = " http://localhost/coplanner/processors/processor.php/google_maps_upload"

# Path to your JSON file
file_path = 'tuples/all_destinations.json'

try:
	with open(file_path, 'r') as file:
		# Load the JSON data from the file
		json_data = json.load(file)

	# Send the JSON data via POST request
	response = requests.post(endpoint_url, json={"data":json_data})

	# Check the response status
	if response.status_code == 200:
		print(response.text)
		print("Data sent successfully!")
	else:
		print(f"Failed to send data. Status code: {response.status_code}")

except FileNotFoundError:
	print("File not found. Please provide a valid file path.")
except Exception as e:
	print(f"An error occurred: {str(e)}")
