<?php
add_action( 'wp_enqueue_scripts', 'theme_load_scripts' );
function theme_load_scripts(){
  wp_deregister_script( 'jquery' );
  wp_register_script( 'jquery', 'http://code.jquery.com/jquery-latest.min.js');
  wp_enqueue_script( 'jquery' );
}
\
define( 'ACFGFS_API_KEY', 'AIzaSyCb6qQxNAuJiQm-iEBkCs3KF1Iopl1gw0U' );

define('CLI_ROOT', get_template_directory_uri());

add_filter('stylesheet_uri','wpi_stylesheet_uri',10,2);

function wpi_stylesheet_uri($stylesheet_uri, $stylesheet_dir_uri){

    return $stylesheet_dir_uri.'/css/style.css';
}

if(!function_exists('cli_is_css_folder_writable')) {
	/**
	 * Function that checks if css folder is writable
	 * @return bool
	 *
	 * @version 0.1
	 * @uses is_writable()
	 */
	function cli_is_css_folder_writable() {
		$css_dir = get_template_directory().'/css';

		return is_writable($css_dir);
	}
}

function cli_generate_dynamic_css_and_js() {

		if(cli_is_css_folder_writable()) {
			$css_dir = get_template_directory().'/css/';

			ob_start();
			include_once('css/style_dynamic.php');
			$css = ob_get_clean();
			file_put_contents($css_dir.'style_dynamic.css', $css, LOCK_EX);

		}
	}

if (file_exists(dirname(__FILE__) ."/css/style_dynamic.css") && cli_is_css_folder_writable() && !is_multisite() && !is_admin()) {
  wp_enqueue_style("style_dynamic", CLI_ROOT . "/css/style_dynamic.css", array(), filemtime(dirname(__FILE__) ."/css/style_dynamic.css"));
} 
else if(!is_admin()) {
  wp_enqueue_style("style_dynamic", CLI_ROOT . "/css/style_dynamic.php");
}

function bac_variable_length_excerpt($text, $length, $finish_sentence){
  //Word length of the excerpt. This is exact or NOT depending on your '$finish_sentence' variable.
  $length = 10; /* Change the Length of the excerpt as you wish. The Length is in words. */
  
  //1 if you want to finish the sentence of the excerpt (No weird cuts).
  $finish_sentence = 1; // Put 0 if you do NOT want to finish the sentence.
   
  $tokens = array();
  $out = '';
  $word = 0;
   
  //Divide the string into tokens; HTML tags, or words, followed by any whitespace.
  $regex = '/(<[^>]+>|[^<>\s]+)\s*/u';
  preg_match_all($regex, $text, $tokens);
  foreach ($tokens[0] as $t){ 
    //Parse each token
    if ($word >= $length && !$finish_sentence){ 
    //Limit reached
    break;
    }
    if ($t[0] != '<'){ 
    //Token is not a tag. 
    //Regular expression that checks for the end of the sentence: '.', '?' or '!'
    $regex1 = '/[\?\.\!]\s*$/uS';
    if ($word >= $length && $finish_sentence && preg_match($regex1, $t) == 1){ 
      //Limit reached, continue until ? . or ! occur to reach the end of the sentence.
      $out .= trim($t);
      break;
    }   
    $word++;
    }
    //Append what's left of the token.
    $out .= $t;     
  }
  //Add the excerpt ending as a link.
  $excerpt_end = ' [&hellip;]';
   
  //Add the excerpt ending as a non-linked ellipsis with brackets.
  //$excerpt_end = ' [&hellip;]';
   
  //Append the excerpt ending to the token. 
  $out .= $excerpt_end;
   
  return trim(force_balance_tags($out)); 
}

function bac_excerpt_filter($text){
  //Get the full content and filter it.
  $text = get_the_content('');
  $text = strip_shortcodes( $text );
  $text = apply_filters('the_content', $text);
   
  $text = str_replace(']]>', ']]&gt;', $text);
   
  /**By default the code allows all HTML tags in the excerpt**/
  //Control what HTML tags to allow: If you want to allow ALL HTML tags in the excerpt, then do NOT touch.
   
  //If you want to Allow SOME tags: THEN Uncomment the next line + Line 80.
  //$allowed_tags = '<p>,<a>,<strong>'; /* Here I am allowing p, a, strong tags. Separate tags by comma. */
   
  //If you want to Disallow ALL HTML tags: THEN Uncomment the next line + Line 80, 
  $allowed_tags = ''; /* To disallow all HTML tags, keep it empty. The Excerpt will be unformated but newlines are preserved. */
  $text = strip_tags($text, $allowed_tags); /* Line 80 */
   
  //Create the excerpt.
  $text = bac_variable_length_excerpt($text, $length, $finish_sentence);  
  return $text;
}
//Hooks the 'bac_excerpt_filter' function to a specific (get_the_excerpt) filter action.
add_filter('get_the_excerpt','bac_excerpt_filter',5);


function get_theme_logo($themelogo){
  
  $logocolor = get_field('logo_color', 'option');
  $logowhite = get_field('logo_white', 'option');
  $logoblack = get_field('logo_black', 'option');
  
  $headerlogo = get_field( 'logo_header_choice', 'option' );
  
  if( $headerlogo == 'black' ) {
    
    $themelogo = $logoblack;
      
    return $themelogo;
  
  } elseif( $headerlogo == 'white' ) {
  
     $themelogo = $logowhite;
      
    return $themelogo;  
       
  } elseif( $headerlogo == 'color' ){
     
     $themelogo = $logocolor;
      
    return $themelogo; 
           
  }
  else{
    return '';  
  }

}

