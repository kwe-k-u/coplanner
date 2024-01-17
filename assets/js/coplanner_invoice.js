

function pay_invoice(){
	let itinerary_id = url_params("id");
	send_request("POST",
	"processors/processor.php/get_itinerary_invoice",
	{
		"itinerary_id" : itinerary_id
	},(response)=>{
		let invoice = response.data.invoice;
		let amount_left = Math.round(invoice.amount_left*100);
		let user_email =invoice.email;
		invoice["purpose"] = "Payment for itinerary "+itinerary_id;
		invoice["payment_purpose"] = "itinerary_payment";


		if(amount_left > 0){
			payWithPaystack("GHS",amount_left,user_email,invoice);
		}else{
			showToast("The cost of the itinerary has been covered by a previous transaction");
		}
	})
	//finalise itinerary
	// paystack payment
}

function set_invoice_reminder(){
	alert("Reminders will be implemented soon");
}