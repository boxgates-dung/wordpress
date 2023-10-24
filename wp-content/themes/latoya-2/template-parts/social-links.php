<?php
global $product;
?>

<div class="social-links">
  <a class="share-facebook" title="<?php echo $product->get_title();?>" href="http://www.facebook.com/sharer.php?u=<?php echo $product->get_permalink();?>&amp;t=<?php echo $product->get_title();?>" target="_blank">
    <i class="fa-brands fa-facebook-f"></i>
  </a>
  <a class="share-twitter" href="http://twitter.com/share?text=<?php echo $product->get_title();?>&amp;url=<?php echo $product->get_permalink();?>" title="<?php echo $product->get_title();?>" target="_blank">
    <i class="fa-brands fa-twitter"></i>
  </a>
  <a class="share-linkedin" href="http://www.linkedin.com/shareArticle?url=<?php echo $product->get_permalink();?>&amp;title=<?php echo $product->get_title();?>" title="<?php echo $product->get_title();?>" target="_blank">
    <i class="fa-brands fa-linkedin-in"></i>
  </a>
  <a class="share-email" href="mailto:?subject=<?php echo $product->get_title();?>&amp;body=<?php echo $product->get_permalink();?>" title="<?php echo $product->get_title();?>" target="_blank">
    <i class="fa-regular fa-envelope"></i>
  </a>
</div>

<div class="protect mt-5">
  <div class="protect-wrap">
    <span class="button-content-wrapper">
      <span class="button-text">Guaranteed Safe Checkout</span>
    </span>

    <img src="https://el4.thembaydev.com/fana_bikini/wp-content/uploads/2022/03/safe-checkout.png" class="attachment-full" alt="protect">
  </div>
</div>