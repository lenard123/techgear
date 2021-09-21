$(document).ready(function(){

  $('[data-action=open-sidebar]').click(function() {
    $('#sidebar').addClass('active')
  })

  $('[data-action=close-sidebar]').click(function() {
    $('#sidebar').removeClass('active')
  })

})