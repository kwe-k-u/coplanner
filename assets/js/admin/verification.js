

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


function show_curator_id_modal(img_url,type){
	// Get the image and insert it inside the modal - use its "alt" text as a caption
	var modal_link = event.target;

	var modal_img = document.getElementById("curator_id_img");
	var captionText = document.getElementById("caption");

	captionText.innerText = type + " of curator ID";

	modal_img.src = img_url;

	document.getElementById("curator_id_modal").style.display="block";

	// Get the <span> element that closes the modal

}

function close_curator_id_modal(){
	document.getElementById("curator_id_modal").style.display = "none";
}