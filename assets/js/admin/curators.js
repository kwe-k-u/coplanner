
function set_curator_invite_id(curator_id){
	document.getElementById("invite_modal_curator_id").value = curator_id;
}

function invite_collaborator(form){
	event.preventDefault();
	const email = form.email.value;
	const role = form.collaborator_role.value;
	let curator_id = form.curator_id.value;


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


function create_curator(form){
	event.preventDefault();
	const name = form.curator_name.value;
	const country = form.country.value;
	const email = form.email.value;
	const role = form.privilege.value;

	send_request("POST",
	"processors/admin_processor.php/add_curator",
	{
		"name" : name,
		"country" : country,
		"email" : email,
		"privilege" : role
	},
	(response)=>{
		console.log(response);
		alert(response.data.msg);
	}
	);
}