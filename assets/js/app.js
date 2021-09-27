
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

  //Sidebar
  Alpine.store('isSidebarOpen', false)


  //Alert Message
  Alpine.data('alert', function() {
    return {
      right: '-300px',
      opacity: '1',
      init() {
        var ctx = this
        //Without nextTick the animation is not applied
        ctx.$nextTick(function() { 
          ctx.right = '5px'
          setTimeout(function() { 
            ctx.opacity = '0'
            ctx.right = '-300px'
          }, 2000)
        })
      }
    }
  })

})