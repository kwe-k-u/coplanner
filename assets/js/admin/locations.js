var location_info_div = document.getElementById("site_info_col");
var location_form_div = document.getElementById("site_form_col");
var location_search_results = document.getElementById("site_result_div");
var submit_loc_btn = document.getElementById("submit_loc_btn");

var name_field = document.getElementById("name");
var description_field = document.getElementById("description");
var location_field = document.getElementById("location");
var country_field = document.getElementById("country");
var gps_field = document.getElementById("cordinates");
var rating_field = document.getElementById("rating");
var review_count_field = document.getElementById("num_reviews");
// var owner_name_field = document.getElementById("owner_name");
// var owner_number_field = document.getElementById("owner_number");
// var website_field = document.getElementById("website");
// var tiktok_field = document.getElementById("tiktok");
// var instagram_field = document.getElementById("instagram");
// var facebook_field = document.getElementById("facebook");
var local_img = document.getElementById("images");


var ext_img_list = document.getElementById("external-images");
var ext_img_field = document.getElementById("external-image-field");
var activity_list = document.getElementById("add_loc_activity_list");
var activity_field = document.getElementById("add_loc_activity_input");
var activity_price_field = document.getElementById("add_loc_activity_price_input");


var info_image_section = document.getElementById("location-info-images");
var info_activity_list = document.getElementById("activity-list-div");

var utility_list = document.getElementById("utility_list");

function select_destination_utility(select){
	var key = select.value;
	var value = select.options[select.selectedIndex].text;

	if(key == ""){ // If default is selected
		return null;
	}

	var option = document.createElement("li")
	option.onclick = function (){
		option.remove();
	}
	option.id = key;
	option.innerText = value;

	utility_list.appendChild(option);
	console.log("added")
}


function select_destination_type(select){
	var key = select.value;
	var value = select.options[select.selectedIndex].text;

	if(key == ""){ // If default is selected
		return null;
	}

	var option = document.createElement("li")
	option.onclick = function (){
		option.remove();
	}
	option.id = key;
	option.innerText = value;

	destination_type_list.appendChild(option);
}


function insert_list_element(group_list,value,id=null){

	var newNode = document.createElement("li");

	newNode.setAttribute("onclick", "removeExtLink(this)");
	if(id != null){
		newNode.setAttribute("id", id);
	}
	// newNode.setAttribute("onclick", "selectedActivityClick()");
	newNode.innerText = value;
	group_list.appendChild(newNode);

}

// Switches the display of the location form. If the location edit is tapped
// it prefills the form with the existing information
function add_location_toggle(location_id = null){

	if(location_form_div.classList.contains("hide")){
		location_info_div.classList.toggle("hide");
		location_form_div.classList.toggle("hide");
	}


	//reset fields

	// empty fields if data is existing in them

	name_field.value = "";
	description_field.value = "";
	location_field.value = "";
	country_field.value = "";
	gps_field.value = "";
	activity_list.innerHTML = "";
	utility_list.innerText = "";

	activity_field.value = "";
	activity_price_field.value = "";
	ext_img_field.value = "";
	ext_img_list.innerHTML = "";

	// owner_name_field.value = "";
	// owner_number.value = "";
	// website_field.value = "";
	// tiktok_field.value = "";
	// instagram_field.value = "";
	// facebook_field.value = "";

	try{ //file reset

		local_img.value = null;
		//old browser reset
		local_img.type = "text";
		local_img.type = "file";
	}catch(e){}




	submit_loc_btn.setAttribute("value","");

	if(location_id != null){ // edit location
		submit_loc_btn.innerText = "Edit destination";
		 // prefill fields with location information
		//get location info
		send_request("POST",
		"processors/processor.php/get_destination_info?id="+location_id,
		{},
		(response)=>{
			// alert(response);
			const data = response["data"]["data"];

			// document.getElementById("name");
			name_field.value = data["destination_name"];
			description_field.value = "";//data["destination_description"];
			location_field.value = data["location"];
			country_field.value = "";//data["country"];
			gps_field.value = data["longitude"].toString()+","+ data["latitude"].toString();
			rating_field.value = data["rating"];
			review_count_field.value = data["num_rating"];
			// data["socials"].forEach(element => {
			// 	switch(element.social_type){
			// 		case "instagram":
			// 			instagram_field.value = element.social_link;
			// 			break;
			// 		case "twitter":
			// 			twitter_field.value = element.social_link;
			// 			break;
			// 		case "facebook":
			// 			facebook_field.value = element.social_link;
			// 			break;
			// 		case "tiktok":
			// 			tiktok_field.value = element.social_link;
			// 			break;
			// 		case "website":
			// 			website_field.value = element.social_link;
			// 			break;
			// 		default:
			// 			console.log("unknown ");
			// 	}
			// });

			for (let i = 0; i < data["activities"].length; i++) {
				let activity = data["activities"][i];
				insert_location_element(activity["activity_name"], activity["price"],activity["activity_id"]);
			}

			for(let i=0; i < data["utilities"].length; i++){
				let utility = data["utilities"][i];
				insert_list_element(utility_list,utility["type_name"],utility["type_id"]);
			}

			for(let i = 0; i < data["destination_type"].length; i++){
				let types = data["destination_type"][i];
				insert_list_element(destination_type_list,types["type_name"],types["type_id"]);
			}


			//set submit button to insert
			submit_loc_btn.setAttribute("value",location_id);
		});

	}
}


