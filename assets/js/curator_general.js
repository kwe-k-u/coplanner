/****************** create_a_trip javascript ******************/
/* selectors */
const coverBtn = document.getElementById("coverphoto-upload-btn");
const tripsBtn = document.getElementById("tripimages-upload-btn");
const coverUpload = document.getElementById("cover-photo-upload");
const tripsUpload = document.getElementById("trip-imgs-upload");
const removeBtns = document.querySelectorAll(".item-remove");
let coverImgFile = null; // holds cover photo
let tripImgsFiles = []; // holds trip images

/* Listeners */
coverUpload
  .querySelector("input[type='file']")
  .addEventListener("change", function () {
    clearFileInputDisplay("#coverphoto-upload-btn");
    clearFileInputDisplay("#cover-photo-upload");
    coverImgFile = this.files[0];
    fillImgContainer("#cover-photo-upload", coverImgFile);
    fillImgContainer("#coverphoto-upload-btn", coverImgFile);
  });
tripsUpload
  .querySelector("input[type='file']")
  .addEventListener("change", function () {
    // clearFileInputDisplay("#tripimages-upload-btn");
    // clearFileInputDisplay("#trip-imgs-upload");
    for (file of this.files) {
      tripImgsFiles.push(file);
      fillImgContainer("#tripimages-upload-btn", file);
      fillImgContainer("#trip-imgs-upload", file);
    }
  });



/* functions */
// function to create img-dislay item
function createImgDispItem(file) {
  let fileURL = URL.createObjectURL(file);
  let dispItem = document.createElement("div");
  dispItem.classList.add("img-display-item");
  let removeBtn = document.createElement("button");
  removeBtn.classList.add("item-remove");
  removeBtn.setAttribute("type", "button"); // to prevent from submitting the form
  removeBtn.innerText = "X";
  removeBtn.addEventListener("click", function (event) {
    event.stopPropagation();
    if (
      this.parentElement.parentElement.parentElement.getAttribute("id") ===
        "coverphoto-upload-btn" ||
      this.parentElement.parentElement.parentElement.getAttribute("id") ===
        "cover-photo-upload"
    ) {
      removeDisplayItem(this.parentElement, coverImgFile, false);
      refillImgContainer("#coverphoto-upload-btn", coverImgFile);
      refillImgContainer("#cover-photo-upload", coverImgFile);
    } else {
      removeDisplayItem(this.parentElement, coverImgFile, true);
      refillImgContainer("#tripimages-upload-btn", tripImgsFiles);
      refillImgContainer("#trip-imgs-upload", tripImgsFiles);
    }
  });
  let img = new Image();
  img.src = fileURL;
  dispItem.appendChild(img);
  dispItem.appendChild(removeBtn);
  dispItem.setAttribute("data-filename", file.name);
  return dispItem;
}
// function to fill image container
function fillImgContainer(selector, file) {
  let containers = document.querySelectorAll(selector);
  containers.forEach((container) => {
    let imgContainer = container.querySelector(".img-display");
    if (!imgContainer.classList.contains("not-empty")) {
      imgContainer.classList.add("not-empty");
    }
    imgContainer.appendChild(createImgDispItem(file));
  });
}

// function to refill container
function refillImgContainer(selector, files) {
  let containers = document.querySelectorAll(selector);
  containers.forEach((container) => {
    clearFileInputDisplay(selector);
    let imgContainer = container.querySelector(".img-display");
    if (Array.isArray(files)) {
      if (files.length > 0) {
        imgContainer.classList.add("not-empty");
        files.forEach((file) => {
          imgContainer.appendChild(createImgDispItem(file));
        });
      } else {
        imgContainer.classList.remove("not-empty");
      }
    } else {
      if (files) {
        imgContainer.classList.add("not-empty");
        imgContainer.appendChild(createImgDispItem(files));
      } else {
        imgContainer.classList.remove("not-empty");
      }
    }
  });
}

// function to clear file input imgaes
function clearFileInputDisplay(selector) {
  let containers = document.querySelectorAll(selector);
  containers.forEach((container) => {
    let imgContainer = container.querySelector(".img-display");
    imgContainer.innerHTML = "";
    imgContainer.classList.remove("not-empty");
  });
}

// function to remove image
function removeDisplayItem(element, item, list) {
  let filename = element.getAttribute("data-filename");
  element.remove();
  if (list) {
    tripImgsFiles = tripImgsFiles.filter((file) => file.name !== filename);
  } else {
    coverImgFile = null;
  }
}

