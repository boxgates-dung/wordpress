<div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasSearch" aria-labelledby="offcanvasSearchLabel">
  <div class="offcanvas-body">
    <div class="heading">
      <h5 id="offcanvasSearchLabel"><?php esc_html_e('Search', LATOYA_THEME_DOMAIN); ?></h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close">
        <i class="tb-icon tb-icon-close-01"></i>
      </button>
    </div>

    <div class="search-form-wrap mx-auto">
      <?php do_action('latoya_product_search_form'); ?>
    </div>
  </div>
</div>