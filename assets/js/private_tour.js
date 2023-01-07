
	function request_private_tour(form){
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

		var payload = "action=request_private_tour";
		payload += "&user_id=" + user_id;
		payload += "&currency=" + currency;
		payload += "&max_budget=" + max_b;
		payload += "&min_budget=" + min_b;
		payload += "&description=" + desc;
		payload += "&start_date=" + start_date;
		payload += "&end_date=" + end_date;
		payload += "&state=" + state;
		payload += "&person_count=" + count;

		send_request(
			 "POST",
			 "processors/processor.php",
			 payload,
			 (response) =>{
				alert(response);
			 }
		);

	}

	function edit_request(id){
		show_loader();
	}


	function bid_private_trip(form){
		event.preventDefault();

		var request_id = form.request_id.value;
		var comment = form.comment.value;
		var fee = form.fee.value;
		var curator = form.curator_id.value;

		payload = "action=bid_private_trip";
		payload += "&request_id=" + request_id;
		payload += "&comment=" + comment;
		payload += "&fee="+fee;
		payload += "&curator_id="+curator;

		send_request(
			"POST",
			"../processors/processor.php",
			payload,
			(response)=>{
				alert(response);
			}
		);
	}