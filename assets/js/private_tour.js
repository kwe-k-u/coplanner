
function request_private_tour(form, request_id = null, custom = true) {
	event.preventDefault();
	var desc = form.desc.value;
	var currency = get_dropdown_value('currency_menu');
	var count = form.seats.value;
	var min_b = form.min_b.value;
	var max_b = form.max_b.value;
	var state = get_dropdown_value("publish_state");
	var user_id = form.user_id.value;
	var start_date = form.start.value;
	var end_date = form.end.value;
	let payload = {
		"user_id": user_id,
		"currency": currency,
		"max_budget": max_b,
		"min_budget": min_b,
		"description": desc,
		"start_date": start_date,
		"end_date": end_date,
		"state": state,
		"person_count": count,
		"type": (custom ? "custom" : campaign)
	};

	if (request_id == null) {
		payload["action"] = "request_private_tour"
	} else {
		payload["action"] = "edit_private_tour";
		payload["request_id"] = request_id;
	}

	// var payload = "action=" + (request_id == null ? "request_private_tour"
	// : ("edit_private_tour&request_id=" + request_id));

	send_request(
		"POST",
		"processors/processor.php",
		payload,
		(response) => {
			console.log(response);
			alert(response["data"]["msg"]);

			window.location.reload();
		}
	);

}

function edit_request(id) {
	show_loader();
	let payload = {
		"action": "get_custom_private_request",
		"request_id": id
	};
	send_request(
		"POST",
		"processors/processor.php",
		payload,
		(response) => {
			var json = response["data"];
			var desc = json["description"];
			var b_min = json["min_budget"];
			var b_max = json["max_budget"];
			var seats = json["person_count"];
			var state = json["publish_state"];
			var start = json["date_start"];
			var end = json["date_end"];
			var currency = json["currency"];
			prefill_tour_request(desc, b_min, b_max, seats, state, start, end, currency);
		}
	);
	document.getElementById("request_form").setAttribute("onsubmit", "return request_private_tour(this,'" + id + "')");
}


function clear_form() {
	document.getElementById("desc");
	document.getElementById("min_b");
	document.getElementById("max_b");
	document.getElementById("start-date");
	document.getElementById("end-date");
	document.getElementById("num-adults");

}


function prefill_tour_request(desc, b_min, b_max, seats, state, start, end, currency) {
	var e_desc = document.getElementById("desc");
	// var e_currency = document.getElementById("currency_menu");
	var e_budget_min = document.getElementById("min_b");
	var e_budget_max = document.getElementById("max_b");
	var e_start = document.getElementById("start-date");
	var e_end = document.getElementById("end-date");
	// var e_state = document.getElementById("publish_state");
	var e_seats = document.getElementById("num-adults");

	e_desc.value = desc;
	e_budget_max.value = b_max;
	e_budget_min.value = b_min;
	e_seats.value = seats;
	e_start.value = new Date(start).toISOString().split("T")[0];
	e_end.value = new Date(end).toISOString().split("T")[0];
	on_option_select("publish_state", state);
	on_option_select("currency_menu", currency);


}


// function bid_private_trip(form){
// 	event.preventDefault();

// 	var request_id = form.request_id.value;
// 	var comment = form.comment.value;
// 	var fee = form.fee.value;
// 	var curator = form.curator_id.value;

// 	// payload = "action=bid_private_trip";
// 	// payload += "&request_id=" + request_id;
// 	// payload += "&comment=" + comment;
// 	// payload += "&fee="+fee;
// 	// payload += "&curator_id="+curator;
// 	let payload = {
// 		"action" : "bid_private_trip",
// 		"request_id" : request_id,
// 		"comment" : comment,
// 		"fee" : fee,
// 		"curator_id": curator
// 	}

// 	send_request(
// 		"POST",
// 		"../processors/processor.php",
// 		payload,
// 		(response)=>{
// 			alert(response);
// 		}
// 	);
// }

function delete_request(id) {
	let payload = {
		"action": "delete_private_tour",
		"request_id": id
	};
	send_request("POST",
		"processors/processor.php",
		payload,
		(response) => {
			show_loader();
			alert(response["data"]["msg"]);
			window.location.reload();
		}
	)
}


async function react_to_bid(accepted, quote_id, email = null) {
	var payload = {
		"action": "react_to_quote",
		"accepted": accepted,
		"quote_id": quote_id,
	};

	if (accepted) {
		//get the fee for the quote and process transaction
		await send_request("POST",
			"processors/processor.php",
			{
				"action": "get_private_tour_charge",
				"quote_id" : quote_id
			},
			(response) => {
				const data = response["data"];
				const currency = data["currency"];
				const fee = data["total"];
				payWithPaystack(currency,fee,email, quote_id,
				accepted);


			}
		);

	} else {

		send_request(
			"POST",
			"processors/processor.php",
			payload,
			(response) => {
				// window.location.reload();
			}
		);
	}


}


function payWithPaystack(currency, charge_amount,c_email,quote_id,accepted){
	let handler = PaystackPop.setup({
		key: paystack_public_key,
		email: c_email,
		amount: charge_amount*100,
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
					"action" : "react_to_quote",
					"quote_id" : quote_id,
					"accepted" : accepted,
					"payment_reference" : response["reference"]
				},
				(res)=>{
					console.log(res);
				}
			)
		}
		});

		handler.openIframe();
}


function display_invoice(quote_id) {
	// var seats = document.getElementById("seat_span");
	var seat_price = document.getElementById("invoice_tour");
	var discount = document.getElementById("invoice_discount");
	var invoice_subtotal = document.getElementById("invoice_subtotal");
	var invoice_vat = document.getElementById("invoice_vat");
	var invoice_tourism = document.getElementById("invoice_tourism");
	var invoice_total = document.getElementById("invoice_total");
	var invoice_currency = document.getElementsByClassName("invoice_currency");

	//get quote information and pricing
	send_request(
		"POST",
		"processors/processor.php",
		{
			"action": "get_private_tour_charge",
			"quote_id": quote_id
		},
		(response) => {
			const data = response["data"];

			// Set currency field
			for (var i = 0; i < invoice_currency.length; i++) {
				invoice_currency[i].innerText = data["currency"];
			}

			seat_price.innerText = data["fee"];
			discount.innerText = data["discount"];
			invoice_vat.innerText = data["vat"];
			invoice_tourism.innerText = data["tourism_levy"];

			invoice_subtotal.innerText = data["sub_total"];
			invoice_total.innerText = data["total"];


		}
	)




}