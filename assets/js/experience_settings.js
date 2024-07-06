const tabs = document.querySelectorAll('.tab-pane');
const shared_experience_tab = document.getElementById("shared-experience-tab");
const package_box = document.getElementById("package-1");
const package_box_clone = package_box.cloneNode(true);
package_box_clone.classList.remove('hide');


document.addEventListener('DOMContentLoaded', () => {
	const radios = document.querySelectorAll('input[name="btnradio"]');
	radios.forEach((radio)=> {
		radio.addEventListener("click",showDashTab);
	});
});

function showDashTab(){
	let selectedTab = document.querySelector('input[name="btnradio"]:checked').getAttribute("data-toggle-target");
	tabs.forEach((tab)=> {
		if (tab.id != selectedTab){
		tab.classList.remove("active");
		}else{
				tab.classList.add("active");
		}
	});



}

function remove_package(button){
	let parent_id = button.parentNode.parentNode.id;
	// let result = get_packages(parent_id)[parent_id];
	if (confirm(" Are you sure you want to delete this package")){
		document.getElementById(parent_id).remove();
	}
}

function get_experience_tags(){
	let checkboxes = document.getElementsByName("experience_tag");
    // Initialize an array to hold the selected tag IDs
    let selectedTags = [];

    // Iterate through the checkboxes
    checkboxes.forEach(function(checkbox) {
        if (checkbox.checked) {
            selectedTags.push(checkbox.value);
        }
    });

	return selectedTags;
}

function create_experience(){
	event.preventDefault();
	let tags = get_experience_tags();
	let name = document.getElementsByName("experience_name")[0].value;
	let description = document.getElementsByName("experience_description")[0].value;
	let flyer = document.getElementsByName("company_logo")[0].files;
	let start_date = document.getElementsByName("start_date")[0].value;
	let booking_fee = document.getElementsByName("booking_fee")[0].value;
	let num_seats = document.getElementsByName("num_seats")[0].value;

	let payload = {
		"experience_name" : name,
		"start_date" : start_date,
		"description" : description,
		"flyer" : flyer[0],
		"price" : booking_fee,
		"seat_count" : num_seats,
		"experience_tags" : tags
	};

	if (!package_box.classList.contains("hide")){
		payload["packages"] = get_packages();
	}



	send_request("POST",
		"processors/processor.php/create_shared_experience",
		payload,
		(response) => {
			if (response.status == 200){
				goto_page("curator/destinations.php?experience_id="+response.data.experience_id);
			}else{
				openDialog(response.data.msg);
			}
		}
	)




}


function duplicate_package_box( ){
	if (package_box.classList.contains("hide")){
		package_box.classList.remove("hide");
		return;
	}
	let newBox = package_box_clone.cloneNode(true);
	newBox.id = "package-"+(document.getElementsByClassName("package-box").length+1);
	shared_experience_tab.insertBefore(newBox,document.getElementById("add-package-button-parent"))
}
function get_packages(package_id = null) {

    let package_boxes = null;
	if(package_id == null){
		package_boxes = document.getElementsByClassName("package-box");
	} else{
		package_boxes = [document.getElementById(package_id)];
	}
    let result = {};

    for (const box of package_boxes) {
        result[box.id] ={
            "package_name" : box.querySelector("input[name='package_name']").value,
            "fee" : box.querySelector("input[name='booking_fee']").value,
            "seats" : box.querySelector("input[name='num_seats']").value,
            "start_date" : box.querySelector("input[name='start_date']").value,
            "end_date" : box.querySelector("input[name='end_date']").value,
            "package_description" : box.querySelector("input[name='package_description']").value
        };
    }

	return result;
}



// function duplicateChildNodes (parentId){
// 	var parent = document.getElementById(parentId);
// 	let newBox = parent.cloneNode();
// 	NodeList.prototype.forEach = Array.prototype.forEach;
// 	var children = parent.childNodes;
// 	children.forEach(function(item){
// 	  var cln = item.cloneNode(true);
// 	  newBox.appendChild(cln);
// 	});
// 	return parent;
//   };