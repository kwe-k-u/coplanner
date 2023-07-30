
//===================================================================================
// 			Functions for Occurance sections
//Track changes to fields and update the corresponding row item
$("#seats").on("input", () => { on_occurance_edit("seats") });
$("#fee").on("input", () => { on_occurance_edit("fee") });
$("#end_date").on("input", () => { on_occurance_edit("end_date") });
$("#start_date").on("input", () => { on_occurance_edit("start_date") });
$("#end_time").on("input", () => { on_occurance_edit("end_time") });
$("#start_time").on("input", () => { on_occurance_edit("start_time") });
// script to prefill the page if a trip id is in the url (User wants to update tour information)
$(document).ready (()=>{
	if(window.location.search.includes("id")){
		//TODO: Edit trip
		const tour_id = url_params("id");

		//show loader
		//get trip id from url params
		//get trip information from database
		// fill the input fields
		// image displays
		//hide the loade
	}
});
// Holds the list of locations and their associated activities
var location_activity_set = {} //{location : {activity_id, activity_name}}
// the location whose activites are shown on the main form
var active_location_name = "";

function submit_tour(form) {
	event.preventDefault();
	var title = form.title.value;
	var description = form.description.value;
	var curator_id = form.curator_id.value;
	// var locations = [];
	var activities = [];
	for (var loc_name in location_activity_set){
		for (var id in location_activity_set[loc_name]){
			activities.push(id);
		}
	}
	var occurances = get_occurance_entries();
	var images = tripimages_upload_display.getFiles();
	//var flyer = flyerimage_upload_displayflyerimage_upload_display.getFiles();




	send_request(
		"POST",
		// "test/test.php",
		"processors/processor.php",
		{
			"action" : "create_campaign",
			"images": images,
			"title" : title,
			"curator_id" : curator_id,
			"description" : description,
			"trips" : JSON.stringify(occurances),
			"activities" : JSON.stringify(location_activity_set)
		},
		(response) => {
			alert(response);
			// alert(response["data"]);
		}
	)


}


function on_occurance_edit(id) {
	var element = document.getElementById(id);
	// check if theres an active field
	if (!document.getElementById("active_occurance_row")) {
		create_active_row();

	}
	//update active row's value
	switch (id) {
		case "seats":
			update_active_row("seats_val", element.value);
			break;
		case "fee":
			update_active_row("fee_val", element.value);
			break;
		case "end_date":
			update_active_row("end_val", element.value);
			break;
		case "end_time":
			update_active_row("end_time_val",element.value);
			break;
		case "start_time":
			update_active_row("start_time_val",element.value);
			break;
		case "start_date":
			update_active_row("start_val", element.value);
			break;
	}
	//if not create one and in real time edit the value
	// if there is edit the respective field
}

function update_active_row(section, value) {
	var active = document.getElementById("active_occurance_row");
	if(section == "end_time_val" || section == "start_time_val"){
		// split hour from minutes
		[hrs,minutes] = value.split(":").map(Number);
		ext = hrs >= 12 ? "PM" : "AM";
		if(hrs> 12){
			hrs = hrs - 12;
		}

		disVal = `${hrs.toString().padStart(2,"0")}:${minutes.toString().padStart(2,"0")} ${ext}`;
	}else{
		disVal = value;
	}
	active.getElementsByClassName(section)[0].innerHTML = disVal ;
}




//clears the entry field and adds the
// occurance entry if the all values have been entered
// function new_occurance_entry() {
// 	// create_entry_row("start","end","fee","ee");
// 	if (is_occurance_entry_complete()) {
// 		var values = get_occurance_entry();
// 		create_entry_row(values["start_date"], values["end_date"], values["fee"], values["seats"]);
// 	} else { // Some fields are empty
// 		alert("You need to provide all these values: Start Date, End Date, Fee, Number of seats");
// 	}
// }

function delete_occurance_entry(element) {
	element.parentNode.parentNode.remove();
}


function edit_occurance_entry(element) {


}



//returns a bool for if all the tour occurance information has been filled
function is_occurance_entry_complete() {
	String.prototype.isEmpty = function () {
		return (this.length == 0 || !this.trim());
	}
	var start = document.getElementById("start_date").value;
	var end = document.getElementById("end_date").value;
	var fee = document.getElementById("fee").value;
	var seats = document.getElementById("seats").value;

	return !(start.isEmpty() && end.isEmpty() && fee.isEmpty() && seats.isEmpty());
}

