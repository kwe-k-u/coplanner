
//===================================================================================
// 			Functions for Occurance sections
//Track changes to fields and update the corresponding row item
$("#seats").on("input", () => { on_occurance_edit("seats") });
$("#fee").on("input", () => { on_occurance_edit("fee") });
$("#end_date").on("input", () => { on_occurance_edit("end_date") });
$("#start_date").on("input", () => { on_occurance_edit("start_date") });
$("#end_time").on("input", () => { on_occurance_edit("end_time") });
$("#start_time").on("input", () => { on_occurance_edit("start_time") });
$("#pickup_loc").on("input",()=> {on_occurance_edit("pickup_loc")});
$("#dropoff_loc").on("input",()=> {on_occurance_edit("dropoff_loc")});

// Variables for the fields
let tour_name_field = document.getElementById("tour_name");
let tour_description_field = document.getElementById("description_field");
// let tour_image_field = document.getElementById("");
// let tour_activity_field = document.getElementById("");
var added_activities_list = document.getElementById("selected-activities");
// Holds the list of locations and their associated activities
var location_activity_set = {} //{location : {activity_id, activity_name}}
// the location whose activites are shown on the main form
var active_location_name = "";


//text fields for occurances
const seats_txt_field = document.getElementById("seats")
const fee_txt_field =document.getElementById("fee");
const end_date_txt_field = document.getElementById("end_date");
const start_date_txt_field = document.getElementById("start_date");
const end_time_txt_field = document.getElementById("end_time");
const start_time_txt_field = document.getElementById("start_time");
const pickup_txt_field = document.getElementById("pickup_loc");
const dropoff_txt_field = document.getElementById("dropoff_loc");
const hidden_occurance_id = document.getElementById("hidden_occurance_id");






// script to prefill the page if a trip id is in the url (User wants to update tour information)
$(document).ready (()=>{
	if(window.location.search.includes("id")){
		const campaign_id = url_params("id");
		if(campaign_id){
			//TODO:: show loader while running
			populate_campaign_form(campaign_id);
		}

		//get trip information from database
		// image displays
	}
});

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
			"action" : url_params("id") ? "edit_campaign": "create_campaign",
			"campaign_id" : url_params("id"),
			"images": images,
			"title" : title,
			"curator_id" : curator_id,
			"description" : description,
			"trips" : JSON.stringify(occurances),
			"activities" : JSON.stringify(location_activity_set)
		},
		(response) => {
			console.log(response);
			openDialog(response.data.msg);
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
		case "start_date":
			update_active_row("start_val", element.value);
			break;
		case "end_time":
			update_active_row("end_time_val",element.value);
			break;
		case "start_time":
			update_active_row("start_time_val",element.value);
			break;
		case "pickup_loc":
			update_active_row("pickup_val", element.value);
			break;
		case "dropoff_loc":
			update_active_row("dropoff_val", element.value);
			break;
	}
	//if not create one and in real time edit the value
	// if there is edit the respective field
}