add_filter('widget_text', 'do_shortcode');

function get_id_by_slug($page_slug) {
	$page = get_page_by_path($page_slug);
	if ($page) {
		return $page->ID;
	} else {
		return null;
	}
}

function create_page_box($page_slug) {
  
  $page = get_page_by_path($page_slug);
  if ($page) {
    $pageboxid = $page->ID;
  } else {
    return null;
  }
  
  if(function_exists('get_field')){
    if(get_field('title', $pageboxid))
    {
      $pageboxtitle = '<h4>' . get_field('title', $pageboxid) . '</h4>';
    }
    if(get_field('subtitle', $pageboxid))
    {
      $pageboxsubtitle = '<p>' . get_field('subtitle', $pageboxid) . '</p>';
    }
  }
  
    return '<div class="page-box-content-wrap">' . $pageboxtitle . $pageboxsubtitle .'<a class="special-btn white-btn center-btn ' . $page_slug .'" href="' . get_permalink( $pageboxid ) . '" target="_self"><span class="first-panel">Learn More</span><span class="second-panel">' . get_the_title( $pageboxid ) . '</span></a></div>';
  
}

function displayfullAddress() {
  
  $address_1 = get_field('address_line_1', 'option');
  $city = get_field('city', 'option');
  $state = get_field('state', 'option');
  $zip = get_field('zip', 'option');
  $phone = get_field('phone', 'option');
  $email = get_field('email', 'option');
  
  if($address_1){
    $addressCode = '<div itemprop="streetAddress">' . $address_1 . '</div>';  
  }
  
  if($city){
    $cityCode = '<span itemprop="addressLocality">' . $city . ', </span>';  
  }
  
  if($state){
    $stateCode = '<span itemprop="addressRegion">' . $state . '</span>';  
  }
  
  if($zip){
    $zipCode = '<span itemprop="postalCode">' . $zip . '</span>';  
  }
  
  if($phone){
    $phoneCode = '<div itemprop="telephone">' . $phone . '</div>';  
  }
  
  if($email){
    $emailCode = '<div><a href="mailto:' . $email  . '" itemprop="email">' . $email . '</a></div>';  
  }

return '<div class="company-address" itemscope itemtype="http://schema.org/LocalBusiness"><div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">' . $addressCode . '<div>' . $cityCode . $stateCode . ' ' . $zipCode . '</div></div>' . $phoneCode . $emailCode . '</div>';
  
}

function displayAddress() {
  
  $address_1 = get_field('address_line_1', 'option');
  $city = get_field('city', 'option');
  $state = get_field('state', 'option');
  $zip = get_field('zip', 'option');
  
  if($address_1){
    $addressCode = '<div itemprop="streetAddress">' . $address_1 . '</div>';  
  }
  
  if($city){
    $cityCode = '<span itemprop="addressLocality">' . $city . ', </span>';  
  }
  
  if($state){
    $stateCode = '<span itemprop="addressRegion">' . $state . '</span>';  
  }
  
  if($zip){
    $zipCode = '<span itemprop="postalCode">' . $zip . '</span>';  
  }

return '<div class="company-address" itemscope itemtype="http://schema.org/LocalBusiness"><div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">' . $addressCode . '<div>' . $cityCode . $stateCode . ' ' . $zipCode . '</div></div></div>';
  
}

function displayContactInfo() {
  
  $phone = get_field('phone', 'option');
  $email = get_field('email', 'option');
  
  if($phone){
    $phoneCode = '<div itemprop="telephone">' . $phone . '</div>';  
  }
  
  if($email){
    $emailCode = '<div><a href="mailto:' . $email  . '" itemprop="email">' . $email . '</a></div>';  
  }

return '<div class="company-address" itemscope itemtype="http://schema.org/LocalBusiness">' . $phoneCode . $emailCode . '</div>';
  
}