//Creates a row for a new occurance entry
function create_active_row() {
	var collection = document.getElementById("occurance_list");


	var collection = document.getElementById("occurance_list");
	var addButton = document.getElementById("add_button");
	var newNode = document.createElement("div");
	newNode.setAttribute("id", "active_occurance_row")
	newNode.classList.add("list-item");
	newNode.innerHTML = "<div class='inner-item start_val'> </div> \
	<div class='inner-item start_time_val'> </div> \
	<div class='inner-item end_val'> </div> \
	<div class='inner-item end_time_val'> </div> \
	<div class='inner-item  fee_val'> </div> \
	<div class='inner-item seats_val'> </div> \
	<div class='inner-item row'> \
		<div class='inner-item fa fa-edit' onclick='edit_occurance_entry(this)'></div> \
		<div class='inner-item fa fa-trash' onclick='delete_occurance_entry(this)'></div> \
	</div>";

	collection.insertBefore(newNode, addButton);
}


//Creates an occurance row with the values passed
function create_entry_row(start_date,start_time, end_date, end_time, fee, seats) {

	var collection = document.getElementById("occurance_list");
	var addButton = document.getElementById("add_button");
	var newNode = document.createElement("div");
	newNode.classList.add("list-item");
	newNode.innerHTML = "<div class='inner-item start_val'>" + start_date + "</div> \
	<div class='inner-item start_time_val'>"+ start_time + "</div> \
	<div class='inner-item end_val'>"+ end_date + "</div> \
	<div class='inner-item end_time_val'>"+ end_time + "</div> \
	<div class='inner-item  fee_val'>" + fee + "</div> \
	<div class='inner-item seats_val'>" + seats + "</div> \
	<div class='inner-item row'> \
		<div class='inner-item' onclick='edit_occurance_entry(this)'>d</div> \
		<div class='inner-item' onclick='delete_occurance_entry(this)'>e</div> \
	</div>";

	collection.insertBefore(newNode, addButton);

}

function add_new_occurance() {
	//check if all entries are filled
	if (is_occurance_entry_complete()) {
		remove_active_row();
		create_active_row();
		clear_occurance_fields();
	} else { // display error if some fields are incomplete
		alert("Ensure that you have provided values for all the occurace fields before adding a new one");
	}

}

//Disables the active row
function remove_active_row() {
	document.getElementById("active_occurance_row").removeAttribute("id");
}


//Removes the values in the textfields for trip occurances
function clear_occurance_fields() {
	document.getElementById("start_date").value = "";
	document.getElementById("seats").value = "";
	document.getElementById("fee").value = "";
	document.getElementById("end_date").value = "";
}


// Returns the values for all entered occurances as a list of json
function get_occurance_entries() {
	var array = [];
	var collection = document.getElementById("occurance_list");
	for (index = 1; index < collection.children.length - 1; index++) {
		var child = collection.children[index];
		var values = get_occurance_row_values(child);
		array.push(values);
		// array.push(JSON.stringify(values));
	}
	return array;
}


//Reads the row element{element} and returns as a map the values for that occurance
function get_occurance_row_values(element) {
	return {
		"start_date": changeToDateTimestr(element.getElementsByClassName("start_val")[0].innerText,  element.getElementsByClassName("start_time_val")[0].innerText),
		"end_date": changeToDateTimestr(element.getElementsByClassName("end_val")[0].innerText,  element.getElementsByClassName("end_time_val")[0].innerText),
		"fee": element.getElementsByClassName("fee_val")[0].innerText,
		"seats": element.getElementsByClassName("seats_val")[0].innerText,
	};

}







//===================================================================================
// 			Functions for activity sections

$(".activity-span").on("click", activity_click);

$(".image-collection").on("click", showRecentList);

$(".activity-span-selected").on("click", selectedActivityClick);




//Changes the display to show the images within the clicked collection
function showRecentList(element) {
	get_collection();

	function get_collection() {
		alert(element.target);
	}

}




function activity_click(element) {
	if (element.target.classList.contains("easygo-btn-1")) {
		activity_deselect(element);
	} else {
		activity_select(element);
	}
}


function activity_select(element) {
	// document.getElementById().
	element.target.classList.add("easygo-btn-1");
	var parent = element.target.parentElement;
	//remove selected node from consideration
	parent.removeChild(element.target);
	var next = null;

	//determine position of clicked activity
	for (index = 0; index < parent.children.length; index++) {
		var child = parent.children[index];
		if (!child.classList.contains("easygo-btn-1")) {
			next = child;
			break;
		}
	}

	//make insertion
	if (next == null) {
		parent.appendChild(element.target);
	} else {
		parent.insertBefore(element.target, next);
	}
}


