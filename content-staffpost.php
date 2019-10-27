<?php
/**
 * The default template for displaying a staff post item.
 */
?>

<?php 
            
	$pm_staff_image_meta = get_post_meta(get_the_ID(), 'pm_staff_image_meta', true);
	$pm_staff_title_meta = get_post_meta(get_the_ID(), 'pm_staff_title_meta', true);
	$pm_staff_twitter_meta = get_post_meta(get_the_ID(), 'pm_staff_twitter_meta', true);
	$pm_staff_facebook_meta = get_post_meta(get_the_ID(), 'pm_staff_facebook_meta', true);
	$pm_staff_gplus_meta = get_post_meta(get_the_ID(), 'pm_staff_gplus_meta', true);
	$pm_staff_linkedin_meta = get_post_meta(get_the_ID(), 'pm_staff_linkedin_meta', true);
	
	$pm_staff_instagram_meta = get_post_meta(get_the_ID(), 'pm_staff_instagram_meta', true);
	
	$pm_staff_email_address_meta = get_post_meta(get_the_ID(), 'pm_staff_email_address_meta', true);
	$pm_staff_quote_meta = get_post_meta(get_the_ID(), 'pm_staff_quote_meta', true);
	
?>

<?php 
$terms = get_the_terms($post->ID, 'staff_titles' );
$terms_slug_str = '';
if ($terms && ! is_wp_error($terms)) :
	$term_slugs_arr = array();
	foreach ($terms as $term) {
	    $term_slugs_arr[] = $term->slug;
	}
	$terms_slug_str = join( " ", $term_slugs_arr);
endif;
?>


<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 pm-column-spacing pm-isotope-item <?php echo $terms_slug_str != '' ? esc_attr($terms_slug_str) : ''; ?> all">
                    	
    <!-- Staff profile item -->
    <div class="pm-staff-profile-item-container" style="background-image:url(<?php echo esc_html($pm_staff_image_meta); ?>);">
        
           <div class="pm-staff-profile-item-details-container">
            
                <div class="pm-staff-profile-item-details">
                
                    <a href="#" class="pm-staff-profile-item-details-btn fa fa-chevron-up">
                    	<div class="pm-class-post-diamond-shadow"></div>
                		<div class="pm-class-post-diamond"></div>
                    </a>
                    
                    
                    <p class="pm-staff-profile-item-excerpt"><?php echo esc_attr($pm_staff_quote_meta); ?></p>
                    
                    <div class="pm-staff-profile-item-details-divider"></div>
                    
                    <p><a href="<?php the_permalink(); ?>" class="pm-staff-profile-item-view-profile"><?php esc_attr_e('View profile', 'energytheme') ?></a></p>
                    
                    <?php if($pm_staff_email_address_meta !== '') : ?>
                    	<a href="mailto:<?php echo esc_attr($pm_staff_email_address_meta); ?>" class="pm-staff-profile-item-email-btn fa fa-envelope"></a>
                    <?php endif; ?>
                    
                </div>
            
            </div>
        
        
            <div class="pm-staff-profile-item-social-icons-container">
            
                <ul class="pm-staff-profile-item-social-icons">
                
                    <?php if($pm_staff_twitter_meta !== '') : ?>
                    
                        <li>
                            <div class="pm-staff-item-social-icon-diamond"></div>
                            <a href="<?php echo esc_html($pm_staff_twitter_meta); ?>" target="_blank" class="fa fa-twitter"></a>
                        </li>
                    
                    <?php endif; ?>
                
                    <?php if($pm_staff_facebook_meta !== '') : ?>
                    
                        <li>
                            <div class="pm-staff-item-social-icon-diamond"></div>
                            <a href="<?php echo esc_html($pm_staff_facebook_meta); ?>" target="_blank" class="fa fa-facebook"></a>
                        </li>
                    
                    <?php endif; ?>
                    
                    <?php if($pm_staff_gplus_meta !== '') : ?>
                    
                        <li>
                            <div class="pm-staff-item-social-icon-diamond"></div>
                            <a href="<?php echo esc_html($pm_staff_gplus_meta); ?>" target="_blank" class="fa fa-google-plus"></a>
                        </li>
                    
                    <?php endif; ?>
                    
                    <?php if($pm_staff_linkedin_meta !== '') : ?>
                    
                        <li>
                            <div class="pm-staff-item-social-icon-diamond"></div>
                            <a href="<?php echo esc_html($pm_staff_linkedin_meta); ?>" target="_blank" class="fa fa-linkedin"></a>
                        </li>
                    
                    <?php endif; ?>
                                        
                    
                    <?php if($pm_staff_instagram_meta !== '') : ?>
                    
                        <li>
                            <div class="pm-staff-item-social-icon-diamond"></div>
                            <a href="<?php echo esc_html($pm_staff_instagram_meta); ?>" target="_blank" class="fa fa-instagram"></a>
                        </li>
                    
                    <?php endif; ?>
                    
                </ul>
            
            </div> 
        
    </div>
        
    <div class="pm-staff-profile-item-name">
        <p class="name"><?php the_title(); ?></p>
        <div class="pm-staff-item-divider"></div>
        <p class="title"><?php echo esc_attr($pm_staff_title_meta); ?></p>
    </div>
    <!-- Staff profile item end -->

</div>