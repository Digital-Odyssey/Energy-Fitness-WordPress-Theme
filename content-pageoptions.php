<?php
//Use this file to display page options (print and share icons)

$enableTooltip = get_theme_mod('enableTooltip', 'on');

?>

<div class="pm-page-share-options">
						
    <a href="#" class="pm-square-btn print" id="pm-print-btn" target="_self" >print page <i class="fa fa-print"></i></a>
    
    <ul class="pm-page-social-icons">
    
        <li class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top gp' : 'gp' ?>" <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Google Plus', 'energytheme') .'"' : '' ?>>
        	<div class="pm-page-social-icon-diamond"></div>
        	<a href="https://plus.google.com/share?url=<?php urlencode(the_permalink()); ?>" title="<?php esc_attr_e('Share on Google Plus', 'energytheme'); ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
        </li>
        
        <li class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top tw' : 'tw' ?>" <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Twitter', 'energytheme') .'"' : '' ?>>
        	<div class="pm-page-social-icon-diamond"></div>
        	<a href="http://twitter.com/home?status=<?php urlencode(the_title()); ?>" title="<?php esc_attr_e('Share on Twitter', 'energytheme'); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
        </li>
        
        <li class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top fb' : 'fb' ?>" <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Facebook', 'energytheme') .'"' : '' ?>>
        	<div class="pm-page-social-icon-diamond"></div>
        	<a href="http://www.facebook.com/share.php?u=<?php urlencode(the_permalink()); ?>" title="<?php esc_attr_e('Share on Facebook', 'energytheme'); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
        </li>
        
        <li class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top linked' : 'linked' ?>" <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Linkedin', 'energytheme') .'"' : '' ?>>
        	<div class="pm-page-social-icon-diamond"></div>
        	<a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(site_url()); ?>&title=<?php urlencode(the_title()); ?>&summary=<?php urlencode(the_title()); ?>&source=<?php echo urlencode(site_url()); ?>" title="<?php esc_attr_e('Share on LinkedIn', 'energytheme'); ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
        </li>
        
    </ul>
    
</div>