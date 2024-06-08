


let mobileImageIndex = 0;
let dekstopImageIndex = 0;
const desktopImageSlide = document.getElementById("image-slide-desktop");
const mobileImageSlide = document.getElementById("image-slide-mobile");
let mobileImages = mobileImageSlide.getAttribute("data-imgs").split(",");
let desktopImages = desktopImageSlide.getAttribute("data-imgs").split(",");

function changeMobileCarousel(){
  mobileImageSlide.classList.remove("fade-in");
  mobileImageSlide.classList.add("fade-out");

  mobileImageIndex = (mobileImageIndex +1) %mobileImages.length;
  let nextImage = mobileImages[mobileImageIndex];

  setTimeout(()=>{
  mobileImageSlide.classList.add("fade-in");
    mobileImageSlide.style.backgroundImage = "url('"+baseurl+nextImage+"')";
    mobileImageSlide.classList.remove("fade-out");
  },1000);
}
function changeDesktopCarousel(){
  desktopImageSlide.classList.remove("fade-in");
  desktopImageSlide.classList.add("fade-out");

  dekstopImageIndex = (dekstopImageIndex +1) %desktopImages.length;
  let nextImage = desktopImages[dekstopImageIndex];

  setTimeout(()=>{
    desktopImageSlide.classList.add("fade-in");
    desktopImageSlide.style.backgroundImage = "url('"+baseurl+nextImage+"')";
    desktopImageSlide.classList.remove("fade-out");
  },1000);
}

setInterval(changeDesktopCarousel,4000);
setInterval(changeMobileCarousel,4000);