const baseurl = "http://localhost/easygo_v2/";



//checks the get get parameters in the url for a matching key;
function url_params(key){
	url = window.location.search.substr(1);
	params = url.split("&");
	params.forEach(element => {
		pair = element.split("=");
		element_key = pair[0];
		if(element_key= key){
			value = pair[1];
		}
	});

	return value;
}



//Make http requests with paraterms type(POST/GET), endpoint,payload and onload function
function send_request(type,endpoint, payload,  onload){
	var xhr = new XMLHttpRequest();
	// Open the connection
	xhr.open(type, baseurl+endpoint);
	// Set up a handler for when the task for the request is complete
	xhr.onload =  function () {
		if (xhr.readyState == XMLHttpRequest.DONE) {
			onload(xhr.response);
		 }
	 };
	 xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	 // Send the data.
		xhr.send(payload);
}


function logout(){
	send_request(
		"POST",
		"processors/processor.php",
		"action=logout",
		(response)=>{
			window.location.reload();
		}
	)
}


//Uploads the images in input with the passed id; returns a
function upload_image(image_input_id, media_type, {curator_id = null, user_id = null, callback = null}) {
	// event.preventDefault();
	var path = "";
	formData = new FormData();
	var images = document.getElementById(image_input_id).files;

	formData.append("action", "upload_media");
	formData.append("media_type",media_type);
	if (curator_id != null){
		formData.append ("curator_id",curator_id);
	} else if (user_id != null){
		formData.append("user_id", user_id);

	}
	//Add images to form
	for (let i = 0; i < images.length; i++) {
		var image = images[i];
		formData.append('images' + i, image, image.name);
	}
	var xhr = new XMLHttpRequest();
	// Open the connection
	xhr.open('POST', baseurl+'processors/processor.php');
	// Set up a handler for when the task for the request is complete
	xhr.onload = function () {
		if (xhr.readyState == XMLHttpRequest.DONE) {
			if (callback != null){
				callback(xhr.response);
			}
			path = xhr.response;
		}
	};

	// Send the data.
	xhr.send(formData);
	return path;
}


function update_curator_logo(media_id,curator_id){
	payload = "action=update_curator_logo";
	payload += "&media_id="+ media_id;
	payload += "&curator_id="+ curator_id;
	send_request(
		"POST",
		"processors/processor.php",
		payload,
		(response) => {}
	)
}

function update_curator_manager_id(user_id,front_media_id, back_media_id){
	payload = "action=link_curator_manager_id";
	payload += "&front_id=" + front_media_id;
	payload += "&user_id=" + user_id;
	payload += "&back_id=" + back_media_id;
	send_request(
		"POST",
		"processors/processor.php",
		payload,
		(response) => {
		}
	)
}



function login(form){
	event.preventDefault();

	var email = form.email.value;
	var password = form.password.value;
	payload = "action=login";
	payload += "&email="+ email;
	payload += "&password="+ password;

	send_request("POST","processors/processor.php",
	payload,
	 (response)=>{
		alert(response);
	 }
	);
}

function request_password_reset(form){
	event.preventDefault();
	var email = form.email.value;
	payload = "action=request_password_reset";
	payload += "&email="+email;

	send_request("POST","processors/processor.php",
	payload,
	(response) =>{
		alert(response);
	}
	);
}



function reset_password(form){
	event.preventDefault();
	var password = form.password.value;
	var token = url_params("token");

	payload = "action=change_password";
	payload += "&token="+token;
	payload += "&password="+password;

	send_request(
		"POST",
		"processors/processor.php",
		payload,
		(response)=>{
			alert(response);
		}
	)
}

