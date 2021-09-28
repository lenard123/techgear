"use strict";

var unwrap = function unwrap(data) {
  return JSON.parse(JSON.stringify(data));
};

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