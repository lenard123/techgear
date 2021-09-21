$(document).ready(function(){

  $('[data-action=open-sidebar]').click(function() {
    $('#sidebar').addClass('active')
  })

  $('[data-action=close-sidebar]').click(function() {
    $('#sidebar').removeClass('active')
  })

  if (typeof php_active_page != 'undefined') {
    $(`[data-page=${php_active_page}`).addClass('bg-gray-700')
  }

})