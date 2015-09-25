<?php 

$page_for_posts = get_option( 'page_for_posts' );  
$postid = get_the_ID();

$item_id = (is_blog()) ? $page_for_posts : $postid;

$custom_class = (get_sub_field('custom_class', $item_id)) ? ' ' . get_sub_field('custom_class', $item_id) : '';?>
<div class="text-block<?php echo $custom_class; ?>">
  <?php the_sub_field('column_text', $item_id); ?>
</div>