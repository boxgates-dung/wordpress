import { Offcanvas } from 'bootstrap'
import 'select2'
import Swiper, { Navigation } from 'swiper'

export default () => {
  Swiper.use([Navigation])
  const offcanvasWishlist = new Offcanvas($('#offcanvasWishlist'))

  $('body').on('added_to_cart', function () {
    offcanvasWishlist.hide()
    $('#cartModal').modal('show')
  })

  $('#offcanvasMinicart, #cartModal, #order_review, .cart-row, form.cart').on('click', '.quantity a', function () {
    const qty = $('.input-text.qty', $(this).parents('.quantity'))
    const currentQty = parseInt(qty.val())

    if ($(this).hasClass('minus')) {
      if (currentQty > 1) {
        qty.val(currentQty - 1).trigger('change')
      }
    } else {
      qty.val(currentQty + 1).trigger('change')
    }
  })

  // Toggle widget
  $('.widget-title').click(function () {
    if ($(this).parent().hasClass('hide')) {
      $(this).parent().toggleClass('hide')
      $('>ul, form, .tagcloud', $(this).parent()).slideDown('fast')
    } else {
      $(this).parent().toggleClass('hide')
      $('>ul, form, .tagcloud', $(this).parent()).slideUp('fast')
    }
  })

  // Toggle mobile menu
  $('#offcanvasMenu .menu-item-has-children').append('<a href="javascript:void(0);" class="accordion"></a>')
  $('#offcanvasMenu .sub-menu').css('display', 'none')
  $('.current-menu-item, .current-menu-parent, .current-menu-ancestor', '#offcanvasMenu').addClass('active')
  $('.current-menu-item>.sub-menu, .current-menu-parent>.sub-menu, .current-menu-ancestor>.sub-menu', '#offcanvasMenu ').css('display', 'block')

  $('#offcanvasMenu .accordion').click(function () {
    $(this).parent().children('.sub-menu').slideToggle('fast')
    $(this).parent().toggleClass('active')
  })

  /**
   * Recommend product carousel
   * */
  $('.recommend-products, .related-post').each(function () {
    const dataSliderConfig = $('.recommend-product-carousel, .related-posts-carousel', $(this)).data( 'slider' )
    const id = $(this).attr('id')

    new Swiper(`#${id} .swiper-container`, {
      loop: false,
      navigation: {
        nextEl: `#${id} .next`,
        prevEl: `#${id} .prev`,
      },
      breakpoints: {
        320: {
          slidesPerView: dataSliderConfig.column_mobile,
          spaceBetween: dataSliderConfig.gutter_mobile,
        },
        640: {
          slidesPerView: dataSliderConfig.column_tablet,
          spaceBetween: dataSliderConfig.gutter_tablet,
        },
        1000: {
          slidesPerView: dataSliderConfig.column,
          spaceBetween: dataSliderConfig.gutter,
        },
      },
    })
  })

  new Swiper('#quickviewModal .swiper-container', {
    loop: false,
    slidesPerView: 1,
    spaceBetween: 0,
    navigation: {
      // nextEl: '#quickviewModal .next',
      // prevEl: '#quickviewModal .prev',
    },
  })

  // Test ==== //
  $('.btn-quick-view').click(function(){
    const _self = $(this)

    $.ajax({
        type : 'GET', 
        dataType : 'html',
        url : '/wp-admin/admin-ajax.php', 
        data : {
            action: 'quickview', 
            product_id : _self.data('prod'),
        },
        context: this,
        beforeSend: function(){
          _self.addClass('loading')
        },
        success: function(output) {
          _self.removeClass('loading')
          $('#quickviewModal .modal-body').html(output)

          new Swiper('.product-gallery', {
            loop: false,
            slidesPerView: 1,
            spaceBetween: 0,
            navigation: {
              nextEl: '.product-gallery .button-next',
              prevEl: '.product-gallery .button-prev',
            },
            modules: [Navigation]
          })
        }
    })
    return false
})


}
