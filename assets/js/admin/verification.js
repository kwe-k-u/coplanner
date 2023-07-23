

function verify_curator_manager_id(curator_id,action){
	send_request("POST",
	"processors/admin_processor.php/verify_curator_manager_id",
	{
		"curator_id" : curator_id,
		"verify_action" : action
	},(response)=>{
		alert(response["data"]["msg"]);
	}
	);
}

function toggle_curator_verification(curator_id){
	send_request("POST",
	"processors/admin_processor.php/verify_curator_account",
	{
		"curator_id" : curator_id
	},
	(response)=> {
		alert(response["data"]["msg"]);
	}
	);
}