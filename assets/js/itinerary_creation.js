const selected_dropdown_label = document.getElementById("selected-dropdown-label");
const destination_search_results = document.getElementById("destination-search-results");

$(document).ready(function() {
    $('#day-dropdown-options').on('click', 'li', function (){

		// If the day option is selected add a new day label
		if(event.target.classList.contains("add-day-option")){
			add_day();
		}else{ //if a day label is selected, move the 'selected' span to that option
			moveSpanToClickedListItem();
		}
	});
});



// Creates an option element to be placed in the add day drop down
function create_day_dropdown_option(){
	// Create outer list item
	let option = document.createElement("li");
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
function create_itinerary_day_item(activities = ["Hike","Run","Swim"], action_required = false){
	let card = document.createElement("li");
	//div at the bottom of the card to show activities
	let activity_div = document.createElement('div');

	// The row to hold all the inner elements
	let top_row = document.createElement("div");
	top_row.className = "row";

	// Left most section to show destination name
	let destination_col = document.createElement("div");
	destination_col.className = "col-4";
	let name_h5 = document.createElement("h5");
	name_h5.innerText = "Destination Name";
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
		activity_div.className = "mt-2";
		let activity_span = document.createElement('span');
		activity_span.className = "badge bg-blue easygo-fw-3 px-4 py-2 mx-1";
		activities.forEach(act_name => {
			let act_node = activity_span.cloneNode();
			act_node.innerText = act_name;
			activity_div.appendChild(act_node);
		});
	}else{
		// Show add activity button
		activity_div.className = "py-2 bg-lblue-1 text-blue text-center";
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
function create_destination_search_result_card(name,location,rating,num_rating,activities = []){
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
		let span = document.createElement("span");
		span.className = "activity badge bg-transparent border border-blue border-1 text-black py-2 px-3 mx-1";
		span.innerText = act_name;
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

	ul.appendChild(create_day_dropdown_option());
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

function update_budget_display(amount){
	document.querySelectorAll('.budget-span').forEach((span)=>span.textContent = amount.toString());
}


function update_day_display(days){
	document.querySelectorAll('.day-span').forEach((span)=>span.textContent = days.toString());
}


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
			console.log(element);
			let name = element["destination_name"];
			let location = element["location"];
			let rating = element["rating"];
			let num_rating = element["num_ratings"];
			let activities = element["activities"];
			let card = create_destination_search_result_card(name,location,rating,num_rating,activities);
			destination_search_results.appendChild(card);

		});
	});
	return false;
}