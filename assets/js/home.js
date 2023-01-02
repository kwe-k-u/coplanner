// const options = {
//   threshold: 0.5,
// };
// const intersectionObserver = new IntersectionObserver(changeNavBg, options);

// let sections = document.querySelectorAll("section");
// sections.forEach(function (section) {
//   intersectionObserver.observe(section);
// });

// function changeNavBg(entries) {
//   entries.forEach(function (entry) {
//     if (entry.isIntersecting) {
//       if (!entry.target.classList.contains("intro")) {
//         $(".navbar").css({
//           "backdrop-filter": "none",
//           "background-color": "white",
//         });
//         $(".navbar a").css("color", "black");
//       } else {
//         $(".navbar").css({
//           "backdrop-filter": "blur(20px)",
//           "background-color": "transparent",
//           "color": "white",
//         });
//       }
//     }
//   });
// }

const swiper = new Swiper(".swiper", {
  speed: 400,
  spaceBetween: 30,
  slidesPerView: "auto",
  // centerInsufficientSlides: true,
  // centeredAuto: true,
  loop: true,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  autoplay: {
    delay: 1000,
  },
});

const slides = document.querySelectorAll(".swiper-slide");
console.log()
slides.forEach(function (slide, index) {
  let slideImg = slide.querySelector("img");
  let imgWidth = slideImg.naturalWidth;
  let imgHeight = slideImg.naturalHeight;

  if ((imgWidth / imgHeight) < 1) {
    slide.classList.add("portrait");
  }
});
