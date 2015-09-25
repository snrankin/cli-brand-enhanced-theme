 <?php 
$page_for_posts = get_option( 'page_for_posts' );  
$postid = get_the_ID();

$item_id = (is_blog()) ? $page_for_posts : $postid;
 
$blog_posts = get_sub_field('blog_posts', $item_id);
$post_offset = get_sub_field('post_offset', $item_id);
$custom_class = get_sub_field('custom_class', $item_id);
 ?>
        
<?php $args = array ('posts_per_page' => $blog_posts, 'offset' => $post_offset,); $query = new WP_Query( $args ); if ( $query->have_posts() ) : ?>
  <div class="blog-feed-wrapper <?php echo $custom_class; ?>">
  <?php while ( $query->have_posts() ) : $query->the_post(); ?>
    <?php get_template_part('templates/post-block-small'); ?>
  <?php endwhile; ?>
  </div>
<?php endif; ?>

<?php wp_reset_postdata(); ?>