function displaySocialProfiles($icon_type, $extra_class) {
  
  $custom_class = $extra_class;
  $type_of_icon = $icon_type;
  $facebook= get_field('facebook', 'options');
  $twitter = get_field('twitter', 'options');
  $google = get_field('google', 'options');
  $linkedin = get_field('linkedin', 'options');
  $tumblr = get_field('tumblr', 'options');
  $pinterest = get_field('pinterest', 'options');
  $flickr = get_field('flickr', 'options');
  $newswire = get_field('newswire', 'options');
  $instagram = get_field('instagram', 'options');
  
  if($facebook){
    if($type_of_icon === 'icon1'){
      $facebookCode = '<div class="social-icon"><a href="' . $facebook  . '" target="_blank"><i class="cli-facebook"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $facebookCode = '<div class="social-icon"><a href="' . $facebook  . '" target="_blank"><i class="cli-facebook-square"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon3'){
      $facebookCode = '<div class="social-icon"><a href="' . $facebook  . '" target="_blank"><i class="cli-facebook-circle"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon4'){
      $facebookCode = '<div class="social-icon"><a href="' . $facebook  . '" target="_blank"><i class="cli-facebook-square-round"></i></a></div>';  
    }
    else{
      $facebookCode = '<div class="social-icon"><a href="' . $facebook  . '" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" id="Layer_1" x="0" y="0" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve"><path id="facebook" fill="none" stroke="#000000" stroke-miterlimit="10" d="M25 2C12.3 2 2 12.3 2 25s10.3 23 23 23 23-10.3 23-23S37.7 2 25 2zM33.2 14.4h-3c-2.4 0-2.9 1.1-2.9 2.7v3.6h5.6l-0.8 5.7h-4.9v14.4h-5.9V26.4h-4.6v-5.7h4.9v-4.1c0-4.8 3-7.5 7.3-7.5 2.1 0 3.8 0.2 4.3 0.2V14.4z"/></svg></a></div>';  
    }
    
  }
  
  if($twitter){
    if($type_of_icon === 'icon1'){
      $twitterCode = '<div class="social-icon"><a href="' . $twitter  . '" target="_blank"><i class="cli-twitter"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $twitterCode = '<div class="social-icon"><a href="' . $twitter  . '" target="_blank"><i class="cli-twitter-square"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon3'){
      $twitterCode = '<div class="social-icon"><a href="' . $twitter  . '" target="_blank"><i class="cli-twitter-circle"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon4'){
      $twitterCode = '<div class="social-icon"><a href="' . $twitter  . '" target="_blank"><i class="cli-twitter-square-round"></i></a></div>';  
    }
    else{
    $twitterCode = '<div class="social-icon"><a href="' . $twitter  . '" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" id="Layer_1" x="0" y="0" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve"><path id="twitter" fill="none" stroke="#000000" stroke-miterlimit="10" d="M25 2C12.3 2 2 12.3 2 25s10.3 23 23 23 23-10.3 23-23S37.7 2 25 2zM37.5 18.5c0 0.3 0 0.6 0 0.8 0 8.6-6.5 18.6-18.6 18.6 -3.6 0-7.1-1.1-10-2.9 0.5 0 1 0.2 1.6 0.2 3 0 5.9-1 8.1-2.9 -2.9 0-5.2-1.9-6-4.4 0.5 0 0.8 0.2 1.3 0.2 0.6 0 1.1-0.2 1.7-0.2 -3-0.6-5.2-3.2-5.2-6.3 0 0 0 0 0-0.2 0.8 0.5 1.9 0.8 3 0.8 -1.7-1.1-2.9-3.2-2.9-5.4 0-1.3 0.3-2.4 1-3.3 3.2 4 8.1 6.5 13.5 6.8 -0.2-0.5-0.2-1-0.2-1.4 0-3.6 2.9-6.5 6.5-6.5 1.9 0 3.5 0.8 4.8 2.1 1.4-0.3 2.9-0.8 4.1-1.6 -0.5 1.6-1.6 2.9-2.9 3.6 1.3-0.2 2.5-0.5 3.8-1C39.9 16.4 38.8 17.5 37.5 18.5z"/></svg></a></div>';  
    }

  }
  
  if($google){
    if($type_of_icon === 'icon1'){
      $googleCode = '<div class="social-icon"><a href="' . $google  . '" target="_blank"><i class="cli-google"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $googleCode = '<div class="social-icon"><a href="' . $google  . '" target="_blank"><i class="cli-google-square"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon3'){
      $googleCode = '<div class="social-icon"><a href="' . $google  . '" target="_blank"><i class="cli-google-circle"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon4'){
      $googleCode = '<div class="social-icon"><a href="' . $google  . '" target="_blank"><i class="cli-google-square-round"></i></a></div>';  
    }
    else{
    $googleCode = '<div class="social-icon"><a href="' . $google  . '" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" id="Layer_1" x="0" y="0" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve"><g id="google"><path fill="none" stroke="#000000" stroke-miterlimit="10" d="M22.1 29.1c-0.3 0-0.6 0-1 0 -3.2 0-7.8 1-7.8 4.9 0 3.6 4 5.1 7.1 5.1 2.9 0 5.9-1.1 5.9-4.4C26.4 32.1 23.9 30.6 22.1 29.1zM24.4 18.3c0-2.9-1.6-7.6-5.1-7.6 -1.1 0-2.2 0.5-2.9 1.4 -0.8 0.8-1 1.9-1 3 0 2.9 1.6 7.3 5.1 7.3 1 0 2.1-0.5 2.7-1.1C24 20.6 24.4 19.4 24.4 18.3zM25 2C12.3 2 2 12.3 2 25s10.3 23 23 23 23-10.3 23-23S37.7 2 25 2zM28.3 36.4c-2.1 3.3-6 4.4-9.7 4.4 -2.9 0-6.3-0.8-7.9-3.5 -0.5-0.8-0.6-1.6-0.6-2.5 0-2.2 1.3-4 3.2-5.1 2.2-1.4 5.1-1.7 7.8-1.9 -0.6-1-1.3-1.6-1.3-2.9 0-0.6 0.2-1.1 0.5-1.6 -0.5 0-0.8 0-1.3 0 -3.6 0-6.7-2.7-6.7-6.5 0-2.1 1-4.1 2.5-5.6 1.7-1.6 4.6-2.2 7.3-2.2h7.9l-2.7 1.7H25c1.7 1.4 2.9 3.2 2.9 5.6 0 4.9-4.4 5.6-4.4 7.9 0 2.5 5.9 3.3 5.9 8.7C29.3 34.2 28.8 35.3 28.3 36.4zM40.1 24.5h-4.1v4.1h-2.1v-4.1h-4v-2.1h4v-4.1h2.1v4.1h4.1V24.5z"/></g></svg></a></div>';  
    }

  }
  
  if($linkedin){
    if($type_of_icon === 'icon1'){
      $linkedinCode = '<div class="social-icon"><a href="' . $linkedin  . '" target="_blank"><i class="cli-linkedin"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $linkedinCode = '<div class="social-icon"><a href="' . $linkedin  . '" target="_blank"><i class="cli-linkedin-square"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon3'){
      $linkedinCode = '<div class="social-icon"><a href="' . $linkedin  . '" target="_blank"><i class="cli-linkedin-circle"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon4'){
      $linkedinCode = '<div class="social-icon"><a href="' . $linkedin  . '" target="_blank"><i class="cli-linkedin-square-round"></i></a></div>';  
    }
    else{
    $linkedinCode = '<div class="social-icon"><a href="' . $linkedin  . '" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0" y="0" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve"><path id="linkedin" fill="none" stroke="#000000" stroke-miterlimit="10" d="M25 2C12.3 2 2 12.3 2 25s10.3 23 23 23 23-10.3 23-23S37.7 2 25 2zM16.3 40.2H9.5V19.8h6.8V40.2zM12.9 16.9L12.9 16.9c-2.4 0-3.8-1.6-3.8-3.5 0-2.1 1.6-3.5 3.8-3.5 2.4 0 3.8 1.6 3.8 3.5S15.3 16.9 12.9 16.9zM40.9 40.2H34V29.3c0-2.7-1-4.6-3.5-4.6 -1.9 0-3 1.3-3.5 2.5 -0.2 0.5-0.2 1.1-0.2 1.7v11.4h-6.8c0.2-18.6 0-20.5 0-20.5h6.8v2.9c1-1.4 2.5-3.3 6.2-3.3 4.4 0 7.8 2.9 7.8 9.2C40.9 28.6 40.9 40.2 40.9 40.2z"/></svg></a></div>';  
    }

  }
  
  if($tumblr){
    if($type_of_icon === 'icon1'){
      $tumblrCode = '<div class="social-icon"><a href="' . $tumblr  . '" target="_blank"><i class="cli-tumblr"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $tumblrCode = '<div class="social-icon"><a href="' . $tumblr  . '" target="_blank"><i class="cli-tumblr-square"></i></a></div>';  
    }
    else if ($type_of_icon == 'icon3'){
      $tumblrCode = '<div class="social-icon"><a href="' . $tumblr  . '" target="_blank"><i class="cli-tumblr-circle"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon4'){
      $tumblrCode = '<div class="social-icon"><a href="' . $tumblr  . '" target="_blank"><i class="cli-tumblr-square-round"></i></a></div>';  
    }
    else{
    $tumblrCode = '<div class="social-icon"><a href="' . $tumblr  . '" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" id="Layer_1" x="0" y="0" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve"><path id="tumblr" fill="none" stroke="#000000" stroke-miterlimit="10" d="M25 2C12.3 2 2 12.3 2 25s10.3 23 23 23 23-10.3 23-23S37.7 2 25 2zM28.6 40.9c-7 0.2-9.5-4.9-9.5-8.4V22.1H16V18c4.8-1.7 6-6 6.2-8.6 0-0.3 0.2-0.3 0.2-0.3s0 0 4.6 0v8.1h6.3V22h-6.3v9.8c0 1.3 0.5 3.2 3 3.2 0.8 0 1.9-0.3 2.5-0.5L34 39C33.6 39.9 30.9 40.9 28.6 40.9z"/></svg></a></div>'; 
    }

  }
  
  if($pinterest){
    if($type_of_icon === 'icon1'){
      $pinterestCode = '<div class="social-icon"><a href="' . $pinterest  . '" target="_blank"><i class="cli-pinterest"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $pinterestCode = '<div class="social-icon"><a href="' . $pinterest  . '" target="_blank"><i class="cli-pinterest-square"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon3'){
      $pinterestCode = '<div class="social-icon"><a href="' . $pinterest  . '" target="_blank"><i class="cli-pinterest-circle"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon4'){
      $pinterestCode = '<div class="social-icon"><a href="' . $pinterest  . '" target="_blank"><i class="cli-pinterest-square-round"></i></a></div>';  
    }
    else{
    $pinterestCode = '<div class="social-icon"><a href="' . $pinterest  . '" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" id="Layer_1" x="0" y="0" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve"><path id="pinterest" fill="none" stroke="#000000" stroke-miterlimit="10" d="M25 2C12.3 2 2 12.3 2 25s10.3 23 23 23 23-10.3 23-23S37.7 2 25 2zM27.5 33.6c-2.1 0-4.1-1.1-4.8-2.4 -1.1 4.4-1.4 5.4-1.4 5.4 -0.5 1.4-1.6 3.5-1.9 4.1 -0.3 0.6-2.4 0.2-2.2-0.8 0-1 0-3 0.3-4.4 0 0 0.3-1.6 2.5-10.5 -0.6-1.3-0.6-3-0.6-3 0-2.9 1.6-5.1 3.8-5.1 1.7 0 2.7 1.3 2.7 2.9 0 1.7-1.1 4.4-1.7 6.8 -0.5 2.1 1.1 3.8 3 3.8 3.6 0 6.2-4.8 6.2-10.3 0-4.3-2.9-7.5-8.1-7.5 -5.9 0-9.5 4.4-9.5 9.4 0 1.7 0.5 2.9 1.3 3.8 0.3 0.5 0.5 0.6 0.3 1.1 -0.2 0.3-0.3 1.3-0.5 1.6 -0.2 0.5-0.5 0.6-1 0.5 -2.7-1.1-4-4.1-4-7.5 0-5.7 4.6-12.4 13.8-12.4 7.5 0 12.2 5.4 12.2 11.1C38 27.9 33.9 33.6 27.5 33.6z"/></svg></a></div>'; 
    }

  }
  
  if($flickr){
    if($type_of_icon === 'icon1'){
      $flickrCode = '<div class="social-icon"><a href="' . $flickr  . '" target="_blank"><i class="cli-flickr"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $flickrCode = '<div class="social-icon"><a href="' . $flickr  . '" target="_blank"><i class="cli-flickr-square"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon3'){
      $flickrCode = '<div class="social-icon"><a href="' . $flickr  . '" target="_blank"><i class="cli-flickr-circle"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon4'){
      $flickrCode = '<div class="social-icon"><a href="' . $flickr  . '" target="_blank"><i class="cli-flickr-square-round"></i></a></div>';  
    }
    else{
    $flickrCode = '<div class="social-icon"><a href="' . $flickr  . '" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" id="Layer_1" x="0" y="0" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve"><path id="flickr" fill="none" stroke="#000000" stroke-miterlimit="10" d="M25 2C12.3 2 2 12.3 2 25s10.3 23 23 23 23-10.3 23-23S37.7 2 25 2zM16 31.8c-3.8 0-6.8-3-6.8-6.8s3-6.8 6.8-6.8 6.8 3 6.8 6.8S19.8 31.8 16 31.8zM34 31.8c-3.8 0-6.8-3-6.8-6.8s3-6.8 6.8-6.8 6.8 3 6.8 6.8S37.8 31.8 34 31.8z"/></svg></a></div>';  
    }

  }
  
  if($newswire){
    if($type_of_icon === 'icon1'){
      $newswireCode = '<div class="social-icon"><a href="' . $newswire  . '" target="_blank"><i class="cli-newswire"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $newswireCode = '<div class="social-icon"><a href="' . $newswire  . '" target="_blank"><i class="cli-newswire-square"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon3'){
      $newswireCode = '<div class="social-icon"><a href="' . $newswire  . '" target="_blank"><i class="cli-newswire-circle"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon4'){
      $newswireCode = '<div class="social-icon"><a href="' . $newswire  . '" target="_blank"><i class="cli-newswire-square-round"></i></a></div>';  
    }
    else{
    $newswireCode = '<div class="social-icon"><a href="' . $newswire  . '" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" id="Layer_1" x="0" y="0" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve"><path id="newswire" fill="none" stroke="#000000" stroke-miterlimit="10" d="M25 2C12.3 2 2 12.3 2 25s10.3 23 23 23 23-10.3 23-23S37.7 2 25 2zM38.5 38.2c0 1.4-1.3 2.7-2.7 2.7 -0.6 0-1.3-0.3-1.7-0.8l0 0c0 0 0 0-0.2-0.2 -0.2-0.2-0.2-0.2-0.3-0.3L16.9 19.3v18.9c0 1.4-1.3 2.7-2.7 2.7s-2.7-1.3-2.7-2.7V11.8c0-1.4 1.1-2.7 2.7-2.7 0.5 0 1 0.2 1.4 0.5 0.3 0.2 0.6 0.3 1 0.6l16.7 20.5V11.8c0-1.4 1.3-2.7 2.7-2.7 1.4 0 2.7 1.3 2.7 2.7v26.3H38.5z"/></svg></a></div>';  
    }

  }
  
  if($instagram){
    if($type_of_icon === 'icon1'){
      $instagramCode = '<div class="social-icon"><a href="' . $instagram  . '" target="_blank"><i class="cli-instagram"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $instagramCode = '<div class="social-icon"><a href="' . $instagram  . '" target="_blank"><i class="cli-instagram-square"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon3'){
      $instagramCode = '<div class="social-icon"><a href="' . $instagram  . '" target="_blank"><i class="cli-instagram-circle"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon4'){
      $instagramCode = '<div class="social-icon"><a href="' . $instagram  . '" target="_blank"><i class="cli-instagram-square-round"></i></a></div>';  
    }
    else{
    $instagramCode = '<div class="social-icon"><a href="' . $instagram  . '" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" id="Layer_1" x="0" y="0" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve"><path id="instagram" fill="none" stroke="#000000" stroke-miterlimit="10" d="M25 2C12.3 2 2 12.3 2 25s10.3 23 23 23 23-10.3 23-23S37.7 2 25 2zM38.5 38.2c0 1.4-1.3 2.7-2.7 2.7 -0.6 0-1.3-0.3-1.7-0.8l0 0c0 0 0 0-0.2-0.2 -0.2-0.2-0.2-0.2-0.3-0.3L16.9 19.3v18.9c0 1.4-1.3 2.7-2.7 2.7s-2.7-1.3-2.7-2.7V11.8c0-1.4 1.1-2.7 2.7-2.7 0.5 0 1 0.2 1.4 0.5 0.3 0.2 0.6 0.3 1 0.6l16.7 20.5V11.8c0-1.4 1.3-2.7 2.7-2.7 1.4 0 2.7 1.3 2.7 2.7v26.3H38.5z"/></svg></a></div>';  
    }

  }
  
  

return '<div id="social-profiles" class="social ' . $type_of_icon . ' ' . $custom_class . '">' . $facebookCode . $twitterCode . $googleCode . $linkedinCode . $tumblrCode  . $pinterestCode  . $flickrCode  . $newswireCode . $instagramCode . '</div>';
  
}

