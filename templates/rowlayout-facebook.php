<?php 
$page_for_posts = get_option( 'page_for_posts' );  
$postid = get_the_ID();

$item_id = (is_blog()) ? $page_for_posts : $postid;
$facebook_posts = get_sub_field('facebook_posts', $item_id);
$custom_class = get_sub_field('custom_class', $item_id);

?>
<div class="facebook-wrapper <?php echo $custom_class; ?>">
<?php echo do_shortcode('[custom-facebook-feed num=' . $facebook_posts . ']'); ?>
<i class="social-grid-icon fa fa-facebook"></i>
</div>