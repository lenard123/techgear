
const unwrap = data => JSON.parse(JSON.stringify(data))

document.addEventListener('alpine:init', function(){

  Alpine.data('cart_plus', () => ({
    canStillAdd: true,

    setAddStatus(canStillAdd) {
      this.canStillAdd = canStillAdd

      if (!canStillAdd) {
        tippy(this.$root, {
          content: 'You can not add more of this item at the moment'
        })
      }

    }

  }))

});
