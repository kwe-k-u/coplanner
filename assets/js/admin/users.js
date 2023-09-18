

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