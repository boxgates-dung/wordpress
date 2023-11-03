<div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasRecentlyViewed" aria-labelledby="offcanvasRecentlyViewedLabel">
  <div class="offcanvas-body">

    <?php
    // $cookie_name = "product_recently_viewed";

    // if (!isset($_COOKIE[$cookie_name])) {
    //   echo "Cookie named '" . $cookie_name . "' is not set!";
    //   print_r($cookie_name);
    // } else {
    //   echo "Cookie '" . $cookie_name . "' is set!<br>";
    //   // echo "Value is: " . $_COOKIE[$cookie_name];

    //   print_r($_COOKIE[$cookie_name]);

    // }

    do_shortcode('[product_recently_viewed]');

    ?>    
  </div>
</div>