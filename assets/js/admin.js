"use strict";

document.addEventListener('alpine:init', function () {
  Alpine.store('isSidebarOpen', false);
  if (typeof window.php_active_page === 'undefined') window.php_active_page = null;
  Alpine.store('page', window.php_active_page);
  Alpine.data('toggler', function () {
    return {
      isOpen: false,
      toggle: function toggle() {
        this.isOpen = !this.isOpen;
      },
      close: function close() {
        this.isOpen = false;
      },
      open: function open() {
        this.isOpen = true;
      }
    };
  }); //Alert Message

  Alpine.data('alert', function () {
    return {
      right: '-300px',
      opacity: '1',
      init: function init() {
        var _this = this;

        //Without nextTick the animation is not applied
        this.$nextTick(function () {
          _this.right = '5px';
          setTimeout(function () {
            _this.opacity = '0';
            _this.right = '-300px';
          }, 2000);
        });
      }
    };
  });
});