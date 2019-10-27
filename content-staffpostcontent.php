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
	$pm_disable_share_feature = get_post_meta(get_the_ID(), 'pm_disable_share_feature', true);
	$pm_staff_quote_meta = get_post_meta(get_the_ID(), 'pm_staff_quote_meta', true);
	
?>
                	
<!-- Staff profile item -->
<div class="pm-staff-profile-item-container single-post">
	   
       	<img src="<?php echo esc_url(esc_html($pm_staff_image_meta)); ?>" alt="<?php the_title(); ?>" />
    
    
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
    
<div class="pm-staff-profile-item-name" style="margin-bottom:40px;">
    <p class="name"><?php the_title(); ?></p>
    <div class="pm-staff-item-divider"></div>
    <p class="title"><?php echo esc_attr($pm_staff_title_meta); ?></p>
</div>
<!-- Staff profile item end -->

<?php the_content(); ?>

<?php if($pm_disable_share_feature === 'no') : ?>
	<?php get_template_part('content','sharewithfriends'); ?>
<?php endif; ?>