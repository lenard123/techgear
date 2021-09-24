$(document).ready(function(){

  //Sidebar toggler
  $('[data-action=open-sidebar]').click(function() {
    $('#sidebar').addClass('active')
  })

  $('[data-action=close-sidebar]').click(function() {
    $('#sidebar').removeClass('active')
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