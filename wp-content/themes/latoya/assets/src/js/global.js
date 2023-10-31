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

  /**
   * Register form and login action form
   * Show and hidden form login and register
   * */
  $('.create-account-button').click(function (e) {
    e.preventDefault()
    $(this).parents('.u-columns').addClass('active-register')
  })
  $('.login-account-button').click(function (e) {
    e.preventDefault()
    $(this).parents('.u-columns').removeClass('active-register')
  })

  /**
   * Custom dropdown
   * */

  $('.latoya-dropdown').each(function () {
    const _self = $(this)
    _self.wrap('<div class="latoya-dropdown-wrap"></div>')

    let html_option = ''
    _self.find('option').each(function () {

      const class_attr = $(this).attr('class')? $(this).attr('class') : ''

      if ($(this).is(':selected')) {
        html_option += `<li class="option ${class_attr} selected"><span>${$(this).text()}</span></li>`
      }else {
        html_option += `<li class="option ${class_attr}"><span>${$(this).text()}</span></li>`
      }
    })

    const html_select_box = `<div class="select-box"><i class="dropdown-icon"></i><span>${_self.find(':selected').text()}</span></div>`
    const html_options = `<div class="options-wrap d-none"><ul class="options">${html_option}</ul></div>`

    _self.parents('.latoya-dropdown-wrap').append(html_select_box + html_options)
    _self.addClass('d-none')
  })

  $('.latoya-dropdown-wrap .select-box').click(function (event) {
    event.stopPropagation()
    const _this_options = $(this).parents('.latoya-dropdown-wrap').find('.options-wrap')
    if (_this_options.hasClass('d-none')) {
      _this_options.removeClass('d-none')
    } else {
      _this_options.addClass('d-none')
    }
  })

  $('body').click(function() {
    $('.latoya-dropdown-wrap .select-box').parents('.latoya-dropdown-wrap').find('.options-wrap').addClass('d-none')
  })

  $('.latoya-dropdown-wrap .option').click(function () {
    const _self = $(this)
    const _this_ele = _self.parents('.latoya-dropdown-wrap')
    const label = _self.find('span').text()
    const index = _self.index()
    const val_index = _this_ele.find('select').find('option').eq(index).val()

    _this_ele.find('.select-box').find('span').text(label)
    _this_ele.find('select').val(val_index).trigger( 'change' )

    _self.parents('.options-wrap').find('.selected').removeClass('selected')
    _self.addClass('selected')
    _self.parents('.options-wrap').addClass('d-none')
  })
})
// }
