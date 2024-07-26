import sys
import json
import os

page_view_events = []
remind_me_events = []
event_set = set()
page_view_summary = {
	"city": {},#counts for city
	"experience": {},#counts for each experience
	"browser": {},#counts for browser
	"os": {},#counts for operating system
	"screen_size": {},#counts for screen sizes
	"region": {},#counts for region
	"page_title": {},#counts for page title
	"page_path": {},#counts for page path
	"referring_domain" : {}, #websites and domains that lead people to our website
	"params": {} #parameters with ids for pages

}
# {experience_id = [{person, email,phone}]}
remind_me_summary = {

}




def get_key(array,key):
	if key in array:
		return array[key]
	return None

def update_page_view_summary(entry):
	experience = get_key(entry, "experience")
	referring_domain = get_key(entry,"$referring_domain")
	city = get_key(entry,"$city")
	browser = get_key(entry,"$browser")
	os = get_key(entry,"$os")
	region = get_key(entry,"$region")
	page_path = get_key(entry,"$current_url")
	page_title = get_key(entry, "current_page_title")
	screen_size = (get_key(entry, "$screen_height"),get_key(entry, "$screen_width"))

	# update city count
	if city in page_view_summary["city"]:
		page_view_summary["city"][city] +=1
	else:
		page_view_summary["city"][city] = 1
	#update operating system count
	if os in page_view_summary["os"]:
		page_view_summary["os"][os] +=1
	else:
		page_view_summary["os"][os] = 1
	#update browser count
	if browser in page_view_summary["browser"]:
		page_view_summary["browser"][browser] += 1
	else:
		page_view_summary["browser"][browser] = 1
	# update experience count
	if experience in page_view_summary["experience"]:
		page_view_summary["experience"][experience] += 1
	else:
		page_view_summary["experience"][experience] = 1
	# update screen size count
	if screen_size in page_view_summary["screen_size"]:
		page_view_summary["screen_size"][screen_size] += 1
	else:
		page_view_summary["screen_size"][screen_size] = 1
	# update region count
	if region in page_view_summary["region"]:
		page_view_summary["region"][region] += 1
	else:
		page_view_summary["region"][region] = 1
	# update page title count
	if page_title in page_view_summary["page_title"]:
		page_view_summary["page_title"][page_title] += 1
	else:
		page_view_summary["page_title"][page_title] = 1
	# update page path count
	if page_path in page_view_summary["page_path"]:
		page_view_summary["page_path"][page_path] += 1
	else:
		page_view_summary["page_path"][page_path] = 1
	# update referring domain count
	referring_domain = get_key(entry, "referring_domain")
	if referring_domain in page_view_summary["referring_domain"]:
		page_view_summary["referring_domain"][referring_domain] += 1
	else:
		page_view_summary["referring_domain"][referring_domain] = 1

def update_remind_me_summary(entry):
	# {experience_id = [{person, email,phone}]}
	experience_id = get_key(entry,"experience_id")
	name = get_key(entry,"user_name")
	email = get_key(entry,"email")
	phone = get_key(entry,"phone")
	data = {
			"user_name" : name,
			"email" : email,
			"phone" : phone
		}
	if (get_key(remind_me_summary,experience_id)):
		remind_me_summary[experience_id].append(data)
	else:
		remind_me_summary[experience_id] = [data]


def get_experience_summary(id):
	result = {}
	count = 0
	for page_path in page_view_summary["page_path"]:
		if "experience_id="+id in page_path:
			count += page_view_summary["page_path"][page_path]
	result["page_views"] = count
	return result


def get_experience_bookmark(id):
	array = get_key(remind_me_summary,id)
	if array:
		return {"reminder_count": len(array)}
	return {"reminder_count" : 0}



# Check if the JSON file path is provided as a command-line argument
if len(sys.argv) < 2:
	print("Please provide the path to the JSON file as a command-line argument.")
	sys.exit(1)

# Get the JSON file path from the command-line argument
json_file_path = sys.argv[1]
json_file_path = os.path.join(os.path.dirname(__file__), json_file_path)
data = None

try:
	# Read the JSON file
	with open(json_file_path, 'r') as file:
		data = json.load(file)

except FileNotFoundError:
	print(f"File '{json_file_path}' not found.")
	sys.exit(1)

except json.JSONDecodeError as e:
	print(f"Error decoding JSON file: {e}")
	sys.exit(1)




# Get every page view logged by mixpanel js
# page_view_events = [event for event in data if event["event"] =="$mp_web_page_view"]
for event in data:
	event_name = get_key(event,"event")
	property = get_key(event,'properties')
	if event_name == "$mp_web_page_view" and property:
		update_remind_me_summary(property)
	elif event_name == "Remind me button clicked" and property:
		update_page_view_summary(property)
	else:
		event_set.add(event["event"])



# print(page_view_summary)

command = "get_experience_summary"
result = {}
if command == "summarized":
	pass # get file name and generate the various action summaries for the month in the file
elif command == "get_experience_summary":
	view_result = get_experience_summary("a204be591353811ef86938ed206f829ea")
	remind_result = get_experience_bookmark("a204be591353811ef86938ed206f829ea")
	result = {**view_result,**remind_result}

	 # return a json with metrics for the experience
	# {experience_id : experience, page_views : 0, reminders: 0}
elif command == "get_curator_summary":
	pass #return metrics for the curator profile page


print(result)


# TODO:: Create endpoint that is triggered by monthly cron
# TODO:: export the file into a log/mixpanel/mixpanelYYYYMMDD.json file
# TODO:: Create a summaries do with {"page_view":{},"remind_me":{}} for monthly caching
# TODO:: Create endpoint to query python script that returns the analytics summary for trips and curator profiiles