function displaySocialShare() {
  
  $type_of_icon = get_field('type_of_icon', 'options');

    if($type_of_icon === 'icon1'){
      $facebookCode = '<div class="social-icon"><a href="http://www.facebook.com/share.php?u=' . get_permalink()  . '" target="_blank"><i class="cli-facebook"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $facebookCode = '<div class="social-icon"><a href="http://www.facebook.com/share.php?u=' . get_permalink()  . '" target="_blank"><i class="cli-facebook-square"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon3'){
      $facebookCode = '<div class="social-icon"><a href="http://www.facebook.com/share.php?u=' . get_permalink()  . '" target="_blank"><i class="cli-facebook-circle"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon4'){
      $facebookCode = '<div class="social-icon"><a href="http://www.facebook.com/share.php?u=' . get_permalink()  . '" target="_blank"><i class="cli-facebook-square-round"></i></a></div>';  
    }
    else{
      $facebookCode = '<div class="social-icon"><a href="http://www.facebook.com/share.php?u=' . get_permalink()  . '" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" id="Layer_1" x="0" y="0" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve"><path id="facebook" fill="none" stroke="#000000" stroke-miterlimit="10" d="M25 2C12.3 2 2 12.3 2 25s10.3 23 23 23 23-10.3 23-23S37.7 2 25 2zM33.2 14.4h-3c-2.4 0-2.9 1.1-2.9 2.7v3.6h5.6l-0.8 5.7h-4.9v14.4h-5.9V26.4h-4.6v-5.7h4.9v-4.1c0-4.8 3-7.5 7.3-7.5 2.1 0 3.8 0.2 4.3 0.2V14.4z"/></svg></a></div>';  
    }

    if($type_of_icon === 'icon1'){
      $twitterCode = '<div class="social-icon"><a href="http://twitter.com/home?status=' . get_permalink()  . '" target="_blank"><i class="cli-twitter"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $twitterCode = '<div class="social-icon"><a href="http://twitter.com/home?status=' . get_permalink()  . '" target="_blank"><i class="cli-twitter-square"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon3'){
      $twitterCode = '<div class="social-icon"><a href="http://twitter.com/home?status=' . get_permalink()  . '" target="_blank"><i class="cli-twitter-circle"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon4'){
      $twitterCode = '<div class="social-icon"><a href="http://twitter.com/home?status=' . get_permalink()  . '" target="_blank"><i class="cli-twitter-square-round"></i></a></div>';  
    }
    else{
    $twitterCode = '<div class="social-icon"><a href="http://twitter.com/home?status=' . get_permalink()  . '" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" id="Layer_1" x="0" y="0" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve"><path id="twitter" fill="none" stroke="#000000" stroke-miterlimit="10" d="M25 2C12.3 2 2 12.3 2 25s10.3 23 23 23 23-10.3 23-23S37.7 2 25 2zM37.5 18.5c0 0.3 0 0.6 0 0.8 0 8.6-6.5 18.6-18.6 18.6 -3.6 0-7.1-1.1-10-2.9 0.5 0 1 0.2 1.6 0.2 3 0 5.9-1 8.1-2.9 -2.9 0-5.2-1.9-6-4.4 0.5 0 0.8 0.2 1.3 0.2 0.6 0 1.1-0.2 1.7-0.2 -3-0.6-5.2-3.2-5.2-6.3 0 0 0 0 0-0.2 0.8 0.5 1.9 0.8 3 0.8 -1.7-1.1-2.9-3.2-2.9-5.4 0-1.3 0.3-2.4 1-3.3 3.2 4 8.1 6.5 13.5 6.8 -0.2-0.5-0.2-1-0.2-1.4 0-3.6 2.9-6.5 6.5-6.5 1.9 0 3.5 0.8 4.8 2.1 1.4-0.3 2.9-0.8 4.1-1.6 -0.5 1.6-1.6 2.9-2.9 3.6 1.3-0.2 2.5-0.5 3.8-1C39.9 16.4 38.8 17.5 37.5 18.5z"/></svg></a></div>';  
    }

    if($type_of_icon === 'icon1'){
      $googleCode = '<div class="social-icon"><a href="https://plus.google.com/share?url=' . get_permalink()  . '" target="_blank"><i class="cli-google"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $googleCode = '<div class="social-icon"><a href="https://plus.google.com/share?url=' . get_permalink()  . '" target="_blank"><i class="cli-google-square"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon3'){
      $googleCode = '<div class="social-icon"><a href="https://plus.google.com/share?url=' . get_permalink()  . '" target="_blank"><i class="cli-google-circle"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon3'){
      $googleCode = '<div class="social-icon"><a href="https://plus.google.com/share?url=' . get_permalink()  . '" target="_blank"><i class="cli-google-square-round"></i></a></div>';  
    }
    else{
    $googleCode = '<div class="social-icon"><a href="https://plus.google.com/share?url=' . get_permalink()  . '" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" id="Layer_1" x="0" y="0" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve"><g id="google"><path fill="none" stroke="#000000" stroke-miterlimit="10" d="M22.1 29.1c-0.3 0-0.6 0-1 0 -3.2 0-7.8 1-7.8 4.9 0 3.6 4 5.1 7.1 5.1 2.9 0 5.9-1.1 5.9-4.4C26.4 32.1 23.9 30.6 22.1 29.1zM24.4 18.3c0-2.9-1.6-7.6-5.1-7.6 -1.1 0-2.2 0.5-2.9 1.4 -0.8 0.8-1 1.9-1 3 0 2.9 1.6 7.3 5.1 7.3 1 0 2.1-0.5 2.7-1.1C24 20.6 24.4 19.4 24.4 18.3zM25 2C12.3 2 2 12.3 2 25s10.3 23 23 23 23-10.3 23-23S37.7 2 25 2zM28.3 36.4c-2.1 3.3-6 4.4-9.7 4.4 -2.9 0-6.3-0.8-7.9-3.5 -0.5-0.8-0.6-1.6-0.6-2.5 0-2.2 1.3-4 3.2-5.1 2.2-1.4 5.1-1.7 7.8-1.9 -0.6-1-1.3-1.6-1.3-2.9 0-0.6 0.2-1.1 0.5-1.6 -0.5 0-0.8 0-1.3 0 -3.6 0-6.7-2.7-6.7-6.5 0-2.1 1-4.1 2.5-5.6 1.7-1.6 4.6-2.2 7.3-2.2h7.9l-2.7 1.7H25c1.7 1.4 2.9 3.2 2.9 5.6 0 4.9-4.4 5.6-4.4 7.9 0 2.5 5.9 3.3 5.9 8.7C29.3 34.2 28.8 35.3 28.3 36.4zM40.1 24.5h-4.1v4.1h-2.1v-4.1h-4v-2.1h4v-4.1h2.1v4.1h4.1V24.5z"/></g></svg></a></div>';  
    }

    if($type_of_icon === 'icon1'){
      $linkedinCode = '<div class="social-icon"><a href="http://linkedin.com/shareArticle?mini=true&url=' . get_permalink()  . '" target="_blank"><i class="cli-linkedin"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $linkedinCode = '<div class="social-icon"><a href="http://linkedin.com/shareArticle?mini=true&url=' . get_permalink()  . '" target="_blank"><i class="cli-linkedin-square"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon3'){
      $linkedinCode = '<div class="social-icon"><a href="http://linkedin.com/shareArticle?mini=true&url=' . get_permalink()  . '" target="_blank"><i class="cli-linkedin-circle"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon3'){
      $linkedinCode = '<div class="social-icon"><a href="http://linkedin.com/shareArticle?mini=true&url=' . get_permalink()  . '" target="_blank"><i class="cli-linkedin-square-round"></i></a></div>';  
    }
    else{
    $linkedinCode = '<div class="social-icon"><a href="http://linkedin.com/shareArticle?mini=true&url=' . get_permalink()  . '" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0" y="0" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve"><path id="linkedin" fill="none" stroke="#000000" stroke-miterlimit="10" d="M25 2C12.3 2 2 12.3 2 25s10.3 23 23 23 23-10.3 23-23S37.7 2 25 2zM16.3 40.2H9.5V19.8h6.8V40.2zM12.9 16.9L12.9 16.9c-2.4 0-3.8-1.6-3.8-3.5 0-2.1 1.6-3.5 3.8-3.5 2.4 0 3.8 1.6 3.8 3.5S15.3 16.9 12.9 16.9zM40.9 40.2H34V29.3c0-2.7-1-4.6-3.5-4.6 -1.9 0-3 1.3-3.5 2.5 -0.2 0.5-0.2 1.1-0.2 1.7v11.4h-6.8c0.2-18.6 0-20.5 0-20.5h6.8v2.9c1-1.4 2.5-3.3 6.2-3.3 4.4 0 7.8 2.9 7.8 9.2C40.9 28.6 40.9 40.2 40.9 40.2z"/></svg></a></div>';  
    }

    if($type_of_icon === 'icon1'){
      $tumblrCode = '<div class="social-icon"><a href="http://www.tumblr.com/share/link?url=' . get_permalink()  . '" target="_blank"><i class="cli-tumblr"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $tumblrCode = '<div class="social-icon"><a href="http://www.tumblr.com/share/link?url=' . get_permalink()  . '" target="_blank"><i class="cli-tumblr-square"></i></a></div>';  
    }
    else if ($type_of_icon == 'icon3'){
      $tumblrCode = '<div class="social-icon"><a href="http://www.tumblr.com/share/link?url=' . get_permalink()  . '" target="_blank"><i class="cli-tumblr-circle"></i></a></div>';  
    }
    else if ($type_of_icon == 'icon3'){
      $tumblrCode = '<div class="social-icon"><a href="http://www.tumblr.com/share/link?url=' . get_permalink()  . '" target="_blank"><i class="cli-tumblr-square-round"></i></a></div>';  
    }
    else{
    $tumblrCode = '<div class="social-icon"><a href="http://www.tumblr.com/share/link?url=' . get_permalink()  . '" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" id="Layer_1" x="0" y="0" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve"><path id="tumblr" fill="none" stroke="#000000" stroke-miterlimit="10" d="M25 2C12.3 2 2 12.3 2 25s10.3 23 23 23 23-10.3 23-23S37.7 2 25 2zM28.6 40.9c-7 0.2-9.5-4.9-9.5-8.4V22.1H16V18c4.8-1.7 6-6 6.2-8.6 0-0.3 0.2-0.3 0.2-0.3s0 0 4.6 0v8.1h6.3V22h-6.3v9.8c0 1.3 0.5 3.2 3 3.2 0.8 0 1.9-0.3 2.5-0.5L34 39C33.6 39.9 30.9 40.9 28.6 40.9z"/></svg></a></div>'; 
    }

    if($type_of_icon === 'icon1'){
      $pinterestCode = '<div class="social-icon"><a href="http://pinterest.com/pin/create/button/?url=' . get_permalink()  . '" target="_blank"><i class="cli-pinterest"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon2'){
      $pinterestCode = '<div class="social-icon"><a href="http://pinterest.com/pin/create/button/?url=' . get_permalink()  . '" target="_blank"><i class="cli-pinterest-square"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon3'){
      $pinterestCode = '<div class="social-icon"><a href="http://pinterest.com/pin/create/button/?url=' . get_permalink()  . '" target="_blank"><i class="cli-pinterest-circle"></i></a></div>';  
    }
    else if ($type_of_icon === 'icon3'){
      $pinterestCode = '<div class="social-icon"><a href="http://pinterest.com/pin/create/button/?url=' . get_permalink()  . '" target="_blank"><i class="cli-pinterest-square-round"></i></a></div>';  
    }
    else{
    $pinterestCode = '<div class="social-icon"><a href="http://pinterest.com/pin/create/button/?url=' . get_permalink()  . '" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" id="Layer_1" x="0" y="0" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve"><path id="pinterest" fill="none" stroke="#000000" stroke-miterlimit="10" d="M25 2C12.3 2 2 12.3 2 25s10.3 23 23 23 23-10.3 23-23S37.7 2 25 2zM27.5 33.6c-2.1 0-4.1-1.1-4.8-2.4 -1.1 4.4-1.4 5.4-1.4 5.4 -0.5 1.4-1.6 3.5-1.9 4.1 -0.3 0.6-2.4 0.2-2.2-0.8 0-1 0-3 0.3-4.4 0 0 0.3-1.6 2.5-10.5 -0.6-1.3-0.6-3-0.6-3 0-2.9 1.6-5.1 3.8-5.1 1.7 0 2.7 1.3 2.7 2.9 0 1.7-1.1 4.4-1.7 6.8 -0.5 2.1 1.1 3.8 3 3.8 3.6 0 6.2-4.8 6.2-10.3 0-4.3-2.9-7.5-8.1-7.5 -5.9 0-9.5 4.4-9.5 9.4 0 1.7 0.5 2.9 1.3 3.8 0.3 0.5 0.5 0.6 0.3 1.1 -0.2 0.3-0.3 1.3-0.5 1.6 -0.2 0.5-0.5 0.6-1 0.5 -2.7-1.1-4-4.1-4-7.5 0-5.7 4.6-12.4 13.8-12.4 7.5 0 12.2 5.4 12.2 11.1C38 27.9 33.9 33.6 27.5 33.6z"/></svg></a></div>'; 
    }


return '<div id="social-share" class="social">' . $facebookCode . $twitterCode . $googleCode . $linkedinCode . $tumblrCode  . $pinterestCode  . '</div>';
  
}

