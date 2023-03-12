
//===================================================================================
// 			Functions for Occurance sections
//Track changes to fields and update the corresponding row item
$("#seats").on("input", () => { on_occurance_edit("seats") });
$("#fee").on("input", () => { on_occurance_edit("fee") });
$("#end_date").on("input", () => { on_occurance_edit("end_date") });
$("#start_date").on("input", () => { on_occurance_edit("start_date") });



  function submit_tour(){
	var form = document.getElementById("create_trip_form");
	var title = form.title;
	var description = form.description;
	// var locations = [];
	var activities = [];
	var occurances = get_occurance_entries();
	var images = tripimages_upload_display.getFiles();// + flyerimage_upload_displayflyerimage_upload_display.getFiles();



	// alert("title "+ title);
	// alert("description "+ description);
	// alert("occurances "+ occurances);
	// alert("images "+ images);

	send_request(
		"POST",
		"test/test.php",
	{"images" : images},
	(response) => {
		alert(response["data"]);
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
	}
	//if not create one and in real time edit the value
	// if there is edit the respective field
}

function update_active_row(section, value) {
	var active = document.getElementById("active_occurance_row");
	active.getElementsByClassName(section)[0].innerHTML = value;
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
	newNode.setAttribute("id","active_occurance_row")
	newNode.classList.add("list-item");
	newNode.innerHTML = "<div class='inner-item start_val'> </div> \
	<div class='inner-item end_val'> </div> \
	<div class='inner-item  fee_val'> </div> \
	<div class='inner-item seats_val'> </div> \
	<div class='inner-item row'> \
		<div class='inner-item fa fa-edit' onclick='edit_occurance_entry(this)'></div> \
		<div class='inner-item fa fa-trash' onclick='delete_occurance_entry(this)'></div> \
	</div>";

	collection.insertBefore(newNode, addButton);
}


//Creates an occurance row with the values passed
function create_entry_row(start, end, fee, seats) {

	var collection = document.getElementById("occurance_list");
	var addButton = document.getElementById("add_button");
	var newNode = document.createElement("div");
	newNode.classList.add("list-item");
	newNode.innerHTML = "<div class='inner-item start_val'>" + start + "</div> \
	<div class='inner-item end_val'>"+ end + "</div> \
	<div class='inner-item  fee_val'>" + fee + "</div> \
	<div class='inner-item seats_val'>" + seats + "</div> \
	<div class='inner-item row'> \
		<div class='inner-item' onclick='edit_occurance_entry(this)'>d</div> \
		<div class='inner-item' onclick='delete_occurance_entry(this)'>e</div> \
	</div>";

	collection.insertBefore(newNode, addButton);

}

function add_new_occurance(){
	//check if all entries are filled
	if(is_occurance_entry_complete()){
		remove_active_row();
		create_active_row();
		clear_occurance_fields();
	}else { // display error if some fields are incomplete
		alert("Ensure that you have provided values for all the occurace fields before adding a new one");
	}

}

//Disables the active row
function remove_active_row(){
	document.getElementById("active_occurance_row").removeAttribute("id");
}


//Removes the values in the textfields for trip occurances
function clear_occurance_fields(){
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
	}

	return array;
}


//Reads the row element{element} and returns as a map the values for that occurance
function get_occurance_row_values(element) {
	return {
		"start_date": element.getElementsByClassName("start_val")[0].innerHTML,
		"end_date": element.getElementsByClassName("end_val")[0].innerHTML,
		"fee": element.getElementsByClassName("fee_val")[0].innerHTML,
		"seats": element.getElementsByClassName("seats_val")[0].innerHTML,
	};

}






//===================================================================================
// 			Functions for activity sections

$(".activity-span").on("click", activity_click);

$(".image-collection").on("click", showRecentList);

$(".activity-span-selected").on("click", selectedActivityClick);




//Changes the display to show the images within the clicked collection
function showRecentList(element){
	get_collection();

	function get_collection(){
		alert(element.target);
	}

}




function activity_click(element){
	if (element.target.classList.contains("easygo-btn-1")){
		activity_deselect(element);
	}else {
		activity_select(element);
	}
}


