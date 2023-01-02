/****************** create_a_trip javascript ******************/
/* selectors */
const coverPhotoUpload = document.getElementById("coverphoto-upload");
const tripImagesUpload = document.getElementById("tripimages-upload");
const popupFileInput = document.getElementById("upload-img-file-input");
const popupInputEl = popupFileInput.querySelector("input[type='file']");
const imgUploadForm = document.getElementById("img-upload-form");
let uploadSelected = "cover-photo";
let bannerImg = null;
let trip_images = [];

// listeners
coverPhotoUpload.addEventListener("click", function (event) {
  uploadSelected = "cover-photo";
  populatePopup();
});

tripImagesUpload.addEventListener("click", function (event) {
  uploadSelected = "trip-images";
  populatePopup();
});

popupInputEl.addEventListener("change", function () {
  addUploadedFiles(this.files);
});

imgUploadForm.addEventListener("submit", function (event) {
  event.preventDefault();
  updateFileLists();
});

/* function to populate popup */
function populatePopup() {
  let displayItems = null;
  if (uploadSelected === "cover-photo") {
    displayItems = coverPhotoUpload
      .querySelector(".img-display")
      .querySelectorAll(".img-display-item");
  } else {
    displayItems = tripImagesUpload
      .querySelector(".img-display")
      .querySelectorAll(".img-display-item");
  }

  popupFileInput.querySelector(".img-display").innerHTML = "";

  if (displayItems.length > 0) {
    popupFileInput.querySelector(".img-display").classList.add("not-empty");
    displayItems.forEach((displayItem) => {
      popupFileInput
        .querySelector(".img-display")
        .appendChild(displayItem.cloneNode(true));
    });
  }
}

// function to add uploaded file
function addUploadedFiles(fileList) {
  if (fileList.length > 0) {
    popupFileInput.querySelector(".img-display").classList.add("not-empty");
    if (uploadSelected === "cover-photo") {
      bannerImg = fileList[0];
      popupFileInput.querySelector(".img-display").innerHTML = "";
      popupFileInput
        .querySelector(".img-display")
        .appendChild(createImgDispItem(bannerImg));
    } else {
      for (file of fileList) {
        trip_images.push(file);
        popupFileInput
          .querySelector(".img-display")
          .appendChild(createImgDispItem(file));
      }
    }
  }
}

// function to create img-dislay item
function createImgDispItem(file) {
  let fileURL = URL.createObjectURL(file);
  let dispItem = document.createElement("div");
  dispItem.classList.add("img-display-item");
  let removeBtn = document.createElement("button");
  removeBtn.classList.add("item-remove");
  removeBtn.innerText = "X";
  let img = new Image();
  img.src = fileURL;
  dispItem.appendChild(img);
  dispItem.appendChild(removeBtn);
  return dispItem;
}

// function to update files lists and displays
function updateFileLists() {
  let items = popupFileInput.querySelectorAll(".img-display-item");
  if (uploadSelected === "cover-photo") {
    if (items.length > 0) {
      coverPhotoUpload.querySelector(".img-display").classList.add("not-empty");
      coverPhotoUpload.querySelector(".img-display").innerHTML = "";
      coverPhotoUpload.querySelector(".img-display").appendChild(items[0]);
    }
  } else {
    if (items.length > 0) {
      tripImagesUpload.querySelector(".img-display").classList.add("not-empty");
      tripImagesUpload.querySelector(".img-display").innerHTML = "";
      for (let item of items) {
        tripImagesUpload.querySelector(".img-display").appendChild(item);
      }
    }
  }
}

{
  /* <div class="img-display-item">
<button class="item-remove">X</button>
<img src="../assets/images/others/tour3.jpg" alt="upload image">
</div> */
}
