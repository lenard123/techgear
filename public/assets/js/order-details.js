"use strict";

document.addEventListener('alpine:init', function () {
  Alpine.data('order_details', function () {
    return {
      order_status: php_order_status,

      get order_progress() {
        switch (this.order_status) {
          case 1:
            return '';

          case 2:
            return 'w-1/3';

          case 3:
            return 'w-2/3';

          case 4:
            return 'w-full';
        }

        return null;
      },

      bg: function bg(status) {
        return status <= this.order_status ? 'bg-blue-500' : null;
      }
    };
  });
});