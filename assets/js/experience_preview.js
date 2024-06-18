

function toggle_experience_visibility(){
	send_request("POST",
		"processors/processor.php/toggle_experience_visibility",
		{
			"experience_id" : url_params("experience_id"),
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