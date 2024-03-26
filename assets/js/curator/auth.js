
function signup(form2){


	event.preventDefault();
	var form1 = document.getElementById("register-form-1");

	let hash = url_params('hash');
	let c_hash = url_params("confirm")


	var name = form1.user_name.value;
	var email = form1.email.value;
	var password = form1.pswd.value;
	var c_password = form1.con_pswd.value;
	var phone = form1.phone.value;
	var bank_name = form1.payout_bank.value.split("=")[0];
	var bank_number = form1.payout_bank.value.split("=")[1];

	let payload = {
		"user_name" : name,
		"email" : email,
		"password" : password,
		"phone_number" : phone,
		"gov_id_front" : form2.gov_id_front.files[0],
		"gov_id_back" : form2.gov_id_back.files[0],
		"payout_bank_name" : bank_name,
		"payout_bank_number" : bank_number,
		"account_number" : form1.account_number.value,
		"account_name" : form1.account_name.value,
		"curator_name" : form1.company_name.value

	};

		// if user was invited
	if (hash != false & false != c_hash){
		payload["invite_hash"] = hash;
		payload["invite_type_hash"] = c_hash;
		payload["action"] = "curator_invite_signup";
	}else{ // if creating a new account
		payload["curator_name"] = form1.company_name.value;
		// payload["country"] = get_dropdown_value("country_selected_icon");
		payload["company_logo"] = form2.company_logo.files[0];
		payload["inc_doc"] = form2.inc_doc.files[0];
	}

	console.log(payload);


	send_request(
		"POST",
		"processors/processor.php/curator_signup",
		payload,
		(response) => {
			if (response.status ==200){

			}else{
				openDialog(response.msg);
			}
			console.log(response);


		}
	);
}