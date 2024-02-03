
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
					console.log(selected)

					if(!btn.innerHTML.includes("Back")){

						if (typeof selected !== "string" ) {

							if (selected === null ||
								(typeof selected === "object" && selected !== null &&
								 (selected[Object.keys(selected)[0]] === null || selected[Object.keys(selected)[0]].length === 0))) {
								openDialog("Please make a selection");
								return null;
							}
						}
					}

					change_question(parent, target);

				});
			});

		});
	}
}


// Moves the choice selection page to the next
function change_question(parent_id, target_id) {
	let parent = document.getElementById(parent_id);
	let target = document.getElementById(target_id);
	let selected = get_section_responses(parent_id);

	target.classList.add("active");
	parent.classList.remove("active");

	if (parent_id == "tool-selection-page") {
		if (selected == "scratch-select") {
			send_request("POST",
				"processors/processor.php/create_itinerary",
				{},
				(response) => {
					if(response.status==200){
						goto_page("coplanner/edit_itinerary.php?id=" + response.data.itinerary_id);
					}else{
						if(response.data.reason=="unauthenticated"){
							goto_page("coplanner/login.php?redirect_url="+window.location);
						}else{
							openDialog(response.data.msg);
						}
					}
				}
			);

			return null;
		}
	}

	if (parent_id != "tool-selection-page") {
		preference_selection = Object.assign({}, preference_selection, selected);
	}

	// if we've reached the end of the form, send the preference_selection to the AI to generate the itinerary
	if (parent == target) {
		event.preventDefault();
		show_loader();

		//if the url doesn't include an itinerary id, then a user is requesting a recommendation
		if (!url_params("itinerary_id")) {
			send_request(
				"POST",
				"processors/processor.php/new_itinerary_request",
				{
					"preference": preference_selection,
				},
				(response) => {
					console.log(response);
					goto_page("coplanner/recommendations.php?id=" + response.data.id);

				}
			);
			//if url contains itinerary id, admin is creating a template
		} else {
			// create itinerary template
			send_request("POST",
				"processors/processor.php/create_template",
				{
					"itinerary_id" : url_params("itinerary_id"),
					"preferences" : preference_selection
				},
				(response)=>{
					if(response.status == 200){
						showToast(response.data.msg);
					}else{
						openDialog(response.data.msg);
					}
				}
			);
		}
	}

}


function get_page(element) {
	let current = element;
	while (current != null) {

		if (current.parentElement.classList.contains("eh-transition-page")) {
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
	radioChoices.forEach(function (radioChoice) {
		// Add change event listener to each element
		radioChoice.addEventListener('change', function () {
			// Find the closest ancestor element with class 'eh-transition-page'
			var selectionPage = get_page(radioChoice);

			// Find the button element within the 'toolSelectionPage'
			var button = selectionPage.querySelectorAll('.eht-btn')[1];
			button.click();
		});
	});

});





function get_section_responses(data_parent) {
	var result = {};
	switch (data_parent) {
		case "tool-selection-page":
			result = get_selected_radio("tool-select");
			break;
		case "location-selection-page":
			result["location"] = get_selected_radio("location-selection");
			break;
		case "duration-selection-page":
			result["duration"] = get_selected_radio("duration-selection");
			break;
		case "type-selection-page":
			result["type"] = get_selected_radio("type-selection");
			break;
		case "vibe-selection-page":
			result["vibe"] = get_selected_checkboxes("vibe-selection");
			break;
		case "budget-selection-page":
			result["budget"] = get_selected_radio("budget-range-selection");
			break;

		default:
			console.log("unknown case", data_parent);
			// result = null;
	}
	return result;
}

function get_selected_checkboxes(name) {
	const checkboxes = document.querySelectorAll(`input[type="checkbox"][name="${name}"]:checked`);
	const selectedValues = Array.from(checkboxes).map(checkbox => checkbox.value);
	if(selectedValues == []){
		return null;
	}
	return selectedValues;
}


function get_selected_radio(name) {
	const radioButtons = document.getElementsByName(name);
	for (let i = 0; i < radioButtons.length; i++) {
		if (radioButtons[i].checked) {
			return radioButtons[i].id;
		}
	}
	return null;
}










transitioner = new EhPageTransition("setup-pages");