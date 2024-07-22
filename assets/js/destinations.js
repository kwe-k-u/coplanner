
const modal_activities_div = document.getElementById("modal-activities-div");
const destination_modal = document.getElementById("destination-modal");
const bs_info_bar = document.getElementById("bottom-selection-info");

document.addEventListener("click", day_button_clicked);

// function show_destination_modal(button){
// 	// document.getElementById();
// 	let modal = button.getAttribute("data-target");

// 	document.getElementById(modal).style.display = "block";
// }

// function hide_destination_modal(button){
// 	let modal = document.getAnimations("data-target");
// 	document.getElementById(modal).style.display = "none";
// }


function populate_destination_modal(button){
	let destination_id = button.getAttribute('data-destination-id');
	send_request("POST",
		"processors/processor.php/get_destination_info?id="+destination_id,
		{},
		(response)=> {
			if (response.status == 200){
				console.log(response.data.data);
				update_modal(response.data.data);
			}else{
				showDialog("Something went wrong");
			}
		}
	);
}

function update_modal(data){
	document.getElementById("destination-name").innerText = data.destination_name;
	document.getElementById("destination-location").innerText = data.location;
	let activities = data.activities;
	document.getElementById("destination-modal").setAttribute("data-destination-id",data.destination_id);
	modal_activities_div.replaceChildren([]);
	//reset activity pills
	document.getElementById
	activities.forEach(element => {
		console.log(element.activity_id,element.activity_name);
		create_modal_activity_button(element.activity_name,element.activity_id);
	});
}

function create_modal_activity_button(activity_name,activity_id){
	let checkbox = document.createElement("input");
	checkbox.type = "checkbox";
	checkbox.className = "btn-check";
	checkbox.name = "activity";
	checkbox.id = "checkbox-for-"+activity_id;

	let label = document.createElement("label");
	label.className = "btn btn-outline-primary pill-select-option";
	label.setAttribute('for', "checkbox-for-"+activity_id);
	label.innerText = activity_name;


	modal_activities_div.appendChild(checkbox);
	modal_activities_div.appendChild(label);
}

function destination_modal_confirm(){
	modal_activities_div.children;
	const checkedActivities = Array.from(modal_activities_div.children)
		.filter(child => child.tagName === 'INPUT' && child.checked)
		.map(checkbox => checkbox.getAttribute('id').replace('checkbox-for-', ''));
	console.log(checkedActivities);
	if(checkedActivities == []){
		return;
	}
	let destination_id = destination_modal.getAttribute("data-destination-id");
	let experience_id = url_params("experience_id");
	let request_url=null;
	let day = document.getElementById("day-buttons").getElementsByClassName("outline-btn")[0].getAttribute("data-day-id");
	let payload = {
		"destination_id" : destination_id,
		"activities" : checkedActivities,
		"day": day
	}
	if(url_params("experience_id")){
		payload["experience_id"] = experience_id;
		request_url = "processors/processor.php/add_experience_activities";

	}else if (url_params("travel_plan_id")){
		payload["travel_plan_id"] = url_params("travel_plan_id");
		request_url = "processors/processor.php/add_travel_plan_activity";
	}
	// console.log(payload);
	bs_info_bar.style.display = "flex";
	send_request("POST",
		request_url,
		payload,
		(response)=> {
			if(response.status == 200){
				console.log(response.data);
				showToast(response.data.msg);
			}else{
				openDialog(response.data.msg);
			}
		}
	);
}



//Adds an extra day to the shared experience and triggers
// the add_day_cosmetic function to make the UI changes
function add_day(){
	let day_buttons = document.getElementById("day-buttons");
	let count = day_buttons.children.length;
	let prev_day_btn = day_buttons.children[day_buttons.children.length - 2];
	let prev_day = prev_day_btn.getAttribute("data-day-id");
	let next_day = null;
	if(url_params("experience_id")){
		next_day = new Date(prev_day);
		next_day.setDate(next_day.getDate()+1);
		next_day = next_day.toISOString().slice(0, 19).replace("T", " ");
	}else{
		next_day = count;
	}


	//disable the previous day button
	for (let index = 0; index < day_buttons.children.length-1; index++) {
		const child = day_buttons.children[index];
		if(child.classList.contains("outline-btn")){
			child.classList.remove("outline-btn");
			child.classList.add("no-outline-btn");
			break;
		}

	}

	//Add a button to the button row for days
	let new_button = document.createElement("button");
	new_button.classList = "btn outline-btn";
	new_button.innerText = "Day "+count.toString();
	new_button.setAttribute("data-day-id",next_day);
	day_buttons.insertBefore(new_button, day_buttons.children[day_buttons.children.length - 1]);

	//resets and hides the bottom bar
	document.getElementById("bs-day-label").innerText = new_button.innerText;
	bs_info_bar.style.display = "none";
}




function filter_destinations(input){
	const query = input.value.toLowerCase();
	const destinationElements = document.getElementById("destination-list").getElementsByClassName("card");

	for (let i = 0; i < destinationElements.length; i++) {

		const destinationName = destinationElements[i].getElementsByClassName("card-title")[0].innerText.toLowerCase();
		if (query === "" || destinationName.includes(query)) {
			destinationElements[i].style.display = "block";
		} else {
			destinationElements[i].style.display = "none";
		}
	}
}


function day_button_clicked(){

	const clickedButton = event.target;
	const dayId = clickedButton.getAttribute("data-day-id");

	if(dayId){

		//change the focus on the buttons
		buttons = document.getElementById("day-buttons").children;

		for (let index = 0; index < buttons.length-1; index++) {
			let current_button = buttons[index];
			current_button.classList.remove("outline-btn");
			if(current_button.getAttribute("data-day-id")==dayId){
				current_button.classList.add("outline-btn");
			}
		}

		console.log('update days'+ dayId);
		if(url_params("experience_id")){
			send_request("POST",
				"processors/processor.php/get_shared_experience_activities_by_day",
				{
					"day" : dayId,
					"experience_id" : url_params("experience_id")
				},
				(response)=> {
					console.log(response);
				}
			);
		}else{
			// send_request("POST","processors/processor.php/add")
		}
	}
}



function notify_no_destination(curator_name){
	send_request("POST",
		"processors/processor.php/notify_no_destination",
		{
			"curator_name" : curator_name
		},
		(response)=> {
			if(response.status == 200){
				showToast(response.data.msg);
			}else{
				openDialog(response.data.msg);
			}
		}
	)
}