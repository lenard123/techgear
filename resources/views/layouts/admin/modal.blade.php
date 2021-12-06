<div 
  x-data="{data: null, isOpen: false, closeModal: function() { this.isOpen = false}}"
  x-show="isOpen"
  class="z-50 fixed top-0 left-0 h-screen w-screen"
  @@open-modal.window="isOpen = true; data = $event.detail;"
  @@close-modal.window="isOpen = false"
  x-cloak
  >

  <div class="bg-black absolute opacity-30 h-screen w-screen"></div>

  <div class="absolute h-screen w-screen flex justify-center items-center">
    @stack('modal')
  </div>

</div>