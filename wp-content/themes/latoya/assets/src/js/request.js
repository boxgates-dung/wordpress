

/**
 * Contains the searched product
 * */ 
const product_search_cache = {}

/**
 * @param search_key String
 * @param product_cat String
 * @param url_api String
 * @param action String
 * @param this_form element
 * @return html string
 * */ 
function product_search_ajax(search_key, product_cat, url_api, action, this_form) {
  if (search_key.length > 1) {
    this_form.find('.search-results').removeClass('d-none')
    let obj_key = search_key + product_cat
    if ( obj_key in product_search_cache) {
      this_form.find('.search-results').html(product_search_cache[obj_key])
    } else {
      $.ajax({
        url: url_api,
        method: 'GET',
        dataType: 'json',
        data: {
          action: action,
          s: search_key,
          cat: product_cat,
        },
        beforeSend: function () {
          this_form.addClass('loading')
        },
        success: function (data) {
          const html = data.data
          this_form.removeClass('loading')
          product_search_cache[obj_key] = html
          this_form.find('.search-results').html(html)
        },
        error: function (xhr) {
          this_form.removeClass('loading')
          console.log(xhr)
        },
      })
    }
  } else {
    this_form.find('.search-results').addClass('d-none').html('')
  }
}

export default {
    product_search_ajax
}