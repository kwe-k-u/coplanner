

function make_trip_payment(){
	if(url_params("id")){
		pay_invoice();
	}else if (url_params("experience_id")){
		pay_experience();
	}
}

function pay_experience(){
	let experience_id = url_params("experience_id");
	send_request("POST",
	"processors/processor.php/get_experience_invoice",
	{
		"experience_id" : experience_id
	},(response)=>{
		console.log(response);
		let payout_account = response.data["payout_account_number"]
		let invoice = response.data["invoice"];
		let user_email = response.data["user_email"];
		let amount = Math.round(invoice.booking_fee*100);
		invoice["description"] = "Payment for experience "+ experience_id + " by user<"+user_email+">";
		invoice["payment_purpose"] = "experience_payment";

		if(payout_account){
			payWithPaystack("GHS",amount,user_email,invoice, payout_account);
		}else{
			payWithPaystack("GHS",amount,user_email,invoice);
		}
	})
}


function pay_invoice(){
	let invoice_id = url_params("id");
	send_request("POST",
	"processors/processor.php/get_itinerary_invoice",
	{
		"invoice_id" : invoice_id
	},(response)=>{
		let invoice = response.data.invoice;
		let amount_left = Math.round(invoice.amount_left*100);
		let user_email =invoice.email;
		invoice["description"] = "Payment for invoice "+ invoice_id +" by user <"+user_email+">";
		invoice["payment_purpose"] = "itinerary_payment";


		if(amount_left >= 0){
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