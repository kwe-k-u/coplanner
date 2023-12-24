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
    let id = response.data.itinerary_id;
    goto_page(baseurl+"coplanner/edit_itinerary.php?id="+id,false);
  });
}

