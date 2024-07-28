
$(document).ready(function (){
	package_select_listener();


	// $("#remind-me-btn").click(()=> mixpanel.track("Remind me button clicked",{
	// 	"user_name":
	// }));
	$(".package-label").click(() => {
		const packageName = $(this).find(".package-option-name").text();
		mixpanel.track("Package Selected", { "package_name": packageName });
	});

	$("#payment_btn").click(() => {
		const buttonText = $("#payment_btn").text();
		mixpanel.track("Payment Button Clicked", { "button_text": buttonText });
	});

	$(".summary-itin-name").click(()=> mixpanel.track("Experience Destination Name Clicked"));

	let images = document.getElementsByClassName("additional-image");
	for(let i = 0; i < images.length; i++) {
		// document.getElementById("")
		let image = images[i];
		// console.log("prev",image.getAttribute("src"),image.src);
		image.onclick = ()=> display_image_modal(image.src);

	}


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

// Toggles the display of the different sections of the invoice car
//returns the id of the now displayed card after a toggle
function switch_invoice_card(){
	let current_invoice = document.querySelectorAll(".invoice-main:not(.hide)")[0];
	let next_id = current_invoice.getAttribute("data-next-target");
	if(next_id){
		document.getElementById(next_id).classList.remove("hide");
		current_invoice.classList.add("hide");
	}
	return next_id;

}
// switch_invoice_card();

async function payment_btn_click(button){
	// return switch_invoice_card();
	let now_visible = switch_invoice_card();
	switch (now_visible) {
		case "invoice_section":
			button.innerText = "Continue";
			break;
		case "tc_section":
			button.innerText = "I Agree";
			break;
		case "user_info_section":
			await get_shared_experience_bill();
			button.innerText = "Continue";
			break;
		case "final_invoice_section":
			button.innerText = "Make Payment";
			break;

		default:
			const bill = await get_shared_experience_bill();
			pay_for_experience(bill.data.invoice);
			break;
	}



}

function pay_for_experience(bill){
	let c_email = user_email_field.value;
	const experience_id = url_params("experience_id");
	let modified_bill = {...bill};

	mixpanel.track("Attempted Experience Booking",{
		"experience_id" : experience_id,
		"user_email" : c_email,
		"user_name" : user_name_field.value,
		"user_phone" : user_phone_field.value
	});


	modified_bill["description"] = "Payment for experience "+ experience_id + " by user<"+c_email+">";
	modified_bill["payment_purpose"] = "experience_payment";
	modified_bill["user_email"] = c_email;
	modified_bill["user_phone"] = user_phone_field.value;
	modified_bill["user_name"] = user_name_field.value;
	console.log(bill.currency_name);
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
			"seats" : booking_seats,
			"package" : document.querySelector('input[name="package"]:checked').value
		},(response) => {
			// let invoice = response.data;
			// payWithPaystack(invoice.currency, charge_amount,c_email,payload, split_account = null)
			// return 1;
			console.log(response);
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



function package_select_listener(){
	const packageRadios = document.getElementsByName("package");
	const seat_field = document.getElementById("number_seats_field");

	for(let index = 0; index < packageRadios.length; index++) {
		let radio = packageRadios[index];



		radio.addEventListener("change", async () => {
			const package_id = radio.value;

			// update_max_seats and steps
			if(index == 0){
				seat_field.style.display = "block";
			}else{
				seat_field.style.display = "none";
			}
		});
	};
}

function remind_me(){
	if ((document.getElementById("booking_info_section").classList.contains("hide") &&
		document.getElementById("user_info_section").classList.contains("hide")) ||
		!document.getElementById("user_info_section").classList.contains("hide")
	){
		// if user has advanced beyond entering their name do the reminder
		if (validate_user_info()){
			let payload ={
				"experience_id" : url_params("experience_id"),
				"user_name" : user_name_field.value,
				"email" : user_email_field.value,
				"phone" : user_phone_field.value
			};


			mixpanel.track("Remind me button clicked",payload);
			send_request("POST",
				"processors/processor.php/shared_experience_reminder",
				payload,
				(response)=>{
					if(response.status == 200){
						showToast(response.data.msg);
					}else{
						showDialog(response.data.msg);
					}
			});
		}
	}else{
		openDialog("Kindly proceed with selecting a package and providing contact information");
	}


	//check if the user provided their details.
}


function display_image_modal(source){
	$('#image-modal').modal('show');
	document.getElementById("modal-image").src = source;

}


function sold_out_toggle(){
	let  current_box = document.querySelectorAll(".invoice-main:not(.hide)")[0];
	let current_id =  current_box.id;
	let next_id = current_box.getAttribute("data-next-target");

	if (next_id != "sold-out-complete"){
		document.getElementById(current_id).classList.add("hide");
		document.getElementById(next_id).classList.remove("hide");
	}else{
		let payload = {
			"experience_id" : url_params("experience_id"),
			"user_name" : document.getElementById("sold-out-input-name").value,
			"email" : document.getElementById("sold-out-input-email").value,
			"number" : document.getElementById("sold-out-input-number").value,
			"seats" : document.getElementById("sold-out-input-seats").value,
			"date" : document.getElementById("sold-out-input-date").value,
		}
		//submit to server
		console.log("do");
		mixpanel.track("Sold out request",payload);
		send_request("POST","processors/processor.php/sold_out_request",
			payload,
			(response)=> {
				if(response.status == 200){
					document.getElementById(current_id).classList.add("hide");
					document.getElementById(next_id).classList.remove("hide");
				}else{
					openDialog(response.data.msg);
				}
			}
		)
	}
}