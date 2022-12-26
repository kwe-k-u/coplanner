
function signup(){
	event.preventDefault();
	var form1 = document.getElementById("register-form-1");
	// var form2 = document.getElementById("register-form-2");


	var name = form1.user_name.value;
	var email = form1.email.value;
	var password = form1.pswd.value;
	var c_password = form1.con_pswd.value;
	var phone = form1.phone.value;
	var company_name = form1.company_name.value;
	var company_country = document.getElementById("country_selected_icon").href.split("#")[1];
	// alert(company_country)
	var company_logo = document.getElementById("company_logo");
	var id_front = document.getElementById("gov_id_front");
	var id_back = document.getElementById("gov_id_back");
	var inc_doc = document.getElementById("inc_doc");

	payload ="action=signup";
	payload += "&user_name="+name;
	payload += "&email="+email;
	payload += "&password="+password;
	payload += "&phone_number="+phone;
	payload += "&country="+company_country;
	payload += "&curator_name="+company_name;
	payload += "&type=curator";

	// alert(id_back.files.length);



	//register user
	send_request(
		"POST",
		"processors/processor.php",
		payload,
		(response) =>{
			// alert(response);
			var json = JSON.parse(response);
			// if(json["status_code"]!= 200){
			// 	alert(json["data"]["msg"]);
			// 	return false;
			// }

			var user_id = "999372d45082a25cf742e37b2f74ee2d";
			var curator_id = "40c0f486531b5ce8c6d3500ec637a2e6";
			// var user_id = json["data"]["user_id"];
			// var curator_id = json["data"]["curator_id"];


			//uploading incorporation document if one exists
			if(inc_doc.files.length >0){
				doc_path = upload_image("inc_doc","confidential", {curator_id: curator_id});
			}

			//uploading incorporation document if one exists
			if(id_front.files.length >0){
				upload_image("gov_id_back","confidential", {user_id : user_id,
				callback: (back_response) =>{
					upload_image("gov_id_front","confidential", {user_id: user_id,
					callback: (front_response)=> {
						var json = JSON.parse(back_response);
						var back_id = json["data"]["media_id"];

						json = JSON.parse(front_response);
						var front_id = json["data"]["media_id"];
						update_curator_manager_id(user_id, front_id, back_id);
					}});
				}});

			}


			//uploading incorporation document if one exists
			if(company_logo.files.length >0){

				//callback for when upload of image completes
				var upload_fn = (response)=>{
					var json = JSON.parse(response);
					var media_id = json["data"]["media_id"];
					update_curator_logo(media_id, curator_id);

				}

				upload_image("company_logo","picture", {curator_id: curator_id, callback : upload_fn});
			}
			// alert("Sign up successful");

		}
	);
	// upload logo
	// upload confidential info

	// $res = upload_image("company_logo",user_id,"image");
	// $res = upload_image("gov_id_ront",user_id,"confidential");
	// $res = upload_image("gov_id_back",user_id,"confidential");
	// $res = upload_image("inc_doc",user_id,"confidential");
	// alert($res);

	//upload if provided: company logo
	//upload if provided: national id front & back
	//upload if provided: incorporation document


	// alert(name);
}


function on_country_select(country){
	var selected = document.getElementById("country_selected_icon");
	selected.href="#"+country;
}
