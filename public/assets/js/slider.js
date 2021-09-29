"use strict";

document.addEventListener('alpine:init', function () {
  Alpine.data('slider', function () {
    return {
      slides: php_slides,
      activeSlide: 0,
      getPosition: function getPosition(i) {
        var pos = i * 100 - this.activeSlide * 100;
        return "".concat(pos, "%");
      },
      nextSlide: function nextSlide() {
        var next = this.activeSlide + 1;

        if (next < this.slides.length) {
          this.activeSlide = next;
        } else {
          this.activeSlide = 0;
        }
      },
      prevSlide: function prevSlide() {
        var prev = this.activeSlide - 1;

        if (prev >= 0) {
          this.activeSlide = prev;
        } else {
          this.activeSlide = this.slides.length - 1;
        }
      },
      init: function init() {
        var _this = this;

        setTimeout(function () {
          _this.nextSlide();
        }, 5000);
      }
    };
  });
}); // $(document).ready(function() {
//   var indicators = $('.slideshow .indicator')
//   var slides = $('.slideshow .slides')
//   var active = 0;
//   var activeChanged = function(i) {
//     $('.slideshow .indicator.bg-white').removeClass('bg-white')
//     $(indicators[active]).addClass('bg-white');
//     if (i > 0) {
//       $('.slideshow .slides.active')
//         .css('left','0')
//         .animate({left: '-100%'}, 300, function(){
//           $(this).removeClass('active')
//         })
//       $(slides[active])
//         .addClass('active')
//         .css({left: '100%'})
//         .animate({left:0}, 300)
//     } else {
//       $('.slideshow .slides.active')
//         .css('left','0')
//         .animate({left: '100%'}, 300, function(){
//           $(this).removeClass('active')
//         })
//       $(slides[active])
//         .addClass('active')
//         .css({left: '-100%'})
//         .animate({left:0}, 300)
//     }
//   }
//   var next = function(i) {
//     active += i
//     if (active < 0) active = indicators.length - 1
//     else if (active >= indicators.length)  active = 0
//     activeChanged(i);
//   }
//   $('.slideshow .btn-left').click(function(){
//     next(-1)
//   })
//   $('.slideshow .btn-right').click(function(){
//     next(1)
//   })
//   indicators.each(function(i, indicator) {
//     $(indicator).click(function() {
//       if (i != active){
//         var move = active > i ? -1 : 1
//         active = i
//         activeChanged(move)
//       }
//     })
//   })
//   activeChanged(1)
//   setInterval(function(){
//     next(1)
//   }, 10000)
// })