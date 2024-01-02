/*************** GLOBAL VARIABLES ****************/
/*************** SELECTORS ****************/

$(document).ready(function () {
  // -- Adding Listeners -- //
  // utility listeners

  $(".slide-down-btn").click(toggleSlideMenu);
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
  $(".shrinkable-sidebar-toggler").click(toggleShrinkableSidebar); // to expand and shrink sidebar
  $(".close-sidebar").click(closeSidebar); // close side bar
  $(".page-reloader").click(function () {
    window.location.reload();
  }); // to reload page

  // form listeners
  $(".date-input").focus(changeToDate);
  $(".time-input").focus(changeToTime);
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
  $(".profile_img-file").change(updateProfileImgDisp);

/* Highlights the navbar link for the currently displayed page*/
  function nav_check() {
    var nav = document.getElementById("mynavbar");
    if (nav != undefined) {
      const nav_page = window.location.pathname;
      if (nav_page.includes("home.php")) {
        nav.getElementsByClassName("nav-link")[0].classList.add("text-blue");
      } else if (nav_page.includes("tours.php")) {
        nav.getElementsByClassName("nav-link")[1].classList.add("text-blue");
      } else if (nav_page.includes("tour_description.php")) {
        nav.getElementsByClassName("nav-link")[1].classList.add("text-blue");
      } else if (nav_page.includes("book_tour.php")) {
        nav.getElementsByClassName("nav-link")[1].classList.add("text-blue");
      } else if (nav_page.includes("about.php")) {
        nav.getElementsByClassName("nav-link")[3].classList.add("text-blue");
      } else if (nav_page.includes("contact.php")) {
        nav.getElementsByClassName("nav-link")[4].classList.add("text-blue");
      } else {
        nav.getElementsByClassName("nav-link")[0].classList.add("text-blue");
      }
    }
  }
/* Highlights the sidebar link for the currently displayed page*/
  function sidebar_check() {
    const select_style = "border-right: solid 2px var(--easygo-blue);";
    var side = document.getElementById("curator_side_bar");
    if (side != undefined) {
      const page = window.location.pathname;
      if (
        page.includes("group_tours.php") ||
        page.includes("private_tours.php")
      ) {
        document.getElementById("nav_trips").classList.toggle("text-blue");
        document.getElementById("nav_trips").style = select_style;
        // document.getElementById("nav_trips").classList.toggle("open");
      } else if (page.includes("transactions.php")) {
        document.getElementById("nav_finance").classList.toggle("text-blue");
        document.getElementById("nav_finance").style = select_style;
      } else if (page.includes("account_settings.php")) {
        document.getElementById("nav_account").classList.toggle("text-blue");
        document.getElementById("nav_account").style = select_style;
      } else {
        document.getElementById("nav_dash").classList.toggle("text-blue");
        document.getElementById("nav_dash").style = select_style;
      }
    }
  }
  nav_check();
  sidebar_check();
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

// function to toggle shrinkable sidebar
function toggleShrinkableSidebar() {
  let target = $(this).attr("data-target");
  $(`#${target}`).toggleClass("expand");
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

//to change time fields form type "text" to type "time"
function changeToTime() {
  $(this).attr("type", "time");
}

//Changes date string and time string to sql datetime compatible string
function changeToDateTimestr(date, timestr) {
  time = timestr.split(" ")[0];
  period = timestr.split(" ")[1];
  hrs = time.split(":")[0];
  mins = time.split(":")[1];
  if (period.toLowerCase() === "pm" && hrs !== "12") {
    hrs = String(Number(hrs) + 12);
  } else if (period.toLowerCase() === "am" && hrs === "12") {
    hrs = "00";
  }
  res = `${date} ${hrs.padStart(2, "0")}:${mins.padStart(2, "0")}:00`;
  return res;
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
function get_dropdown_value(dropdown_id) {
  var element = document.getElementById(dropdown_id);
  return element.href.split("#")[1];
}

//Updates the custom dropdown value with the value of selected option
function on_option_select(id, value) {
  var selected = document.getElementById(id);
  selected.innerText = value;
  selected.href = "#" + value;
}

//Shows a loader animation for 5 seconds
function show_loader(hide_element = null, time = 5000) {
  var fn = (e) => {
    e.preventDefault();
    e.stopPropagation();
  };

  if (hide_element != null) {
    hide_element.classList.toggle("hide");
    hide_element.classList.toggle("animate-bottom");
  }
  document.getElementsByClassName("loader")[0].style.display = "inline";
  document.addEventListener("click", fn, true);
  var load_var = setTimeout(() => {
    if (hide_element != null) {
      hide_element.classList.toggle("hide");
    }
    document.getElementsByClassName("loader")[0].style.display = "none";
    document.removeEventListener("click", fn, true);
    // document.getElementsByClassName("loader")[0].classList.toggle("hide");
  }, time);
  return load_var;
}


/**
 * Function to open dialog box to display error message
 * @param {string} message the message to display in the dialog box
 */
function openDialog(message) {
  const oldWindow = document.querySelector(".dialog-window");

  // checking if dialog box already appended to page body
  // if already appended, change message to new message and display
  if (oldWindow) {
    oldWindow.classList.add("dialog-show");
    oldWindow.querySelector(".dialog-window .error-message").textContent =
      message;
  } else {
    // creating the dialog window, since it hasn't been appended to
    // document body
    const dialogWindow = document.createElement("div");
    dialogWindow.classList.add("dialog-window");
    const dialogBox = document.createElement("div");
    dialogBox.classList.add("dialog-box");
    const exclamationSign = document.createElement("div");
    exclamationSign.classList.add("exclamation-sign");
    const exCircle = document.createElement("div");
    exCircle.classList.add("circle");
    const exSign = document.createElement("span");
    exSign.textContent = "!";
    const errorMessage = document.createElement("div");
    errorMessage.classList.add("error-message");
    errorMessage.textContent = message;
    const footer = document.createElement("div");
    footer.classList.add("footer");
    const btn = document.createElement("button");
    btn.textContent = "OK";
    btn.classList.add("easygo-btn-1", "easygo-rounded-2");

    // building tree for dialog window
    dialogWindow.appendChild(dialogBox);
    dialogBox.appendChild(exclamationSign);
    dialogBox.appendChild(errorMessage);
    dialogBox.appendChild(footer);
    exclamationSign.appendChild(exCircle);
    exCircle.appendChild(exSign);
    footer.appendChild(btn);

    // adding event listener to button
    btn.addEventListener("click", (event) => {
      document.querySelector(".dialog-window").classList.remove("dialog-show");
    });

    document.body.appendChild(dialogWindow);

    // to allow for animation when dialog window first added to the document body
    setTimeout(() => dialogWindow.classList.add("dialog-show"), 1);
  }
}

// class for editable text
class EditableText {
  constructor(element) {
    this.element = element;
    this.currentValue = this.element.textContent;
    this.element.textContent = "";

    // creating element to hold text
    this.textHolder = document.createElement("span");
    this.textHolder.textContent = this.currentValue;
    this.element.appendChild(this.textHolder);

    // creating the input element
    this.inputEl = document.createElement("input");
    this.inputEl.value = this.currentValue;
    this.inputEl.style.display = "none";
    this.element.appendChild(this.inputEl);

    // adding click event listener to element
    this.element.addEventListener("click", () => {
      this.#editValue();
    });

    // adding event listener to update with new value
    this.inputEl.addEventListener("change", () => {
      this.#updateValue();
    });

    // adding event listener when focus out
    this.inputEl.addEventListener("focusout", () => {
      this.#updateValue();
      if(this.onchange != null){
        this.onchange();
      }
    });
  }

  #editValue() {
    this.textHolder.textContent = "";
    this.inputEl.style.display = "inline";
    this.inputEl.focus();
  }

  #updateValue() {
    if (this.inputEl.value != "")
      this.textHolder.textContent = this.inputEl.value;
    else this.textHolder.textContent = "Untitled";

    this.inputEl.style.display = "none";
  }
}

// instantiating for all editable text in page
[].slice
  .call(document.querySelectorAll(".easygo-editable-text"))
  .forEach((element) => {
    new EditableText(element);
  });

/**
 * function to toggle form input error message display
 * @param {list} inputData objects in the form {type, value, message_target, err_message}
 * where type is the input type eg. email, password etc
 * value is the actual value of the input
 * message_target is the element which should contain and display the error message.
 * Corresponding input elements must have their data-eg-target set to this value
 * err_message is the error message to display.
 * @returns {boolean} true if inputs pass validation, false otherwise
 */
function validateFormInputs(...inputData) {
  let valid = true;
  for (let inputItem of inputData) {
    let msgContainer = document.getElementById(inputItem.message_target);
    if (!msgContainer) {
      msgContainer = createErrorMessageContainer(inputItem.message_target);
    }
    if (!testInput(inputItem.type, inputItem.value, inputItem.compare_val)) {
      // display error message
      if (msgContainer) {
        msgContainer.textContent = inputItem.message;
        msgContainer.classList.add("form-input-err-show");
      }
      valid = false;
    } else {
      // remove error message if being displayed
      msgContainer.classList.remove("form-input-err-show");
    }
  }
  return valid;
}

/**
 *
 * @param {string} dataTarget new id of error container to create. Main purpose
 * is to find the parent element of the input element in order to append the error
 * container
 * @returns {HTMLElement} the newly created html element
 */
function createErrorMessageContainer(dataTarget) {
  if (dataTarget) {
    const parent = document.querySelector(
      `[data-eg-target=${dataTarget}]`
    ).parentElement;
    const errContainer = document.createElement("p");
    errContainer.classList.add("form-err-msg");
    errContainer.id = dataTarget;
    parent.appendChild(errContainer);
    return errContainer;
  }
}

/**
 * All regex for input testing
 */
const FORM_INPUT_REGEX = {
  EMAIL: /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-]+)(\.[a-zA-Z]{2,5}){1,2}$/,
  PASSWORD: /^(?=.*[a-z])(?=.*[0-9])(?=.*[@$!%*#?&]).{8,}/,
};

/**
 *
 * @param {string} type the type of input to consider when testing value
 * @param {string} value the value of the given input
 * @returns {boolean} true if test passed else false
 */
function testInput(type, value,compare_val = null) {
  switch (type) {
    case "email":
      return FORM_INPUT_REGEX["EMAIL"].test(value);
    case "password":
      return FORM_INPUT_REGEX["PASSWORD"].test(value);
    case "confirm_password":
    case "confirm password":
      return value == compare_val;
    default:
      return false;
  }
}



