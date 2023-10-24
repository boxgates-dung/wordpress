$(document).ready(function () {
  $('.search-mobile input[type="text"]').keyup(function () {
    const _self = $(this)
    const this_form = _self.parents('.ajax-search')
    const input = _self.val()
    const url = this_form.data('ajax_action')
    const action = 'latoya_product_search'
    const cat = ''

    if (input.length > 1) {
      this_form.find('.search-results').removeClass('d-none')

      $.ajax({
        url: url,
        method: 'GET',
        dataType: 'json',
        data: {
          action: action,
          search_key: input,
          cat: cat,
        },
        beforeSend: function () {
          // setting a timeout
          this_form.addClass('loading')
        },
        success: function (data) {
          this_form.removeClass('loading')
          console.log(data.results)
          const products = data.results

          let html = `<div class="list-header"><span><span class="count">${products.length} </span> results found with <span class="keywork">"${input}"</span></span></div>`

          products.map(function (product) {
            html += `
            <div class="autocomplete-suggestion" data-index="0">
              <div class="suggestion-thumb"><img width="480" height="638" src="${product.photo}" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" decoding="async" loading="lazy"></div>
                <div class="suggestion-group">
                  <div class="suggestion-title product-title"><span>${product.title}</span></div>
                <div class="suggestion-price price">${product.price}</div>
              </div>
            </div>
            `
          })

          this_form.find('.search-results').html(html)
        },
        error: function (xhr) {
          // if error occured
          console.log(xhr)
        },
      })
    } else {
      this_form.find('.search-results').addClass('d-none').html('')
    }
  })

  $('.search-mobile input[type="text"], .search-results').click(
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
