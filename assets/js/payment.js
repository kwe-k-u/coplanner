function book_trip(form){
	event.preventDefault();
	var payment_method = form.payment_method.value;
	var user_id = form.user_id.value;
	var contact_name = form.contact_name.value;
	var contact_number = form.contact_number.value;
	var seats = form.seats.value;


	payload = "action=trip_payment";
	payload += "&trip_id=" + url_params("trip_id");
	payload += "&user_id=" + user_id;
	payload += "&seats=" + seats;
	payload += "&contact_name" + contact_name;
	payload += "&contact_number" + contact_number;

	//get details for respective payment options
	if (payment_method == "mobile money"){
		payload += mobile_money_payload(form);
	}else {
		payload += credit_card_payload(form);
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
	var payload = "&payment_method=momo";
	payload += "&network=" + form.network.value;
	payload += "&number=" + form.number.value;

	return payload;
}

function credit_card_payload(form){
	var payload = "&payment_method=card";

	return payload;
}

