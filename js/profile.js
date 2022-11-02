// Profile Slider
let swiperVerse = new Swiper(".swiper-counter", {
  loop: true,
  spaceBetween: 24,
  slidesPerView: "auto",
  grabCursor: true,
  autoplay: true,
  pagination: {
    el: ".swiper-pagination",
    dynamicBullets: true,
    autoplay: true,
  },
  breakpoints: {
    768: {
      slidesPerView: 3,
    },
    1024: {
      spaceBetween: 48,
    },
  },
});
