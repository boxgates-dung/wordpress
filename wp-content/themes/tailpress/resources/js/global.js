jQuery(document).ready(function ($) {
  $('.header-icon .top-action-btn').click(function () {
    const modal_id = $(this).data('name')
    $(`#modal-${modal_id}`).toggleClass('modal-show')
  })

  $('.modal .btn-close').click(function () {
    $(this).parents('.modal').removeClass('modal-show')
  })
})
