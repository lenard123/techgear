import Alpine from 'alpinejs'
import stickyTop from './sticky-top.js'
import carousel from './carousel.js'

window.Alpine = Alpine

Alpine.directive('sticky-top', stickyTop)

Alpine.data('carousel', carousel)

Alpine.store('phpData', {})
window.addPhpData = function (key, value) {
  Alpine.store('phpData')[key] = value
}

Alpine.data('resetErrorValidation', () => ({
  removeErrorMessage() {
    this.$refs?.errorMessage?.remove()
    this.$refs?.input?.classList?.remove('error')
  }
}))

Alpine.start()