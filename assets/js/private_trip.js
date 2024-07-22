const info_selection = document.getElementById("info-selection");
const personal_info = document.getElementById("personal-info");
const extra_services = document.getElementById("additional-service");

function submit_click(){

	let current_invoice = document.querySelectorAll(".section:not(.hide)")[0];
	let next_id = current_invoice.getAttribute("data-target-next");
	if(next_id){
		document.getElementById(next_id).classList.remove("hide");
		current_invoice.classList.add("hide");
	}


	if (!next_id){
		send_request("POST","processors/processor.php/request_travel_plan",
			{
				"num_people": document.getElementById("number-of-people").value,
				"preferred_date": document.getElementById("preferred-date").value,
				"name": document.getElementById("person-name").value,
				"phone": document.getElementById("person-number").value,
				"email": document.getElementById("person-email").value,
				"notes" : document.getElementById("extra-notes").value,
				"additional_services" : get_additional_service_request(),
				"travel_plan_id" : url_params('travel_plan_id')
			},
			(response)=> {
				console.log(response);
				if(response.status == 200){
					showToast(response.data.msg);
				}else{
					showDialog(response.data.msg);
				}
			}
		)
	}



}

function get_additional_service_request(){
	let requests = [];
	if(document.getElementById("accomodation-check").checked){
		requests.push('accomodation');
	}
	if(document.getElementById("airport-check").checked){
		requests.push('airport-pickup');
	}
	return requests;
}