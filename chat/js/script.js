function login_submit(form) {
	event.preventDefault();
	send_request("POST",
	"chat/process/processor.php",
	{
		"action" : "login",
		"name" : form.name.value,
		"email" : form.email.value,
		"number" : form.number.value
	},
	(response)=> {
		alert(response);
		console.log(response);
	});

}

function query_submit(form, id){
	event.preventDefault();

	var list_div = document.getElementById(id+"-list");

	var newNode = document.createElement("span");
	newNode.innerText = form.text.value;
	list_div.appendChild(newNode);
}

function generate_trip(email){
	var act_div = document.getElementById("activity-list");
	var loc_div = document.getElementById("location-list");
	var locations = [];
	var activities = [];
	for ( i = 0; i < act_div.children.length; i++){
		activities[i] = act_div.children[i].innerText;
	}
	for ( i = 0; i < loc_div.children.length; i++){
		locations[i] = loc_div.children[i].innerText;
	}
	set_prompt("Generating your tour itinery")
	send_request("POST",
	"chat/process/processor.php",
	{
		"action":"generate",
		"activities" : activities,
		"email": email,
		"locations" : locations
	},(response)=> {
		var message = JSON.parse(response)["choices"][0]["message"]["content"];
		set_prompt(message);
	});
}

function set_prompt(prompt){
	document.getElementById("prompt_message").innerText = prompt;
	window.scrollTo(0, document.body.scrollHeight);
}


async function send_request(type, endpoint, data, onload) {
	let formdata = new FormData();
	for (key in data) {
		formdata.append(key, data[key]);
	}

	let response = await fetch("https://www.easygo.com.gh/" + endpoint, {
		method: type,
		body: formdata
	});

	// alert(response.json());

	try {
		var caught = response.clone();
		// alert(await caught.clone().text());
		onload(await response.text());
	} catch (e) {
		var data = await caught.text()
		console.log(data);
		onload(data);
		// alert("error " + await caught.text());
	}
}