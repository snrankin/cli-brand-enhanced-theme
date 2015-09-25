<header class="page-header wow fadeInUp" data-wow-delay="0.5s" <?php 

  $page_for_posts = get_option( 'page_for_posts' );  
  $postid = get_the_ID();
  
  $item_id = (is_blog()) ? $page_for_posts : $postid;

  $header_item_direction = (is_blog()) ? get_field('header_item_direction', $page_for_posts) : get_field('header_item_direction');
  $header_item_distribution = (is_blog()) ? get_field('header_item_distribution', $page_for_posts) : get_field('header_item_distribution');
  $header_item_alignment = (is_blog()) ? get_field('header_item_alignment', $page_for_posts) : get_field('header_item_alignment');
  $add_background_video = (is_blog()) ? get_field('add_background_video', $page_for_posts) : get_field('add_background_video');
  $video_mp4 = (is_blog()) ? get_field('video_mp4', $page_for_posts) : get_field('video_mp4');
  $video_ogg = (is_blog()) ? get_field('video_ogg', $page_for_posts) : get_field('video_ogg');
  $video_webm = (is_blog()) ? get_field('video_webm ', $page_for_posts) : get_field('video_webm ');
  $video_placeholder_image = (is_blog()) ? get_field('video_placeholder_image', $page_for_posts) : get_field('video_placeholder_image');
  $background_image = (is_blog()) ? get_field('background_image', $page_for_posts) : get_field('background_image');
  
  if($add_background_video == 0 && $background_image){echo 'style="background: url(' . $background_image . ') center no-repeat; background-size: cover;"';}
  
  $detect = new Mobile_Detect;
?>>
  <?php if(!$detect->isMobile() && $add_background_video == 1) { ?>
    <div class="header-bg-video bg-video">
      <video autoplay loop poster="<?php echo $video_placeholder_image; ?>" class="bgvid">
        <source src="<?php echo $video_webm; ?>" type="video/webm">
        <source src="<?php echo $video_mp4; ?>" type="video/mp4">
        <source src="<?php echo $video_ogg; ?>" type="video/ogv">
      </video>
      <div class="bg-video-overlay"></div>
    </div>
  <?php } else if($detect->isMobile() && $add_background_video == 1){?>
    <div class="header-bg-video bg-video" style="background: url('<?php echo $video_placeholder_image; ?>') center no-repeat; background-size: cover;">
      <div class="bg-video-overlay"></div>
    </div>
  <?php } ?>
  <div class="page-header-inner in-grid flex-row<?php if($header_item_direction){ echo ' flex-direction-' . $header_item_direction;} ?><?php if($header_item_distribution){ echo ' flex-position-' . $header_item_distribution;} ?><?php if($header_item_alignment){ echo ' flex-align-' . $header_item_alignment;} ?>">
    <?php if( have_rows('header_content', $item_id) ): while ( have_rows('header_content', $item_id) ) : the_row(); ?>
       
      <div class="header-block">   
        <?php if( get_row_layout() == 'header_text' ) { $text_color = get_sub_field('text_color', $item_id)?>
          <span<?php if($text_color) { echo ' style="color:' . $text_color . ';"';} ?>><?php the_sub_field('header_text', $item_id); ?></span>
        <?php } ?>
        
        <?php if( get_row_layout() == 'image' ) { $image = get_sub_field('header_image', $item_id);?>
          <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="single-image" />
        <?php } ?>
      
      </div>
    
   <?php endwhile; endif; ?>  
  </div>
</header>