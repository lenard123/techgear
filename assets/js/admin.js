$(document).ready(function(){

  //Sidebar toggler
  $('[data-action=open-sidebar]').click(function() {
    $('#sidebar').addClass('active')
  })

  $('[data-action=close-sidebar]').click(function() {
    $('#sidebar').removeClass('active')
  })

  //Sidebar dropdown
  $('.sidebar-dropdown').click(function(e){
    var target = $(e.target)
    if (!target.is('.sidebar-dropdown-menu *')) {
      $(this).toggleClass('active').find('.sidebar-dropdown-menu').slideToggle()
    }
  })

  //Set Active Page
  if (typeof php_active_page != 'undefined') {
    $(`[data-page=${php_active_page}`).addClass('bg-gray-700')
  }


  //Animate alert message
  $('.alert-message').animate({right: '5px'}, 300, function() {
    var message = this;
    setTimeout(function() {
      $(message).animate({opacity: 0}, 300, function(){
        $(message).remove()
      })
    }, 2000)
  })
})