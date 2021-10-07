
document.addEventListener('alpine:init',  () => {
  
  Alpine.directive('tooltip', (el, {expression}) => {
    el.addEventListener('mouseover', function(){
      tippy(el, {
        content: expression
      })
    })
  })

  //Watch Scroll Position
  Alpine.store('scroll', {
    position: window.scrollY,
    init() {
      window.onscroll = () => this.position = window.scrollY
    }
  })

  //Sidebar
  Alpine.store('isSidebarOpen', false)


  //Alert Message
  Alpine.data('alert', () => ({
    right: '-300px',
    opacity: '1',
    init(){
      //Without nextTick the animation is not applied
      this.$nextTick(() => {
        this.right = '5px'
        setTimeout(() => {
          this.opacity = '0'
          this.right = '-300px'          
        }, 2000)
      })
    }
  }))

})