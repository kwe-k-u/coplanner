


const invoice_section = document.getElementById("invoice_section");
const user_info_section = document.getElementById("user_info_section");
const booking_info_section = document.getElementById("booking_info_section");
const tc_section = document.getElementById("tc_section");
const final_invoice_section = document.getElementById("final_invoice_section");
const final_invoice_destination_count = document.getElementById("final_invoice_destination_count");
const final_invoice_price = document.getElementById("final_invoice_price");
const final_invoice_platform_fee = document.getElementById("final_invoice_platform_fee");
const final_invoice_total = document.getElementById("final_invoice_total");

const user_email_field =document.getElementById("user_info_email");
const user_phone_field =document.getElementById("user_info_phone");
const user_name_field =document.getElementById("user_info_name");



function validate_user_info(){
	return validateFormInputs({
		type : "email",
		value : user_email_field.value,
		message_target: "email-err",
		message : "Enter a valid email"
	},{
		type : "phone",
		value : user_phone_field.value,
		message_target : "phone-err",
		message : "Kindly provide a valid phone number"
	},{
		type : "text",
		value : user_name_field.value,
		message_target : "name-err",
		message : "Please provide a valid name"
	}
);
}

async function payment_btn_click(button){

	if(!invoice_section.classList.contains("hide")){
		button.innerText = "Continue";
		invoice_section.classList.toggle("hide");
		user_info_section.classList.toggle("hide");
	}else if (!user_info_section.classList.contains('hide')){
		let is_input_valid = validate_user_info();
		if (is_input_valid){
			button.innerText = "Confirm Choices";
			user_info_section.classList.toggle("hide");
			booking_info_section.classList.toggle("hide");
		}
	}else if (!booking_info_section.classList.contains('hide')){
		get_shared_experience_bill();
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
		const bill = await get_shared_experience_bill();
		pay_for_experience(bill.data.invoice);
	}
}

function pay_for_experience(bill){
	let c_email = user_email_field.value;
	let modified_bill = {...bill};



	modified_bill["description"] = "Payment for experience "+ url_params("experience_id") + " by user<"+c_email+">";
	modified_bill["payment_purpose"] = "experience_payment";
	modified_bill["user_email"] = c_email;
	modified_bill["user_phone"] = user_phone_field.value;
	modified_bill["user_name"] = user_name_field.value;
	if(bill.payout_account_number){
		payWithPaystack(bill.currency_name, bill.total_fee*100,c_email,modified_bill, bill.payout_account_id)
	}else{
		payWithPaystack(bill.currency_name, bill.total_fee*100,c_email,modified_bill);
	}
}


function formatDate(date_string){
	let parts = date_string.split(" ");
	return parts[0]+" "+parts[2]+" "+parts[1]+" "+parts[3];
}

async function get_shared_experience_bill(){
	let booking_seats = document.getElementById("number_seats").value;
	let result =  await send_request("POST",
		"processors/processor.php/get_experience_invoice",
		{
			"experience_id" : url_params("experience_id"),
			"seats" : booking_seats
		},(response) => {
			// let invoice = response.data;
			// payWithPaystack(invoice.currency, charge_amount,c_email,payload, split_account = null)
			// return 1;
			if(response.status ==200){
				let invoice = response.data.invoice;
				//update screen invoice
				final_invoice_price.innerText = invoice.currency_name +" "+ invoice.booking_fee;
				final_invoice_destination_count.innerText = booking_seats;
				final_invoice_platform_fee.innerText = invoice.currency_name +" "+ invoice.platform_fee;
				final_invoice_total.innerText = invoice.currency_name +" "+ invoice.total_fee;
				let startDate = new Date(invoice.start_date);
				document.getElementById("final_invoice_dates"). innerText = formatDate((startDate).toString("dd MMMM yyyy"));

			}else{
				openDialog(response.data.msg);
			}
		}
	);
	return result;
}