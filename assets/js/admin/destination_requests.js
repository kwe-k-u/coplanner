

function toggle_destination_request_status(request_id,status){
	send_request("POST",
	"processors/processor.php/toggle_destination_request_status",
	{
		"request_id" : request_id,
		"status" : status
	},
	(response)=>{
		if(response.status == 200){
			showToast(response.data.msg);
		}else{
			alert("Something went wrong");
			console.log(response);
		}
	}
	)
}