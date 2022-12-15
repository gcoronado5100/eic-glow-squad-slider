
const allLocationsSelector = document.querySelectorAll('.row-nav-pos ul li');
const allSlides = document.querySelectorAll('.swiper-slide')
let LocationScope = 'allLocations'

const slideSelecting = () => {
  if (LocationScope !== 'allLocations' ){
  allSlides.forEach( slide => slide.style.display = 'none')
  allSlides.forEach(slide => ( slide.classList.contains(`${LocationScope}`) ? slide.style.display ='block' : '') )
  }else {
    allSlides.forEach( slide => slide.style.display = 'block')
  }
}

allLocationsSelector.forEach( item => {
  item.addEventListener('click', (e)=> {
    document.querySelector('.active-location').classList.remove('active-location')
    e.target.classList.add('active-location')
    LocationScope = e.target.id
    slideSelecting()
  })
})



