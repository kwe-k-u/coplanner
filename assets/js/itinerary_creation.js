const selected_dropdown_label = document.getElementById("selected-dropdown-label");
const destination_search_results = document.getElementById("destination-search-results");
const itinerary_card_activity_list = document.getElementById("itinerary-card-activity-list");


$(document).ready(function() {
    $('#day-dropdown-options').on('click', 'li', function (){

		// If the day option is selected add a new day label
		if(event.target.classList.contains("add-day-option")){
			add_day();
		}else{ //if a day label is selected, move the 'selected' span to that option
			//TODO
			moveSpanToClickedListItem(); // make return the day id of the selected li
			switch_current_day() // insert into a function that gets the day info and populates the itinerary_card
		}
	});
});



// Creates an option element to be placed in the add day drop down
function create_day_dropdown_option(day_id = null){
	// Create outer list item
	let option = document.createElement("li");
	if(day_id != null){
		option.id = "day_label_"+day_id
	}
	option.className = "px-2 d-flex align-items-center";

	// Create anchor element to hold spans
	let anchor = document.createElement("a");
	anchor.className = "dropdown-item d-flex gap-1 align-items-center border-bottom  border-blue";
	anchor.href = "#";
	// First span for drag icon
	let firstSpan = document.createElement("span");
	firstSpan.className = "text-blue me-1";
	// Drag icon
	let dragIcon = document.createElement("li");
	dragIcon.className = "fa-solid fa-ellipsis-vertical";
	//Second Span for Day Text
	let secondSpan = document.createElement("span");
	secondSpan.className = "me-3 day-span";
	//Add day text to second span
	secondSpan.innerText = "Day New";

	//Add drag icon to first span
	firstSpan.appendChild(dragIcon);
	firstSpan.appendChild(dragIcon.cloneNode());
	//Add spans to anchor
	anchor.append(firstSpan,secondSpan);
	//Add anchor to list item
	option.appendChild(anchor)

	return option;
}


//Creates the card to display selected itinerary destinations and activities
function create_itinerary_card_item(des_id,name,activities, action_required = false){
	let card = document.createElement("li");
	card.id = "destination_"+des_id;
	//div at the bottom of the card to show activities
	let activity_div = document.createElement('div');

	// The row to hold all the inner elements
	let top_row = document.createElement("div");
	top_row.className = "row";

	// Left most section to show destination name
	let destination_col = document.createElement("div");
	destination_col.className = "col-4";
	let name_h5 = document.createElement("h5");
	name_h5.innerText = name;
	// Expected time
	let time_p = document.createElement("p");
	time_p.className = "easygo-fs-5";
	time_p.innerText = "8:00 AM";
	//Add the children for the name column
	destination_col.append(name_h5);
	destination_col.append(time_p);
	// Show activity icon if there is one
	if(action_required){
		let action_button = document.createElement("button");
		action_button.className = "border-0 bg-transparent";
		let action_icon = document.createElement("svg");
		action_icon.width = "30";
		action_icon.height = "30";
		action_icon.fill = "none";
		action_icon.xmlns = "http://www.w3.org/2000/svg";
		action_icon.viewBox = "0 0 34 34";
		action_icon.innerHTML = '<path d="M28.3333 24.0835C29.8917 24.0835 31.1667 22.8085 31.1667 21.2502V5.66683C31.1667 4.1085 29.8917 2.8335 28.3333 2.8335H13.4583C13.8833 3.6835 14.1667 4.67516 14.1667 5.66683H28.3333V21.2502H15.5833V24.0835M21.25 9.91683V12.7502H12.75V31.1668H9.91667V22.6668H7.08333V31.1668H4.25V19.8335H2.125V12.7502C2.125 11.1918 3.4 9.91683 4.95833 9.91683H21.25ZM11.3333 5.66683C11.3333 7.22516 10.0583 8.50016 8.5 8.50016C6.94167 8.50016 5.66667 7.22516 5.66667 5.66683C5.66667 4.1085 6.94167 2.8335 8.5 2.8335C10.0583 2.8335 11.3333 4.1085 11.3333 5.66683ZM24.0833 8.50016H26.9167V19.8335H24.0833V8.50016ZM19.8333 14.1668H22.6667V19.8335H19.8333V14.1668ZM15.5833 14.1668H18.4167V19.8335H15.5833V14.1668Z" fill="#1204B5" />';
		action_button.appendChild(action_icon);
		destination_col.appendChild(action_button);
	}

	//Main body elements
	let main_col = document.createElement("div");
	main_col.className = "col-8";
	//image row
	let image_row = document.createElement("div");
	image_row.className = "row";
	//Create and append image elements
	for (let i = 0; i <3; i++) {
		let image_col = document.createElement("div");
		image_col.className = "col-4";
		let image_element = document.createElement("img");
		image_element.className = "img-fluid";
		image_element.src = "../assets/images/others/tour2.jpg";
		//Append image
		image_col.appendChild(image_element);
		image_row.append(image_col);
	}

	//Activity description section
	let act_div = document.createElement("div");
	act_div.className = "mt-3";
	act_div.innerText = "Here is the summary of the activities and destinations selected for the day";
	//Add main body elements
	main_col.appendChild(image_row);
	main_col.appendChild(act_div);


	//Activity section of main body
	if(activities.length > 0){
		//Create activity cards
		activity_div.className = "itinerary-activities mt-2";
		activities.forEach(element => {
			let act_name = element["activity_name"];
			let act_id = element["activity_id"];
			let act_node = create_itinerary_card_acitivity_span(act_id,act_name);
			activity_div.appendChild(act_node);
		});
	}else{
		// Show add activity button
		activity_div.className = "add-activity-div py-2 bg-lblue-1 text-blue text-center";
		let anchor = document.createElement("a");
		anchor.href = "#";
		anchor.innerText = "--- Add Activities ---";
		activity_div.appendChild(anchor);
	}


	//Add the top row elements
	top_row.appendChild(destination_col);
	top_row.appendChild(main_col);
	card.appendChild(top_row);
	card.appendChild(activity_div);
	return card;

}


