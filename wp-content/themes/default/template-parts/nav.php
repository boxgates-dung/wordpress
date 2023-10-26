<div class="mobile-top-nav d-lg-none position-fixed top-0 start-0 w-100">
  <div class="position-relative h-100 w-100">
    <div class="row align-items-center">
      <!-- Nav btn hambuger -->
      <div class="w-auto">
        <span class="btn-nav-mobile" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMobileSidebar">
          <span></span>
        </span>
      </div>
      <!-- End btn hambuger  -->

      <!-- Middle mobile nav -->
      <div class="w-auto flex-fill text-center">
        <div class="mobile-nav-middle w-100">
          <div class="mobile-logo w-auto flex-fill text-center">
            <?php if (get_custom_logo()) { ?>
              <?php echo get_custom_logo(); ?>
            <?php } else { ?>
              <a href="<?php echo esc_url(home_url('/')); ?>" class="custom-logo-link">
                <span>
                  <?php echo get_bloginfo('name'); ?>
                </span>
              </a>
            <?php } ?>
          </div>

          <div class="search-form-mobile">
            <form role="search" method="get" action="#" class="position-relative">
              <input type="text" placeholder="Search..." name="s" class="search-field">
              <button type="submit" class="search-submit position-absolute text-white top-0 end-0 p-0 shadow-none border-0 bg-transparent">
                <svg class="svgSearch styler-svg-icon" width="30" height="30" fill="currentColor" viewBox="0 0 48 48" enable-background="new 0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                  <g>
                    <path d="m40.2850342 37.4604492-6.4862061-6.4862061c1.9657593-2.5733643 3.0438843-5.6947021 3.0443115-8.9884033 0-3.9692383-1.5458984-7.7011719-4.3530273-10.5078125-2.8066406-2.8066406-6.5380859-4.3525391-10.5078125-4.3525391-3.9692383 0-7.7011719 1.5458984-10.5078125 4.3525391-5.7939453 5.7944336-5.7939453 15.222168 0 21.015625 2.8066406 2.8071289 6.5385742 4.3530273 10.5078125 4.3530273 3.2937012-.0004272 6.4150391-1.0785522 8.9884033-3.0443115l6.4862061 6.4862061c.3901367.390625.9023438.5859375 1.4140625.5859375s1.0239258-.1953125 1.4140625-.5859375c.78125-.7807617.78125-2.0473633 0-2.828125zm-25.9824219-7.7949219c-4.234375-4.234375-4.2338867-11.1245117 0-15.359375 2.0512695-2.0507813 4.7788086-3.1806641 7.6796875-3.1806641 2.9013672 0 5.628418 1.1298828 7.6796875 3.1806641 2.0512695 2.0512695 3.1811523 4.7788086 3.1811523 7.6796875 0 2.9013672-1.1298828 5.628418-3.1811523 7.6796875s-4.7783203 3.1811523-7.6796875 3.1811523c-2.9008789.0000001-5.628418-1.1298827-7.6796875-3.1811523z"></path>
                  </g>
                </svg>
              </button>
            </form>
          </div>
        </div>
      </div>
      <!-- End middle mobile nav -->

      <!-- Btn mobile search -->
      <div class="w-auto">
        <span class="btn-icon-search-mobile d-block">
          <svg class="svgSearch styler-svg-icon" width="30" height="30" fill="currentColor" viewBox="0 0 48 48" enable-background="new 0 0 48 48" xmlns="http://www.w3.org/2000/svg">
            <g>
              <path d="m40.2850342 37.4604492-6.4862061-6.4862061c1.9657593-2.5733643 3.0438843-5.6947021 3.0443115-8.9884033 0-3.9692383-1.5458984-7.7011719-4.3530273-10.5078125-2.8066406-2.8066406-6.5380859-4.3525391-10.5078125-4.3525391-3.9692383 0-7.7011719 1.5458984-10.5078125 4.3525391-5.7939453 5.7944336-5.7939453 15.222168 0 21.015625 2.8066406 2.8071289 6.5385742 4.3530273 10.5078125 4.3530273 3.2937012-.0004272 6.4150391-1.0785522 8.9884033-3.0443115l6.4862061 6.4862061c.3901367.390625.9023438.5859375 1.4140625.5859375s1.0239258-.1953125 1.4140625-.5859375c.78125-.7807617.78125-2.0473633 0-2.828125zm-25.9824219-7.7949219c-4.234375-4.234375-4.2338867-11.1245117 0-15.359375 2.0512695-2.0507813 4.7788086-3.1806641 7.6796875-3.1806641 2.9013672 0 5.628418 1.1298828 7.6796875 3.1806641 2.0512695 2.0512695 3.1811523 4.7788086 3.1811523 7.6796875 0 2.9013672-1.1298828 5.628418-3.1811523 7.6796875s-4.7783203 3.1811523-7.6796875 3.1811523c-2.9008789.0000001-5.628418-1.1298827-7.6796875-3.1811523z"></path>
            </g>
          </svg>
        </span>
      </div>
      <!-- End btn mobile search -->
    </div>
  </div>
</div>