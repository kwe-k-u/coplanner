
//===================================================================================
// 			Functions for Occurance sections
//Track changes to fields and update the corresponding row item
$("#seats").on("input", () => { on_occurance_edit("seats") });
$("#fee").on("input", () => { on_occurance_edit("fee") });
$("#end_date").on("input", () => { on_occurance_edit("end_date") });
$("#start_date").on("input", () => { on_occurance_edit("start_date") });



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
		<div class='inner-item' onclick='edit_occurance_entry(this)'>d</div> \
		<div class='inner-item' onclick='delete_occurance_entry(this)'>e</div> \
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

