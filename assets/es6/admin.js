
document.addEventListener('alpine:init', function () {
  Alpine.store('isSidebarOpen', false)

  if (typeof window.php_active_page === 'undefined')  
    window.php_active_page = null

  Alpine.store('page', window.php_active_page)

  Alpine.data('toggler', () => ({
    isOpen: false,
    toggle() {
      this.isOpen = !this.isOpen
    },
    close() {
      this.isOpen = false
    },
    open() {
      this.isOpen = true
    }
  }))

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