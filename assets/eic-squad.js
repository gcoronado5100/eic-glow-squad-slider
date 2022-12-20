  const allSwipers = document.querySelectorAll('.swiper-eic-slider')
  allSwipers.forEach( swiper => {
    let counter = 0 
    const eicSwiper = new Swiper('.swiper-eic-slider', {
        loop: true,
        slidesPerView:1,
        slidesPerGroup:1,
        navigation: {
            nextEl: `.swiper-button-next`,
            prevEl: `.swiper-button-prev`,
        },
        centeredSlides: true,
      });
      counter = counter + 1 
  })