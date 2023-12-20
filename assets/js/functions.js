//error catcher for all pages

function logError(event) {
  // event.preventDefault();
  message = event.message;
  line = event.lineno;
  error_stack = event.error.stack;
  page = window.location.href;
  js_file = event.filename;

  col_num = event.colno;

  send_request(
    "POST",
    "processors/processor.php/log_error",
    {
      message: message,
      line: line,
      page: page,
      type: "js",
      js_file: js_file,
      error_stack: error_stack,
      col_num: col_num,
    },
    (response) => {
      console.log(response);
      alert("Hmm something went wrong. The developers have been notified. Kindly reach out to main.easygo@gmail.com if you need immediate assitance!");
    }
  );
}

// $(document).ready(function () {
//   //   // -- Adding Listeners -- //
//   //   // utility listeners
//   //   alert("ready");
//   window.addEventListener("error", function (event) {
//     event.preventDefault();
//     logError(event);
//   });
// });

//checks the get get parameters in the url for a matching key;
function url_params(key) {
  if (!window.location.search.includes(key)){
    return false;
  }

  url = window.location.search.substr(1);
  let value = false;
  params = url.split("&");
  params.forEach((element) => {
    pair = element.split("=");
    element_key = pair[0];
    if (element_key == key) {
      value = pair[1];
    }
  });

  return value;
}

//Make http requests with paraterms type(POST/GET), endpoint,payload and onload function
async function send_request(type, endpoint, data, onload = null, files = null) {
  let formdata = new FormData();

  for (key in data) {
    if (Array.isArray(data[key])) {
      for (let i = 0; i < data[key].length; i++) {
        formdata.append(key + "[]", data[key][i]);
      }
    } else if (typeof data[key] === 'object' && !Array.isArray(data[key])) {
      // Assuming the JSON object is nested and needs to be stringified before appending
      formdata.append(key, JSON.stringify(data[key]));
  }else {
      formdata.append(key, data[key]);
    }
  }
  if (files != null) {
    var uploadedFiles = [].concat(files);
    // for (let i = 0; i < files.length; i++){
    // 	uploadedFiles.push(files[i])
    // }
    for (let i = 0; i < files.length; i++) {
      formdata.append(i + "[]", files[i]);
    }
  }

  let response = await fetch(baseurl + endpoint, {
    method: type,
    body: type=="POST" ? formdata : null,
  });

  // alert(response.json());

  // try {
  // var caught = response.clone();
  // alert(await caught.clone().text());
  if (onload != null) {
    onload(await response.json());
  }
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

function logout() {
  send_request(
    "POST",
    "processors/processor.php/signout",
    { },
    (response) => {
      window.location.href.reload();
    }
  );
}

//Uploads the images in input with the passed id; returns a
function upload_image(
  image_input_id,
  media_type,
  { curator_id = null, user_id = null, callback = null }
) {
  // event.preventDefault();
  var path = "";
  formData = new FormData();
  var images = document.getElementById(image_input_id).files;

  formData.append("action", "upload_media");
  formData.append("media_type", media_type);
  if (curator_id != null) {
    formData.append("curator_id", curator_id);
  } else if (user_id != null) {
    formData.append("user_id", user_id);
  }
  //Add images to form
  for (let i = 0; i < images.length; i++) {
    var image = images[i];
    formData.append("images" + i, image, image.name);
  }
  var xhr = new XMLHttpRequest();
  // Open the connection
  xhr.open("POST", baseurl + "processors/processor.php");
  // Set up a handler for when the task for the request is complete
  xhr.onload = function () {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      console.log(image_input_id + " <<<<<start>>>> ");
      console.log(xhr.response);
      console.log(" <<<<<end>>>> ");
      if (callback != null) {
        callback(xhr.response);
      }
      path = xhr.response;
    }
  };

  // Send the data.
  xhr.send(formData);
  return path;
}

function update_curator_logo(media_id, curator_id) {
  // payload = "action=update_curator_logo";
  // payload += "&media_id="+ media_id;
  // payload += "&curator_id="+ curator_id;
  let payload = {
    action: "update_curator_logo",
    media_id: media_id,
    curator_id: curator_id,
  };
  send_request("POST", "processors/processor.php", payload, (response) => {});
}

function update_profile_image(media_id, user_id, { callback = null }) {
  // payload = "action=update_user_profile_image";
  // payload += "&media_id="+ media_id;
  // payload += "&user_id="+ user_id;
  let payload = {
    action: "update_user_profile_image",
    media_id: media_id,
    user_id: user_id,
  };
  send_request("POST", "processors/processor.php", payload, (response) => {
    if (callback != null) {
      callback(response);
    }
  });
}

function update_curator_manager_id(user_id, front_media_id, back_media_id) {
  // payload = "action=link_curator_manager_id";
  // payload += "&front_id=" + front_media_id;
  // payload += "&user_id=" + user_id;
  // payload += "&back_id=" + back_media_id;
  let payload = {
    action: "link_curator_manager_id",
    front_id: front_media_id,
    user_id: user_id,
    back_id: back_media_id,
  };
  send_request("POST", "processors/processor.php", payload, (response) => {});
}


// $("#subscribe_button").click(add_subscriber);
$(".nl-subscription-form").submit(add_subscriber);

function add_subscriber(event) {
  event.preventDefault();
  var email = document.getElementById("newsletter_email_field");
  // payload = "action=add_subscriber";
  // payload += "&email="+email.value;
  let payload = {
    action: "add_subscriber",
    email: email.value,
  };

  send_request("POST", "processors/processor.php", payload, (response) => {
    // alert(response);
    var json = response;
    alert(json["data"].msg);
    email.value = "";
  });
}

function goto_page(url, isRelative = true){
	if(event){
		event.preventDefault();
	}
	if (isRelative){
		window.location.href = baseurl + url;
	}else {
		window.location.href = url;
	}
}

function add_to_wishlist(user_id, campaign_id) {
  // payload = "action=add_campaign_wishlist";
  let payload = {
    action: "add_campaign_wishlist",
    campaign_id: campaign_id,
    user_id: user_id,
  };
  // payload += "&user_id="+user_id;
  // payload += "&campaign_id="+campaign_id;
  send_request("POST", "processors/processor.php", payload, (response) => {
    window.location.reload();
  });
}

function remove_from_wishlist(user_id, campaign_id) {
  let payload = {
    action: "remove_campaign_wishlist",
    user_id: user_id,
    campaign_id: campaign_id,
  };
  send_request("POST", "processors/processor.php", payload, (response) => {
    window.location.reload();
  });
}

function toggle_curator_follow(curator_id) {
  var button = event.target;
  let payload = {
    action: "toggle_curator_follow",
    curator_id: curator_id,
  };
  send_request("POST", "processors/processor.php", payload, (response) => {
    console.log(response);
    if (response.status != 200) {
      // something went wrong
      alert(response.data.msg);
    }
    if (response.data.new_status) {
      // Change button to red unfollow
      button.classList.toggle("easygo-btn-3");
      button.classList.toggle("easygo-btn-1");
      button.innerText = "Unfollow";
    } else {
      // Change button to blue follow
      button.classList.toggle("easygo-btn-3");
      button.classList.toggle("easygo-btn-1");
      button.innerText = "Follow";
    }
  });
}



function create_itinerary(){
  send_request("GET",
  "processors/processor.php/create_itinerary",
  null,
  (response)=>{
    let id = response.data.itinerary_id;
    goto_page(baseurl+"coplanner/edit_itinerary.php?id="+id,false);
  });
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
