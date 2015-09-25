<?php

function add_my_plugins() {
  
  //wp_register_style( 'OpenSans', 'https://fonts.googleapis.com/css?family=Open+Sans:400,300,700,800', false, '3.4.0' );
	//wp_enqueue_style( 'OpenSans' );
  
  //wp_register_style( 'Montserrat', 'https://fonts.googleapis.com/css?family=Montserrat:400,700', false, '3.4.0' );
//	wp_enqueue_style( 'Montserrat' );
  
  wp_register_style( 'animate', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.4.0/animate.min.css', false, '3.4.0' );
	wp_enqueue_style( 'animate' );
  
  wp_register_style( 'fontAwesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css', false, '4.4.0' );
	wp_enqueue_style( 'fontAwesome' );
  
  wp_register_style( 'genericons', get_template_directory_uri() . '/fonts/genericons/genericons.css', false, '' );
	wp_enqueue_style( 'genericons' );
  
  wp_register_style( 'hover', 'https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.0.2/css/hover-min.css', false, '2.0.2' );
	wp_enqueue_style( 'hover' );
  
  //wp_register_style( 'fancybox', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css', false, '2.1.5' );
  //wp_enqueue_style( 'fancybox' );
  
  wp_register_style( 'owlCarousel', get_template_directory_uri() . '/js/vendor/owl-carousel/assets/owl.carousel.css', false, '2.0' );
  wp_enqueue_style( 'owlCarousel' );
  
  wp_register_script( 'modernizr', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js', array('jquery'),'2.8.3', false);
  wp_enqueue_script( 'modernizr' );
  
  wp_register_script( 'migrate', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/1.2.1/jquery-migrate.min.js', array('jquery'),'1.2.1', false);
  wp_enqueue_script( 'migrate' );
  
  wp_register_script( 'googleFonts', 'https://ajax.googleapis.com/ajax/libs/webfont/1.5.18/webfont.js', false,'1.5.18', false);
  wp_enqueue_script( 'googleFonts' );
  
  wp_register_script( 'googleMaps', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false', false,'', false);
  wp_enqueue_script( 'googleMaps' );
  
  wp_register_script( 'lazyload', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js', array( 'jquery' ), '1.9.1',  false );
  wp_enqueue_script( 'lazyload' );
  
  wp_register_script( 'imagesloaded', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/3.1.8/imagesloaded.pkgd.min.js', array( 'jquery' ), '3.1.8',  false );
  wp_enqueue_script( 'imagesloaded' );
  
  wp_register_script( 'transit', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.transit/0.9.12/jquery.transit.min.js', array('jquery'),'0.9.12', true);
  wp_enqueue_script( 'transit' );
  
  wp_register_script( 'scrollTo', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/2.1.0/jquery.scrollTo.min.js', array( 'jquery' ), '2.1.0',  true );
  wp_enqueue_script( 'scrollTo' );
  
  wp_register_script( 'wow', 'https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js', array('jquery'),'1.1.2', true);
  wp_enqueue_script( 'wow' );

  wp_register_script( 'hoverintent','https://cdnjs.cloudflare.com/ajax/libs/jquery.hoverintent/1.8.1/jquery.hoverIntent.min.js', array('jquery'),'1.8.1', true);
  wp_enqueue_script( 'hoverintent' );
  
  wp_register_script( 'instagramFeed', get_template_directory_uri() . '/js/vendor/instafeed.min.js', false, '1.3.2',  false );
  wp_enqueue_script( 'instagramFeed' );

  wp_register_script( 'maps', get_template_directory_uri() . '/js/maps.js', array('jquery'),'', true);
  wp_enqueue_script( 'maps' );
  
  wp_register_script( 'owlCarousel', get_template_directory_uri() . '/js/vendor/owl-carousel/owl.carousel.min.js', array('jquery'),'2.0', true);
  wp_enqueue_script( 'owlCarousel' );
  
  wp_register_script( 'scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'),'', true);
  wp_enqueue_script( 'scripts' );
  

}
 
add_action( 'wp_enqueue_scripts', 'add_my_plugins' );