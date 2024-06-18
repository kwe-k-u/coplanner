document.addEventListener('DOMContentLoaded', () => {
	let sidebar_burgers = Array.from(document.getElementsByClassName("burger-btn"))

	sidebar_burgers.forEach((burger)=> {
		burger.addEventListener("click",show_dash_sidebar);
	});
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