function book_trip(form){
	event.preventDefault();
	var payment_method = form.payment_method.value;
	var user_id = form.user_id.value;
	var contact_name = form.contact_name.value;
	var contact_number = form.contact_number.value;
	var seats = form.seats.value;


	// payload = "action=trip_payment";
	// payload += "&trip_id=" + url_params("trip_id");
	// payload += "&user_id=" + user_id;
	// payload += "&seats=" + seats;
	// payload += "&contact_name" + contact_name;
	// payload += "&contact_number" + contact_number;
	let payload = {
		"action" : "trip_payment",
		"trip_id" : url_params("trip_id"),
		"user_id" : user_id,
		"seats" : seats,
		"contact_name" : contact_name,
		"contact_number" : contact_number
	};

	//get details for respective payment options
	if (payment_method == "mobile money"){
		let m = mobile_money_payload(form);
		for (key in m){
			payload[key] = m[key];
		}
	}else {
		let m = credit_card_payload(form);
		for (key in m){
			payload[key] = m[key];
		}
	}


	//initiate 10 second pause to prevent over booking
	show_loader(form);

	send_request("POST",
	"processors/processor.php",
	payload,
	(response) => {
		alert(response);
	}
	);


}

function mobile_money_payload(form){
	return {
		"payment_method" : "momo",
		"network" : form.network.value,
		"number" : form.number.value,
	};
}

function credit_card_payload(form){
	return {
		"payment_method" : card
	};

}

