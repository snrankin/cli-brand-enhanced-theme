<?php $page_for_posts = get_option( 'page_for_posts' );  
$postid = get_the_ID();

$item_id = (is_blog()) ? $page_for_posts : $postid; if( have_rows('locations', $item_id) ): ?>
  <div>
    <div><select id="locationSelect" style="width:100%;visibility:hidden"></select></div>
  </div>
	<div class="acf-map">
		<?php while ( have_rows('locations', $item_id) ) : the_row();  ?>
		<?php $location = get_sub_field('location', $item_id); ?>
			<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">
				<?php get_template_part('templates/rowlayout', 'location'); ?>
			</div>
	<?php endwhile; ?>
	</div>
<?php endif; ?>

<?php if( have_rows('locations', $item_id) ): ?>
	<div class="locations-list">
		<?php while ( have_rows('locations', $item_id) ) : the_row(); ?>
			<?php get_template_part('templates/rowlayout', 'location'); ?>
	  <?php endwhile; ?>
	</div>
<?php endif; ?>