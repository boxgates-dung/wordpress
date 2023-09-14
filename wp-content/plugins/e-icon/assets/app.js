jQuery(document).ready(function ($) {
  $('#addCus').click(function () {
    const _self = $(this)

    // Init data
    const email = 'ydungkuan@gmail.com'
    const phone = '123123'
    const first_name = 'first'
    const last_name = 'last'
    const avatar = 'sad'
    const age = 10
    const gender = 1
    const location = 'VN - hcm'
    const desc = 'sdasd'
    const note = 'asdasd'
    const url = 'http://google.com'
    const status = 1

    if (!_self.hasClass('loading')) {
      $.ajax({
        type: 'post',
        dataType: 'json',
        url: '/wp-admin/admin-ajax.php',
        data: {
          'action': 'add_item_x',
          'email': email,
          'phone': phone,
          'first_name': first_name,
          'last_name': last_name,
          'avatar': avatar,
          'age': age,
          'gender': gender,
          'location': location,
          'desc': desc,
          'note': note,
          'url': url,
          'status': status,
        },
        context: this,
        beforeSend: function () {
          _self.addClass('loading')
        },
        success: function (response) {
          _self.removeClass('loading')

          if (response.success) {
            console.log(response.data)
          }
          else {
            console.log('Đã có lỗi xảy ra')
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.log('The following error occured: ' + textStatus, errorThrown);
        }
      })
    }

  })
})