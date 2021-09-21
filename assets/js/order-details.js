$(document).ready(function(){
  var order_progress = {
    1: '',
    2: 'w-1/3',
    3: 'w-2/3',
    4: 'w-full'
  }
  var order_progress_class = order_progress[php_order_status]

  $('#order-progress').addClass(order_progress_class)

  for(var i = 1; i <= php_order_status; i++)
  {
    $(`#order-status-${i}`).addClass('bg-blue-500')
  }

})