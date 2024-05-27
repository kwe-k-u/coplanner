document.addEventListener('DOMContentLoaded', (event) => {
	const dateInput = document.getElementById('preferred_start_date');

	const today = new Date();
	const minDate = new Date(today);
	minDate.setDate(today.getDate() + 2);

	const maxDate = new Date(today);
	maxDate.setMonth(today.getMonth() + 1);

	dateInput.min = minDate.toISOString().split('T')[0];
	dateInput.max = maxDate.toISOString().split('T')[0];
});



const invoice_section = document.getElementById("invoice_section");
const user_info_section = document.getElementById("user_info_section");
const booking_info_section = document.getElementById("booking_info_section");
const tc_section = document.getElementById("tc_section");
const final_invoice_section = document.getElementById("final_invoice_section");
const final_invoice_destination_count = document.getElementById("final_invoice_destination_count");
const final_invoice_price = document.getElementById("final_invoice_price");
const final_invoice_platform_fee = document.getElementById("final_invoice_platform_fee");
const final_invoice_total = document.getElementById("final_invoice_total");

function payment_btn_click(button){
	if(!invoice_section.classList.contains("hide")){
		button.innerText = "Continue";
		invoice_section.classList.toggle("hide");
		user_info_section.classList.toggle("hide");
	}else if (!user_info_section.classList.contains('hide')){
		button.innerText = "Confirm Choices";
		user_info_section.classList.toggle("hide");
		booking_info_section.classList.toggle("hide");
		get_travel_plan_bill();
	}else if (!booking_info_section.classList.contains('hide')){
		booking_info_section.classList.toggle("hide");
		tc_section.classList.toggle("hide");
		button.innerText = "Agree";
		//create_invoice
	}else if (!tc_section.classList.contains('hide')){
		button.innerText = "Make Payment";
		tc_section.classList.toggle("hide");
		//disable pay button
		// populate final invoice
		//enable pay button
		final_invoice_section.classList.toggle("hide");
	}else{
		alert("payment bit");
	}
}

function on_preferred_date_change(field,num_days){
	const preferredDate = new Date(field.value);
	const endDate = new Date(field.value);
	const endDateInput = document.getElementById("preferred_end_date");

	if (isNaN(preferredDate.getTime())) {
		endDateInput.value = '';
		return;
	}

	endDate.setDate(preferredDate.getDate() + num_days);

	const endDateText = endDate.toISOString().split('T')[0];

	endDateInput.value = endDateText;

	if(preferredDate.toLocaleDateString() == endDate.toLocaleDateString()){ // If its a one day trip, show only one date
		document.getElementById("final_invoice_dates"). innerText = formatDate(endDate.toString("dd MMMM yyyy"));
	}else{
		document.getElementById("final_invoice_dates"). innerText = formatDate(preferredDate.toString("dd MMMM yyyy"))
		+" - "+formatDate(endDate.toString("dd MMMM yyyy"));

	}
}

function formatDate(date_string){
	let parts = date_string.split(" ");
	return parts[0]+" "+parts[2]+" "+parts[1]+" "+parts[3];
}

function get_travel_plan_bill(){
	send_request("POST",
		"processors/processor.php/get_travel_plan_bill",
		{
			"itinerary_id" : url_params("id"),
			"seats" : document.getElementById("number_seats").value
		},(response) => {
			if(response.status ==200){
				let invoice = response.data.invoice;
				final_invoice_price.innerText = invoice.currency_name +" "+ invoice.price;
				final_invoice_destination_count.innerText = invoice.num_destinations;
				final_invoice_platform_fee.innerText = invoice.currency_name +" "+ invoice.platform_fee;
				final_invoice_total.innerText = invoice.currency_name +" "+ invoice.total;

			}else{
				openDialog(response.data.msg);
			}
		}
	)
}