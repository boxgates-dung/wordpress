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
    const _this_form = $(this).parents('.search-form')
    const search_form_input = _this_form.find('input[name="s"]')
    const keywork = search_form_input.val()
    search_form_input.val(keywork).trigger('keyup')
  })

  $('.search-form.ajax-search input[type="text"], .search-results').click(
    function () {
      $('.search-results').removeClass('d-none')
    }
  )

  $(document).mouseup(function (e) {
    let container = $('.search-results, .latoya-dropdown-wrap .select-box')

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

  $('a[data-bs-target="#loginModal"]').click(function () {
    $('.u-columns').removeClass('active-register')
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
        html_option += `<li class="option ${class_attr} selected"><a href="#" class="dropdown-item">${$(this).text()}</a></li>`
      }else {
        html_option += `<li class="option ${class_attr}"><a href="#" class="dropdown-item">${$(this).text()}</a></li>`
      }
    })

    const html_select_box = `<div class="select-box dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="dropdown-icon"></i><span>${_self.find(':selected').text()}</span></div>`
    const html_options = `<ul class="dropdown-menu options">${html_option}</ul>`

    _self.parents('.latoya-dropdown-wrap').append(html_select_box + html_options)
    _self.addClass('d-none')
  })

  $('.latoya-dropdown-wrap .option').click(function () {
    const _self = $(this)
    const _this_ele = _self.parents('.latoya-dropdown-wrap')
    const label = _self.find('a').text()
    const index = _self.index()

    _this_ele.find('.select-box').find('span').text(label)
    _this_ele.find('select').prop('selectedIndex', index).change()

    _self.parents('.options').find('.selected').removeClass('selected')
    _self.addClass('selected')
  })
})
// }
