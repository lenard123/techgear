import Alpine from 'alpinejs'
import stickyTop from './modules/sticky-top.js'
import carousel from './modules/carousel.js'
import resetErrorValidation from './modules/resetErrorValidation.js'

require('./bootstrap.js')

Alpine.directive('sticky-top', stickyTop)

Alpine.data('carousel', carousel)

Alpine.data('resetErrorValidation', resetErrorValidation)

window.Alpine = Alpine
Alpine.start()