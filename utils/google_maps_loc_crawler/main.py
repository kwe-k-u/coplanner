
# adsfjjal
# wfsd
import math
import requests
import json
import multiprocessing
from random import randint
from time import sleep



def calculate_distance(lat1, lon1, lat2, lon2):
	earth_radius = 6371  # Earth's radius in kilometers

	# Convert degrees to radians
	lat1_rad = math.radians(lat1)
	lon1_rad = math.radians(lon1)
	lat2_rad = math.radians(lat2)
	lon2_rad = math.radians(lon2)

	# Calculate distance using the formula
	distance = math.acos(
		(math.sin(lat1_rad) * math.sin(lat2_rad)) +
		(math.cos(lat1_rad) * math.cos(lat2_rad) * math.cos(lon2_rad - lon1_rad))
	) * earth_radius

	return distance




def get_destinations(query,center, category):
	save_data = {}
	maps_api_key = ""
	url = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?key="+maps_api_key+"&keyword="+query+"&location="+str(center[0])+", "+str(center[1])+"&type="+category+"&radius=50000"

	payload = {}
	headers = {}
	response = requests.request("GET", url, headers=headers, data=payload)
	data = response.json()["results"]
	print("Checking for ",center)
	print("Size", len(data))
	for index in range(len(data)):
		loc_info = data[index]
		try:
			relevant = {
				"name" : loc_info["name"],
				"place_id" : loc_info["place_id"],
				"types" : loc_info["types"],
				"user_ratings_total" : loc_info.get("user_ratings_total",0),
				"rating" : loc_info.get("rating",1),
				"vicinity" : loc_info["vicinity"],
				"location" : loc_info["geometry"]["location"]
			}
		except:
			save_file("error",loc_info)
			input("Error caught")
		save_data[index] = relevant
		print("Added", relevant["name"])

	return save_data



def move(cords, direction='right', distance=50):
	earth_radius = 6371  # Earth's radius in kilometers
	start_lat, start_lon = cords

	# Convert degrees to radians
	start_lat_rad = math.radians(start_lat)

	new_lat = start_lat
	new_lon = start_lon

	if direction == 'right':
		angular_distance = distance / earth_radius
		new_lon = start_lon + math.degrees(angular_distance / math.cos(start_lat_rad))
	elif direction == 'bottom':
		angular_distance = distance / earth_radius
		new_lat = start_lat - math.degrees(angular_distance)

	return (new_lat, new_lon)


def next_line(cu, start):
	# print("Next line")
	# move down
	current_position = move(cu,"bottom")
	# go back to start position
	return (current_position[0], start)

def move_right(cu):
	# print("Moving right")
	return move(cu)


def run_destination_search(vert_steps,hor_steps,position,typ):
	wait_time = randint(1,3)
	print("wait",wait_time)
	sleep(wait_time)
	return {}
	current_position = position
	des = {}
	for v in range(vert_steps):
		for h in range(hor_steps):
			for query in search_queries:
				_ =get_destinations(query,current_position,typ)
				des.update(_)
			current_position = move_right(current_position)
		current_position = next_line(current_position,start_pos)
	return des


def spin_thread(func,args = [],result_queue = None):
	print("starting new process")
	result = func(*args)
	if result_queue is not None:
		result_queue.put(result)

def save_file(filename,data):
	print("saving file")
	print(filename+".json",data)
	return 0
	with open(filename+".json", 'a') as file:
		json.dump(data, file, indent=4)
	if filename == "error":
		with open(filename+".json", 'a') as file:
			file.write("\n")




if  __name__ == "__main__":

	max_km = 50
	destination_types = ["amusement_park","aquarium","art_gallery","bowling_alley","cafe","campground","library","lodging","movie_theater","musem","night_club","park","casino","stadium","shopping_mall","restaurant","zoo","tourist_attraction"]
	search_queries = ["things to do","places to visit","tour sites"]
	ghana_tl = (11.02603066883424, -3.1447569426908735)
	ghana_tr = (11.11026093989852, 0.3312241000695119)
	ghana_bl = (4.681113101193597, -2.98740800659884)
	ghana_br = (4.7238819932005525, 0.874793152023812)
	current_position = ghana_tl
	#using min because left most is the smaller number
	start_pos = min(ghana_tl[1],ghana_bl[1])

	current_position = ghana_tl

	width = calculate_distance(ghana_tl[0],ghana_tl[1],ghana_tr[0],ghana_tr[1])
	height = calculate_distance(ghana_tl[0],ghana_tl[1],ghana_bl[0],ghana_bl[1])
	# print("Ghana width and height", width,height)

	v_steps = int(height / max_km) # vertical steps
	h_steps = int(width / max_km) # horizontal steps

	process_list = {}
	process_results = {}
	process_queue = multiprocessing.Queue()

	for type_check in destination_types:
		process_results[type_check] = []


		# all_location_data = {}
		# res = run_destination_search(v_steps,h_steps,current_position,type_check)
		process = multiprocessing.Process(target=spin_thread,args = (run_destination_search,[v_steps,h_steps,current_position,type_check],process_queue))
		process_list[type_check] = process
		process.start()

	while len(process_results.keys()) != len(process_list.keys()):
		type_check,_ = process_queue.get()
		print("result check",_)
		process_results[type_check] = _
	for p in process_list.values():
		# print(p)
		p.join()

	for key in process_results.keys():
		res = process_results[key]
		print(key,res)
		# all_location_data.update(res)
		# save_file(key,res)
