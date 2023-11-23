

function invite_collaborator(form, curator_id){
	event.preventDefault();
	const email = form.email.value;
	const role = form.collaborator_role.value;

	send_request("POST",
	"processors/processor.php",
	{
		"action" : "invite_curator_collaborator",
		"curator_id" : curator_id,
		"email" : email,
		"privilege" : role
	},(response) => {
		alert(response["data"]["msg"])
	}
	);
}