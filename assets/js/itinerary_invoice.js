

function pay_invoice(){
	let invoice_id = url_params("id");
	send_request("POST",
	"processors/processor.php/get_invoice",
	{
		"invoice_id" : invoice_id
	},(response)=>{
		let invoice = response.data.invoice;
		let amount_left = Math.round(invoice.amount_left*100);
		let user_email =invoice.email;
		invoice["purpose"] = "Payment for invoice "+ invoice_id;
		invoice["payment_purpose"] = "itinerary_payment";


		if(amount_left >= 0){
			payWithPaystack("GHS",amount_left,user_email,invoice,);
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