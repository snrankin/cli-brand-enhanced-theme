<?php 
  $page_for_posts = get_option( 'page_for_posts' );  
  $postid = get_the_ID();
  
  $item_id = (is_blog()) ? $page_for_posts : $postid;
  $custom_class = (get_sub_field('custom_class', $item_id)) ? ' ' . get_sub_field('custom_class', $item_id) : '';
  $instagram_user_id = get_sub_field('instagram_user_id', $item_id);
  $block_id = get_sub_field('block_id', $item_id);
  $access_token = get_sub_field('access_token', $item_id);
?>
        
<div class="instagram-wrapper"><div id="<?php echo $block_id; ?>" class="instagram-block <?php echo $custom_class; ?>"><i class="social-grid-icon cli-instagram-circle"></i></div></div> 
        
<script type="text/javascript">
  var userFeed = new Instafeed({
    target: '<?php echo $block_id; ?>',
    get: 'user',
    userId: <?php echo $instagram_user_id; ?>,
    accessToken: '<?php echo $access_token; ?>',
    template: '<a href="{{link}}" class="instagram-img" target="_blank" style="background-image: url({{image}});"></a>',
    resolution: 'standard_resolution',
    limit: 1,
  });
  userFeed.run();
</script>