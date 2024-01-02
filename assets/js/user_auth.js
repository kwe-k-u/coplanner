

function email_login(form){
	event.preventDefault()
	let email = form.email.value;
	let password = form.password.value;

	// [start] input validation
	let isEmailValid = validateFormInputs(
		{
			type: "email",
			value: email,
			message_target: form.email.getAttribute("data-eg-target"),
			message: "Enter a valid Email Address"
		}
	);
	// [end] Input validaton

	if (isEmailValid){

		send_request("POST","processors/processor.php/login",
		{
			"email" : email,
			"password" : password,
			"method" : "email"
		},
		(response) =>{
			if(response.status == 200){
				if(url_params("redirect_url")){
					//go to the redirect url if one exists
		  //TODO:: redirect doesn't include the value of its GET parameters
					window.location.href = url_params("redirect_url");
				}else{
					goto_page("./index.php")
				}
			}else{
				openDialog(response.data.msg);
			}
		}
		);
	}
}

function email_signup(form){
	event.preventDefault();
	let email = form.email.value;
	let password = form.password.value;
	let confirm_password = form.confirm_password.value;
	let name = form.username.value;

	let isCredentialValid = validateFormInputs({
		type: "email",
		value : email,
		message_target: form.email.getAttribute("data-eg-target"),
		message: "Enter a valid email"
	},{
		type : "confirm password",
		value : password,
		confirm_val : confirm_password,
		message_target : form.confirm_password.getAttribute("data-eg-target"),
		message: "The passwords don't match"
	},{
		type : "password",
		value : password,
		message : "Password must be at least 8 characters long, contain a special character (EG: @,$,!,%,*,#,?,&)",
		message_target : form.password.getAttribute("data-eg-target")
	}
	);
	if(isCredentialValid){
		send_request(
			"POST",
			"processors/processor.php/register",
			{
				"email" : email,
				"password" : password,
				"name" : name,
				"method" : "email"
			}, (response)=> {
				if(response.status != 200){
					openDialog(response.data.msg);
				}else{
					window.location.href = "login.php"
				}
			}
		)
	}
}





//   function request_password_reset(form) {
// 	event.preventDefault();
// 	var email = form.email.value;
// 	// payload = "action=request_password_reset";
// 	// payload += "&email="+email;
// 	let payload = {
// 	  action: "request_password_reset",
// 	  email: email,
// 	};

// 	send_request("POST", "processors/processor.php", payload, (response) => {
// 	  alert(response.data.msg);
// 	});
//   }

//   function reset_password(form) {
// 	event.preventDefault();
// 	var password = form.password.value;
// 	var token = url_params("token");

// 	// payload = "action=change_password";
// 	// payload += "&token="+token;
// 	// payload += "&password="+password;
// 	let payload = {
// 	  action: "change_password",
// 	  token: token,
// 	  password: password,
// 	};

// 	send_request("POST", "processors/processor.php", payload, (response) => {
// 	  alert(response.data.msg);
// 	});
//   }