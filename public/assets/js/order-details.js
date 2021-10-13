"use strict";

document.addEventListener('alpine:init', function () {
  var OrderDetails = function OrderDetails(classNames, defaultColor) {
    return {
      status: php_order_status,
      classNames: classNames,

      get orderProgress() {
        return this.classNames[this.status - 1];
      },

      bg: function bg(status) {
        return status === this.status ? defaultColor : '';
      }
    };
  };

  Alpine.data('OrderDetails', OrderDetails);
});