// Creates the card to display destination search result entries
function create_destination_search_result_card(id,name,location,rating,num_rating,activities = []){
	let card = document.createElement("div");
	card.className = "my-4 border border-1 border-blue rounded-1 overflow-hidden box-shadow-3";

	//Top section of card to show summary information
	let top = document.createElement("div");
	top.className = "p-3";

	//first part of top section to show
	let top_row = document.createElement("div");
	top_row.className = "row";
	let image_div = document.createElement("div");
	image_div.className = "col-5";
	let image_element = document.createElement("img");
	image_element.src = '../assets/images/others/tour2.jpg';
	image_element.className = "img-fluid";
	image_element.style = "max-height: 150px;";
	image_div.appendChild(image_element);
	top_row.appendChild(image_div);
	//info section of top div
	let info_section = document.createElement("div");
	info_section.className = "col-7";
	//destination name
	let name_h4 = document.createElement("h4");
	name_h4.className = "m-0";
	name_h4.innerText = name;
	info_section.appendChild(name_h4);
	//location
	let location_div = document.createElement("div");
	location_div.innerText = location;
	info_section.appendChild(location_div);
	//utilities
	let utility_div = document.createElement("div");
	utility_div.className = "text-blue easygo-fs-2 py-2";
	["fa-wifi","fa-bath","fa-person-swimming"].forEach((uti)=> {//todo app spacing between icons
		let icon = document.createElement("i");
		icon.className = "fa-solid "+uti;
		utility_div.appendChild(icon);
	})
	info_section.appendChild(utility_div);
	//ratings
	let rating_div = document.createElement("div");
	rating_div.innerText = rating+" stars from "+num_rating+" reviews";
	info_section.appendChild(rating_div);
	top_row.appendChild(info_section);
	top.appendChild(top_row);



	//second part of top section to show destination description
	let description = document.createElement("p");
	description.className = "my-3";
	description.innerText = "Here is the summary of the activities and destinations selected for the day";
	top.appendChild(description);


	//third part of top section to show activities
	let activity_section = document.createElement("div");
	activity_section.className = "d-flex justify-content-end";
	let inner_section = document.createElement("div");
	inner_section.className = "mt-2 easygo-fw-4 easygo-fs-2";
	activities.forEach((entry)=> {
		let act_name = entry["activity_name"];
		let act_id = entry['activity_id'];
		let span = document.createElement("span");
		span.className = "activityd badge bg-transparent border border-blue border-1 text-black py-2 px-3 mx-1";
		span.innerText = act_name;
		span.id = act_id;
		span.onclick = () =>add_activity_to_itineary_card(id,name,act_id,act_name);
		inner_section.appendChild(span);
	});
	activity_section.appendChild(inner_section);

	//append top elements
	top.appendChild(activity_section);


	// botttom section of card to show more destination information
	let bottom = document.createElement("div");
	bottom.className = "py-2 bg-lblue-1 text-blue text-center";
	let bottom_anchor = document.createElement("a");
	bottom_anchor.href = "#";
	bottom_anchor.innerText  = "--- View more ---";
	//show destination on anchor click
	// bottom_anchor.data-bs-target='#dest-1-modal'
	bottom_anchor.setAttribute("data-bs-target","#dest-1-modal");
	bottom_anchor.setAttribute("data-bs-toggle",'modal');
	bottom_anchor.onclick = update_destination_modal(id);

	bottom.appendChild(bottom_anchor);

	card.appendChild(top);
	card.appendChild(bottom);
	return card;
}











