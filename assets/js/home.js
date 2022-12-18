const options = {
  threshold: 0.5,
};
const intersectionObserver = new IntersectionObserver(changeNavBg, options);

let sections = document.querySelectorAll("section");
sections.forEach(function (section) {
  intersectionObserver.observe(section);
});

function changeNavBg(entries) {
  entries.forEach(function (entry) {
    if (entry.isIntersecting) {
      if (!entry.target.classList.contains("intro")) {
        $(".navbar").css({
          "backdrop-filter": "none",
          "background-color": "white",
        });
        $(".navbar a").css("color", "black");
      } else {
        $(".navbar").css({
          "backdrop-filter": "blur(20px)",
          "background-color": "transparent",
          "color": "white",
        });
      }
    }
  });
}
