console.log("main.js loaded", typeof Swiper);
document.addEventListener("DOMContentLoaded", () => {
  const el = document.querySelector(".js-bestworks-swiper");
  if (!el || typeof Swiper === "undefined") return;

  new Swiper(el, {
    loop: true,
    spaceBetween: 16,
    slidesPerView: 1,
    navigation: {
      nextEl: ".slider-arrow--next",
      prevEl: ".slider-arrow--prev",
    },
    pagination: {
      el: ".slider-pagination",
      clickable: true,
    },
    breakpoints: {
      640: { slidesPerView: 2 },
      1024: { slidesPerView: 3 },
    },
  });
});
