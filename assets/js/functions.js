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
//set full to through if we want to substring at the value of the key
function url_params(key, full = false) {
  if (!window.location.search.includes(key)){
    return false;
  }
  let url = window.location.search.substr(1);
  let value = false;


  if(full){
    //include other key values for the string
    let start_index = url.indexOf(key) + key.length+1;
    value = url.substring(start_index);
  }else{
    // exclude other the key value pairs
    params = url.split("&");
    params.forEach((element) => {
      pair = element.split("=");
      element_key = pair[0];
      if (element_key == key) {
        value = pair[1];
      }
    });
  }






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
    } else if (typeof data[key] === 'object' && !Array.isArray(data[key]) && !(data[key] instanceof File)) {
      // Assuming the JSON object is nested and needs to be stringified before appending
      formdata.append(key, JSON.stringify(data[key]));
  }else {
      formdata.append(key, data[key]);
    }
  }
  if (files != null) {
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

function logout() {
  send_request(
    "POST",
    "processors/processor.php/signout",
    { },
    (response) => {
      window.location.reload();
    }
  );
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




function create_itinerary(){
  send_request("GET",
  "processors/processor.php/create_itinerary",
  null,
  (response)=>{
    if(response.status == 200){
      let id = response.data.itinerary_id;
      goto_page(baseurl+"coplanner/edit_itinerary.php?id="+id,false);
    }else{
      if(response.data.reason == "unauthenticated"){
        goto_page("coplanner/login.php?redirect_url="+window.location);
      }else{
        openDialog(response.data.msg);
      }
    }
  });
}


function duplicate_itinerary(itinerary_id){
  send_request("POST",
  "processors/processor.php/duplicate_itinerary",
  {
    "itinerary_id" : itinerary_id
  },
  (response)=>{
    if(response.status ==200){
      let id = response.data.itinerary_id;
      goto_page(baseurl+"coplanner/itinerary_settings.php?id="+id,false);
    }else{
      if(response.data.reason == "unauthenticated"){

        goto_page("coplanner/login.php?redirect_url="+window.location);
      }else{
        openDialog(response.data.msg);
      }
    }
  }
  );
}

function toggle_wishlist(){
  let target = event.target;
  if(url_params("id")){
    endpoint = "processors/processor.php/toggle_itinerary_wishlist";
    body ={
      "itinerary_id" : url_params("id")
    };
  }else if (url_params("experience_id")){
    endpoint = "processors/processor.php/toggle_experience_wishlist";
    body ={
      "experience_id" : url_params("experience_id")
    };

  }
  send_request("POST",
  endpoint,
  body,
  (response)=> {
    console.log(response.data);
    if (response.status == 200){
      if(response.data.added == 1){
        //The itinerary has been added to wishlist
        target.innerText = "Remove from Wishlist";
        target.classList= "easygo-btn-4 border-orange text-orange easygo-fs-5 w-50 bg-orange";
      }else{
        //The itinerary was been removed from wishlist
        target.innerText = "Add to Wishlist";
        target.classList= "easygo-btn-4 border-blue text-blue easygo-fs-5 w-50 bg-white";
      }
    }else{
      if(response.data.reason=="unauthenticated"){
        goto_page("coplanner/login.php?redirect_url="+window.location);
      }else{
        openDialog(response.data.msg);
      }
    }
  }) //TODO:: IMplement wishlist remove by default on interface
}

function showToast(msg = "Test toast",timeout = 3000){
  let toast = document.createElement("div");
  toast.className = "notification";
  toast.role = "alert";
  toast.onclick = function (){toast.remove();};

  let header = document.createElement("div");
  header.className = "notification-header";
  let title = document.createElement("strong");
  title.className = "mr-auto";
  title.innerText = "Notification";
  header.appendChild(title);
  let time_text = document.createElement("small");
  time_text.innerText = "Just Now";
  header.appendChild(time_text);

  let toast_body = document.createElement("div");
  toast_body.className = "notification-body";
  toast_body.innerText = msg;

  toast.appendChild(header);
  toast.appendChild(toast_body);
  document.body.appendChild(toast);



  setTimeout(function () {
    toast.remove();
  }, timeout);
}




function payWithPaystack(currency, charge_amount,c_email,payload, split_account = null, multiplit = null){
	let handler = PaystackPop.setup({
		key: paystack_public_key,
		email: c_email,
		amount: charge_amount,
		currency: currency,
		metadata : payload,
    subaccount: split_account,
		// ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
		// label: "Optional string that replaces customer email"

		onClose: function(){
			alert('Window closed.');
		},

		callback: function(response){
			// Confirm payment receipt
			// send_request(
			// 	"POST",
			// 	"processors/processor.php",
			// 	{
			// 		"action" : "book_standard_tour",
			// 		"provider" : "paystack",
			// 		"amount_expected" : charge_amount,
			// 		"currency_expected" : currency,
			// 		"payload": JSON.stringify(payload),
			// 		"response" : JSON.stringify(response)
			// 	},
			// 	(res)=>{
			// 		console.log(res);
			// 	}
			// )

			// TODO:: check status for payment and go to redirect page

			console.log("callback",response);
			window.location.href=response.redirecturl;
		}
		});

		handler.openIframe();
}