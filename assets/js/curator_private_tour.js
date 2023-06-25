

function create_bid(id){
	var form_div = document.getElementById("bid_form_div");
	var form = document.getElementById("request_form");

	//clear content
	clear_bid_form_content();

	form_div.style = "display:block;";

	// move form
	var click_request = document.getElementById("div_"+id);
	// form_div.insertBefore(click_request);
	var next = click_request.nextElementSibling;
	if ( next != null){
		click_request.parentNode.insertBefore(form_div,next);
	}else {
		click_request.parentNode.appendChild(form_div);
	}

	//add request id to form
	form.request_id.value=id;


}


function submit_bid(form){
	event.preventDefault();
	var comment = form.comment.value;
	var currency = get_dropdown_value("currency_menu");
	var amount = form.amount.value;
	var request_id = form.request_id.value;
	var curator_id = form.curator_id.value;

	let payload = {
		"action" : "bid_private_tour",
		"comment" : comment,
		"currency" : currency,
		"fee" : amount,
		"curator_id" : curator_id,
		"request_id" : request_id
	};

	send_request("POST",
	"processors/processor.php",
	payload,
	(response)=>{
		var json = response;
		if(json["status"] == 200){
			hide_bid_form();
		}
		alert(json["data"]["msg"]);
	}
	);
}


function hide_bid_form(){
	var form = document.getElementById("bid_form_div");
	form.style = "display:none";
}

function clear_bid_form_content(){
	var form = document.getElementById("request_form");
	form.comment.value = "";
	form.amount.value = "0";
	form.request_id = "";
	// form.

}