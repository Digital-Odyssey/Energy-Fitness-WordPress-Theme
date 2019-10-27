<?php  $enableTooltip = get_theme_mod('enableTooltip', 'on'); ?>

<div class="pm-share-post-container">
    <p><?php esc_attr_e('Share this:','energytheme'); ?></p>
    
    <ul class="pm-post-social-icons">
        <li class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top tw' : 'tw' ?>" <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Twitter', 'energytheme') .'"' : '' ?>> 
            <div class="pm-post-social-icon-diamond"></div>
            <a href="https://twitter.com/share?url=<?php echo urlencode(get_the_permalink()); ?>&amp;text=<?php echo urlencode(get_the_title()); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
        </li>
        
        <li class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top fb' : 'fb' ?>" <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Facebook', 'energytheme') .'"' : '' ?>> 
            <div class="pm-post-social-icon-diamond"></div>
            <a href="http://www.facebook.com/share.php?u=<?php echo urlencode(get_the_permalink()); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
        </li>
        
        <li class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top gp' : 'gp' ?>" <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Google Plus', 'energytheme') .'"' : '' ?>> 
            <div class="pm-post-social-icon-diamond"></div>
            <a href="https://plus.google.com/share?url=<?php echo urlencode(get_the_permalink()); ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
        </li>
        <li class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top linked' : 'linked' ?>" <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Linkedin', 'energytheme') .'"' : '' ?>> 
            <div class="pm-post-social-icon-diamond"></div>
            <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo get_permalink(); ?>&title=<?php echo get_the_title(); ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
        </li>
        <li class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top yt' : 'yt' ?>" <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Reddit', 'energytheme') .'"' : '' ?>> 
            <div class="pm-post-social-icon-diamond"></div>
            <a href="http://reddit.com/submit?url=<?php echo urlencode(get_the_permalink()); ?>&amp;title=<?php echo urlencode(get_the_title()); ?>" target="_blank"><i class="fa fa-reddit"></i></a>
        </li>
        <li class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top st' : 'st' ?>" <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('StumbleUpon', 'energytheme') .'"' : '' ?>> 
            <div class="pm-post-social-icon-diamond"></div>
            <a href="http://www.stumbleupon.com/submit?url=<?php echo urlencode(get_the_permalink()); ?>&amp;title=<?php echo urlencode(get_the_title()); ?>" target="_blank"><i class="fa fa-stumbleupon"></i></a>
        </li>
    </ul>
    
</div>