function get_day_info(day_id){
	send_request("GET",
	"processors/processor.php/get_day?day_id=" +day_id,
	{},
	(response)=>{
		console.log(response);
	});


}



function add_day(){
    let duplicate = null;
    let ul = document.getElementById("day-dropdown-options");
    let options = ul.children;

	send_request("POST",
	"processors/processor.php/add_itinerary_day",
	{"itinerary_id" : url_params("id")},
	(response)=> {
		ul.appendChild(create_day_dropdown_option(response.data.day_id));
	});

	return null;
    for (let i = 0; i < options.length; i++){
        let item_li = options[i];
        if (item_li.querySelector("#selected-dropdown-label") == null){
            duplicate = item_li.cloneNode(true);
            break;
        }
    }

    if (duplicate) {
		// change the day label
		// duplicate.querySelector(".day-span").text = "Day "+ul.children.length.toString();
		ul.insertBefore(duplicate,ul.childNodes[ul.childNodes.length-2])
    }
}







/**Moves the selected label in the day dropdown to the new day that was clicked */
function moveSpanToClickedListItem() {
    let selectedSpan = document.getElementById('selected-dropdown-label');

    // Check if the span exists
    if (selectedSpan) {
        // Find the <a> element within the <li> that was clicked
        let clickedListItem = event.target.closest('li');
		selected_day_id = clickedListItem.id.replace("mobile_day_label_","").replace("day_label_","");
        if (clickedListItem) {
            let anchorElement = clickedListItem.querySelector('a');

            // Remove the selected-span from its current position
            selectedSpan.parentNode.removeChild(selectedSpan);

            // Append the selected-span as a child of the <a> element within the clicked <li>
            anchorElement.appendChild(selectedSpan);

			//Change day displayed in main section of page
			let text = anchorElement.querySelector(".day-span").innerText;
			document.querySelectorAll(".selected-day-display").forEach((element)=>{
				element.innerText =  text;

			});
        }
    }
}



// Update the information displayed about budgets and number of participants
function update_quick_stats(budget,days,people){
	update_budget_display(budget);
	update_day_display(days);
	update_people_display(people);
}


/**Updates the estimated budget displayed for the itinerary across all relevant elements */
function update_budget_display(amount){
	document.querySelectorAll('.budget-span').forEach((span)=>span.textContent = amount.toString());
}


/**Updates the number of days displayed for the itinerary across all relevant elements */
function update_day_display(days){
	document.querySelectorAll('.day-span').forEach((span)=>span.textContent = days.toString());
}

/**Updates the number of participants displayed across all relevant elements */
function update_people_display(people){
	document.querySelectorAll('.people-span').forEach((span)=>span.textContent = people.toString());
}



function destination_search(form){
	event.preventDefault();
	send_request("GET","processors/processor.php/search_destination?query="+form.query.value,
	null,
	(response)=>{
		let destinations = response.data.results;
		destination_search_results.replaceChildren();
		destinations.forEach(element => {
			let name = element["destination_name"];
			let location = element["location"];
			let rating = element["rating"];
			let num_rating = element["num_ratings"];
			let activities = element["activities"];
			let id = element["destination_id"];
			let card = create_destination_search_result_card(id,name,location,rating,num_rating,activities);
			destination_search_results.appendChild(card);

		});
	});
	return false;
}


/**Updates the information in the destination modal with the destination matching the passed id */
function update_destination_modal(destination_id){
	send_request(
		"GET",
		"processors/processor.php/get_destination_info?id="+destination_id,
		{},
		(response)=> {
			let json = response.data.data;
			let name = json["destination_name"];
			let id = json["destination_id"];
			let activities = json["activities"];
			let utilities = json["utilities"];
			let rating = json["rating"];
			let location = json["location"];
			let rating_count = json["num_ratings"];
			document.getElementById("modal-destination-name").innerText = name;
			document.getElementById("modal-location").innerText = location;
			document.getElementById("modal-rating").innerText = rating;
			document.getElementById("modal-rating-count").innerText = rating_count;

			let modal_activity_list = document.getElementById("modal-activity-list");
			modal_activity_list.innerHTML = "";

			activities.forEach((entry)=> {
				let act_name = entry["activity_name"];
				let span = create_modal_activity_span(act_name);
				modal_activity_list.appendChild(span);
			});

		}
	);
}

