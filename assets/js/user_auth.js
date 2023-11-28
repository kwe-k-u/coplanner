

function email_login(form){
	event.preventDefault()
	let email = form.email.value;
	let password = form.password.value;

	send_request("POST","processors/processor.php/login",
	{
		"email" : email,
		"password" : password,
		"method" : "email"
	},
	(response) =>{
		console.log(response);
		if(response.status == 200){
			goto_page("./index.php")
		}
	}
	)
}

function email_signup(form){
	event.preventDefault();
	let email = form.email.value;
	let password = form.password.value;
	let confirm_password = form.confirm_password.value;
	let name = form.username.value;
	send_request(
		"POST",
		"processors/processor.php/register",
		{
			"email" : email,
			"password" : password,
			"name" : name,
			"method" : "email"
		}
	)
}




// function login(form) {
// 	event.preventDefault();

// 	var email = form.email.value;
// 	var password = form.password.value;

// 	// ** input validation code [start] **//
// 	let didPassValidation = validateFormInputs(
// 	  {
// 		type: "email",
// 		value: form.email.value,
// 		message_target: form.email.getAttribute("data-eg-target"),
// 		message: "Invalid Email Address",
// 	  },
// 	  // {
// 	  //   type: "password",
// 	  //   value: form.password.value,
// 	  //   message_target: form.password.getAttribute("data-eg-target"),
// 	  //   message:
// 	  //     "Password must contain at least one of an uppercase letter, a lowercase letter, a special character and a digit and must be at least 8 characters long",
// 	  // }
// 	);

// 	if (!didPassValidation) return false;
// 	// ** input validation code [end] **//

// 	let payload = {
// 	  action: "login",
// 	  email: email,
// 	  password: password,
// 	};

// 	send_request("POST", "processors/processor.php", payload, (response) => {
// 	  var json = response;
// 	  var status = json["status"];
// 	  var url = "";
// 	  json = json["data"];
// 	  if (status == 200) {
// 		url = json["url"];
// 		//check redirect
// 		if (url_params("redirect")) {
// 		  // url = url_params("redirect");
// 		  //substring url for all text after redirect
// 		  url = window.location.href.substring(window.location.href.indexOf("redirect=")+9);
// 		  // url = window.location.
// 		  // url =
// 		  //TODO:: redirect doesn't include the value of its GET parameters
// 		}

// 		window.location.href = url;
// 	  } else {
// 		openDialog(json["msg"]);
// 	  }
// 	});
//   }

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