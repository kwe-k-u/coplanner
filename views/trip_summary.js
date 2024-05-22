const invoice_section = document.getElementById("invoice_section");
const tc_section = document.getElementById("tc_section");
const user_info_section = document.getElementById("user_info_section");
let active_section = "invoice_section";

function payment_btn_click(){
	if(!invoice_section.classList.contains("hide")){
		invoice_section.classList.toggle("hide");
		tc_section.classList.toggle("hide");
	}else if (!tc_section.classList.contains('hide')){
		tc_section.classList.toggle("hide");
		user_info_section.classList.toggle("hide");
	}else{
		
	}
}