const tabs = document.querySelectorAll('.tab-pane');

document.addEventListener('DOMContentLoaded', () => {
	const radios = document.querySelectorAll('input[name="btnradio"]');

	radios.forEach((radio)=> {
		radio.addEventListener("click",showDashTab);
	})
});

function showDashTab(){
	let selectedTab = document.querySelector('input[name="btnradio"]:checked').getAttribute("data-toggle-target");
	tabs.forEach((tab)=> {
		if (tab.id != selectedTab){
		tab.classList.remove("active");
		}else{
				tab.classList.add("active");
		}
	});



}

function get_experience_tags(){
	let checkboxes = document.getElementsByName("experience_tag");
    // Initialize an array to hold the selected tag IDs
    let selectedTags = [];

    // Iterate through the checkboxes
    checkboxes.forEach(function(checkbox) {
        if (checkbox.checked) {
            selectedTags.push(checkbox.value);
        }
    });

	return selectedTags;

}
function create_experience(){
	// function get_experience_tags(){
	// 	let experienceType = [];
	// 	const checkboxes = document.querySelectorAll('input[name="experience_type"]:checked');
	// 	checkboxes.forEach((checkbox) => {
	// 		experienceType.push(checkbox.value);
	// 	});
	// 	return experienceType;
	// }
	event.preventDefault();
	let tags = get_experience_tags();
	let name = document.getElementsByName("experience_name")[0].value;
	let description = document.getElementsByName("experience_description")[0].value;
	let flyer = document.getElementsByName("company_logo")[0].files;
	let start_date = document.getElementsByName("start_date")[0].value;
	let booking_fee = document.getElementsByName("booking_fee")[0].value;
	let num_seats = document.getElementsByName("num_seats")[0].value;

	send_request("POST",
		"processors/processor.php/create_shared_experience",
		{
			"experience_name" : name,
			"start_date" : start_date,
			"description" : description,
			"flyer" : flyer[0],
			"price" : booking_fee,
			"seat_count" : num_seats,
			"experience_tags" : tags
		},
		(response) => {
			if (response.status == 200){
				goto_page("curator/destinations.php?experience_id="+response.data.experience_id);
			}else{
				openDialog(response.data.msg);
			}
		}
	)




}