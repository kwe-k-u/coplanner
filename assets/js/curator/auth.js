$(document).ready(function (){
	mixpanel.time_event("Curator Signup Time");

});



function signup(form2){
	event.preventDefault();
	var form1 = document.getElementById("register-form-1");



	if(form2.gov_id_back.files.length == 0 || form2.gov_id_front.files.length == 0){
		alert("Kindly upload a picture of both the front and back of your Government issued ID card");
		return false;
	}

	mixpanel.track("Curator Signup Time");


	let hash = url_params('invite_token');


	var name = form1.user_name.value;
	var email = form1.email.value;
	var password = form1.pswd.value;
	var c_password = form1.con_pswd.value;
	var phone = form1.phone.value;



	let payload = {
		"user_name" : name,
		"email" : email,
		"password" : password,
		"phone_number" : phone,
		"gov_id_front" : form2.gov_id_front.files[0],
		"gov_id_back" : form2.gov_id_back.files[0]

	};

		// if user was invited
	if (hash != false ){
		payload["invite_token"] = hash;
		send_request(
			"POST",
			"processors/processor.php/curator_invite_signup",
			payload,
			(response) => {
				if (response.status ==200){
					showToast(response.data.msg);
				}else{
					openDialog(response.data.msg);
				}
				console.log(response);
			}
		);
	}else{ // if creating a new account

		// if (form2.inc_doc.files.length == 0){
		// 	alert("Kindly upload an incorporation document to proceed. You may contact support@easygo.com.gh if you have not registered your company");
		// 	return false;
		// }

	mixpanel.track("curator signup attempt",{
		"user_name" : form1.user_name.value,
		"email" : form1.email.value,
		"phone_number" : form1.phone.value,
		"curator_name" : form1.company_name.value,
	});


		var bank_name = form1.payout_bank.value.split("=")[0];
		var bank_number = form1.payout_bank.value.split("=")[1];

		payload["curator_name"] = form1.company_name.value;
		// payload["country"] = get_dropdown_value("country_selected_icon");
		payload["company_logo"] = form2.company_logo.files[0];
		payload["inc_doc"] = form2.inc_doc.files[0];
		payload["payout_bank_name"] = bank_name;
		payload["payout_bank_number"] = bank_number;
		payload["account_number"] = form1.account_number.value;
		payload["account_name"] = form1.account_name.value;



		send_request(
			"POST",
			"processors/processor.php/curator_signup",
			payload,
			(response) => {
				if (response.status ==200){
					showToast(response.data.msg);
				}else{
					openDialog(response.data.msg);
				}
				console.log(response);
			}
		);
	}




}


function invite_collaborator(form){
	event.preventDefault();
	send_request("POST",
		"processors/processor.php/invite_collaborator",
		{

			"email" : form.email.value
		},
		(response)=>{
			if (response.status == 200){
				showToast(response.data.msg);
			}else{
				openDialog(response.data.msg);
			}
		}
	);
}