// Creates a span to hold activity information in the destination modal
function create_modal_activity_span(activity_name){
	let span = document.createElement("span");
	span.className = "activity badge bg-transparent border border-blue border-1 text-black py-2 px-3";
	span.innerText = activity_name;
	return span;
}


//Creates the information that is displayed in the itinerary card when no destinations or activities exist for the selected date
function create_default_itinerary_list(){
	let li = document.createElement("li");
	li.id = "default-itinerary-list";
	let div = document.createElement("div");
	let h = document.createElement("h5");
	h.innerText = "Add a destination";
	let p = document.createElement("p");
	p.innerText= "Add a destination or an activity from the right to populate this section";
	div.appendChild(h);
	div.appendChild(p);
	li.appendChild(div);

	return li;
}


/** Clears the destination information in the itinerary card
 * and displays the default 'add destination' text if the text is the detected */
function reset_itinerary_card(){
	if(itinerary_card_activity_list.querySelector("#default-itinerary-list") == null){
		itinerary_card_activity_list.replaceChildren([]);
		itinerary_card_activity_list.appendChild(create_default_itinerary_list());
	}
}




/**Adds an activity to the current day that has been selected. Creates the destination card in the itinerary list
 *  if the destination isn't in the card */
function add_activity_to_itineary_card(destination_id, destination_name, activity_id,activity_name){
	let destination_card = itinerary_card_activity_list.querySelector("#destination_"+destination_id);
	// Create itinerary activity card if it doesn't exist in the itinerary list
	if (!destination_card){
		destination_card = create_itinerary_card_item(destination_id,destination_name,[{activity_id,activity_name}]);
		if(itinerary_card_activity_list.querySelector("#default-itinerary-list") != null){
			itinerary_card_activity_list.replaceChildren([]);
		}
		itinerary_card_activity_list.appendChild(destination_card);

		add_itinerary_activity(selected_day_id,activity_id,destination_id)
	}else{
		// if destination exists in the current day list, add the activity to it
		let activity_section = destination_card.querySelector(".itinerary-activities");
		let activity_span = create_itinerary_card_acitivity_span(activity_id,activity_name);
		// If there are no added activities for the destination_card, structure section to receive activities
		if (!activity_section){
			activity_section = destination_card.querySelector(".add-activity-div");
			activity_section.className = "itinerary-activities mt-2";
			activity_section.replaceChildren([]);
		}
		if(activity_section.querySelector("#activity_"+activity_id)){
			alert("You've already added this activity for this destination on this day");
		}else{
			activity_section.appendChild(activity_span);
			//come back
			add_itinerary_activity(selected_day_id,activity_id,destination_id)
		}


	}


}

/**Creates the activity labels that shows the selected activities for a destination
 * in the itinerary card
 */
function create_itinerary_card_acitivity_span(id,name){
	let span = document.createElement("span");
	span.className = "badge bg-blue easygo-fw-3 px-4 py-2 mx-1";
	span.innerText = name;
	span.id = "activity_"+id;
	return span;
}


function update_itinerary_name(text){
	const itinerary_id = url_params("id");
	send_request("POST",
	"processors/processor.php/update_itinerary_name",
	{
		"itinerary_id" : itinerary_id,
		"new_name" : text
	},
	(response)=> {

	}
	);
}


function add_itinerary_activity(day_id,activity_id,destination_id){
	console.log('adding activity');
	send_request("POST",
	"processors/processor.php/add_itinerary_activity",
	{
		"destination_id" : destination_id,
		"activity_id" : activity_id,
		"day_id" : day_id
	},
	(response)=>{
		console.log(response);
	}
	);
}

function switch_current_day(){
	reset_itinerary_card();
	send_request("GET",
	"processors/processor.php/get_day_info?day_id="+selected_day_id,
	{},
	(response)=> {
		// console.log(response.data.result["destinations"]);
		let destinations = response.data.result.destinations;
		if(destinations.length != 0){
			itinerary_card_activity_list.replaceChildren([]);
		}
		destinations.forEach((e)=> {
			let card = create_itinerary_card_item(e.destination_id,e.destination_name,e.activities);
			itinerary_card_activity_list.appendChild(card);
		});
	}
	);
}