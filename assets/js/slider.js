$(document).ready(function() {
  var indicators = $('.slideshow .indicator')
  var slides = $('.slideshow .slides')

  var active = 0;

  var activeChanged = function(i) {
    $('.slideshow .indicator.bg-white').removeClass('bg-white')
    $(indicators[active]).addClass('bg-white');

    if (i > 0) {
      $('.slideshow .slides.active')
        .css('left','0')
        .animate({left: '-100%'}, 300, function(){
          $(this).removeClass('active')
        })

      $(slides[active])
        .addClass('active')
        .css({left: '100%'})
        .animate({left:0}, 300)

    } else {
      $('.slideshow .slides.active')
        .css('left','0')
        .animate({left: '100%'}, 300, function(){
          $(this).removeClass('active')
        })

      $(slides[active])
        .addClass('active')
        .css({left: '-100%'})
        .animate({left:0}, 300)
    }
  }

  var next = function(i) {
    active += i
    if (active < 0) active = indicators.length - 1
    else if (active >= indicators.length)  active = 0

    activeChanged(i);
  }

  $('.slideshow .btn-left').click(function(){
    next(-1)
  })

  $('.slideshow .btn-right').click(function(){
    next(1)
  })

  indicators.each(function(i, indicator) {
    $(indicator).click(function() {
      if (i != active){
        var move = active > i ? -1 : 1
        active = i
        activeChanged(move)
      }
    })
  })

  activeChanged(1)

  setInterval(function(){
    next(1)
  }, 10000)
})