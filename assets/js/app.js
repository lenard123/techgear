"use strict";

document.addEventListener('alpine:init', function () {
  //Watch Scroll Position
  Alpine.store('scroll', {
    position: window.scrollY,
    init: function init() {
      var _this = this;

      window.onscroll = function () {
        return _this.position = window.scrollY;
      };
    }
  }); //Sidebar

  Alpine.store('isSidebarOpen', false); //Alert Message

  Alpine.data('alert', function () {
    return {
      right: '-300px',
      opacity: '1',
      init: function init() {
        var _this2 = this;

        //Without nextTick the animation is not applied
        this.$nextTick(function () {
          _this2.right = '5px';
          setTimeout(function () {
            _this2.opacity = '0';
            _this2.right = '-300px';
          }, 2000);
        });
      }
    };
  });
});