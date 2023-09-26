

function resend_email_verification(user_id){
	send_request("POST",
	"processors/processor.php",
	{
		"action" : "resend_email_verification",
		"user_id" : user_id
	},
	(response)=>{
		alert(response.data.msg);
	}
	);
}

function send_password_reset(email){
	send_request("POST",
	"processors/processor.php",
	{
		"action" : "request_password_reset",
		"email" : email
	},
	(response)=>{
		alert(response.data.msg);
	}
	);
}


function log_in_as_user(user_id){
	//TODO:: show popup for admin to enter their password before continuing process

	send_request("POST",
	"processors/admin_processor.php/login_as_user",
	{
		"user_id" : user_id

	},
	(response)=>{

		//log in with credentials
		if(response.status == 200){
			send_request("POST",
			"processors/processor.php",
			{
				action: "admin_login",
				email: response.data.email,
				password: response.data.password,
			  },
			  (response)=>{
				console.log("second",response);
				window.location.reload();
			  }
			);
		}else{
			alert(response.msg);
		}
	},
	);

}