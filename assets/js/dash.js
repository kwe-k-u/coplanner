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