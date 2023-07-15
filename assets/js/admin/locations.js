var location_info_div = document.getElementById("site_info_col");
var location_form_div = document.getElementById("site_form_col");
var location_search_results = document.getElementById("site_result_div");

var name_field = document.getElementById("name");
var description_field = document.getElementById("description");
var location_field = document.getElementById("location");
var country_field = document.getElementById("country");
var owner_name_field = document.getElementById("owner_name");
var owner_number_field = document.getElementById("owner_number");
var website_field = document.getElementById("website");
var tiktok_field = document.getElementById("tiktok");
var instagram_field = document.getElementById("instagram");
var facebook_field = document.getElementById("facebook");



// Switches the display of the location form. If the location edit is tapped
// it prefills the form with the existing information
function add_location_toggle(location_id = null){

	if(location_form_div.classList.contains("hide")){
		location_info_div.classList.toggle("hide");
		location_form_div.classList.toggle("hide");
	}
	if(location_id != null){
		//get location info
		send_request("POST",
		"processors/admin_processor.php/get_location_info?id="+location_id,
		{},
		(response)=>{
			// alert(response);
			const data = response["data"];
			// console.log(response);

			// document.getElementById("name");
			name_field.value = data["site_name"];
			description_field.value = data["toursite_description"];
			location_field.value = data["site_location"];
			country_field.value = data["country"];
			// owner_name.value = data[""];
			// owner_number_field.value = data[""];
			// website_field.value = data[""];
			// tiktok_field.value = data[""];
			// instagram_field.value = data[""];
			// facebook_field.value = data[""];

			for (let i = 0; i < array.length; i++) {
				const element = array[i];
				insert_location_element(data["activities"][i]);
			}
			//TODO:: Insert locations
			//TODO:: Insert social credentials



		});

		//populate the edit fields
	}
}


function expand_location_info(id) {
	var title = document.getElementById("location-info-title");
	var description = document.getElementById("location-info-desc");

	var payload = {
		"action": "get_site_by_id",
		"toursite_id": id
	};


	send_request(
		"POST",
		"processors/processor.php",
		payload,
		(response) => {
			var json = response["data"];
			var activity = json["activities"];
			var image_list = [
				"../assets/images/others/scenery2.jpg",
				"../assets/images/others/tour1.jpg"
			];

			title.innerText = json["site_name"];
			description.innerText = json["toursite_description"];

			reset_location_info_images(image_list);
			reset_location_info_activities(activity);
			$(".activity-span").on("click", activity_click);
		}
	);


}



function location_edit(site_id){

}

function on_location_search(form) {
	event.preventDefault();
	var query = form.query.value;
	var type = get_dropdown_value("location_search_filter");

	// payload = "action=query_site";
	// payload += "&query="+query;
	// payload += "&type="+type;
	let payload = {
		"action": "query_site",
		"query": query,
		"type": type
	};

	send_request("POST",
		'processors/processor.php',
		payload,
		(response) => {
			// alert(response);
			// console.log(response["data"]["sites"])
			insert_result_element(response["data"]["sites"])
		}
	);


}


function verification_toggle(site_id){
	var text = document.getElementById("verified_text_"+site_id);
	var icon = document.getElementById("verified_image_"+site_id);
	const verified = text.value == "Verified (Click to Change)";
	const confirm_text = verified ? "Remove verification for location?" : "Verify the toursite?"

	if(confirm(confirm_text)){

		send_request("POST",
		"processors/admin_processor.php/toggle_location_verification",
		{
			"toursite_id" : site_id
		},
		(response)=> {
			//location is now unverified
			if(response["data"]["new_verification"] == "0"){
				text.innerText  = "Unverified(Click to Change)";
				icon.src = baseurl+"assets/images/svgs/empty_star.svg";

			}else{ // location is now verified
				text.innerTExt = "Verified (Click to Change)";
				icon.src = baseurl+"assets/images/svgs/full_star.svg";

			}

		}
		);

	}

}



// Adds an activity to the list for activities for a location
function add_loc_activity(){
	event.preventDefault();
	var acts = document.getElementById("add_loc_activity_list");
	var field = document.getElementById("add_loc_activity_input");
	field.value = field.value.trim();
	if(field.value.length < 4){
		console.log("Too short a word for an activity");
		return false;
	}

	for (var act_index = 0; act_index < acts.children.length; act_index++){
		var child = acts.children[act_index];
		if(child.innerText == field.value){
			console.log("Already included");
			return false;
		}
	}

	insert_location_element(field.value);




	field.value = '';
	return true;
}


// creates a list element and inserts location information on the edit/insert form
function insert_location_element(value,id=null){

	var newNode = document.createElement("li");
	// newNode.setAttribute("onclick", "selectedActivityClick()");
	newNode.innerText = value;
	acts.appendChild(newNode);

}


// Update the tour location modal with a list of tour locations
function insert_result_element(location_list) {

	// update search result count
	document.getElementById("site_search_result_count").innerText = location_list.length;


	//update list with the children
	var list_div = document.getElementById("site_result_div");
	list_div.innerHTML = "";
	if (location_list.length > 0){ // If results exist, populate list
		location_list.forEach(json => {
			list_div.appendChild(create_result_tile(json));
		});

		//Update the expanded list with the first result
		on_location_expand(location_list[0]["toursite_id"]);
	}else { //else show message for no results TODO
	}
}


// creates and returns an html element for the result tile of tour sites
function create_result_tile(map) {
	var title = map["site_name"];
	var location = map["site_location"];
	var id = map["toursite_id"];

	const locationCard = document.createElement("div");
	locationCard.classList.add('location-card', 'border', 'p-4', 'rounded', 'my-3');

	// create the header div with site name and location
	const header = document.createElement('div');
	header.classList.add('header', 'd-flex', 'justify-content-between');
	const siteNameH1 = document.createElement('h1');
	siteNameH1.classList.add('easygo-fs-3', 'text-capitalize');
	siteNameH1.textContent = title;
	const siteLocationH5 = document.createElement('h5');
	siteLocationH5.classList.add('easygo-fs-4', 'text-orange');
	siteLocationH5.textContent = location;
	header.appendChild(siteNameH1);
	header.appendChild(siteLocationH5);
	locationCard.appendChild(header);

	// create the text-gray-1 div with time and buttons
	const textGray1 = document.createElement('div');
	textGray1.classList.add('text-gray-1', 'easygo-fs-6');

	// create the time div with site location
	const time = document.createElement('div');
	const timeLocationSpan = document.createElement('span');
	timeLocationSpan.textContent = location;
	time.appendChild(timeLocationSpan);
	textGray1.appendChild(time);


	locationCard.appendChild(textGray1);

	// create the pt-3 div with the See More button
	const pt3 = document.createElement('div');
	pt3.classList.add('pt-3');
	const seeMoreButton = document.createElement('button');
	seeMoreButton.classList.add('easygo-btn-1', 'easygo-fs-5', 'py-1', 'px-4');
	seeMoreButton.textContent = 'See More';
	seeMoreButton.setAttribute('onclick', `on_location_expand("${id}")`);
	pt3.appendChild(seeMoreButton);
	locationCard.appendChild(pt3);

	return locationCard;

}