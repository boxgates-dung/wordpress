import 'bootstrap'
import request from './request'

// export default () => {
$(document).ready(function () {
  /**
   * Bootstrap action modal
   * */
  $('[data-toggle="modal"]').click(function () {
    $($(this).data('target')).modal('show')
  })

  $('[data-dismiss="modal"]').click(function () {
    $('#' + $(this).parents('.modal').attr('id')).modal('hide')
  })

  /**
   * Action product search ajax
   * */
  let globalTimeout = null
  $('.search-form.ajax-search input[type="text"]').keyup(function () {
    const _self = $(this)
    const this_form = _self.parents('form')
    const search_key = _self.val()
    const url_api = this_form.data('ajax_action')
    const action = 'ajax_search_products'
    const product_cat = this_form.find('select[name="product_cat"]').val()

    if (globalTimeout != null) {
      clearTimeout(globalTimeout)
    }
    globalTimeout = setTimeout(function () {
      globalTimeout = null

      request.product_search_ajax(
        search_key,
        product_cat,
        url_api,
        action,
        this_form
      )
    }, 200)
  })

  $('.search-form.ajax-search select[name="product_cat"]').change(function () {
    const search_form_input = $('.search-form.ajax-search input[type="text"]')
    const keywork = search_form_input.val()
    search_form_input.val(keywork).trigger('keyup')
  })

  $('.search-form.ajax-search input[type="text"], .search-results').click(
    function () {
      $('.search-results').removeClass('d-none')
    }
  )

  $(document).mouseup(function (e) {
    let container = $('.search-results')

    // If the target of the click isn't the container
    if (!container.is(e.target) && container.has(e.target).length === 0) {
      $('.search-results').addClass('d-none')
    }
  })
})
// }
