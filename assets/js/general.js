/*************** GLOBAL VARIABLES ****************/
/*************** SELECTORS ****************/
$(document).ready(function () {
  // -- Adding Listeners -- //
  // utility listeners
  $(".slide-down-btn").click(toggleSlideMenu);
  $(".dashlogo").click(open_curator_dashboard);
  $(".toggle-password-show").click(togglePasswordShow); // password toggle
  $(".file-input").click(triggerFileUpload); // file upload
  $(".file-input input[type=file]").click(function (event) {
    event.stopPropagation();
  }); // preventing click event from bubbling
  $(".file-input.drag-n-drop").on("dragover", receiveDraggedFiles);
  $(".file-input.drag-n-drop.type-img").on("drop", processDroppedFiles);
  $(".file-input.drag-n-drop.type-doc").on("drop", showDroppedDocName);
  $(".file-input input[type=file].img-upload").change(function (event) {
    displayUpload(
      $(this).attr("data-display-target"),
      $(this).prop("files")[0]
    );
  });
  $(".file-input input[type=file].file-upload").change(function (event) {
    showDocName(
      $(this).prop("files")[0],
      $(this).attr("data-display-target"),
      $(this).attr("data-name-display")
    );
  });
  $(".doc-display .doc-display-item .item-remove").click(removeDocName);
  $(".pad-item-add").click(padListAdd);
  $(".sidebar-toggler").click(toggleSidebar); // to open and close side bar
  $(".close-sidebar").click(closeSidebar); // close side bar
  $(".page-reloader").click(function () {
    window.location.reload();
  }); // to reload page

  // form listeners
  $(".date-input").focus(changeToDate);
  $(".date-input").blur(changeToText);
  $(".select-menu-1").click(openSelectMenu);
  $(".select-menu-1").focusout(closeSelectMenu);
  $(".input-enabler").click(enableInputs);
  $(".input-disabler").click(disableInputs);
  $(".visibility-changer").click(changeVisibility);
  $(".easygo-num-input .plus").click(changeNumInputVal);
  $(".easygo-num-input .minus").click(changeNumInputVal);
  $(".img-display .item-remove");
  // $(".file-input.w-popup").click(updateUploadPopup);

  // form page listeners
  $("#register-form-1 .next-btn").click(nextForm); // going to next form when next button is clicked
  $("#register-form-2 .back-btn").click(previousForm); // to previous form
  $(".profile-img-file").change(updateProfileImgDisp);
});

/*************** FUNCTIONS ****************/
//--- [utility] functions --//
// toggle slide menu
function toggleSlideMenu() {
  let target = $(this).attr("data-target");
  $(`#${target}`).slideToggle();
  $(this).toggleClass("open");
}
// to add item to item pad list
function padListAdd() {
  let inputClass = $(this).attr("data-sender");
  let padListClass = $(this).attr("data-target");
  let item = $(`#${inputClass}`).val();
  $(`#${inputClass}`).val("");

  if (item) {
    $(`#${padListClass}`).append(`<div class="item-pad">${item}</div>`);
  }
}

// function to toggle sidebar
function toggleSidebar() {
  let target = $(this).attr("data-target");
  $(`#${target}`).toggleClass("open");
}
// function to close side bar
function closeSidebar() {
  let target = $(this).attr("data-target");
  $(`#${target}`).removeClass("open");
}

// function to create img-dislay item
function createImgDispItem(file) {
  let fileURL = URL.createObjectURL(file);
  let dispItem = document.createElement("div");
  dispItem.classList.add("img-display-item");
  let removeBtn = document.createElement("button");
  removeBtn.classList.add("item-remove");
  removeBtn.innerText = "X";
  removeBtn.setAttribute("type", "button"); // to prevent from submitting the form
  // adding event listener to remove button
  removeBtn.addEventListener("click", deleteDispayItem);
  let img = new Image();
  // freeing up memory when done loaidng image
  img.onload = function () {
    URL.revokeObjectURL(img.src);
  };
  img.src = fileURL;
  dispItem.appendChild(img);
  dispItem.appendChild(removeBtn);
  return dispItem;
}

