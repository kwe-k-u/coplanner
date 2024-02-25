
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
					let target = event.target.getAttribute("data-transit-target");

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


	// // if we've reached the end of the form, send the preference_selection to the AI to generate the itinerary
	preference_selection = Object.assign({}, preference_selection, selected);
	if (parent == target) {
		event.preventDefault();
		show_loader();

		//if the url doesn't include an itinerary id, then a user is requesting a recommendation
		send_request("POST",
			"processors/processor.php/personality_test",
			{"preference" : preference_selection},
			(response)=> {
				goto_page("coplanner/quiz_result.php?type="+response.data.personality_type)
			}
		);
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
			let parent_section = selectionPage.getAttribute("data-transit-parent");
			let target_section = selectionPage.getAttribute("data-transit-target");
			change_question(parent_section,target_section);
		});
	});

});





function get_section_responses(data_parent) {
	let name = data_parent.split("-");
	let key_text = name[0];
	let result = {}
	result[key_text] = get_selected_radio(name[0]+"-"+name[1]);
	return result;

}



function get_selected_radio(name) {
	const radioButtons = document.getElementsByName(name);
	for (let i = 0; i < radioButtons.length; i++) {
		if (radioButtons[i].checked) {
			let parts =  radioButtons[i].id.split("-");
			return parts[0];
		}
	}
	return null;
}










transitioner = new EhPageTransition("setup-pages");