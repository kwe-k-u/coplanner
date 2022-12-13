/*************** SELECTORS ****************/
$(document).ready(function () {
  // -- Adding Listeners -- //
  // utility listeners
  $(".slide-down-menu .slide-down-btn").click(toggleSlideMenu);
  $(".toggle-password-show").click(togglePasswordShow); // password toggle
  $(".file-input").click(triggerFileUpload); // file upload
  $(".file-input input[type=file]").click(function (event) {
    event.stopPropagation();
  }); // preventing click event from bubbling
  $("#register-form-1 .next-btn").click(nextForm); // going to next form when next button is clicked
  $("#register-form-2 .back-btn").click(previousForm); // to previous form
});

/*************** FUNCTIONS ****************/
//--- [utility] functions --//
// toggle slide menu
function toggleSlideMenu(){
  $(this).parent().children(".slide-down-sub-menu").slideToggle();
}

//--- [form] functions ---//
// to toggle password show
function togglePasswordShow() {
  let passInput = $(this).parent().children("input");

  if (passInput.attr("type") === "password") {
    passInput.attr("type", "text");
    $(this).html("<i class='fa-solid fa-eye'></i>");
  } else {
    passInput.attr("type", "password");
    $(this).html("<i class='fa-sharp fa-solid fa-eye-slash'></i>");
  }
}

// to trigger file uploadd
function triggerFileUpload() {
  $(this).children("input[type=file]").trigger("click");
}

// to move to next form
function nextForm() {
  $("#register-form-2").css("opacity", "1");
  $("#register-form-2").css("pointer-events", "all");
  $("#register-form-1").css("opacity", "0");
  $("#register-form-1").css("pointer-events", "none");
}
// to move to previous form
function previousForm() {
  $("#register-form-1").css("opacity", "1");
  $("#register-form-1").css("pointer-events", "all");
  $("#register-form-2").css("opacity", "0");
  $("#register-form-2").css("pointer-events", "none");
}
