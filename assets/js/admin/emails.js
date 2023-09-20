const individual_select = document.getElementById("individual_select");
const group_select = document.getElementById("group_select");

function preview_template(path){
	send_request("POST",
	"admin/email_preview.php",
	{
		"template_path" : path,
		"custom_message" : "testing message too"
	},
	(response)=> {
		// window.location = "location/easygo_v2/admin/email_preview.php";
		goto_page("admin/email_preview.php");
	}
	);
}


function select_template(path){
	alert("not implemented");
}


function toggle_receipients(select){
	if(select.value == "individual"){ //show an input field
		if(individual_select.classList.contains("hide")){
			individual_select.classList.toggle("hide");
		}
		if(!group_select.classList.contains("hide")){
			group_select.classList.toggle("hide");
		}
	}else{ //show a drop down
		if(!individual_select.classList.contains("hide")){
			individual_select.classList.toggle("hide");
		}
		if(group_select.classList.contains("hide")){
			group_select.classList.toggle("hide");
		}
	}
}

function send_email(form){
	if(!confirm("Do you want to send this email?")){
		return false;
	}
	event.preventDefault();
	let message = form.message.value;
	let subject = form.subject.value;
	let recipient_type = form.receipient_type.value;
	let recipient = null;

	if( recipient_type == "group"){
	 recipient = form.recipient_group.value;
	}else {
		recipient = form.recipient_individual.value;
	}


	send_request("POST",
	"processors/admin_processor.php/send_email",
	{
		"message" : message,
		"subject" : subject,
		"type" : recipient_type,
		"recipient" : recipient
	},
	(response)=> {
		console.log(response);
		alert(response.data.msg);
	}
	)
}