<?php get_header(); ?>
<header class="page-header wow slideInDown" data-wow-duration="0.5s" data-wow-delay="1s" <?php 
    $careers_page = get_id_by_slug( 'careers' );
  
    $title = get_field('title', $careers_page);
    $title_color = get_field('title_color', $careers_page);
    $subtitle= get_field('subtitle', $careers_page);
    $subtitle_color = get_field('subtitle_color', $careers_page);
    $add_word_slider = get_field('add_word_slider', $careers_page);
    $static_title = get_field('static_title', $careers_page);
    $rotating_words_color = get_field('rotating_words_color', $careers_page);
    $rotating_words_background_color = get_field('rotating_words_background_color', $careers_page);
    $static_title_color = get_field('static_title_color', $careers_page);
    $background_image = get_field('background_image', $careers_page);
    $background_color = get_field('background_color', $careers_page);
    
    if($background_image){echo 'style="background: url(' . $background_image . ') center no-repeat; background-size: cover;"';}
    else{echo 'style="background: ' . $background_color. ';"';}
  ?>>
    <div class="page-header-inner">
      <?php if($add_word_slider == 1) { ?>
        <h1 class="page-header-title has-word-rotator">
        <div class="static-title" <?php if($static_title_color){ echo ' style="color: ' . $static_title_color . ' "';} ?>><?php echo $static_title; ?></div>
        <?php if( have_rows('words', $careers_page) ): $i = 0;?>
          <div class="words" >
            <?php while( have_rows('words', $careers_page) ): the_row(); $word = get_sub_field('word', $careers_page); $i++;?>
              <div class="word<?php if($i == 1){echo ' is-active';} ?>" <?php if($rotating_words_color){ echo ' style="color: ' . $rotating_words_color . '; background-color: ' . $rotating_words_background_color . ';"';} ?>>
                <div>
                  <?php echo $word; ?>
                </div>
              </div>
            <?php endwhile; ?>
          </div>
        <?php endif; ?>
        </h1>
      <?php } else { ?>
        <h1 class="page-header-title"<?php if($title_color){ echo ' style="color: ' . $title_color . ' "';} ?>><?php echo $title; ?></h1>
      <?php } ?>
      <?php if($subtitle) : ?>
        <div class="page-header-subtitle"<?php if($subtitle_color){ echo ' style="color: ' . $subtitle_color . ' "';} ?>><?php echo $subtitle; ?></div>
      <?php endif; ?>
    </div>
  </header>
<section id="content" role="main">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>  
  <section class="position-content">
    <div class="position-content-inner">
      <header class="position-header">
        <div class="position-header-inner">
          <h1><?php the_title(); ?></h1>
        </div>
      </header>
      <?php 
        $description = get_field('description');
        $category = get_field('category');
        $location= get_field('location');
        $apply_form= get_field('apply_form');
      ?>
      <div class="position-description">
        <?php echo $description; ?>
      </div>
      <div class="position-row">
        <div class="position-col">
        <?php if($category) {?>
          <div class="position-meta-box">
            <div class="position-meta-box-inner">
              <div>
              <h4>Category:</h4>
              </div>
              <div>
              <?php echo $category; ?>
              </div>
            </div>
          </div>
        <?php } ?>
        <?php if($location) {?>
          <div class="position-meta-box">
            <div class="position-meta-box-inner">
              <div>
                <h4>Location:</h4>
              </div>
              <div>
                <?php echo $location; ?>
              </div>
            </div>
          </div>
        <?php } ?>
        <?php if( have_rows('benefits') ): ?>
          <div class="position-meta-box">
            <div class="position-meta-box-inner">
              <div>
              <h4>Benefits:</h4>
              </div>
              <div>
              <?php while( have_rows('benefits') ): the_row(); $benefit = get_sub_field('benefit');?>
                <span class="benefit"><?php echo $benefit; ?></span>
              <?php endwhile; ?>
              </div>
            </div>
          </div>
        <?php endif; ?>
        </div>
        <div class="position-col">
        <a class="position-btn back-to-careers btn color4 solid" href="<?php echo get_permalink($careers_page); ?>"><span>See Other Jobs</span></a>
        <div class="position-btn show-apply-form btn color1 solid">
          <span>Apply Now</span>
        </div>
        </div>
      </div>
    </div>
  </section>
  <div class="form position-form">
    <?php echo $apply_form; ?>
  </div>
</article>
<?php endwhile; endif; ?>
</section>
<?php get_footer(); ?>