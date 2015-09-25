<?php 
        
//Vars

$page_for_posts = get_option( 'page_for_posts' );  
$postid = get_the_ID();

$item_id = (is_blog()) ? $page_for_posts : $postid;

$first_block_background_color = (get_sub_field('first_block_background_color', $item_id)) ? 'background-color: ' . get_sub_field('first_block_background_color', $item_id) . '; ' : '';
$first_block_text_color = (get_sub_field('first_block_text_color', $item_id)) ? 'color: ' . get_sub_field('first_block_text_color', $item_id) . '; ' : '';
$block_background_color = (get_sub_field('block_background_color', $item_id)) ? 'background-color: ' . get_sub_field('block_background_color', $item_id) . '; ' : '';
$block_text_color = (get_sub_field('block_text_color', $item_id)) ?  'color: ' . get_sub_field('block_text_color', $item_id) . '; ' : '';
$first_block_intro_text = (get_sub_field('first_block_intro_text', $item_id)) ? get_sub_field('first_block_intro_text', $item_id) : '';
$extra_class = (get_sub_field('extra_class', $item_id)) ? get_sub_field('extra_class', $item_id) : '';

$first_block_styles = 'style="' . $first_block_background_color . $first_block_text_color . '"';
$block_styles = 'style="' . $block_background_color . $block_text_color . '"';

?>

<?php

$args1 = array (
  'post_type' => array( 'position' ),
);

$query1 = new WP_Query( $args1 );

if ( $query1->have_posts() ) : ?>
  <div class="positions">
    <div class="position-block">
      <div class="position-block-inner" <?php echo $first_block_styles; ?>>
        <h2><?php echo $first_block_intro_text; ?></h2>
      </div>
    </div>
    <?php while ( $query1->have_posts() ) : $query1->the_post(); ?>
      <?php
        $description = get_field('description');
      ?>
      <a href="<?php the_permalink(); ?>" class="position-block">
      <div class="position-block-inner <?php echo $extra_class; ?>" <?php echo $block_styles; ?>>
        <h3><?php the_title(); ?></h3>
        <div class="job-description">
          <?php echo $description; ?>
        </div>
      </div>
      </a>
    <?php endwhile; ?>
  </div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>