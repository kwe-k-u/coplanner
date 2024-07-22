

function reset_password(form){
	event.preventDefault();
	let current_password = form.current_password.value;
	let confirm_password = form.confirm_password.value;
	let new_password = form.new_password.value;

	if(confirm_password != new_password){
		openDialog("Your passwords don't match");
		return;
	}

	send_request("POST",
		"processors/processor.php/request_password_reset",
		{
			"current_password" : current_password,
			"confirm_password" : confirm_password,
			"new_password" : new_password
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


function invite_collaborator(form){
	event.preventDefault();
	send_request("POST",
		"processors/processor.php/invite_collaborator",
		{
			"email" : form.email.value,
			"role" : form.collaborator_role.value
		},(response)=> {
			console.log(response);
			if(response.status == 200){
				showToast(response.data.msg);
			}else{
				openDialog(response.data.msg);
			}
		}
	);
}

function update_payment_info(form){
	event.preventDefault();

	send_request("POST",
		"processors/processor.php/update_payment_info",
		{
			"bank_name" : form.bank_name.value,
			"account_number" : form.account_number.value,
			"account_name" : form.account_name.value,
		}, (response)=> {
			if(response.status == 200){
				showToast(response.data.msg);
			}else{
				openDialog(response.data.msg);
			}
		}
	)
}