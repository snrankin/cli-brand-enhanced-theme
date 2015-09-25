<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width">
<title><?php wp_title( ' | ', true, 'right' ); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />

<?php //Theme Variables 
  $favicon = get_field('favicon', 'option');
?>

<?php if ($favicon) : ?>

<link rel="shortcut icon" href="<?php echo $favicon; ?>" type="image/x-icon" />

<?php endif; ?>

<?php wp_head(); ?>

<?php
  
  $theme_fonts = get_field('theme_fonts', 'option');
  
  if($theme_fonts)
  {
    echo '<script>WebFont.load({ google: { families: [';  
    foreach($theme_fonts as $theme_font)
    {
      $font = $theme_font['theme_font'];
      
      $font_variants = $font["variants"];
      
      $variants = implode(",", $font_variants);
      
      echo "'" . $font["font"] . ': ' . $variants . "', ";
    }
    echo ']}});</script>';
  }

?>

</head>
<body <?php body_class(); ?> >
<div id="top"></div>
<div id="wrapper" class="hfeed">
<?php get_template_part('templates/site-header') ?>
<div id="container">