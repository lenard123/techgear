import Alpine from 'alpinejs'
import stickyTop from './sticky-top.js'

window.Alpine = Alpine

Alpine.directive('sticky-top', stickyTop)

Alpine.data('carousel', () => ({

  move: 'move-right',
  head: 0,

  get active() {
    return this.head % this.slidesCount
  },

  slidesCount: 0,

  init() {
    this.$nextTick(() => {
      this.slidesCount = this.$refs.container.childElementCount
    })
  },

  next(val) {
    this.move = val === 1 ? 'move-right' : 'move-left'
    if (this.head + val < 0) {
      val += this.slidesCount
    } 
    this.head += val
  }

}))

// Alpine.data('carousel', () => ({
//     get slides() {
//       return this.$store.phpData.slides
//     },

//     activeSlide: 0,

//     getPosition(i) {
//       var pos = (i * 100) - (this.activeSlide * 100)
//       return `${pos}%`
//     },

//     nextSlide() {
//       let next = this.activeSlide + 1
//       if (next < this.slides.length) {
//         this.activeSlide = next
//       } else {
//         this.activeSlide = 0
//       }
//     },

//     prevSlide() {
//       let prev = this.activeSlide - 1
//       if (prev >= 0) {
//         this.activeSlide = prev
//       } else {
//         this.activeSlide = this.slides.length-1
//       }
//     },

//     init() {
//       setTimeout(() => {
//         this.nextSlide()
//       }, 5000)
//     }
// }))


Alpine.store('phpData', {})
window.addPhpData = function (key, value) {
  Alpine.store('phpData')[key] = value
}

Alpine.start()