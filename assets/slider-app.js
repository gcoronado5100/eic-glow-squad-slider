
const allLocationsSelector = document.querySelectorAll('.row-nav-pos ul li');
const allSlides = document.querySelectorAll('.swiper-slide')
let LocationScope = 'allLocations'

// Initialize the slider
const allSlidersEIC = document.querySelectorAll('.swiper-eic-slider')
allSlidersEIC.forEach( slider => {
  (slider.id === 'swiper_allLocations') ? console.log('paso') :  slider.style.display = 'none' } )

const sliderSelecting = () => {
 allSlidersEIC.forEach(slider => { 
  (LocationScope === slider.id.replace( 'swiper_' , '')) ? (slider.style.display = 'block')  : slider.style.display = 'none'
 })
}

allLocationsSelector.forEach( item => {
  item.addEventListener('click', (e)=> {
    document.querySelector('.active-location').classList.remove('active-location')
    e.target.classList.add('active-location')
    LocationScope = e.target.id
    sliderSelecting()
  })
})



