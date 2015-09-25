<?php 
  $page_for_posts = get_option( 'page_for_posts' );  
  $postid = get_the_ID();
  
  $item_id = (is_blog()) ? $page_for_posts : $postid; 
  
  $title = get_sub_field('title', $item_id);
  $phone = (get_sub_field('phone', $item_id)) ? '<div class="location-item-table-row phone"><div class="location-item-table-cell label">Phone:</div><div class="location-item-table-cell">' . get_sub_field('phone', $item_id) . '</div></div>' : '';
  $website = (get_sub_field('website', $item_id)) ? '<div class="location-item-table-row"><div class="location-item-table-cell label">Website:</div><div class="location-item-table-cell"><a href="' . get_sub_field('website', $item_id) . '"target="_blank" class="location-website">' . get_sub_field('website', $item_id) . '</a></div></div>' : '';
  $location = get_sub_field('location', $item_id);
  $location_string = $location['address'];
  $location_split = explode( ',', $location_string, 2 );
  $address_line_1 = $location_split[0];
  $address_line_2 = $location_split[1];
  $company_logo = (get_sub_field('company_logo', $item_id)) ? '<div class="company-logo" style="background: url(' . get_sub_field('company_logo', $item_id) . ') center no-repeat; background-size: contain;"></div>' : '<div class="company-logo" style="background: #e2e2e1 url(' . get_field('favicon', 'option') . ') center no-repeat; background-size: contain;"></div>';
?>
<div class="location-item">
  <div class="location-item-title-row"><?php echo $company_logo . ' <div><h4 class="location-item-title">' . $title . '</h4></div> '; ?></div>
  <div class="location-item-table">
    <div class="location-item-table-row">
      <div class="location-item-table-cell label">
        Address:
      </div>
      <div class="location-item-table-cell address">
        <div class="address_line_1"><?php echo $address_line_1; ?></div>
        <div class="address_line_2"><?php echo $address_line_2; ?></div>
      </div>
    </div>
    <?php echo $phone ?>
    <?php echo $website; ?>
  </div>
</div>