function hex2rgb($hex) {
  $hex = str_replace("#", "", $hex);
  
  if(strlen($hex) == 3) {
  $r = hexdec(substr($hex,0,1).substr($hex,0,1));
  $g = hexdec(substr($hex,1,1).substr($hex,1,1));
  $b = hexdec(substr($hex,2,1).substr($hex,2,1));
  } else {
  $r = hexdec(substr($hex,0,2));
  $g = hexdec(substr($hex,2,2));
  $b = hexdec(substr($hex,4,2));
  }
  $rgb = array($r, $g, $b);
  
  //return $rgb; // returns an array with the rgb values
  
  $Final_Rgb_color = implode(", ", $rgb);
  
  return $Final_Rgb_color;
}

function is_blog () {
	global  $post;
	$posttype = get_post_type($post );
	return ( ((is_archive()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_tag())) && ( $posttype == 'post')  ) ? true : false ;
}

add_image_size( 'sidebar-thumb', 50, 50, true );

function position() {

	$labels = array(
		'name'                => _x( 'Positions', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Position', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Open Positions', 'text_domain' ),
		'name_admin_bar'      => __( 'Open Positions', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Item:', 'text_domain' ),
		'all_items'           => __( 'All Positions', 'text_domain' ),
		'add_new_item'        => __( 'Add New Position', 'text_domain' ),
		'add_new'             => __( 'Add New', 'text_domain' ),
		'new_item'            => __( 'New Position', 'text_domain' ),
		'edit_item'           => __( 'Edit Position', 'text_domain' ),
		'update_item'         => __( 'Update Position', 'text_domain' ),
		'view_item'           => __( 'View Position', 'text_domain' ),
		'search_items'        => __( 'Search Position', 'text_domain' ),
		'not_found'           => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
	);
	$args = array(
		'label'               => __( 'Position', 'text_domain' ),
		'description'         => __( 'Open job positions', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-index-card',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => false,
		'can_export'          => true,
		'has_archive'         => false,		
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'position', $args );

}
add_action( 'init', 'position', 0 );

function team_member() {

	$labels = array(
		'name'                => _x( 'Team Members', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Team Member', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Team Members', 'text_domain' ),
		'name_admin_bar'      => __( 'Team Members', 'text_domain' ),
		'parent_item_colon'   => __( 'Team Member:', 'text_domain' ),
		'all_items'           => __( 'All Team Members', 'text_domain' ),
		'add_new_item'        => __( 'Add New Team Member', 'text_domain' ),
		'add_new'             => __( 'Add New Team Member', 'text_domain' ),
		'new_item'            => __( 'New Team Member', 'text_domain' ),
		'edit_item'           => __( 'Edit Team Member', 'text_domain' ),
		'update_item'         => __( 'Update Team Member', 'text_domain' ),
		'view_item'           => __( 'View Team Member', 'text_domain' ),
		'search_items'        => __( 'Search Team Member', 'text_domain' ),
		'not_found'           => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
	);
	$args = array(
		'label'               => __( 'Team Member', 'text_domain' ),
		'description'         => __( 'Post Type Description', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail', ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-businessman',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => false,
		'can_export'          => true,
		'has_archive'         => false,		
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'team_member', $args );

}
add_action( 'init', 'team_member', 0 );

function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

add_filter('the_content', 'filter_ptags_on_images');

function my_acf_load_field( $field ) {
  
  $theme_fonts = get_field('theme_fonts', 'option');
  
  $font_choices = array();
  
  if($theme_fonts)
  {  
    foreach($theme_fonts as $theme_font)
    {
      $font = $theme_font['theme_font'];
      
      array_push($font_choices, $font["font"]);
    }
  }
  
  $field['choices'] = $font_choices;
  
  return $field;
    
}

add_filter('acf/load_field/key=field_5602e24562fc3', 'my_acf_load_field');
add_filter('acf/load_field/key=field_56043cbf10409', 'my_acf_load_field');
add_filter('acf/load_field/key=field_56043d901040e', 'my_acf_load_field');