jQuery(document).ready(function ($) {
  $('#add_new_subcriber').click(function () {
    console.log('heaweal;')
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

  /* Modal */
  $('.wpem-body').on('click', '.btn-wpem-modal', function () {
    $(`#${$(this).data('modal')}`).addClass('show')
    $('.wpem-body').append('<div class="wpem-backdrop show"></div>')
  })

  $('.wpem-body').on('click', '.wpem-btn-close-modal', function () {
    $(`#${$(this).data('modal')}`).removeClass('show')
    $('.wpem-backdrop').remove()
  })

  $('.wpem-body').on('click', '.wpem-backdrop', function () {
    $('.wpem-modal').removeClass('show')
    $('.wpem-backdrop').remove()
  })

  /* Submit */
  $('#add_new_cus').submit(function (e) {
    e.preventDefault()
    const _self = $(this)

    const values = {
      'action': 'add_new_subcriber',
    };
    $.each($(this).serializeArray(), function (i, field) {
      values[field.name] = field.value
    });

    if (!_self.hasClass('loading') && values.email) {
      $.ajax({
        type: 'post',
        dataType: 'json',
        url: '/wp-admin/admin-ajax.php',
        data: values,
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

  $('#add_new_cus').validate({
		onfocusout: false,
		onkeyup: false,
		onclick: false,
		rules: {
			'email': {
				required: true
			},
      'first_name': {
				required: true
			},
      'last_name': {
				required: true
			}
		}
	});

  $('.wpem-body').on('click', 'a.show-data', function () {
    console.log('jshssh')
    
    
  })

})