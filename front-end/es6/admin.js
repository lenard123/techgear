document.addEventListener('alpine:init', function () {
  Alpine.store('isSidebarOpen', false)

  //Darkmode Toggler
  Alpine.store('darkmode', {
    enabled: false,

    init() {
      if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        this.enabled = true
      } else {
        this.enabled = false
      }
    },

    toggle() {
      this.enabled = !this.enabled
      if (this.enabled){
        localStorage.theme = 'dark'
        document.documentElement.classList.add('dark')
      }
      else {
        localStorage.theme = 'light'
        document.documentElement.classList.remove('dark')
      }
    }
  })

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