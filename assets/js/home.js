$(document).ready(function () {
  const swiper = new Swiper(".swiper", {
    speed: 400,
    spaceBetween: 30,
    slidesPerView: "auto",
    loop: true,
    centeredSlides: true,
    centerInsufficientSlides: true,
    loop: true,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    autoplay: {
      delay: 3000,
    },
    pagination: {
        el: '.swiper-pagination',
        type: 'bullets',
        clickable: true,
      },
  });

  const slides = document.querySelectorAll(".swiper-slide");
  slides.forEach(function (slide, index) {
    let slideImg = slide.querySelector("img");

    slides.forEach(function (slide, index) {
      let slideImg = slide.querySelector("img");
      let imgWidth = slideImg.naturalWidth;
      let imgHeight = slideImg.naturalHeight;

      if (imgWidth / imgHeight < 1) {
        slide.classList.add("portrait");
      }
    });
  });
});
