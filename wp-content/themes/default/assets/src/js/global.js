import 'bootstrap'

$(document).ready(function () {
  /**
   * Bootrap modal action
   * */ 
  $('[data-toggle="modal"]').click(function () {
    $($(this).data('target')).modal('show')
  })

  $('[data-dismiss="modal"]').click(function () {
    $('#' + $(this).parents('.modal').attr('id')).modal('hide')
  })

  /**
   * Action click show search on mobile
   * */ 
  $('.btn-icon-search-mobile').click(function () {
    const self = $(this)
    if (self.hasClass('show')) {
      self.removeClass('show')
      $('.mobile-top-nav .search-form-mobile').removeClass('show')
      $('.mobile-top-nav .mobile-logo').removeClass('d-none')
    } else {
      self.addClass('show')
      $('.mobile-top-nav .search-form-mobile').addClass('show')
      $('.mobile-top-nav .mobile-logo').addClass('d-none')
    }
  })

  /**
   * 
   * Show button Back to top and show nav when scroll from top
   * */ 
  function scroll_nav(height) {
    if (height > 100) {
      $('.header-main').addClass('scroll-down')
      $('.btn-scroll-top').removeClass('d-none')
    } else {
      $('.header-main').removeClass('scroll-down')
      $('.btn-scroll-top').addClass('d-none')
    }
  }

  scroll_nav($(window).scrollTop())
  $(window).scroll(function () {
    scroll_nav($(window).scrollTop())
  })
})
