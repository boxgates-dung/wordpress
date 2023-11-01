<div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasRecentlyViewed" aria-labelledby="offcanvasRecentlyViewedLabel">
  <div class="offcanvas-body">

    <?php


    $cookie_name = "bgx_product_recently_viewed";

    if (!isset($_COOKIE[$cookie_name])) {
      echo "Cookie named '" . $cookie_name . "' is not set!";
      print_r($cookie_name);
    } else {
      echo "Cookie '" . $cookie_name . "' is set!<br>";
      echo "Value is: " . $_COOKIE[$cookie_name];

      print_r($_COOKIE[$cookie_name]);

    }
    ?>


    <ul class="list-recent">
      <?php for ($i = 0; $i < 10; $i++) { ?>
        <li class="product-item">
          <a title="Cotton Parka with Faux" href="#" class="product-image">
            <img src="https://el4.thembaydev.com/fana/wp-content/uploads/2022/01/product-21-480x638.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail lazyloaded" alt="" decoding="async" fetchpriority="high" data-ll-status="loaded">
          </a>
        </li>
      <?php } ?>
    </ul>
  </div>
</div>