




function signup(form){
	event.preventDefault();
	var name = form.user_name.value;
	var password = form.pswd.value;
	var email = form.email.value;
	var country = form.country.value;
	var referal = form.referral.value;
	var phone = form.phone.value;
	var profile_img = form.profile_img.files[0];

	var payload = {
		"action" : "signup",
		"user_name" : name,
		"email" : email,
		"password" : password,
		"country" : country,
		"phone_number" : phone,
		"referal_code" : referal,
		"profile_img" : profile_img
	}


	send_request("POST",
	"processors/processor.php",
	payload,
	(response) => {
		window.location.href = baseurl + "views/register_success.php";
	}
	);

}



function change_password_signed_in(form){
	event.preventDefault();
	var current = form.current_password.value;
	var new_pass = form.new_password.value;
	var confirm_pass = form.confirm_password.value;

	let payload = {
		"action" :"change_password_logged_in",
		"current_password": current,
		"new_password": confirm_pass,
	};

	send_request("POST",
	"processors/processor.php",
	payload,
	 (response)=>{
		alert(response);
		var json = response;
		if(json["status"]==100){
			event.preventDefault();
		}
		alert(json)
	});
}