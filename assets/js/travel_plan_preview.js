

function publish_travel_plan(){
	send_request("POST","processors/processor.php/publish_travel_plan",
		{
			"travel_plan_id" : url_params("travel_plan_id")
		},
		(response)=> {
			if(response.status == 200){
				showToast(response.data.msg);
			}else {
				showDialog(response.data.msg);
			}
		}
	)
}