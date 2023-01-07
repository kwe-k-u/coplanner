class EhImageUploadDisplay {
  constructor(selector, options) {
    this.init(selector, options);
  }

  // initilization function
  init(selector, options) {
    // necessary variables
    this.fileList = [];

    // element selectors
    this.element = document.querySelector(selector);
    this.fileInput = this.element.querySelector("input[type='file']");

    // setting up event listener for parts
    this.element.addEventListener("click", () => {
      this.fileInput.click();
    });
    this.fileInput.addEventListener("change", () => {
      this.addFile(this.fileInput.files);
    });

    // checking if the file input has the multiple attribute and setting necessary property
    this.multiple = this.fileInput.hasAttribute("multiple") ? true : false;

    //-- setting up the html --//
    // adding image display section
    this.imageDisplay = document.createElement("div");
    this.imageDisplay.classList.add("eh_img-display");
    this.element.appendChild(this.imageDisplay);

    //-- setting up with initalization object --//
    if (options.dragAndDrop) {
      this.init_dragAndDropp();
    }
    if (options.altDisplay) {
      this.hasAltScreens = true;
      this.init_altDisplay(options.altDisplay);
    }
    if (options.displayItemOptions) {
      this.displayItemOptions = options.displayItemOptions;
    }
  }

  // **** options object initialization functions ****?
  // initialize drag and drop properties
  init_dragAndDropp() {
    // creating the hover element to add to the element
    this.dragOverInterface = document.createElement("div");
    this.dragOverInterface.classList.add("eh_dragover-interface");
    this.dragOverInterface.innerText = "Drop Here";
    this.element.appendChild(this.dragOverInterface);

    // adding the drag event listeners and drop event listeners
    this.element.addEventListener("dragenter", (event) => {
      event.preventDefault();
      this.dragOverInterface.classList.add("show");
    });
    this.element.addEventListener("dragleave", (event) => {
      event.preventDefault();
      this.dragOverInterface.classList.remove("show");
    });
    this.element.addEventListener("dragover", (event) => {
      event.preventDefault();
    });
    this.element.addEventListener("drop", (event) => {
      event.preventDefault();
      this.dragOverInterface.classList.remove("show");
      this.addFile(event.dataTransfer.files);
    });
  }

  // initialize alt display properties
  init_altDisplay(altDisplayOptions) {
    // setting up the alternate display
    this.altDisplays = document.querySelectorAll(altDisplayOptions.selector);
    this.altDisplays.forEach((altDisplay) => {
      altDisplay.classList.add("eh_alt-display");
      let altImgDisplay = document.createElement("div");
      altImgDisplay.classList.add("eh_img-display");
      altDisplay.appendChild(altImgDisplay);
    });
  }

  // function to add a file when the input element detects a change
  addFile(files) {
    // adding the display items and adding to the fileList
    if (this.multiple) {
      for (let file of files) {
        this.fileList.push(file);
      }
      this.addDisplayItems(files);
    } else {
      this.fileList = [];
      this.fileList.push(files[0]);
      this.addDisplayItem(files[0]);
    }
  }

  // function to remove a file
  removeFile(event) {
    event.stopPropagation();
    let displayItem = event.target.parentElement;
    let fileToRemove = displayItem.getAttribute("data-file-name");

    for (let i = 0; i < this.fileList.length; i++) {
      if (this.fileList[i].name === fileToRemove) {
        this.fileList.splice(i, 1);
        displayItem.remove();
        if (this.hasAltScreens) {
          this.removeItemFromAltDisplay(fileToRemove);
        }
        break;
      }
    }

    // checking if the image display is empty
    if (this.imageDisplay.children.length === 0) {
      this.imageDisplay.classList.remove("show");
    }
  }

  // function to display single item
  addDisplayItem(file) {
    if (file) {
      this.imageDisplay.innerHTML = "";
      this.imageDisplay.appendChild(this.createDisplayItem(file));
      this.imageDisplay.classList.add("show");
    } else {
      if (this.imageDisplay.children.length === 0) {
        this.imageDisplay.classList.remove("show");
      }
    }

    if (this.hasAltScreens) {
      this.addItemToAltDisplay(file);
    }
  }

  addDisplayItems(files) {
    if (files.length > 0) {
      this.imageDisplay.classList.add("show");
      for (let file of files) {
        this.imageDisplay.appendChild(this.createDisplayItem(file));
      }
    } else {
      if (this.imageDisplay.children.length === 0) {
        this.imageDisplay.classList.remove("show");
      }
    }

    if (this.hasAltScreens) {
      this.addItemsToAltDisplay(files);
    }
  }

  // function to add a single display items to alternate display
  addItemToAltDisplay(file) {
    if (file) {
      this.altDisplays.forEach((altDisplay) => {
        let altImgDisplay = altDisplay.querySelector(".eh_img-display");
        altImgDisplay.innerHTML = "";
        altImgDisplay.appendChild(this.createDisplayItem(file, true));
        altImgDisplay.classList.add("show");
      });
    } else {
      this.altDisplays.forEach((altDisplay) => {
        if (altDisplay.children.length === 0) {
          altDisplay.classList.remove("show");
        }
      });
    }
  }

  // function to add multiple display items to alternate display
  addItemsToAltDisplay(files) {
    if (files.length > 0) {
      this.altDisplays.forEach((altDisplay) => {
        altDisplay.querySelector(".eh_img-display").classList.add("show");
        for (let file of files) {
          altDisplay
            .querySelector(".eh_img-display")
            .appendChild(this.createDisplayItem(file, true));
        }
      });
    } else {
      this.altDisplays.forEach((altDisplay) => {
        if (altDisplay.querySelector(".eh_img-display").children.length === 0) {
          altDisplay.querySelector(".eh_img-display").classList.remove("show");
        }
      });
    }
  }

  // function to remove display items from alternate display
  removeItemFromAltDisplay(filename) {
    this.altDisplays.forEach((altDisplay) => {
      let altDisplayItems = altDisplay
        .querySelector(".eh_img-display")
        .getElementsByClassName("eh_img-display-item");
      for (let i = 0; i < altDisplayItems.length; i++) {
        if (altDisplayItems[i].getAttribute("data-file-name") === filename) {
          altDisplayItems[i].remove();
          break;
        }
      }
      // checking if there are no more children in alternate display
      if (altDisplayItems.length === 0) {
        altDisplay.querySelector(".eh_img-display").classList.remove("show");
      }
    });
  }

  // function to create a display item
  createDisplayItem(file, isNotRemovable) {
    let fileURL = URL.createObjectURL(file);
    let dispItem = document.createElement("div");
    dispItem.classList.add("eh_img-display-item");
    dispItem.setAttribute("data-file-name", file.name);
    let removeBtn = document.createElement("button");
    removeBtn.classList.add("item-remove");
    removeBtn.innerText = "X";
    removeBtn.setAttribute("type", "button"); // to prevent from submitting the form
    // adding event listener to remove button
    removeBtn.addEventListener("click", (event) => {
      this.removeFile(event);
    });
    let img = new Image();
    // freeing up memory when done loaidng image
    img.onload = function () {
      URL.revokeObjectURL(img.src);
    };
    img.src = fileURL;
    dispItem.appendChild(img);
    if (!isNotRemovable) {
      dispItem.appendChild(removeBtn);
    }

    // checking for display item options
    if (this.displayItemOptions) {
      if (this.displayItemOptions.width) {
        dispItem.style.width = this.displayItemOptions.width;
      }
    }
    return dispItem;
  }

  // function to get files
  getFiles() {
    return this.fileList;
  }
}

// let img_upload_display = new EhImageUploadDisplay("#upload-display", {
//   dragAndDrop: true,
//   altDisplay: {
//     selector: "#alt-screen",
//   },
//   displayItemOptions: {
//     width: "10rem",
//   },
// });
