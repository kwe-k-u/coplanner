document.addEventListener('DOMContentLoaded', () => {
	let sidebar_burgers = Array.from(document.getElementsByClassName("burger-btn"))

	sidebar_burgers.forEach((burger)=> {
		burger.addEventListener("click",show_dash_sidebar);
	});


	//get the current url. using switch, if it contains dashboard.php, add 'active' to the li that contains dashboard in its class
	let currentUrl = window.location.pathname;
	let navItems = Array.from(document.getElementById("dash-sidebar").querySelector(".nav").getElementsByTagName("li"));

	if(currentUrl.includes("dashboard.php")){
		navItems.forEach((item) => {
			if (item.innerHTML.includes("Dashboard")) {
				item.querySelector(".nav-link").classList.add("active");
				item.querySelector(".nav-link").classList.remove("link-dark");
			}
		});
	}else if (currentUrl.includes("trips.php")){
		navItems.forEach((item) => {
			if (item.innerHTML.includes("Your Trips")){
				item.querySelector(".nav-link").classList.add("active");
				item.querySelector(".nav-link").classList.remove("link-dark");
			}
		});
	}else if (currentUrl.includes("travel_plan_requests.php")){
		navItems.forEach((item) => {
			if (item.innerHTML.includes("Travel Plan requests")){
				item.querySelector(".nav-link").classList.add("active");
				item.querySelector(".nav-link").classList.remove("link-dark");
			}
		});
	}else if (currentUrl.includes("bookings.php")){
		navItems.forEach((item) => {
			if (item.innerHTML.includes("Bookings")){
				item.querySelector(".nav-link").classList.add("active");
				item.querySelector(".nav-link").classList.remove("link-dark");
			}
		});
	}



});

function show_dash_sidebar(){
	let sidebar = document.getElementsByTagName("aside")[0];
	sidebar.style.display = "flex";
	sidebar.addEventListener("click", (event)=> {
		if (event.target.classList.contains("nav-link")){
			sidebar.style.display = "none";
		}
	});
}

function quick_edit_prep(){
	let target = event.target;
	let id = target.getAttribute("data-experience-id");
	send_request("POST","processors/processor.php/get_experience_details",
		{
			"experience_id" : id
		}, (response)=>{
			if (response.status == 200){
				document.getElementById("quick-edit-seats").value = response.data.number_of_seats;
				document.getElementById("quick-edit-fee").value = response.data.booking_fee;
				document.getElementById("quick-edit-status").value = response.data.is_visible;
				document.getElementById("quick-edit-modal").setAttribute("experience_id",id);
				newDisplayUpload(document.getElementById("company_logo").getAttribute("data-display-target"),response.data.media_location);
			}else{
				$("quick-edit-modal").modal("hide");
				openDialog(response.data.msg);
			}
		}
	)
	console.log(id);
	document.getElementById("adv-edit-btn").setAttribute("href",baseurl+"curator/experience_settings.php?experience_id="+id);
}

function quick_edit_submit(){
	let experience_id = document.getElementById("quick-edit-modal").getAttribute("experience_id");
	let seats = document.getElementById("quick-edit-seats").value;
	let fee = document.getElementById("quick-edit-fee").value;
	let status = document.getElementById("quick-edit-status").value;
	let flyer = document.getElementById("company_logo").files[0];

	send_request("POST","processors/processor.php/quick_edit_experience",{
		"experience_id" : experience_id,
		"seats" : seats,
		"fee" : fee,
		"status" : status,
		"flyer" : flyer
	},(response)=> {
		if (response.status == 200){
			// Hide modal
			$("#quick-edit-modal").modal("hide");
			//Update table row for experience
			let row = document.getElementById("trip_row_"+experience_id);
			row.children[3].innerText = "GHS "+fee;
			row.children[4].innerText = status == 1 ? "Published" : "Draft";
			// #show success toast
			showToast(response.data.msg);
		}else{
			openDialog(response.data.msg);
		}
	});
}