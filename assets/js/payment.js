

async function book_trip(form) {
	event.preventDefault();
	// var payment_method = form.payment_method.value;
	var user_id = form.user_id.value;
	var contact_name = form.contact_name.value;
	var contact_number = form.contact_number.value;
	var adults = form.num_adults.value;
	var kids = form.num_kids.value;
	var tour_id = url_params("tour_id");
	var charge_amount = 0;
	var currency = "GHS";
	var email = form.invoice_email.value;


	let payload = {
		"action" : "book_standard_tour",
		"tour_id" : tour_id,
		"user_id" : user_id,
		"num_kids" : kids,
		"num_adults" : adults,
		"contact_name" : contact_name,
		"contact_number" : contact_number
	};
	//get seat charge from database
	await send_request(
		"POST",
		"processors/processor.php",
		{
			"action" : "get_tour_charge",
			"tour_id" : tour_id,
			"adult_seats" : adults,
			"kid_seats" : kids
		},
		(response)=>{
			var data = response["data"];
			 charge_amount = data["amount"] * 100;
			 currency = data["currency"];

			//initiate 10 second pause to prevent over booking
			show_loader(form,15000);



			payWithPaystack(currency,charge_amount,email,payload);
		}
	);
	return 1;

	// //get details for respective payment options
	// if (payment_method == "mobile money"){
	// 	let m = mobile_money_payload(form);
	// 	for (key in m){
	// 		payload[key] = m[key];
	// 	}
	// }else {
	// 	let m = credit_card_payload(form);
	// 	for (key in m){
	// 		payload[key] = m[key];
	// 	}
	// }


	// send_request("POST",
	// "processors/processor.php",
	// payload,
	// (response) => {
	// 	console.log(response);
	// }
	// );


}


function payWithPaystack(currency, charge_amount,c_email,payload){
	let handler = PaystackPop.setup({
		key: paystack_public_key,
		email: c_email,
		amount: charge_amount,
		currency: currency,
		// ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
		// label: "Optional string that replaces customer email"

		onClose: function(){
			alert('Window closed.');
		},

		callback: function(response){
			// Confirm payment receipt
			send_request(
				"POST",
				"processors/processor.php",
				{
					"action" : "book_standard_tour",
					"provider" : "paystack",
					"amount_expected" : charge_amount,
					"currency_expected" : currency,
					"payload": JSON.stringify(payload),
					"response" : JSON.stringify(response)
				},
				(res)=>{
					console.log(res);
				}
			)
		}
		});

		handler.openIframe();
}

function display_invoice(fee,max_seats){
	var seats = document.getElementById("seat_span");
	var seat_price = document.getElementById("invoice_tour");
	var discount = document.getElementById("invoice_discount");
	var invoice_subtotal = document.getElementById("invoice_subtotal");
	var invoice_vat = document.getElementById("invoice_vat");
	var invoice_tourism = document.getElementById("invoice_tourism");
	var invoice_total = document.getElementById("invoice_total");


	var adult_field = document.getElementById("num-adults");
	var kid_field = document.getElementById("num-kids");

	var total = parseInt(adult_field.value) + parseInt(kid_field.value)

	if(total > max_seats){
		if (event.target.id == "num-kids"){
			kid_field.value = max_seats - parseInt(adult_field.value);
		}else {
			adult_field.value = max_seats - parseInt(kid_field.value);
		}
		alert("This tour has only " + max_seats + " seats available");
		total = parseInt(adult_field.value) + parseInt(kid_field.value);
	}
	//calculate new fees
	//seat charge
	var seat_charge = total * fee;
	//vat charge
	var vat_charge = seat_charge * vat_rate;
	//tourism charge
	var tourism_charge = seat_charge * tourism_levy;
	//sub_total_charge
	var sub_total_charge = seat_charge
	//total charge
	var total_charge = sub_total_charge + vat_charge + tourism_charge;

	//update fields
	seats.innerText = total;
	invoice_subtotal.innerText = sub_total_charge;
	invoice_vat.innerText = vat_charge;
	invoice_tourism.innerText = tourism_charge;
	invoice_total.innerText = total_charge;
	seat_price.innerText = seat_charge;
	console.log("change");


	console.log(total);





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