function activity_deselect(element) {
	// document.getElementById().classList;
	element.target.classList.remove("easygo-btn-1");
	var parent = element.target.parentElement;
	//remove selected node from consideration
	parent.removeChild(element.target);
	var next = null;

	//determine position of clicked activity
	for (index = 0; index < parent.children.length; index++) {
		var child = parent.children[index];
		if (!child.classList.contains("easygo-btn-1")) {
			next = child;
			break;
		}
	}

	//make insertion
	if (next == null) {
		parent.appendChild(element.target);
	} else {
		parent.insertBefore(element.target, next);
	}
}



function on_location_expand(id) {
	var title = document.getElementById("location-info-title");
	var description = document.getElementById("location-info-desc");

	var payload = {
		"action": "get_site_by_id",
		"destination_id": id
	};


	send_request(
		"POST",
		"processors/processor.php",
		payload,
		(response) => {
			var json = response["data"];
			var activity = json["activities"];
			var image_list = [
				"../assets/images/others/scenery2.jpg",
				"../assets/images/others/tour1.jpg"
			];

			title.innerText = json["destination_name"];
			description.innerText = json["destination_description"];

			reset_location_info_images(image_list);
			reset_location_info_activities(activity);
			$(".activity-span").on("click", activity_click);
		}
	);


}


function reset_location_info_images(images) {
	var image_div = document.getElementById("location-info-images")
	var full_body = "";


	images.forEach(image_source => {
		full_body += "<div class='grid-item'> \
		<img class='w-100 h-100 rounded' src='"+ image_source + "' alt='scene 1'> \
	</div>";
	});

	image_div.innerHTML = full_body;
}


function reset_location_info_activities(activities) {
	// alert(activities[0]["activity_name"]);
	var activity_div = document.getElementById("activity-list-div");
	var full_body = "";


	for (index = 0; index < activities.length; index++) {
		var value = activities[index]["activity_name"];
		var key = activities[index]["activity_id"];
		full_body += "<span id='" + key + "' class='px-3 py-1 border-blue rounded border easygo-fs-5 text-capitalize activity-span'>" + value + "</span>";
	}
	activity_div.innerHTML = full_body;
}

function location_search_submit(form) {
	event.preventDefault();
	var query = form.query.value;
	var type = get_dropdown_value("location_search_filter");

	// payload = "action=query_site";
	// payload += "&query="+query;
	// payload += "&type="+type;
	let payload = {
		"action": "query_site",
		"query": query,
		"type": type
	};

	send_request("POST",
		'processors/processor.php',
		payload,
		(response) => {
			// alert(response);
			// console.log(response["data"]["sites"])
			update_location_results(response["data"]["sites"])
		}
	);


}


// Update the tour location modal with a list of tour locations
function update_location_results(location_list) {

	// update search result count
	document.getElementById("site_search_result_count").innerText = location_list.length;


	//update list with the children
	var list_div = document.getElementById("site_result_div");
	list_div.innerHTML = "";
	if (location_list.length > 0){ // If results exist, populate list
		location_list.forEach(json => {
			list_div.appendChild(create_location_tile(json));
		});

		//Update the expanded list with the first result
		on_location_expand(location_list[0]["destination_id"]);
	}else { //else show message for no results TODO
	}
}


function add_location_activity() {
	//filling location section of page
	var selected_location_list = document.getElementById("selected-locations");
	var location_name = document.getElementById("location-info-title").innerText;
	var add_location = true;

	for (var loc_index = 0; loc_index < selected_location_list.children.length; loc_index++){
		var child = selected_location_list.children[loc_index];
		if (child.innerText == location_name){
			add_location = false
			break;
		}
	}
	//if the list of added locations does not include current location,
	//then it should be added
	if (add_location){ // if location has already been added update its list data
		var newNode = document.createElement("span");
		newNode.setAttribute("class","location_name mx-1 my-1 px-3 py-1 border-blue rounded border easygo-fs-5 text-capitalize location-span");
		// newNode.setAttribute("onclick", "selectedActivityClick()");
		newNode.innerText = location_name;
		selected_location_list.appendChild(newNode);
		location_activity_set[location_name] = {};
	}

	//filling activity section of page
	var added_activities_list = document.getElementById("selected-activities");
	//for every activity the location has,
	for (var index = 0; index < document.getElementById("activity-list-div").children.length; index++) {
		var element = document.getElementById("activity-list-div").children[index];
		var already_added = false; // if false add activity, if true skip activity

		//Prevent duplicate additions by checking if the selected activity list
		//has that Id already added to the page
		for (var act_index = 0; act_index < added_activities_list.children.length; act_index++){
			var child = added_activities_list.children[act_index];
			if(child.id == element.id){
				already_added = true;
			}
		}

		if (element.classList.contains("easygo-btn-1") && !already_added) {
			var newNode = document.createElement("span");
			newNode.setAttribute("id", element.id);
			newNode.setAttribute("class", "px-3 py-1 border-blue rounded border easygo-fs-5 text-capitalize activity-span-selected");
			// newNode.setAttribute("onclick", "selectedActivityClick()");
			newNode.innerText = element.innerText;
			added_activities_list.appendChild(newNode);

			location_activity_set[location_name][element.id] = element.innerText;
		}

		setActiveLocation(location_name)

	};


	$(".activity-span-selected").on("click", selectedActivityClick);
	$(".location-span").on("click",selectedLocationClick);
}

