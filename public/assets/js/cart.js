"use strict";

document.addEventListener('alpine:init', function () {
  Alpine.data('cart_plus', function () {
    return {
      canStillAdd: true,
      setAddStatus: function setAddStatus(canStillAdd) {
        this.canStillAdd = canStillAdd;

        if (!canStillAdd) {
          tippy(this.$root, {
            content: 'You can not add more of this item at the moment'
          });
        }
      }
    };
  });
});