




function signup(form){
	event.preventDefault();
	var name = form.user_name.value;
	var password = form.pswd.value;
	var email = form.email.value;
	var country = form.country.value;
	var referal = form.referral.value;
	var phone = form.phone.value;

	var payload = {
		"action" : "signup",
		"user_name" : name,
		"email" : email,
		"password" : password,
		"country" : country,
		"phone_number" : phone,
		"referal_code" : referal
	}
	// payload += "referral=" + referral;


	send_request("POST",
	"processors/processor.php",
	payload,
	(response) => {
		console.log(response);
		var json = response;
		// if (json["status"] == 200){

		// 	var user_id = json["data"]["user_id"];
		// 	upload_image("profile-img","picture", {user_id: user_id,
		// 	callback: (image_res)=>{
		// 		var img_json = image_res;
		// 		var img_id = img_json["data"]["media_id"];
		// 		update_profile_image(img_id,user_id, {
		// 			callback: (update_res) => {

					window.location.href = baseurl + "views/register_success.php";
	// 			}});
	// 		}
	// 		})
	// 	}else {
	// 		alert(json["data"]["msg"]);
	// 	}
	}
	);

}



function change_password_signed_in(form){
	event.preventDefault();
	var current = form.current_password.value;
	var new_pass = form.new_password.value;
	var confirm_pass = form.confirm_password.value;

	// payload="action=change_password_logged_in";
	// payload += "&current_password="+ current;
	// payload += "&new_password="+ confirm_pass;
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