function selectedLocationClick(element){
	// setActiveLocation(element.target.innerText);
}
// Sets the location whose activites are shown
function setActiveLocation(element){
	// var location_name = element.target.innerText;
	// console.log(location_name);
}

// creates and returns an html element for the result tile of tour sites
function create_location_tile(map) {
	var title = map["destination_name"];
	var location = map["destination_location"];
	var id = map["destination_id"];

	const locationCard = document.createElement("div");
	locationCard.classList.add('location-card', 'border', 'p-4', 'rounded', 'my-3');

	// create the header div with site name and location
	const header = document.createElement('div');
	header.classList.add('header', 'd-flex', 'justify-content-between');
	const siteNameH1 = document.createElement('h1');
	siteNameH1.classList.add('easygo-fs-3', 'text-capitalize');
	siteNameH1.textContent = title;
	const siteLocationH5 = document.createElement('h5');
	siteLocationH5.classList.add('easygo-fs-4', 'text-orange');
	siteLocationH5.textContent = location;
	header.appendChild(siteNameH1);
	header.appendChild(siteLocationH5);
	locationCard.appendChild(header);

	// create the text-gray-1 div with time and buttons
	const textGray1 = document.createElement('div');
	textGray1.classList.add('text-gray-1', 'easygo-fs-6');

	// create the time div with site location
	const time = document.createElement('div');
	const timeLocationSpan = document.createElement('span');
	timeLocationSpan.textContent = location;
	time.appendChild(timeLocationSpan);
	textGray1.appendChild(time);


	locationCard.appendChild(textGray1);

	// create the pt-3 div with the See More button
	const pt3 = document.createElement('div');
	pt3.classList.add('pt-3');
	const seeMoreButton = document.createElement('button');
	seeMoreButton.classList.add('easygo-btn-1', 'easygo-fs-5', 'py-1', 'px-4');
	seeMoreButton.textContent = 'See More';
	seeMoreButton.setAttribute('onclick', `on_location_expand("${id}")`);
	pt3.appendChild(seeMoreButton);
	locationCard.appendChild(pt3);

	return locationCard;

}


function selectedActivityClick(element) {
	if (confirm("Remove Activity from list?")) {
		delete location_activity_set[active_location_name][element.id];
		document.getElementById("selected-activities").removeChild(element.target);
		if(location_activity_set[active_location_name] == {}){
			delete location_activity_set[active_location_name];
		}
	}
}





// Tour site addition by curator

function create_site(form){
	event.preventDefault();
	const act_list = document.getElementById("add_loc_activity_list");
	var activities = [];

	for (var act_index = 0; act_index < act_list.children.length; act_index++){
		var child = act_list.children[act_index];
		activities.push(child.innerText);
	}


	var payload = {
			"action" : "add_tour_site",
			"destination_name" : form.name.value,
			"destination_location" : form.location.value,
			"site_description" : form.description.value,
			"country" : form.country.value,
			"activities" : activities,
			"owner_name" : form.owner.value,
			"owner_number" : form.number.value
		};

	send_request(
		"POST",
		"processors/processor.php",
		payload,
		(response) => {
			console.log(response);
			alert(response['msg']);

		}
	);


}


function add_loc_activity(){
	event.preventDefault();
	var acts = document.getElementById("add_loc_activity_list");
	var field = document.getElementById("add_loc_activity_input");
	field.value = field.value.trim();
	if(field.value.length < 4){
		alert("Too short a word for an activity");
		return false;
	}

	for (var act_index = 0; act_index < acts.children.length; act_index++){
		var child = acts.children[act_index];
		if(child.innerText == field.value){
			alert("Already included");
			return false;
		}
	}



	var newNode = document.createElement("li");
	// newNode.setAttribute("onclick", "selectedActivityClick()");
	newNode.innerText = field.value;
	acts.appendChild(newNode);

	field.value = '';
	return true;
}