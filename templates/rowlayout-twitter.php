<?php 
  $page_for_posts = get_option( 'page_for_posts' );  
  $postid = get_the_ID();
  
  $item_id = (is_blog()) ? $page_for_posts : $postid;
  
  $is_slider = get_sub_field('is_slider', $item_id);
  $custom_class = get_sub_field('custom_class', $item_id);
 ?>
<div class="twitter-feed-wrapper <?php echo $custom_class; ?>">
<div class="twitter-feed<?php if ($is_slider == 1) { echo ' twitter-slider'; }?>">
  <?php $twitter_posts = get_sub_field('twitter_posts', $item_id); echo do_shortcode('[timeline-twitter-feed]'); ?>
</div>
<?php if($is_slider == 1){ ?>
  <div class="slider-nav">
    <div class="slider-prev"></div> 
    <div class="slider-next"></div>
  </div>
<?php } ?>

<i class="social-grid-icon cli-twitter-circle"></i>
</div>