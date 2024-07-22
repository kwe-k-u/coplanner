

function select_request(request_id){


	send_request("POST","processors/processor.php/get_travel_plan_request",
		{
			"request_id" : request_id
		}, (response)=>{
			console.log(response);
			if(response.status == 200){
				document.getElementById("modal_tourist_notes").innerText = response.data.request.additional_notes;
				document.getElementById("modal_tourist_name").innerText = response.data.request.user_name;
				document.getElementById("modal_group_size").innerText = response.data.request.group_size.toString()  + " people";
				document.getElementById("modal_experience_name").innerText = response.data.request.experience_name;
				document.getElementById("modal_request_id").value = request_id;
			}else{
				$("#request-modal").modal("close");
				showDialog("Something went wrong please try again");

			}
		}
	)
}

function travel_plan_response(form){
	event.preventDefault();

	let validate_input = true;
	if (validate_input){
		send_request("POST",
			"processors/processor.php/respond_travel_plan",
			{
				"request_id" : form.request_id.value,
				"curator_notes" : form.curator_notes.value,
				"quote_price" : form.quote_price.value,
				"accept_status" : form.curator_accept_status.value
			},
			(response)=>{
				if(response.status == 200){
					showToast(response.data.msg);
					$("#request-modal").modal("hide");
				}else{
					openDialog(response.data.msg);
				}
			}
		);
	}
}