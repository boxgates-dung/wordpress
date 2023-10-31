<?php if (!is_user_logged_in() && class_exists('WooCommerce')) { ?>
  <?php if (!is_account_page()) { ?>
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content rounded-0">
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
            <i class="tb-icon tb-icon-close-01"></i>
          </button>
          <div class="modal-body p-0">
            <!-- Form login -->
            <?php do_action('latoya_form_login'); ?>
            <!-- End form login -->
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
<?php } ?>