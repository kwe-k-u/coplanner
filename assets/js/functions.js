


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
async function send_request(type,endpoint, data,  onload){
	let formdata = new FormData();


    for (key in data) {
        if (Array.isArray(data[key])) {
            for (let i = 0; i < data[key].length; i++) {
                formdata.append(key + "[]", data[key][i]);
            }
        } else {
            formdata.append(key, data[key]);
        }
    }

	let response = await fetch(baseurl+endpoint,
		{
			method : type,
			body : formdata
		});

		// alert(response.json());

		// try {
			// var caught = response.clone();
			// alert(await caught.clone().text());
			onload (await response.json());
		// }catch (e){
		// 	alert("error "+await caught.text());
		// }
}
// function send_request(type,endpoint, payload,  onload){
// 	var xhr = new XMLHttpRequest();
// 	// Open the connection
// 	xhr.open(type, baseurl+endpoint);
// 	// Set up a handler for when the task for the request is complete
// 	xhr.onload =  function () {
// 		if (xhr.readyState == XMLHttpRequest.DONE) {
// 			// console.log(endpoint + " <<<<<start>>>> "+ xhr.response);
// 			// console.log( " <<<payload>>> "+ payload);
// 			// console.log(" <<<<<end>>>> ");
// 			if (onload != null){
// 				onload(xhr.response);
// 			}
// 		 }
// 	 };
// 	 xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

// 	 // Send the data.
// 		xhr.send(payload);
// }


function logout(){
	send_request(
		"POST",
		"processors/processor.php",
		{"action":"logout"},
		(response)=>{
			console.log(response);
			console.log(baseurl);
			window.location.href = baseurl;
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
			console.log(image_input_id + " <<<<<start>>>> ");
			console.log( xhr.response);
			console.log(" <<<<<end>>>> ");
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
	// payload = "action=update_curator_logo";
	// payload += "&media_id="+ media_id;
	// payload += "&curator_id="+ curator_id;
	let payload = {
		"action" : "update_curator_logo",
		"media_id" : media_id,
		"curator_id" : curator_id
	};
	send_request(
		"POST",
		"processors/processor.php",
		payload,
		(response) => {
		}
	)
}


function update_profile_image(media_id,user_id, {callback = null}){
	// payload = "action=update_user_profile_image";
	// payload += "&media_id="+ media_id;
	// payload += "&user_id="+ user_id;
	let payload = {
		"action" : "update_user_profile_image",
		"media_id" : media_id,
		"user_id" : user_id
	};
	send_request(
		"POST",
		"processors/processor.php",
		payload,
		(response) => {
			if (callback != null){
				callback(response);
			}
		}
	)
}


function update_curator_manager_id(user_id,front_media_id, back_media_id){
	// payload = "action=link_curator_manager_id";
	// payload += "&front_id=" + front_media_id;
	// payload += "&user_id=" + user_id;
	// payload += "&back_id=" + back_media_id;
	let payload = {
		"action" : "link_curator_manager_id",
		"front_id" : front_media_id,
		"user_id" : user_id,
		"back_id" : back_media_id
	};
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
	let payload = {
		"action": "login",
		"email" : email,
		"password" : password
	};

	send_request("POST","processors/processor.php",
	payload,
	 (response)=>{
		var json = response;
		var status = json["status"];
		var url = "";
		json = json["data"];
		if (status == 200){
			url = json["url"];
			//check redirect
			if (url_params("redirect")){
				url = url_params("redirect");

			}

			window.location.href = url;

		}else {
			alert(json["msg"]);
		}
	 }
	);
}

function request_password_reset(form){
	event.preventDefault();
	var email = form.email.value;
	// payload = "action=request_password_reset";
	// payload += "&email="+email;
	let payload = {
		"action" : "request_password_reset",
		"email" : email
	};

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
	let payload = {
		"action" : "change_password",
		"token" : token,
		"password" : password
	};

	send_request(
		"POST",
		"processors/processor.php",
		payload,
		(response)=>{
			alert(response);
		}
	)
}


// $("#subscribe_button").click(add_subscriber);
$(".nl-subscription-form").submit(add_subscriber);

function add_subscriber(event){
	event.preventDefault();
	var email = document.getElementById("newsletter_email_field");
	// payload = "action=add_subscriber";
	// payload += "&email="+email.value;
	let payload = {
		"action" : "add_subscriber",
		"email" : email.value
	};

	send_request(
		"POST",
		"processors/processor.php",
		payload,
		(response)=> {
			// alert(response);
			var json = response;
			alert(json["data"].msg);
			email.value= "";

		}
	)
}

function goto_page(url, isRelative = true){
	if (isRelative){
		window.location.href = baseurl + url;
	}else {
		window.location.href = url;
	}
}




function add_to_wishlist(user_id,campaign_id){
	// payload = "action=add_campaign_wishlist";
	let payload = {
		"action" : "add_campaign_wishlist",
		"campaign_id" : campaign_id,
		"user_id" : user_id
	};
	// payload += "&user_id="+user_id;
	// payload += "&campaign_id="+campaign_id;
	send_request(
		"POST",
		"processors/processor.php",
		payload,
		(response)=>{
			window.location.reload();
		}
	);
}


function remove_from_wishlist(user_id,campaign_id){
	let payload = {
		"action" : "remove_campaign_wishlist",
		"user_id" : user_id,
		"campaign_id": campaign_id
	};
	send_request(
		"POST",
		"processors/processor.php",
		payload,
		(response)=>{
			window.location.reload();
		}
	);
}

function payWithPaystack(currency, charge_amount,c_email,payload){
	let handler = PaystackPop.setup({
		key: paystack_public_key,
		email: c_email,
		amount: charge_amount,
		currency: currency,
		ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
		// label: "Optional string that replaces customer email"

		onClose: function(){
			alert('Window closed.');
		},

		callback: function(response){
			// Confirm payment receipt
			send_request(
				"POST",
				"processors/processor.php",
				{
					"action" : "book_standard_tour",
					"provider" : "paystack",
					"amount_expected" : charge_amount,
					"currency_expected" : currency,
					"payload": JSON.stringify(payload),
					"response" : JSON.stringify(response)
				},
				(res)=>{
					console.log(res);
				}
			)
		}
		});

		handler.openIframe();
}
// async function getFile() {
// 	let myPromise = new Promise(function(resolve) {
// 	  let req = new XMLHttpRequest();
// 	  req.open('GET', "mycar.html");
// 	  req.onload = function() {
// 		if (req.status == 200) {
// 		  resolve(req.response);
// 		} else {
// 		  resolve("File not Found");
// 		}
// 	  };
// 	  req.send();
// 	});

// 	document.getElementById("demo").innerHTML = await myPromise;
//   }