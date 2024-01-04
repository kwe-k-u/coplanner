# Script to help with uploading the files to the server

import os
import shutil

local_path = "C:/xampp/htdocs/coplanner"
dest_path = "C:/Users/KWAKU/Desktop/upload"
ignore_dir_list, ignore_file_list = [], []
move_list = []

#retrieve the list of files and folders to be ignored
with  open(local_path + "/utils/automations/ignore.txt") as file:
	for i in file:
		if (i.replace("\n","").endswith("/")):
			ignore_dir_list.append(i.replace("\n",""))
		else:
			ignore_file_list.append(i.replace("\n",""))


#takes in a file path and checks if the search algorithm should explore its contents
# returns false if the folder should be skipped
def check_folder(folder_path: str):
	for path in ignore_dir_list:
		# print(path.replace("\\","/"),path in  folder_path)
		if (path in  folder_path.replace("\\","/")) or (path[:-1] in folder_path):
			return False
	return True

# Check if the file should be uploaded based on the ignore file extension list
# returns false if the file should be ignored
def check_file(file_name:str):
	for file in ignore_file_list:
		if file_name.endswith(file[1:]):
			return False
	return True

# Takes the path of the file to be duplicated and the destination directory and returns the path(including sub directories) for the destination
def create_des_path(file : str,des :str):
	# print(file)
	old = file.replace("\\","/").split("/")
	new = des.split("/")
	res = ""
	for d in new:
		res = res +d+"/"

	for d in old[len(new)-1:]:
		res = res +d+"/"
	return res[:-1]


# get the path for the files that should be uploaded
for dir_path,dir_name,files in os.walk(local_path):
	if (check_folder(dir_path)):
		for file in files:
			if(check_file(file)):
				move_list.append(dir_path+"/"+file)

for file in move_list:
	destination = create_des_path(file,dest_path)
	r_dir = destination[:destination.rindex("/")]
	os.makedirs(r_dir,exist_ok=True)
	print("writing",destination)
	shutil.copyfile(file,destination)
