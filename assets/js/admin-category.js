$(document).ready(function() {

  $('[data-action=show-edit-form]').click(function(){
    $('.category-item').removeClass('edit')
    var target = $(this).parents('.category-item')
    var form = target.find('form')

    target.addClass('edit')
    form.trigger('reset')
  })

  $('[data-action=hide-edit-form]').click(function() {
    var target = $(this).parents('.category-item')
    target.removeClass('edit')
  })

  $('[data-action=submit-edit-form]').click(function() {
    var target = $(this).parents('.category-item')
    var form = target.find('form')
    form.submit()
  })
})
