import 'bootstrap'
// import request from './request'

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
      const class_attr = $(this).attr('class') ? $(this).attr('class') : ''

      if ($(this).is(':selected')) {
        html_option += `<li class="option ${class_attr} selected"><a href="#" class="dropdown-item">${$(
          this
        ).text()}</a></li>`
      } else {
        html_option += `<li class="option ${class_attr}"><a href="#" class="dropdown-item">${$(
          this
        ).text()}</a></li>`
      }
    })

    const html_select_box = `<div class="select-box dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="dropdown-icon"></i><span>${_self
      .find(':selected')
      .text()}</span></div>`
    const html_options = `<ul class="dropdown-menu options">${html_option}</ul>`

    _self
      .parents('.latoya-dropdown-wrap')
      .append(html_select_box + html_options)
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

  /**
   *
   * Show button Back to top and show nav when scroll from top
   * */
  function scroll_nav(height) {
    if (height > 100) {
      $('.element-sticky-header').addClass('sticky')
      $('.latoya-to-top').addClass('active')
    } else {
      $('.element-sticky-header').removeClass('sticky')
      $('.latoya-to-top').removeClass('active')
    }
  }

  scroll_nav($(window).scrollTop())
  $(window).scroll(function () {
    scroll_nav($(window).scrollTop())
  })

  $('.latoya-to-top').click(function () {
    $('html, body').animate({scrollTop: 0}, 300)
  })
})
// }
