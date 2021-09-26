
document.addEventListener('alpine:init', function () {
  
  //Watch Scroll Position
  Alpine.store('scroll', {
    position: window.scrollY,
    init: function () {
      var context = this
      window.onscroll = function () {
        context.position = window.scrollY
      }
    }
  })

  Alpine.store('isSidebarOpen', false)
})

var alertMessages = document.querySelector('.alert-message')
if (alertMessages) { 
  alertMessages.style.right = '5px'
  setTimeout(function() {
    alertMessages.style.opacity = 0
  }, 2000)
}
