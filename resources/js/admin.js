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

Alpine.data('chart', (config) => ({

  chart: null,

  testConfig: {
    type: 'doughnut',
    data: {
      labels: ['Published', 'Unpublished'],
      datasets: [{
        data: [300, 50],
        backgroundColor: [
          '#10B981',
          '#FCD34D',
        ],
        hoverOffset: 4
      }]
    },
    options: {
      plugins:{
        legend: {
          position: 'bottom',
          labels: {
            pointStyle: 'circle',
            usePointStyle: true
          }
        }
      }
    }
  },

  init() {
    this.chart = new Chart(this.$root, config)
  }

}))

window.Alpine = Alpine
Alpine.start()