function activity_select(element){
	// document.getElementById().
	element.target.classList.add("easygo-btn-1");
	var parent = element.target.parentElement;
	//remove selected node from consideration
	parent.removeChild(element.target);
	var next = null;

	//determine position of clicked activity
	for(index = 0; index < parent.children.length; index++){
		var child = parent.children[index];
		if (!child.classList.contains("easygo-btn-1")){
			next = child;
			break;
		}
	}

	//make insertion
	if(next == null){
		parent.appendChild(element.target);
	}else {
		parent.insertBefore(element.target,next);
	}
}


function activity_deselect(element){
	// document.getElementById().classList;
	element.target.classList.remove("easygo-btn-1");
	var parent = element.target.parentElement;
	//remove selected node from consideration
	parent.removeChild(element.target);
	var next = null;

	//determine position of clicked activity
	for(index = 0; index < parent.children.length; index++){
		var child = parent.children[index];
		if (!child.classList.contains("easygo-btn-1")){
			next = child;
			break;
		}
	}

	//make insertion
	if(next == null){
		parent.appendChild(element.target);
	}else {
		parent.insertBefore(element.target,next);
	}
}



function on_location_expand(id){
	var title = document.getElementById("location-info-title");
	var description = document.getElementById("location-info-desc");

	var payload ={
		"action" : "get_site_by_id",
		"toursite_id" : id
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

			title.innerText = json["site_name"];
			description.innerText = json["toursite_description"];

			reset_location_info_images(image_list);
			reset_location_info_activities(activity);
			$(".activity-span").on("click", activity_click);
		}
	);


}


function reset_location_info_images(images){
	var image_div = document.getElementById("location-info-images")
	var full_body = "";


	images.forEach(image_source => {
		full_body += "<div class='grid-item'> \
		<img class='w-100 h-100 rounded' src='"+image_source+"' alt='scene 1'> \
	</div>";
	});

	image_div.innerHTML = full_body;
}


function reset_location_info_activities(activities){
	// alert(activities[0]["activity_name"]);
	var activity_div = document.getElementById("activity-list-div");
	var full_body = "";


	for(index=0; index < activities.length; index++){
		var value = activities[index]["activity_name"];
		var key = activities[index]["activity_id"];
		full_body += "<span id='"+key+"' class='px-3 py-1 border-blue rounded border easygo-fs-5 text-capitalize activity-span'>"+value+"</span>";
	}
	activity_div.innerHTML = full_body;
}

function location_search_submit(form){
	event.preventDefault();
	var query = form.query.value;
	var type = get_dropdown_value("location_search_filter");

	// payload = "action=query_site";
	// payload += "&query="+query;
	// payload += "&type="+type;
	let payload = {
		"action" : query_site,
		"query" : query,
		"type" : type
	};

	send_request("POST",
	'processors/processor.php',
	payload,
	(response) => {
		alert(response);
	}
	);


}




function add_location_activity(){
	//filling location section of page
	// var selected = document.getElementById("selected-locations");
	// for(var index = 0; index <document.getElementById("activity-list-div").children.length; index ++){
	// 	var element = document.getElementById("activity-list-div").children[index];
	// 	if (element.classList.contains("easygo-btn-1")){
	// 		var newNode = document.createElement("span");
	// 		newNode.setAttribute("id",element.id);
	// 		newNode.setAttribute("class","px-3 py-1 border-blue rounded border easygo-fs-5 text-capitalize activity-span-selected");
	// 		// newNode.setAttribute("onclick", "selectedActivityClick()");
	// 		newNode.innerText = element.innerText;
	// 		selected.appendChild(newNode);
	// 	}

	// };

	//filling activity section of page
	var selected = document.getElementById("selected-activities");
	for(var index = 0; index <document.getElementById("activity-list-div").children.length; index ++){
		var element = document.getElementById("activity-list-div").children[index];
		if (element.classList.contains("easygo-btn-1")){
			var newNode = document.createElement("span");
			newNode.setAttribute("id",element.id);
			newNode.setAttribute("class","px-3 py-1 border-blue rounded border easygo-fs-5 text-capitalize activity-span-selected");
			// newNode.setAttribute("onclick", "selectedActivityClick()");
			newNode.innerText = element.innerText;
			selected.appendChild(newNode);
		}

	};


$(".activity-span-selected").on("click", selectedActivityClick);
}

function create_location_tile(map){
	var title = map["site_name"];
	var location = map["site_location"];
	var id = map["toursite_id"];
}


function selectedActivityClick(element){
	if(confirm("Remove Activity from list?")){
		document.getElementById("selected-activities").removeChild(element.target);
	}
}