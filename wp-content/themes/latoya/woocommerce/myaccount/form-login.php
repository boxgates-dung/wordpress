<?php

/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}

do_action('woocommerce_before_customer_login_form'); ?>

<div class="latoya-auth-form">
  <?php if ('yes' === get_option('woocommerce_enable_myaccount_registration')) : ?>

    <div class="u-columns col2-set position-relative" id="customer_login">

      <div class="u-column1 latoya-login-form">

      <?php endif; ?>

      <h2 class="form-title"><?php esc_html_e('Sign in', 'woocommerce'); ?></h2>

      <form class="woocommerce-form woocommerce-form-login login" method="post">

        <?php do_action('woocommerce_login_form_start'); ?>

        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
          <input type="text" class="woocommerce-Input woocommerce-Input--text input-text w-100" name="username" id="username" autocomplete="username" placeholder="<?php _e('Username or email address', 'woocommerce'); ?>" value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" /><?php // @codingStandardsIgnoreLine 
                                                                                                                                                                                                                                                                                                                                    ?>
        </p>
        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
          <input class="woocommerce-Input woocommerce-Input--text input-text w-100" type="password" name="password" id="password" autocomplete="current-password" placeholder="<?php _e('Password', 'woocommerce'); ?>" />
        </p>

        <?php do_action('woocommerce_login_form'); ?>

        <div class="login-form-footer d-flex align-items-center justify-content-between">
          <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
            <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e('Remember me', 'woocommerce'); ?></span>
          </label>

          <a href="<?php echo esc_url(wp_lostpassword_url()); ?>" class="woocommerce-LostPassword lost_password"><?php esc_html_e('Lost password?', 'woocommerce'); ?></a>
        </div>

        <p class="form-row">
          <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
          <button type="submit" class="woocommerce-button button w-100 woocommerce-form-login__submit<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>" name="login" value="<?php esc_attr_e('Log in', 'woocommerce'); ?>"><?php esc_html_e('Log in', 'woocommerce'); ?></button>
        </p>

        <?php if ('yes' === get_option('woocommerce_enable_myaccount_registration')) : ?>
          <p class="form-row text-center mb-0">
            <?php esc_html_e('Not a member?', 'woocommerce'); ?>
            <a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>" class="w-100 highlight create-account-button"><?php esc_html_e('Create an account', 'woocommerce'); ?></a>
          </p>
        <?php endif; ?>

        <?php do_action('woocommerce_login_form_end'); ?>

      </form>

      <?php if ('yes' === get_option('woocommerce_enable_myaccount_registration')) : ?>

      </div>

      <div class="u-column2 latoya-register-form">

        <h2 class="form-title"><?php esc_html_e('Register', 'woocommerce'); ?></h2>

        <form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action('woocommerce_register_form_tag'); ?>>

          <?php do_action('woocommerce_register_form_start'); ?>

          <?php if ('no' === get_option('woocommerce_registration_generate_username')) : ?>

            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
              <!-- <label for="reg_username"><?php esc_html_e('Username', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label> -->
              <input type="text" class="woocommerce-Input woocommerce-Input--text input-text w-100" name="username" placeholder="<?php _e('Username', 'woocommerce'); ?>" id="reg_username" autocomplete="username" value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" /><?php // @codingStandardsIgnoreLine 
                                                                                                                                                                                                                                                                                                                          ?>
            </p>

          <?php endif; ?>

          <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <!-- <label for="reg_email"><?php esc_html_e('Email address', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label> -->
            <input type="email" class="woocommerce-Input woocommerce-Input--text input-text w-100" name="email" placeholder="<?php _e('Email', 'woocommerce'); ?>" id="reg_email" autocomplete="email" value="<?php echo (!empty($_POST['email'])) ? esc_attr(wp_unslash($_POST['email'])) : ''; ?>" /><?php // @codingStandardsIgnoreLine 
                                                                                                                                                                                                                                                                                                        ?>
          </p>

          <?php if ('no' === get_option('woocommerce_registration_generate_password')) : ?>

            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
              <!-- <label for="reg_password"><?php esc_html_e('Password', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label> -->
              <input type="password" class="woocommerce-Input woocommerce-Input--text input-text w-100" name="password" placeholder="<?php _e('Password', 'woocommerce'); ?>" id="reg_password" autocomplete="new-password" />
            </p>

          <?php else : ?>

            <p><?php esc_html_e('A link to set a new password will be sent to your email address.', 'woocommerce'); ?></p>

          <?php endif; ?>

          <?php do_action('woocommerce_register_form'); ?>

          <p class="woocommerce-form-row form-row">
            <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
            <button type="submit" class="woocommerce-Button woocommerce-button w-100 button<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?> woocommerce-form-register__submit" name="register" value="<?php esc_attr_e('Register', 'woocommerce'); ?>"><?php esc_html_e('Register', 'woocommerce'); ?></button>
          </p>

          <p class="woocommerce-form-row form-row text-center mb-0">
            <?php esc_html_e('Already got an account?', 'woocommerce'); ?>
            <a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>" class="login-account-button"><?php esc_html_e('Sign in here', 'woocommerce'); ?></a>
          </p>

          <?php do_action('woocommerce_register_form_end'); ?>

        </form>

      </div>

    </div>
  <?php endif; ?>
</div>

<?php do_action('woocommerce_after_customer_login_form'); ?>