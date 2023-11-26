# Script that is run first.



import math
import requests
import json
import multiprocessing
import threading
from random import randint
from time import sleep, time

destination_types = ["shopping_mall","restaurant","zoo","tourist_attraction"]
# destination_types = ["amusement_park","aquarium","art_gallery","bowling_alley","cafe","campground","library","lodging","movie_theater","musem","night_club","park","casino","stadium","shopping_mall","restaurant","zoo","tourist_attraction"]
search_queries = ["things to do","places to visit","tour sites"]
max_km = 50
ghana_tl = (11.02603066883424, -3.1447569426908735)
ghana_tr = (11.11026093989852, 0.3312241000695119)
ghana_bl = (4.681113101193597, -2.98740800659884)
ghana_br = (4.7238819932005525, 0.874793152023812)
current_position = ghana_tl
#using min because left most is the smaller number
start_pos = min(ghana_tl[1],ghana_bl[1])

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
	try:

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
	except:
		save_file("url_fails",url)
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
	# move down
	current_position = move(cu,"bottom")
	# go back to start position
	return (current_position[0], start)

def move_right(cu):
	return move(cu)


def run_get_threads(position,typ,result):
	for query in search_queries:
		_ =get_destinations(query,position,typ)
		result.append((typ,_))

def run_destination_search(vert_steps,hor_steps,position,typ):
	current_position = position
	des = {}
	num_threads = vert_steps * hor_steps
	threads = []
	thread_result = []
	print("Spawning",num_threads," threads for destination retrieval")
	for i in range(num_threads):
		t = threading.Thread(target=run_get_threads,args=(current_position,typ,thread_result))
		threads.append(t)
		t.start()
		current_position = move_right(current_position)

		if i%hor_steps == 0:
			current_position = next_line(current_position,start_pos)

	for _ in threads:
		_.join()
	print("Threads finished",thread_result)
	save_file("tuples/destination_tuples",thread_result)
	for _ in thread_result:
		des.update(_[1])

	return (typ,des)


def spin_thread(func,args = [],result_queue = None):
	print("starting new process")
	result = func(*args)
	if result_queue is not None:
		result_queue.put(result)

def save_file(filename,data):
	# print("saving file")
	# print(filename+".json",data)
	# return 0
	with open(filename+".json", 'a') as file:
		json.dump(data, file, indent=4)
	if filename == "error":
		with open(filename+".json", 'a') as file:
			file.write("\n")




if  __name__ == "__main__":
	start_time = time()


	current_position = ghana_tl

	width = calculate_distance(ghana_tl[0],ghana_tl[1],ghana_tr[0],ghana_tr[1])
	height = calculate_distance(ghana_tl[0],ghana_tl[1],ghana_bl[0],ghana_bl[1])

	v_steps = int(height / max_km) # vertical steps
	h_steps = int(width / max_km) # horizontal steps

	process_list = {}
	process_results = []
	# process_results = {}
	process_queue = multiprocessing.Queue()

	print("Spinning up",len(destination_types), "pocesses")

	for type_check in destination_types:
		# process_results[type_check] = []
		process_results = [{type_check : {}}]


		# all_location_data = {}
		# res = run_destination_search(v_steps,h_steps,current_position,type_check)
		process = multiprocessing.Process(target=spin_thread,args = (run_destination_search,[v_steps,h_steps,current_position,type_check],process_queue))
		process_list[type_check] = process
		process.start()

	while len(process_results) != len(process_list.keys()):
	# while not all(process_results.values()):
		a,b = process_queue.get()

		# process_results[a] = b
		for _ in range(len(process_results)):
			c = process_results[_]
			print("c result", c)
			if (list(c.keys())[0] == a):
				process_results[_][a] = b

	for p in process_list.values():
		p.join()

	for _ in process_results:
		key = list(_.keys())[0]
		res = _[key]
		save_file(key,res)

	end_time = time()
	seconds = end_time - start_time
	minutes = int(seconds / 60)
	min_seconds = seconds %60
	hours = int(minutes / 60)
	hours_minutes = minutes % 60

	print("Time stats")
	print("seconds", seconds)
	print("minutes",minutes,min_seconds)
	print("hours",hours, hours_minutes)
	print("total time", hours, hours_minutes, min_seconds)