

function delete_media(media_id){
	event.preventDefault();
}

function set_changeMedia_id(media_id){
	document.getElementById("changeMedia_id").value = media_id;
}

function change_media(form){
	event.preventDefault();
	let file = null;
	if(form.media.files){
		file = form.media.files[0];
	}else{
		file = form.media.value;
	}
	send_request("POST",
	"processors/admin_processor.php/change_media",
	{
		"media" : file,
		"media_id" : form.media_id.value
	},
	(response)=>{
		console.log(response);
	});
}

function change_media_select(select){
	document.getElementById("change_media_input").type = select.value;
}