function update_active_row(section, value) {
	var disVal = "";
	if(hidden_occurance_id.value != ""){
		var active = document.getElementById(hidden_occurance_id.value).parentNode;
	}else{

		var active = document.getElementById("active_occurance_row");
	}


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




function delete_occurance_entry(element) {
	if(confirm("Are you sure you want to remove this tour?")){
		element.parentNode.parentNode.parentNode.remove();
	}
}
 function prefill_occurance_field(seats,fee,end_date,start_date,end_time,start_time,pickup,dropoff){
	seats_txt_field.value = seats;
	fee_txt_field.value = fee;
	end_date_txt_field.value = end_date;
	start_date_txt_field.value = start_date;
	end_time_txt_field.value = end_time;
	start_time_txt_field.value = start_time;
	pickup_txt_field.value = pickup;
	dropoff_txt_field.value = dropoff;
 }

function edit_occurance_entry(element) {
	let occurance_element = element.parentNode.parentNode;
	remove_active_row();
	function get_value(obj,classname) {
		return obj.getElementsByClassName(classname)[0].innerText;
	}

	// console.log("Id",occurance_element.id);
	// prefill the occurance text fields with the values for the tour
	seats_txt_field.value = get_value(occurance_element,"seats_val");
	fee_txt_field.value = get_value(occurance_element,"fee_val");
	end_date_txt_field.value = get_value(occurance_element,"end_val");
	start_date_txt_field.value = get_value(occurance_element,"start_val");
	end_time_txt_field.value = get_value(occurance_element,"end_time_val");
	start_time_txt_field.value = get_value(occurance_element,"start_time_val");
	pickup_txt_field.value = get_value(occurance_element.parentNode,"pickup_val");
	dropoff_txt_field.value = get_value(occurance_element.parentNode,"dropoff_val");
	hidden_occurance_id.value = occurance_element.id;


	//move window to #group-tours
	window.location.href = "#group-tour";

}



//returns a bool for if all the tour occurance information has been filled
function is_occurance_entry_complete() {
	String.prototype.isEmpty = function () {
		return (this.length == 0 || !this.trim());
	}
	var start = start_date_txt_field.value;
	var end = end_date_txt_field.value;
	var fee = fee_txt_field.value;
	var seats = seats_txt_field.value;
	var pickup = pickup_txt_field.value;
	var dropoff = dropoff_txt_field.value;

	return !(start.isEmpty() && end.isEmpty() && fee.isEmpty() && seats.isEmpty()&& pickup.isEmpty()&& dropoff.isEmpty());
}

//Creates a row for a new occurance entry
function create_active_row(tour_id = null) {
	var collection = document.getElementById("occurance_list");

	let id_text = tour_id ? `id='${tour_id}'` : "";

	var addButton = document.getElementById("add_button");
	var newNode = document.createElement("div");
	newNode.setAttribute("id", "active_occurance_row")
	newNode.innerHTML =
	"<div class='list-item' "+id_text+">\
		<div class='inner-item start_val'> </div> \
		<div class='inner-item start_time_val'> </div> \
		<div class='inner-item end_val'> </div> \
		<div class='inner-item end_time_val'> </div> \
		<div class='inner-item  fee_val'> </div> \
		<div class='inner-item seats_val'> </div> \
		<div class='inner-item col'> \
			<div class='inner-item fa fa-edit' onclick='edit_occurance_entry(this)'></div> \
			<div class='inner-item fa fa-trash' onclick='delete_occurance_entry(this)'></div> \
		</div>\
	</div>\
	<div>\
		<p class='easygo-fs-5' style='margin-top:0px'>\
			pickup location: <span style='margin-right: 16px' class='pickup_val'></span>\
			drop-off location: <span class='dropoff_val'></span>\
		</p>\
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
	if(hidden_occurance_id.value == ""){
		if(document.getElementById("active_occurance_row") != null){
			document.getElementById("active_occurance_row").removeAttribute("id");
		}
	}else{
			document.getElementById("active_occurance_row").setAttribute("id",hidden_occurance_id.value);
	}
}


//Removes the values in the textfields for trip occurances
function clear_occurance_fields() {
	start_date_txt_field.value = "";
	seats_txt_field.value = "";
	fee_txt_field.value = "";
	end_date_txt_field.value = "";
	start_time_txt_field.value = "";
	end_time_txt_field.value = "";
	dropoff_txt_field.value = "";
	pickup_txt_field.value = "";
	hidden_occurance_id.value = "";
}


// Returns the values for all entered occurances as a list of json
function get_occurance_entries(occurance_id = null) {
	var array = [];
	var collection = document.getElementById("occurance_list");
	if(occurance_id){
		values = get_occurance_row_values(document.getElementById(occurance_id));
		array.push(values);
	}else{

		for (index = 1; index < collection.children.length - 1; index++) {
			var child = collection.children[index];
			var values = get_occurance_row_values(child);
			array.push(values);
		}
	}
	return array;
}


//Reads the row element{element} and returns as a map the values for that occurance
function get_occurance_row_values(element) {
	return {
		"start_date": changeToDateTimestr(element.children[0].getElementsByClassName("start_val")[0].innerText,  element.children[0].getElementsByClassName("start_time_val")[0].innerText),
		"end_date": changeToDateTimestr(element.children[0].getElementsByClassName("end_val")[0].innerText,  element.children[0].getElementsByClassName("end_time_val")[0].innerText),
		"fee": element.children[0].getElementsByClassName("fee_val")[0].innerText,
		"seats": element.children[0].getElementsByClassName("seats_val")[0].innerText,
		"pickup" : element.children[1].getElementsByClassName("pickup_val")[0].innerText,
		"dropoff" : element.children[1].getElementsByClassName("dropoff_val")[0].innerText,
		"tour_id" : element.children[0].id
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

function add_selected_destination(destination_name){
	var selected_location_list = document.getElementById("selected-locations");
	var add_location = true;

	for (var loc_index = 0; loc_index < selected_location_list.children.length; loc_index++){
		var child = selected_location_list.children[loc_index];
		if (child.innerText == destination_name){
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
		newNode.innerText = destination_name;
		selected_location_list.appendChild(newNode);
	}
}


function add_location_activity() {
	//filling location section of page
	var location_name = document.getElementById("location-info-title").innerText;

	//filling activity section of page
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
			create_selected_destination_activity_span(element.id,element.innerText, location_name);
		}


	};


	$(".activity-span-selected").on("click", selectedActivityClick);
}

function create_selected_destination_activity_span(activity_id,activity_name,location_name){

	add_selected_destination(location_name);

	var newNode = document.createElement("span");
	newNode.setAttribute("id", activity_id);
	newNode.setAttribute("class", "px-3 py-1 border-blue rounded border easygo-fs-5 text-capitalize activity-span-selected");
	// newNode.setAttribute("onclick", "selectedActivityClick()");
	newNode.innerText = activity_name;
	added_activities_list.appendChild(newNode);
	if(!location_activity_set[location_name]){
		location_activity_set[location_name] = {};
	}

	location_activity_set[location_name][activity_id] = activity_name;
}

// Sets the location whose activites are shown

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


function fill_occurance_fields(seats,fee,end_date,start_date,pickup_loc,dropoff_loc,tour_id){
	seats_txt_field.value = seats;
	fee_txt_field.value = fee;
	end_date_txt_field.value = end_date.split(" ")[0];
	start_date_txt_field.value = start_date.split(" ")[0];
	end_time_txt_field.value = end_date.split(" ")[1];
	start_time_txt_field.value = start_date.split(" ")[1];
	pickup_txt_field.value = pickup_loc;
	dropoff_txt_field.value = dropoff_loc;
	document.getElementById("tour_id").value = tour_id;
	["seats","fee","end_date","start_date","end_time","start_time","pickup_loc","dropoff_loc"].forEach(value => {
		on_occurance_edit(value);
	});
}

function populate_campaign_form(campaign_id){
	send_request("POST",
	"processors/processor.php",
	{
		"action" : "get_campaign",
		"campaign_id" : campaign_id
	},
	(response)=>{
		// console.log(response);
		const campaign = response.data.campaign;
		const activities = campaign.activities;
		tour_name_field.value = campaign.title;
		tour_description_field.value = campaign.description;

		//insert tours
		console.log(campaign);
		campaign.tours.forEach(element => {
			create_active_row(element.tour_id)
			prefill_occurance_field(element.seats_available,element.fee,element.end_date.split(" ")[0],element.start_date.split(" ")[0],element.end_date.split(" ")[1],element.start_date.split(" ")[1],element.pickup_location,element.dropoff_location);
			["seats","fee","end_date","start_date","end_time","start_time","pickup_loc","dropoff_loc"].forEach(value =>{
				on_occurance_edit(value);
			});
			add_new_occurance();

		});

		activities.forEach(element => {
			create_selected_destination_activity_span(element.activity_id,element.activity_name,element.destination_name);
		});

		// tripimages_upload_display.addItemsToAltDisplay(campaign.images);
		//TODO:: update image class to display files from the web

		//remove the active row
		document.getElementById("active_occurance_row").remove();

		document.getElementById("submit_btn").innerText = "Update Tour";
	}
	);
}