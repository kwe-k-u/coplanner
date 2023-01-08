
	function request_private_tour(form, request_id = null){
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

		var payload = "action=" + (request_id == null ? "request_private_tour"
		: ("edit_private_tour&request_id=" + request_id));
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
				alert(JSON.parse(response)["data"]["msg"]);

				window.location.reload();
			 }
		);

	}

	function edit_request(id){
		show_loader();
		payload = "action=get_private_request&request_id="+id;
		send_request(
			"POST",
			"processors/processor.php",
			payload,
			(response) => {
				var json = JSON.parse(response)["data"];
				var desc = json["description"];
				var b_min = json["min_budget"];
				var b_max = json["max_budget"];
				var seats = json["person_count"];
				var state = json["publish_state"];
				var start = json["date_start"];
				var end = json["date_end"];
				var currency = json["currency"];
				prefill_tour_request(desc, b_min,b_max,seats,state,start,end,currency);
			}
			);
			document.getElementById("request_form").setAttribute("onsubmit", "return request_private_tour(this,'"+id+"')");
	}


	function clear_form(){
		 document.getElementById("desc");
		document.getElementById("min_b");
		document.getElementById("max_b");
		document.getElementById("start-date");
		document.getElementById("end-date");
		document.getElementById("num-adults");

	}


	function prefill_tour_request(desc, b_min,b_max,seats,state,start,end,currency){
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
		on_option_select("publish_state",state);
		on_option_select("currency_menu",currency);


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

	function delete_request(id){
		payload = "action=delete_private_tour&request_id="+id;
		send_request("POST",
		"processors/processor.php",
		payload,
		(response)=> {
			show_loader();
			alert(JSON.parse(response)["data"]["msg"]);
			window.location.reload();
		}
		)
	}