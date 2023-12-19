
preference_selection = {}


class EhPageTransition {
	constructor(container_id) {
		this.container = document.getElementById(container_id);
		this.pages = this.container.querySelectorAll(".eh-transition-page")

		this.#init();
	}

	#init() {
		this.pages.forEach(page => {
			page.querySelectorAll(".eht-btn").forEach(btn => {
				btn.addEventListener("click", event => {
					let parent = event.target.getAttribute("data-transit-parent");
					let selected = get_section_responses(parent);
					let target = event.target.getAttribute("data-transit-target");

					if(selected == {} && !btn.innerHTML.includes("Back")){
						alert("Please make a selection");
						return null;
					}
					next_choice(parent,target);

				});
			});

		});
	}
}


// Moves the choice selection page to the next
function next_choice(parent_id,target_id){
	let parent = document.getElementById(parent_id);
	let target = document.getElementById(target_id);
	let selected = get_section_responses(parent_id);

	target.classList.add("active");
	parent.classList.remove("active");

	if (parent_id == "tool-selection-page"){
		if(selected == "scratch-select"){
			send_request("POST",
			"processors/processor.php/create_itinerary",
			{},
			(response)=> {
				goto_page("coplanner/itinerary_item_view.php?id="+response.data.itinerary_id);
			}
			);

			return null;
		}
	}

	if(parent_id != "tool-selection-page"){
		preference_selection = Object.assign({},preference_selection,selected);
	}

	// if we've reached the end of the form, send the preference_selection to the AI to generate the itinerary
	if (parent == target){
		event.preventDefault();
		show_loader();

	send_request(
		"POST",
		"processors/processor.php/new_itinerary_request",
		{
			"preference": preference_selection,
			"itinerary_id" : url_params("itinerary_id")
		},
		(response)=> {
			if(!url_params("itinerary_id")){
				console.log(response);
				//If action not admin, show recommendations
				goto_page("coplanner/recommendations.php?id="+response.data.id);
			}

		}
	);
	}

}


function get_page(element){
	let current = element;
	while(current != null){

		if (current.parentElement.classList.contains("eh-transition-page")){
			return current.parentElement;
		}
		current = current.parentElement;
	}
	return null;
}

$(document).ready(function () {
	// Get all elements with class 'radio_choice'
var radioChoices = document.querySelectorAll('.radio_choice');

// Iterate through each element
radioChoices.forEach(function(radioChoice) {
  // Add change event listener to each element
  radioChoice.addEventListener('change', function() {
    // Find the closest ancestor element with class 'eh-transition-page'
    var selectionPage = get_page(radioChoice);

    // Find the button element within the 'toolSelectionPage'
    var button = selectionPage.querySelectorAll('.eht-btn')[1];
	button.click();
  });
});

});





function get_section_responses(data_parent){
	var result = {};
	switch(data_parent){
		case "tool-selection-page":
			result = get_selected_radio("tool-select");
			break;
		case "tour-type-selection-page":
			result["type"] = get_selected_radio("tour-type-selection")
			break;
		case "duration-selection-page":
			result["duration"] = get_selected_radio("tour-duration-selection");
			break;
		case "accomodation-selection-page":
			result["accommodation"] = get_selected_radio("tour-accomodation-selection");
			break;
		case "activities-selection-page":
			result["acitivities"] = get_selected_checkboxes("activity-selection");
			break;
		case "budget-selection-page":
			result["budget"] = get_selected_radio("budget-range-selection");
			break;
		default:
			console.log("unknown case",data_parent);
			result = null;
	}
	return result;
}

function get_selected_checkboxes(name) {
	const checkboxes = document.querySelectorAll(`input[type="checkbox"][name="${name}"]:checked`);
	const selectedValues = Array.from(checkboxes).map(checkbox => checkbox.value);
	return selectedValues;
}


function get_selected_radio(name){
	const radioButtons = document.getElementsByName(name);
			for (let i = 0; i < radioButtons.length; i++) {
				if (radioButtons[i].checked) {
					return radioButtons[i].id;
				}
			}
}










transitioner = new EhPageTransition("setup-pages");