// function to delete displayItem
function deleteDispayItem(event) {
  event.stopPropagation();
  let displayContainer = this.parentElement.parentElement;
  let inputTarget = displayContainer.getAttribute("data-input-target");

  if (inputTarget) {
    let fileInput = document.querySelector(`${inputTarget}`);
    // removing the item from the file input
    fileInput.value = "";
    fileInput.files = null;
  }

  this.parentElement.remove();
  displayContainer.classList.remove("not-empty");
}

// function to show file name
function showDocName(file, targetDisplay, nameDisplay) {
  if (file) {
    $(`${targetDisplay}`).addClass("not-empty");
    $(`${nameDisplay}`).text(file.name);
  } else {
    $(`${targetDisplay}`).removeClass("not-empty");
  }
}

// function to show name of dropped document
function showDroppedDocName(event) {
  event.preventDefault();
  event.stopPropagation();
  let targetDisplay = $(this).attr("data-display-target");
  let nameDisplay = $(this).attr("data-name-display");
  let file = event.originalEvent.dataTransfer.files[0];
  if (file) {
    $(`${targetDisplay}`).addClass("not-empty");
    $(`${nameDisplay}`).text(file.name);
  } else {
    $(`${targetDisplay}`).removeClass("not-empty");
  }

  let fileInput = $(this).attr("data-input-target");
  $(`${fileInput}`).prop("files", event.originalEvent.dataTransfer.files);
}

// function to remove file name
function removeDocName(event) {
  event.stopPropagation();
  let displayContainer = $(this).parent().parent();
  let inputTarget = displayContainer.attr("data-input-target");

  if (inputTarget) {
    $(`${inputTarget}`).val("");
  }

  displayContainer.removeClass("not-empty");
}

// function to change between display none and display block
function changeVisibility() {
  let targets = $(this).attr("data-visibility-target");
  let showAlways = $(this).attr("data-visibility-show");
  $(`${targets}`).each(function () {
    let dMode = $(this).attr("visible-mode");
    let currentDisplay = $(this).css("display");

    // making just particular visible
    if (showAlways) {
      let classOrId = showAlways.substring(1);
      if ($(this).hasClass(classOrId) || $(this).attr("id") === classOrId) {
        if (dMode) {
          $(this).css("display", dMode);
        } else {
          $(this).css("display", "block");
        }
      } else {
        $(this).css("display", "none");
      }
    } else {
      // invert displays
      if (currentDisplay === "none") {
        if (dMode) {
          $(this).css("display", dMode);
        } else {
          $(this).css("display", "block");
        }
      } else {
        $(this).css("display", "none");
      }
    }
  });
}

// function to handle drag and drop events
function receiveDraggedFiles(event) {
  event.preventDefault();
  event.stopPropagation();
}

