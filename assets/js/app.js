
$(document).ready(function() {

  //Navbar Position
  var setNavbarPosition = function() {
    var scrollPosition = window.scrollY
    if (scrollPosition <= 36) {
      $('#navbar').css('position', '')
    } else {
      $('#navbar').css('position', 'fixed')
    }
  }
  setNavbarPosition()
  $(document).scroll(setNavbarPosition)




  //Dropdown
  $('[data-type=dropdown]').hover(function(){
    $(this).find('[data-type=dropdown-menu]').show()
  }, function() {
    $(this).find('[data-type=dropdown-menu]').hide()
  })
  $(document).click(function(e) {
    var dropdown = $(e.target).parents('[data-type=dropdown]')
    var target = null
    if (dropdown.length > 0) {
      target = $(dropdown[0]).find('[data-type=dropdown-menu]')
    }
    $('[data-type=dropdown-menu]').hide()
    if(target) target.toggle()
  })

  //Sidebar
  $('#sidebar_burger').click(function() {
    $('#sidebar').show();
    $('#sidebar_overlay').show();
    $('#sidebar_nav').animate({left: '0'})
  })

  $('#sidebar_overlay').click(function() {
    $('#sidebar_nav').animate({left: '-300px'}, 300, function() {
      $('#sidebar').hide();
    })
  })

  $('.alert-message').animate({right: '5px'}, 300, function() {
    var message = this;
    setTimeout(function() {
      $(message).animate({opacity: 0}, 300, function(){
        $(message).remove()
      })
    }, 2000)
  })
})