// Ensures the location info section is visible and updates the location info
// being displayed
function expand_location_info(id) {

	if(location_info_div.classList.contains("hide")){
		location_info_div.classList.toggle("hide");
		location_form_div.classList.toggle("hide");
	}
	var title = document.getElementById("location-info-title");
	var description = document.getElementById("location-info-desc");



	send_request(
		"POST",
		"processors/processor.php/get_destination_info?id="+id,
		{},
		(response) => {
			var json = response["data"]["data"];
			var activity = json["activities"];

			title.innerText = json["destination_name"];
			description.innerText = "No information available";//json["destination_description"];

			// var image_list = json.media;
			// reset_location_info_images(image_list);

			reset_location_info_activities(activity);
			// $(".activity-span").on("click", activity_click);
		}
	);
}

function reset_location_info_activities(activities){

	info_activity_list.innerHTML = "";
	activities.forEach(element => {
		let newNode = document.createElement("span");
		newNode.classList.add("px-3","py-1","border-blue","rounded","border","easygo-fs-5","text-capitalize","activity-span");
		newNode.id = element.activity_id;
		newNode.innerText = element.activity_name;
		info_activity_list.appendChild(newNode);
	});
}

function reset_location_info_images(images){
	info_image_section.innerHTML = "";

	images.forEach(element => {
		let image_sec = document.createElement("div");
		image_sec.classList.add("grid-item");
		image_sec.innerHTML = "<img class='w-100 h-100 rounded' src='"+element.media_location+"' alt='scene 1'>";
		info_image_section.appendChild(image_sec);
	});

	//TODO:: if no image, show a default ui

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




// Adds an activity to the list for activities for a location
function add_loc_activity(){
	event.preventDefault();
	activity_field.value = activity_field.value.trim();
	if(activity_field.value.length < 4){
		console.log("Too short a word for an activity");
		return false;
	}

	for (var act_index = 0; act_index < activity_list.children.length; act_index++){
		var child = activity_list.children[act_index];
		if(child.innerText.includes(activity_field.value)){
			console.log("Already included");
			return false;
		}
	}

	insert_location_element(activity_field.value.trim(),activity_price_field.value.trim());

	activity_field.value = '';
	activity_price_field.value = "";
	return true;
}


// creates a list element and inserts location information on the edit/insert form
function insert_location_element(value,price,id=null){

	var newNode = document.createElement("li");

	newNode.setAttribute("onclick", "removeExtLink(this)");
	if(id != null){
		newNode.setAttribute("id", id);
	}
	// newNode.setAttribute("onclick", "selectedActivityClick()");
	newNode.innerText = value ;
	var priceNode = document.createElement("span");
	priceNode.className = "easygo-fs-5";
	priceNode.innerText = " GHS "+price.toString();
	newNode.appendChild(priceNode);
	activity_list.appendChild(newNode);

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
		expand_location_info(location_list[0]["destination_id"]);
	}else { //else show message for no results TODO
	}
}


