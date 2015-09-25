<nav id="nav-below" class="navigation" role="navigation">
<?php
$next_post = get_next_post();
if ( is_a( $next_post , 'WP_Post' ) ) { $nextsection = get_field( 'post_section', $next_post->ID );?>
  <a href="<?php echo get_permalink( $next_post->ID ); ?>" class="next-post btn color3 solid color1-hover"><i class="fa fa-angle-left"></i> <span class="nav-txt">next post</span></a>
<?php } ?>
<?php
$prev_post = get_previous_post();
$prevsection = get_field( 'post_section', $prev_post->ID );
if (!empty( $prev_post )): ?>
 <a href="<?php echo get_permalink( $prev_post->ID ); ?>" class="previous-post btn color3 solid color1-hover"><span class="nav-txt">previous post</span> <i class="fa fa-angle-right"></i></a>
<?php endif; ?>
</nav>