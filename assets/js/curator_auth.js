

function signup(form){
	event.preventDefault();
	console.log(form.company_logo.files);
	payload = {
	};

	send_request("POST",
	"test/test.php",
	payload,
	(response) => {
		console.log(response)
	}
	);

}
function signup(form2){


	event.preventDefault();
	var form1 = document.getElementById("register-form-1");


	var name = form1.user_name.value;
	var email = form1.email.value;
	var password = form1.pswd.value;
	var c_password = form1.con_pswd.value;
	var phone = form1.phone.value;
	var company_name = form1.company_name.value;
	var company_country = get_dropdown_value("country_selected_icon");

	let payload = {
		"action" : "signup",
		"type" : "curator",
		"user_name" : name,
		"email" : email,
		"password" : password,
		"phone_number" : phone,
		"country" : company_country,
		"curator_name" : company_name,
		"company_logo" : form2.company_logo.files[0],
		"gov_id_front" : form2.gov_id_front.files[0],
		"gov_id_back" : form2.gov_id_back.files[0],
		"inc_doc" : form2.inc_doc.files[0]

	};


	send_request(
		"POST",
		"processors/processor.php",
		payload,
		(response) => {
			console.log(response);
		}
	);
}
