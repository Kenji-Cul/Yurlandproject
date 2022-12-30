// Profile Slider
if (window.innerWidth < 800) {
  let swiperVerse = new Swiper(".swiper-counter", {
    loop: true,
    spaceBetween: 10,
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
        spaceBetween: 10,
      },
    },
  });
}
