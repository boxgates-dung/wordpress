<?php if (!is_user_logged_in()) { ?>
  <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content rounded-0">
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
          <i class="tb-icon tb-icon-close-01"></i>
        </button>

        <div class="modal-body p-0">
          <!-- Form login -->
          <?php do_action('woocommerce_before_customer_login_form'); ?>

          <h2 class="form-title"><?php esc_html_e('Sign in', 'woocommerce'); ?></h2>

          <form class="woocommerce-form woocommerce-form-login login" method="post">

            <?php do_action('woocommerce_login_form_start'); ?>

            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
              <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" placeholder="Username or email address" value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" />
            </p>
            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
              <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" placeholder="Password" />
            </p>

            <?php do_action('woocommerce_login_form'); ?>

            <div class="login-form-footer">
              <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
                <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e('Remember me', 'woocommerce'); ?></span>
              </label>

              <a href="<?php echo esc_url(wp_lostpassword_url()); ?>" class="woocommerce-LostPassword lost_password"><?php esc_html_e('Lost password?', 'woocommerce'); ?></a>
            </div>

            <p class="form-row">
              <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
              <button type="submit" class="woocommerce-button button woocommerce-form-login__submit<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>" name="login" value="<?php esc_attr_e('Log in', 'woocommerce'); ?>"><?php esc_html_e('Log in', 'woocommerce'); ?></button>
            </p>

            <p class="form-row mb-0">
              <a href="#" class="button create-account-button"><?php esc_html_e('Create an account', 'woocommerce'); ?></a>
            </p>

            <?php do_action('woocommerce_login_form_end'); ?>

          </form>

          <?php do_action('woocommerce_after_customer_login_form'); ?>
          <!-- End form login -->
        </div>

      </div>
    </div>
  </div>
<?php } ?>