jQuery(document).ready(function ($) {
  // $('body').html('sdsd')
  console.log("ready!")
  $('.header-icon .top-action-btn').click(function () {
    const modal_id = $(this).data('name')
    $(`#modal-${modal_id}`).click(function () {
      console.log('sdsdgsauydfast')
    })

  })

  $('.modal-show').click(function () {
    console.log('sdsdgsauydfast')
  })
})