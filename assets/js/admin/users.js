

function make_user_admin(user_id){
	if(confirm("Do you want to make the user an admin?")){
		send_request("POST",
		"processors/processor.php/make_user_admin",
		{
			"user_id" : user_id
		},
		(response)=>{
			if(response.status == 200){
				showToast(response.data.msg);
			}else{
				openDialog(response.data.msg);
			}
		});
	}
}


function login_as_user(user_id,user_name){
	if(confirm("Log in as "+ user_name)){
			send_request("POST",
		"processors/processor.php/login_as_user",{
			"user_id" : user_id
		},
		(response)=> {
			console.log(response);
			if (confirm("Reload page?")){
				window.location.reload();
			}
		}
		);
	}
}