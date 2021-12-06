import Alpine from 'alpinejs'
import collapse from '@alpinejs/collapse'
import resetErrorValidation from './modules/resetErrorValidation.js'
import imagePreview from './modules/imagePreview.js'

Alpine.plugin(collapse)
Alpine.data('resetErrorValidation', resetErrorValidation)
Alpine.data('imagePreview', imagePreview);

Alpine.data('tinymce', (selector) => ({
  init() {
    tinymce.init({
      selector
    });
  }
}))

window.Alpine = Alpine
Alpine.start()