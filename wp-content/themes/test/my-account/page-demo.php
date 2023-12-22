<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="<?php echo THEME_URL . "/assets/public/css/vendors.css"; ?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

  <!-- <link rel="stylesheet" href="//avon-demo.myshopify.com/cdn/shop/t/169/assets/theme.css?v=138044047921281506061697549192" type="text/css" media="all"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="<?php echo THEME_URL . "/assets/public/js/app.min.js"; ?>"></script>
</head>

<body class="woocommerce-accountx">

  <div class="container">
    <div class="row my-account-row">
      <div class="col-md-3">
        <?php do_action('woocommerce_account_navigation'); ?>
      </div>

      <div class="woocommerce-MyAccount-content col-md-9">
        <?php
        /**
         * My Account content.
         *
         * @since 2.6.0
         */
        do_action('woocommerce_account_content');
        ?>
      </div>
    </div>
  </div>

  <!-- User auth -->
  <div class="container d-none">
    <?php do_action('woocommerce_before_customer_login_form'); ?>

    <div class="user-auth">
      <!-- Login form -->
      <div class="login-form">

        <h2><?php esc_html_e('Login', 'woocommerce'); ?></h2>

        <form class="woocommerce-form woocommerce-form-login login" method="post">

          <?php do_action('woocommerce_login_form_start'); ?>

          <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" placeholder="Username or email address" />
          </p>
          <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" placeholder="Password" />
          </p>

          <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <span class="d-flex align-items-center justify-content-between">
              <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
                <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e('Remember me', 'woocommerce'); ?></span>
              </label>

              <span class="woocommerce-LostPassword lost_password">
                <a href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php esc_html_e('Forgot Password?', 'woocommerce'); ?></a>
              </span>
            </span>
          </p>

          <?php do_action('woocommerce_login_form'); ?>

          <p class="form-row">
            <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
            <button type="submit" class="woocommerce-button button woocommerce-form-login__submit<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>" name="login" value="<?php esc_attr_e('Log in', 'woocommerce'); ?>"><?php esc_html_e('Log in', 'woocommerce'); ?></button>
          </p>

          <?php do_action('woocommerce_login_form_end'); ?>

        </form>

        <!-- Switch form -->
        <?php if ('yes' === get_option('woocommerce_enable_myaccount_registration')) : ?>
          <p class="auth-switch-form">
            <?php esc_html_e('Not a member?', 'woocommerce') ?>
            <a class="switch-register" href="javascript:void(0);" rel="nofollow"> <?php esc_html_e('Create an account', 'woocommerce') ?> </a>
          </p>
        <?php endif; ?>
        <!-- End switch form -->
      </div>
      <!-- End login form -->

      <?php if (get_option('woocommerce_enable_myaccount_registration')) : ?>
        <!-- Register form -->
        <div class="register-form">

          <h2><?php esc_html_e('Register', 'woocommerce'); ?></h2>

          <form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action('woocommerce_register_form_tag'); ?>>
            <?php do_action('woocommerce_register_form_start'); ?>

            <?php if ('no' === get_option('woocommerce_registration_generate_username')) : ?>
              <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" placeholder="User name" />
              </p>
            <?php endif; ?>

            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
              <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo (!empty($_POST['email'])) ? esc_attr(wp_unslash($_POST['email'])) : ''; ?>" placeholder="Email" />
            </p>

            <?php if ('no' === get_option('woocommerce_registration_generate_password')) : ?>
              <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" placeholder="Password" />
              </p>
            <?php else : ?>
              <p><?php esc_html_e('A link to set a new password will be sent to your email address.', 'woocommerce'); ?></p>
            <?php endif; ?>

            <?php do_action('woocommerce_register_form'); ?>

            <p class="woocommerce-form-row form-row">
              <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
              <button type="submit" class="woocommerce-Button woocommerce-button button<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?> woocommerce-form-register__submit" name="register" value="<?php esc_attr_e('Register', 'woocommerce'); ?>"><?php esc_html_e('Register', 'woocommerce'); ?></button>
            </p>

            <?php do_action('woocommerce_register_form_end'); ?>
          </form>

          <!-- Switch form -->
          <p class="auth-switch-form">
            <?php esc_html_e('Already got an account?', 'woocommerce') ?>
            <a class="switch-login" href="javascript:void(0);" rel="nofollow"> <?php esc_html_e('Sign in here', 'woocommerce') ?> </a>
          </p>
          <!-- End switch form -->
        </div>
        <!-- End register form -->
      <?php endif; ?>
    </div>

    <?php do_action('woocommerce_after_customer_login_form'); ?>
  </div>
  <!-- End user auth -->

  <script>
    jQuery(document).ready(function() {

      $('.switch-register, .switch-login').click(function() {
        $('.user-auth').toggleClass('active')
      })

    })
  </script>
</body>

</html>