// function to process dropped files
function processDroppedFiles(event) {
  event.preventDefault();
  event.stopPropagation();
  displayUpload(
    $(this).attr("data-display-target"),
    event.originalEvent.dataTransfer.files[0]
  );

  let fileInput = $(this).attr("data-input-target");
  $(`${fileInput}`).prop("files", event.originalEvent.dataTransfer.files);
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

// function to display uploaded item
function displayUpload(targetDisplay, file) {
  $(`${targetDisplay}`).html("");

  if (file) {
    $(`${targetDisplay}`).addClass("not-empty");
    $(`${targetDisplay}`).append(createImgDispItem(file));
  } else {
    $(`${targetDisplay}`).removeClass("not-empty");
  }
}

// to change input[type='number'] value when plus or minus buttons clicked
function changeNumInputVal() {
  let targetSelector = $(this).attr("data-input-target");
  let targetEl = $(`${targetSelector}`);
  let min_val = targetEl.attr("min")
    ? parseInt(targetEl.attr("min"))
    : Number.MIN_SAFE_INTEGER;
  let max_val = targetEl.attr("max")
    ? targetEl.attr("max")
    : Number.MAX_SAFE_INTEGER;
  let cur_val = targetEl.val() ? parseInt(targetEl.val()) : 0;

  // setting the current value of the input element
  targetEl.val(cur_val);

  // adding or subtracting
  // adding
  if ($(this).hasClass("plus")) {
    targetEl.val(
      parseInt(targetEl.val()) + 1 > max_val
        ? parseInt(targetEl.val())
        : parseInt(targetEl.val()) + 1
    );
  }
  // subtracting
  if ($(this).hasClass("minus")) {
    targetEl.val(
      parseInt(targetEl.val()) - 1 < min_val
        ? parseInt(targetEl.val())
        : parseInt(targetEl.val()) - 1
    );
  }
}

// // to open popup for file upload
// function updateUploadPopup() {
//   let target = $(this).attr("data-popup-target");
//   let displayItems = $(this).find(".img-display-item").clone();
//   // clearing  the image display and removing the not-empty class
//   $(`${target}`).children(".img-display").html("");
//   $(`${target}`).children(".img-display").removeClass("not-empty");
//   if (displayItems.length > 0) {
//     $(`${target}`).children(".img-display").append(displayItems);
//     $(`${target}`).children(".img-display").addClass("not-empty");
//   }
// }

// to change date fields from type "text" to type "date"
function changeToDate() {
  $(this).attr("type", "date");
}
// to change type back to "text"
function changeToText() {
  $(this).attr("type", "text");

  let value = $(this).val();

  if (value) {
    let splitStr = value.split("-");
    $(this).val(splitStr.reverse().join("-"));
  }
}

// to open select menu
function openSelectMenu(event) {
  if (event.target.classList.contains("option")) {
    $(this).find(".select-menu-value").text(event.target.textContent);
    $(this).find(".value").val(event.target.textContent);
    $(this).children(".options").slideUp();
  } else {
    $(this).children(".options").slideDown();
  }
}
function closeSelectMenu(event) {
  $(this).children(".options").slideUp();
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

// to insert user profile images
function updateProfileImgDisp() {
  let fileInput = $(this)[0];
  let chosenFile = fileInput.files[0];

  if (chosenFile) {
    let fileReader = new FileReader();

    fileReader.addEventListener("load", function () {
      let targetId = fileInput.getAttribute("display-target");
      document
        .getElementById(`${targetId}`)
        .setAttribute("src", fileReader.result);
    });

    fileReader.readAsDataURL(chosenFile);
  }
}

// to enable inputs with class equal to 'data-enable-target'
function enableInputs() {
  let targets = $(this).attr("data-enable-target");
  $(`${targets}`).prop("disabled", false);
}
// to disable inputs with class equal to 'data-disable-target'
function disableInputs() {
  let targets = $(this).attr("data-disable-target");
  $(`${targets}`).prop("disabled", true);
}



//Returns the value of the option selected in the custom select dropdown
function get_dropdown_value(dropdown_id){
  return document.getElementById(dropdown_id).href.split("#")[1]
}

//Updates the custom dropdown value with the value of selected option
function on_option_select(id,value){
	var selected = document.getElementById(id);
	selected.href="#"+value;
}

//Shows a loader animation for 5 seconds
function show_loader(hide_element = null, time=5000){
	var fn = e => {e.preventDefault(); e.stopPropagation();};

  if (hide_element != null){
    hide_element.classList.toggle("hide");
    hide_element.classList.toggle("animate-bottom");
  }
	document.getElementsByClassName("loader")[0].style.display= "inline";
	document.addEventListener("click", fn, true);
	var load_var = setTimeout(()=> {
    if (hide_element != null){
      hide_element.classList.toggle("hide");
    }
		document.getElementsByClassName("loader")[0].style.display= "none";
		document.removeEventListener("click", fn, true);
		// document.getElementsByClassName("loader")[0].classList.toggle("hide");
	}, time);
}




function open_curator_dashboard(){
  window.location.href = "dashboard.php";
}