import 'bootstrap'
import './helper'

export default () => {
  $(document).ready(function (){
    $('[data-toggle="modal"]').click(function () {
      $($(this).data('target')).modal('show')
    })

    $('[data-dismiss="modal"]').click(function () {
      $( '#' + $(this).parents('.modal').attr('id')).modal('hide')
    })

    // $('.dropdown').show()

  })
}
