const tabs = document.querySelectorAll('.tab-pane');

document.addEventListener('DOMContentLoaded', () => {
	const radios = document.querySelectorAll('input[name="btnradio"]');

	radios.forEach((radio)=> {
		radio.addEventListener("click",showDashTab);
	})
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