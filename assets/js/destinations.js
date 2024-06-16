

function show_destination_modal(button){
	// document.getElementById();
	let modal = button.getAttribute("data-target");

	document.getElementById(modal).style.display = "block";
}

function hide_destination_modal(button){
	let modal = document.getAnimations("data-target");
	document.getElementById(modal).style.display = "none";
}