// creates and returns an html element for the result tile of tour sites
function create_result_tile(map) {
	var title = map["destination_name"];
	var location = map["destination_location"];
	var id = map["destination_id"];
	const is_verified = map["is_verified"] == 1;

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


	//create section with verification toggle
	const ver_div = document.createElement("div");
	const ver_img_span = document.createElement("span");
	const ver_img = document.createElement("img");

	ver_div.classList.add("rating-and-info","d-flex","align-items-center","gap-1");
	// creating star display for verification
	ver_img.src = baseurl+"assets/images/svgs/"+(is_verified ? "full_star.svg" : "empty_star.svg");
	ver_img.setAttribute("id","verified_image_"+ id);
	ver_img_span.appendChild(ver_img);
	ver_div.appendChild(ver_img_span);

	//creating span text for verification
	textGray1.appendChild(ver_div);


	// create the time div with site location
	const time = document.createElement('div');
	const timeLocationSpan = document.createElement('span');
	timeLocationSpan.textContent = location;
	time.appendChild(timeLocationSpan);
	textGray1.appendChild(time);




	locationCard.appendChild(textGray1);

	// create the pt-3 div with the Expand and edit button
	const pt3 = document.createElement('div');
	pt3.classList.add('pt-3',"gap-2","d-flex");

	//on location expand button
	const expandButton = document.createElement('button');
	expandButton.classList.add('easygo-btn-1', 'easygo-fs-5', 'py-1', 'px-4');
	expandButton.textContent = 'Expand';
	expandButton.setAttribute('onclick', `expand_location_info("${id}")`);

	pt3.appendChild(expandButton);


	//on location edit button
	const editButton = document.createElement('button');
	editButton.classList.add('easygo-btn-2', 'easygo-fs-5', 'py-1', 'px-4');
	editButton.textContent = 'Edit';
	editButton.setAttribute('onclick', `add_location_toggle("${id}")`);

	pt3.appendChild(editButton);


	locationCard.appendChild(pt3);

	return locationCard;

}

function get_div_list(div_name){
	var utilities = {};
	for (var ut_index = 0; ut_index < div_name.children.length; ut_index++){
		var child = div_name.children[ut_index];
		utilities[child.id] = child.innerText;
	}
	return utilities;
}



//submits the location info
function create_site(form){
	event.preventDefault();
	var activities = [];

	for (var act_index = 0; act_index < activity_list.children.length; act_index++){
		var child = activity_list.children[act_index];
		activities.push(child.innerText);
	}


	var payload = {
			"destination_name" : form.name.value,
			"destination_location" : form.location.value,
			"site_description" : form.description.value,
			"external_images" : get_ext_images(),
			"site_id" : form.loc_id.value,
			"country" : form.country.value,
			"activities" : activities,
			"utilities" : get_div_list(utility_list),
			"destintion_type" : get_div_list(destination_type_list),
			"rating" : form.rating.value,
			"num_ratings" : form.num_reviews.value,
			"cordinates" : form.cordinates.value
		};
	send_request(
		"POST",
		"processors/processor.php/" +(form.loc_id.value == "" ? "create_destination" : "edit_destination"),
		payload,
		(response) => {
			console.log(response);
			alert(response['data']['msg']);
		},
		form.images.files
	);

}
//TODO:: when info of destination is displayed, click on activity for destination to mark as verified or unverified


function insert_external_image_url(){
	event.preventDefault();

	var newEntry = document.createElement("li");
	newEntry.innerText = ext_img_field.value;
	newEntry.setAttribute("onclick", "removeExtLink(this)");
	ext_img_field.value = "";

	ext_img_list.appendChild(newEntry);

}

function get_ext_images(){
	var list = [];

	for (let i = 0; i < ext_img_list.children.length; i++){
		list[i] = ext_img_list.children[i].innerText;
	}

	return list;
}


function removeExtLink(){
	event.target.remove()
}



function create_utility(form){
	event.preventDefault();
	let name = form.utility_name.value;
	send_request("POST","processors/processor.php/create_utility",
	{
		"utility_name" : name
	},
	(response)=>{
		if(response.status == 200){

			// Add an option to the utility dropdown
			var selectElement = document.getElementById("utility_options");
			// Create a new option element
			var newOption = document.createElement('option');
			newOption.value = response.data.utility_id;
			newOption.text = response.data.utility_name;

			// Add the new option to the select element
			selectElement.appendChild(newOption);
		}else{
			alert(response.data.msg);
		}
	}
	)
}




function create_type_of_destination(form){
	event.preventDefault();
	let name = form.destination_type_name.value;
	send_request("POST","processors/processor.php/create_type_of_destination",
	{
		"destination_type_name" : name
	},
	(response)=>{
		if(response.status == 200){

			// Add an option to the utility dropdown
			var selectElement = document.getElementById("destination_type_options");
			// Create a new option element
			var newOption = document.createElement('option');
			newOption.value = response.data.type_id;
			newOption.text = response.data.type_name;

			// Add the new option to the select element
			selectElement.appendChild(newOption);
		}else{
			alert(response.data.msg);
		}
	}
	)
}

