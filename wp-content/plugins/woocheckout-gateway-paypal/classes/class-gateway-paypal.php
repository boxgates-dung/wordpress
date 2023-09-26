<?php
if (!defined('ABSPATH')) {
  exit;
}

/**
 * Class that handles P24 payment method.
 *
 * @extends WC_Gateway_Stripe
 *
 * @since 4.0.0
 */
class Gateway_Paypal extends WC_Payment_Gateway
{
  public $id;
  public $icon;
  public $has_fields;
  public $method_title;
  public $method_description;
  public $supports;
  public $title;
  public $description;
  public $enabled;
  public $testmode;
  public $private_key;
  public $publishable_key;

  /**
   * Class constructor, more about it in Step 3
   */
  public function __construct()
  {
    $this->id = 'woocheckout_paypal'; // payment gateway plugin ID
    $this->icon = ''; // URL of the icon that will be displayed on checkout page near your gateway name
    $this->has_fields = true; // in case you need a custom credit card form
    $this->method_title = __('Woocheckout Gateway Paypal');
    $this->method_description = __('Description Checkout payment gateway'); // will be displayed on the options page

    // gateways can support subscriptions, refunds, saved payment methods,
    // but in this tutorial we begin with simple payments
    $this->supports = array(
      'products'
    );

    // Method with all the options fields
    $this->init_form_fields();
    // Load the settings.
    $this->init_settings();

    $this->title            = $this->get_option('title');
    $this->description      = $this->get_option('description');
    $this->enabled          = $this->get_option('enabled');
    $this->testmode         = 'yes' === $this->get_option('testmode');
    $this->private_key      = $this->testmode ? $this->get_option('test_private_key') : $this->get_option('private_key');
    $this->publishable_key  = $this->testmode ? $this->get_option('test_publishable_key') : $this->get_option('publishable_key');

    // This action hook saves the settings
    add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));

    add_action('woocommerce_api_alabacha', array($this, 'webhook'));

    add_action('woocommerce_thankyou_' . $this->id, array($this, 'thankyou_page'));

    // Customer Emails.
    add_action('woocommerce_email_before_order_table', array($this, 'email_instructions'), 10, 3);

    // Enqueue scripts 
    add_action('wp_enqueue_scripts', [$this, 'payment_scripts']);
  }

  /**
   * Plugin options, we deal with it in Step 3 too
   */
  public function init_form_fields()
  {
    //Tự động sinh prefix đơn hàng cho website.
    $server_domain = $_SERVER['SERVER_NAME'];
    $shopname = preg_replace('#^.+://[^/]+#', '', $server_domain);
    $shopname = str_replace(".", "", $shopname);

    $this->form_fields = array(
      'enabled' => array(
        'title'       => 'Enable/Disable',
        'label'       => 'Enable Woocheckout Gateway',
        'type'        => 'checkbox',
        'description' => '',
        'default'     => 'no'
      ),
      'title' => array(
        'title'       => 'Title',
        'type'        => 'text',
        'description' => 'This controls the title which the user sees during checkout.',
        'default'     => 'Credit Card',
        'desc_tip'    => true,
      ),
      'description' => array(
        'title'       => 'Description',
        'type'        => 'textarea',
        'description' => 'This controls the description which the user sees during checkout.',
        'default'     => 'Pay with your credit card via our super-cool payment gateway.',
      ),
      'testmode' => array(
        'title'       => 'Test mode',
        'label'       => 'Enable Test Mode',
        'type'        => 'checkbox',
        'description' => 'Place the payment gateway in test mode using test API keys.',
        'default'     => 'yes',
        'desc_tip'    => true,
      ),
      'test_publishable_key' => array(
        'title'       => 'Test Publishable Key',
        'type'        => 'text'
      ),
      'test_private_key' => array(
        'title'       => 'Test Private Key',
        'type'        => 'password',
      ),
      'publishable_key' => array(
        'title'       => 'Live Publishable Key',
        'type'        => 'text'
      ),
      'private_key' => array(
        'title'       => 'Live Private Key',
        'type'        => 'password'
      )
    );
  }

  /**
   * You will need it if you want your custom credit card form, Step 4 is about it
   */
  public function payment_fields()
  {
    // // ok, let's display some description before the payment form
    // if ($this->description) {
    //   // you can instructions for test mode, I mean test card numbers etc.
    //   if ($this->testmode) {
    //     $this->description .= ' TEST MODE ENABLED. In test mode, you can use the card numbers listed in <a href="#">documentation</a>.';
    //     $this->description  = trim($this->description);
    //   }
    //   // display the description with <p> tags etc.
    //   echo wpautop(wp_kses_post($this->description));
    // }

    // // I will echo() the form, but you can close PHP tags and print it directly in HTML
    // echo '<fieldset id="wc-' . esc_attr($this->id) . '-cc-form" class="wc-credit-card-form wc-payment-form" style="background:transparent;">';

    // // Add this action hook if you want your custom payment gateway to support it
    // do_action('woocommerce_credit_card_form_start', $this->id);

    // // I recommend to use inique IDs, because other gateways could already use #ccNo, #expdate, #cvc
    // echo '<div class="form-row form-row-wide"><label>Card Number ssss<span class="required">*</span></label>
    // <input id="misha_ccNo" type="text" autocomplete="off">
    // </div>
    // <div class="form-row form-row-first">
    // 	<label>Expiry Date <span class="required">*</span></label>
    // 	<input id="misha_expdate" type="text" autocomplete="off" placeholder="MM / YY">
    // </div>
    // <div class="form-row form-row-last">
    // 	<label>Card Code (CVC) <span class="required">*</span></label>
    // 	<input id="misha_cvv" type="password" autocomplete="off" placeholder="CVC">
    // </div>
    // <div class="clear"></div>';

    // do_action('woocommerce_credit_card_form_end', $this->id);

    // echo '<div class="clear"></div></fieldset>';


    $endpoint = 'http://localhost:3000/';

    $body = [
      'name'  => 'Pixelbart',
      'email' => 'pixelbart@example.com',
    ];

    $body = wp_json_encode($body);

    $options = [
      'method'      => 'POST',
      'body'        => $body,
      'headers'     => [
        'Content-Type' => 'application/json',
      ],
      'timeout'     => 60,
      'redirection' => 5,
      'blocking'    => true,
      'httpversion' => '1.0',
      'sslverify'   => false,
      'data_format' => 'body',
    ];

    $response = wp_remote_post($endpoint, $options);

    if (!is_wp_error($response)) {
      $body = json_decode(wp_remote_retrieve_body($response), true);
      print_r($body);
      // return $body;
    } else {
      $error_message = $response->get_error_message();
      throw new Exception($error_message);
    }
?>
  

<?php

    echo "
      <script>
      jQuery(document).ready(function($) {
        if ($('#payment_method_" . $this->id . "').is(':checked')) {
          show_btn_checkout($('#payment_method_" . $this->id . "'));
        }

        $('.wc_payment_methods .input-radio').click(function() {
          show_btn_checkout($(this));
        })

        function show_btn_checkout(ele) {
          if (ele.is('#payment_method_" . $this->id . "')) {
            const checkout_btn = $('#place_order').clone(true).css('background-color', '#ffc439').attr('id', 'place_order_with_paypal')
            checkout_btn.html(`<img style='height: calc(100% - 10px);' src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAxcHgiIGhlaWdodD0iMzIiIHZpZXdCb3g9IjAgMCAxMDEgMzIiIHByZXNlcnZlQXNwZWN0UmF0aW89InhNaW5ZTWluIG1lZXQiIHhtbG5zPSJodHRwOiYjeDJGOyYjeDJGO3d3dy53My5vcmcmI3gyRjsyMDAwJiN4MkY7c3ZnIj48cGF0aCBmaWxsPSIjMDAzMDg3IiBkPSJNIDEyLjIzNyAyLjggTCA0LjQzNyAyLjggQyAzLjkzNyAyLjggMy40MzcgMy4yIDMuMzM3IDMuNyBMIDAuMjM3IDIzLjcgQyAwLjEzNyAyNC4xIDAuNDM3IDI0LjQgMC44MzcgMjQuNCBMIDQuNTM3IDI0LjQgQyA1LjAzNyAyNC40IDUuNTM3IDI0IDUuNjM3IDIzLjUgTCA2LjQzNyAxOC4xIEMgNi41MzcgMTcuNiA2LjkzNyAxNy4yIDcuNTM3IDE3LjIgTCAxMC4wMzcgMTcuMiBDIDE1LjEzNyAxNy4yIDE4LjEzNyAxNC43IDE4LjkzNyA5LjggQyAxOS4yMzcgNy43IDE4LjkzNyA2IDE3LjkzNyA0LjggQyAxNi44MzcgMy41IDE0LjgzNyAyLjggMTIuMjM3IDIuOCBaIE0gMTMuMTM3IDEwLjEgQyAxMi43MzcgMTIuOSAxMC41MzcgMTIuOSA4LjUzNyAxMi45IEwgNy4zMzcgMTIuOSBMIDguMTM3IDcuNyBDIDguMTM3IDcuNCA4LjQzNyA3LjIgOC43MzcgNy4yIEwgOS4yMzcgNy4yIEMgMTAuNjM3IDcuMiAxMS45MzcgNy4yIDEyLjYzNyA4IEMgMTMuMTM3IDguNCAxMy4zMzcgOS4xIDEzLjEzNyAxMC4xIFoiPjwvcGF0aD48cGF0aCBmaWxsPSIjMDAzMDg3IiBkPSJNIDM1LjQzNyAxMCBMIDMxLjczNyAxMCBDIDMxLjQzNyAxMCAzMS4xMzcgMTAuMiAzMS4xMzcgMTAuNSBMIDMwLjkzNyAxMS41IEwgMzAuNjM3IDExLjEgQyAyOS44MzcgOS45IDI4LjAzNyA5LjUgMjYuMjM3IDkuNSBDIDIyLjEzNyA5LjUgMTguNjM3IDEyLjYgMTcuOTM3IDE3IEMgMTcuNTM3IDE5LjIgMTguMDM3IDIxLjMgMTkuMzM3IDIyLjcgQyAyMC40MzcgMjQgMjIuMTM3IDI0LjYgMjQuMDM3IDI0LjYgQyAyNy4zMzcgMjQuNiAyOS4yMzcgMjIuNSAyOS4yMzcgMjIuNSBMIDI5LjAzNyAyMy41IEMgMjguOTM3IDIzLjkgMjkuMjM3IDI0LjMgMjkuNjM3IDI0LjMgTCAzMy4wMzcgMjQuMyBDIDMzLjUzNyAyNC4zIDM0LjAzNyAyMy45IDM0LjEzNyAyMy40IEwgMzYuMTM3IDEwLjYgQyAzNi4yMzcgMTAuNCAzNS44MzcgMTAgMzUuNDM3IDEwIFogTSAzMC4zMzcgMTcuMiBDIDI5LjkzNyAxOS4zIDI4LjMzNyAyMC44IDI2LjEzNyAyMC44IEMgMjUuMDM3IDIwLjggMjQuMjM3IDIwLjUgMjMuNjM3IDE5LjggQyAyMy4wMzcgMTkuMSAyMi44MzcgMTguMiAyMy4wMzcgMTcuMiBDIDIzLjMzNyAxNS4xIDI1LjEzNyAxMy42IDI3LjIzNyAxMy42IEMgMjguMzM3IDEzLjYgMjkuMTM3IDE0IDI5LjczNyAxNC42IEMgMzAuMjM3IDE1LjMgMzAuNDM3IDE2LjIgMzAuMzM3IDE3LjIgWiI+PC9wYXRoPjxwYXRoIGZpbGw9IiMwMDMwODciIGQ9Ik0gNTUuMzM3IDEwIEwgNTEuNjM3IDEwIEMgNTEuMjM3IDEwIDUwLjkzNyAxMC4yIDUwLjczNyAxMC41IEwgNDUuNTM3IDE4LjEgTCA0My4zMzcgMTAuOCBDIDQzLjIzNyAxMC4zIDQyLjczNyAxMCA0Mi4zMzcgMTAgTCAzOC42MzcgMTAgQyAzOC4yMzcgMTAgMzcuODM3IDEwLjQgMzguMDM3IDEwLjkgTCA0Mi4xMzcgMjMgTCAzOC4yMzcgMjguNCBDIDM3LjkzNyAyOC44IDM4LjIzNyAyOS40IDM4LjczNyAyOS40IEwgNDIuNDM3IDI5LjQgQyA0Mi44MzcgMjkuNCA0My4xMzcgMjkuMiA0My4zMzcgMjguOSBMIDU1LjgzNyAxMC45IEMgNTYuMTM3IDEwLjYgNTUuODM3IDEwIDU1LjMzNyAxMCBaIj48L3BhdGg+PHBhdGggZmlsbD0iIzAwOWNkZSIgZD0iTSA2Ny43MzcgMi44IEwgNTkuOTM3IDIuOCBDIDU5LjQzNyAyLjggNTguOTM3IDMuMiA1OC44MzcgMy43IEwgNTUuNzM3IDIzLjYgQyA1NS42MzcgMjQgNTUuOTM3IDI0LjMgNTYuMzM3IDI0LjMgTCA2MC4zMzcgMjQuMyBDIDYwLjczNyAyNC4zIDYxLjAzNyAyNCA2MS4wMzcgMjMuNyBMIDYxLjkzNyAxOCBDIDYyLjAzNyAxNy41IDYyLjQzNyAxNy4xIDYzLjAzNyAxNy4xIEwgNjUuNTM3IDE3LjEgQyA3MC42MzcgMTcuMSA3My42MzcgMTQuNiA3NC40MzcgOS43IEMgNzQuNzM3IDcuNiA3NC40MzcgNS45IDczLjQzNyA0LjcgQyA3Mi4yMzcgMy41IDcwLjMzNyAyLjggNjcuNzM3IDIuOCBaIE0gNjguNjM3IDEwLjEgQyA2OC4yMzcgMTIuOSA2Ni4wMzcgMTIuOSA2NC4wMzcgMTIuOSBMIDYyLjgzNyAxMi45IEwgNjMuNjM3IDcuNyBDIDYzLjYzNyA3LjQgNjMuOTM3IDcuMiA2NC4yMzcgNy4yIEwgNjQuNzM3IDcuMiBDIDY2LjEzNyA3LjIgNjcuNDM3IDcuMiA2OC4xMzcgOCBDIDY4LjYzNyA4LjQgNjguNzM3IDkuMSA2OC42MzcgMTAuMSBaIj48L3BhdGg+PHBhdGggZmlsbD0iIzAwOWNkZSIgZD0iTSA5MC45MzcgMTAgTCA4Ny4yMzcgMTAgQyA4Ni45MzcgMTAgODYuNjM3IDEwLjIgODYuNjM3IDEwLjUgTCA4Ni40MzcgMTEuNSBMIDg2LjEzNyAxMS4xIEMgODUuMzM3IDkuOSA4My41MzcgOS41IDgxLjczNyA5LjUgQyA3Ny42MzcgOS41IDc0LjEzNyAxMi42IDczLjQzNyAxNyBDIDczLjAzNyAxOS4yIDczLjUzNyAyMS4zIDc0LjgzNyAyMi43IEMgNzUuOTM3IDI0IDc3LjYzNyAyNC42IDc5LjUzNyAyNC42IEMgODIuODM3IDI0LjYgODQuNzM3IDIyLjUgODQuNzM3IDIyLjUgTCA4NC41MzcgMjMuNSBDIDg0LjQzNyAyMy45IDg0LjczNyAyNC4zIDg1LjEzNyAyNC4zIEwgODguNTM3IDI0LjMgQyA4OS4wMzcgMjQuMyA4OS41MzcgMjMuOSA4OS42MzcgMjMuNCBMIDkxLjYzNyAxMC42IEMgOTEuNjM3IDEwLjQgOTEuMzM3IDEwIDkwLjkzNyAxMCBaIE0gODUuNzM3IDE3LjIgQyA4NS4zMzcgMTkuMyA4My43MzcgMjAuOCA4MS41MzcgMjAuOCBDIDgwLjQzNyAyMC44IDc5LjYzNyAyMC41IDc5LjAzNyAxOS44IEMgNzguNDM3IDE5LjEgNzguMjM3IDE4LjIgNzguNDM3IDE3LjIgQyA3OC43MzcgMTUuMSA4MC41MzcgMTMuNiA4Mi42MzcgMTMuNiBDIDgzLjczNyAxMy42IDg0LjUzNyAxNCA4NS4xMzcgMTQuNiBDIDg1LjczNyAxNS4zIDg1LjkzNyAxNi4yIDg1LjczNyAxNy4yIFoiPjwvcGF0aD48cGF0aCBmaWxsPSIjMDA5Y2RlIiBkPSJNIDk1LjMzNyAzLjMgTCA5Mi4xMzcgMjMuNiBDIDkyLjAzNyAyNCA5Mi4zMzcgMjQuMyA5Mi43MzcgMjQuMyBMIDk1LjkzNyAyNC4zIEMgOTYuNDM3IDI0LjMgOTYuOTM3IDIzLjkgOTcuMDM3IDIzLjQgTCAxMDAuMjM3IDMuNSBDIDEwMC4zMzcgMy4xIDEwMC4wMzcgMi44IDk5LjYzNyAyLjggTCA5Ni4wMzcgMi44IEMgOTUuNjM3IDIuOCA5NS40MzcgMyA5NS4zMzcgMy4zIFoiPjwvcGF0aD48L3N2Zz4'>`)
            $('#place_order').after(`<iframe src='http://localhost:8888/' frameborder='0' style='width: 100%; min-height: 180px'></iframe>`)
            $('#place_order').hide()
          } else {
            $('#place_order').show()
            $('#place_order_with_paypal').remove()
            $('iframe').remove()
          }
        }        
      })
      </script>
    ";

?>
    
<?php
  }

  /*
  * Custom CSS and JS, in most cases required only when you decided to go with a custom credit card form
  */
  public function payment_scripts()
  {
    // we need JavaScript to process a token only on cart/checkout pages, right?
    if (!is_cart() && !is_checkout()) {
      return;
    }

    wp_register_style('woocheckout-gateway-paypal-css', WOOCHECKOUT_GATEWAY_PAYPAL_PLUGIN_URI . '/assets/css/front-end-style.css');
    wp_enqueue_style('woocheckout-gateway-paypal-css');

    wp_register_script('woocheckout-gateway-paypal-js', WOOCHECKOUT_GATEWAY_PAYPAL_PLUGIN_URI  . '/assets/js/front-end-script.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('woocheckout-gateway-paypal-js');
  }

  public function admin_scripts()
  {
  }

  /*
   * Fields validation, more in Step 5
  */
  public function validate_fields()
  {
    if (empty($_POST['billing_first_name'])) {
      wc_add_notice('First name is required!', 'error');
      return false;
    }
    return true;
  }

  /*
  * We're processing the payments here, everything about it is in Step 5
  */
  public function process_payment($order_id)
  {

    global $woocommerce;

    // we need it to get any order detailes
    $order = wc_get_order($order_id);


    /*
 	 * Array with parameters for API interaction
	 */
    $args = array();

    /*
	 * Your API interaction could be built with wp_remote_post()
 	 */
    // $response = wp_remote_post('{payment processor endpoint}', $args);


    // if (!is_wp_error($response)) {

    //   $body = json_decode($response['body'], true);

    //   // it could be different depending on your payment processor
    //   if ($body['response']['responseCode'] == 'APPROVED') {

    //     // we received the payment
    //     $order->payment_complete();
    //     $order->reduce_order_stock();

    //     // some notes to customer (replace true with false to make it private)
    //     $order->add_order_note('Hey, your order is paid! Thank you!', true);

    //     // Empty cart
    //     $woocommerce->cart->empty_cart();

    //     // Redirect to the thank you page
    //     return array(
    //       'result' => 'success',
    //       'redirect' => $this->get_return_url($order)
    //     );
    //   } else {
    //     wc_add_notice('Please try again.', 'error');
    //     return;
    //   }
    // } else {
    //   wc_add_notice('Connection error sfdfdfdfd.', 'error');
    //   return;
    // }


    // ============================================================================ //
    // $order = wc_get_order($order_id);

    // if ($order->get_total() > 0) {
    //   // Mark as on-hold (we're awaiting the payment).
    //   $order->update_status(apply_filters('woocommerce_' . $this->id . '_process_payment_order_status', 'on-hold', $order), __('Awaiting BACS payment', 'woocommerce'));
    // } else {
    //   $order->payment_complete();
    // }

    // // Remove cart.
    // WC()->cart->empty_cart();

    // // Return thankyou redirect.
    // return array(
    //   'result'   => 'success',
    //   'redirect' => $this->get_return_url($order),
    // );

    echo '<script>
  console.log("==============frooooooooooooooooooooooooo eeeeeeeeeeeeeeeeeeeeeee nnnnnnnnnnnnnnn"==============)
    
    </script>';

    return;
  }

  /*
  * In case you need a webhook, like PayPal IPN etc
  */
  public function webhook()
  {
    $order = wc_get_order($_GET['id']);
    $order->payment_complete();
    $order->reduce_order_stock();

    update_option('webhook_debug', $_GET);
  }

  /**
   * Output for the order received page.
   *
   * @param int $order_id Order ID.
   */
  public function thankyou_page($order_id)
  {
    $this->payment_details($order_id);
  }

  /**
   * Add content to the WC emails.
   *
   * @param WC_Order $order Order object.
   * @param bool     $sent_to_admin Sent to admin.
   * @param bool     $plain_text Email format: plain text or HTML.
   */
  public function email_instructions($order, $sent_to_admin, $plain_text = false)
  {
    // if (!$sent_to_admin && 'vnpg' === $order->get_payment_method() && $order->has_status('on-hold')) {
    $this->payment_details($order->get_id());
    // }
  }

  private function payment_details($order_id)
  {

    // Get order and store in $order.
    $order = wc_get_order($order_id);

    $html  = '<h3>Thông tin thanh toán</h3>';
    $html .= '<div>Bạn vui lòng chuyển khoản theo thông tin dưới đây</div>';
    $html .= '<ul>';
    $html .= '<li class="order-amount">Số tiền: ' . $order->get_total() . '</li>';
    $html .= '<li class="bank-name">Ngân hàng: </li>';
    $html .= '<li class="account-number">Số tài khoản: </li>';
    $html .= '<li class="account-name">Chủ tài khoản: </li>';
    $html .= '<li class="prefix">Nội dung: </li>';
    $html .= '</ul>';

    echo $html;
  }
}
