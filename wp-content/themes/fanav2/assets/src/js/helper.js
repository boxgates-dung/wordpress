$(document).ready(function () {
  $('.search-mobile input[type="text"]').keyup(function () {
    const _self = $(this)
    const this_form = _self.parents('.ajax-search')
    const input = _self.val()
    const url = this_form.data('ajax_action')
    const action = 'latoya_product_search'
    const product_cat = ''

    if (input.length > 1) {
      this_form.find('.search-results').removeClass('d-none')

      $.ajax({
        url: url,
        method: 'GET',
        dataType: 'json',
        data: {
          action: action,
          search_key: input,
          product_cat: product_cat,
        },
        beforeSend: function () {
          this_form.addClass('loading')
        },
        success: function (data) {
          const html = data.data
          this_form.removeClass('loading')
          this_form.find('.search-results').html(html)
        },
        error: function (xhr) {
          console.log(xhr)
        },
      })
    } else {
      this_form.find('.search-results').addClass('d-none').html('')
    }
  })

  $('.search-mobile input[type="text"], .search-results').click(function () {
    $('.search-results').removeClass('d-none')
  })

  $(document).mouseup(function (e) {
    let container = $('.search-results')

    // If the target of the click isn't the container
    if (!container.is(e.target) && container.has(e.target).length === 0) {
      $('.search-results').addClass('d-none')
    }
  })
})
