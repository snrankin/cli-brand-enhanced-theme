<?php

if ( function_exists('register_sidebar') ) {
  register_sidebar(array(
    'name' => 'Footer Column 1',
    'id' => 'footer-1',
    'description' => 'Footer column 1 widget area',
    'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widget-title">',
    'after_title' => '</h4>',
  ));
  
  register_sidebar(array(
    'name' => 'Footer Column 2',
    'id' => 'footer-2',
    'description' => 'Footer column 2 widget area',
    'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widget-title">',
    'after_title' => '</h4>',
  ));
  
  register_sidebar(array(
    'name' => 'Footer Column 3',
    'id' => 'footer-3',
    'description' => 'Footer column 3 widget area',
    'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widget-title">',
    'after_title' => '</h4>',
  ));
  
  register_sidebar(array(
    'name' => 'Footer Column 4',
    'id' => 'footer-4',
    'description' => 'Footer column 4 widget area',
    'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widget-title">',
    'after_title' => '</h4>',
  ));
  
  register_sidebar(array(
    'name' => 'Footer Column 5',
    'id' => 'footer-5',
    'description' => 'Footer column 5 widget area',
    'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widget-title">',
    'after_title' => '</h4>',
  ));
  
  register_sidebar(array(
    'name' => 'Footer Bottom',
    'id' => 'footer-bottom',
    'description' => 'Secondary footer Area',
    'before_widget' => '<div id="%1$s" class="btm-footer-widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '',
    'after_title' => '',
  ));
  
  register_sidebar(array(
    'name' => 'Content Bottom',
    'id' => 'content-bottom',
    'description' => '',
    'before_widget' => '<div id="%1$s" class="content-bottom-widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="content-widget-title">',
    'after_title' => '</h4>',
  ));
}

?>