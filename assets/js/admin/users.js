

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