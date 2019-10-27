<?php 

//Redux options
global $energy_options;

$enableTooltip = get_theme_mod('enableTooltip', 'on');

//Header options
$companyLogoAltTag = get_theme_mod('companyLogoAltTag');
$companyLogoURL = get_theme_mod('companyLogoURL');

//Footer Options
$footerLogo = get_theme_mod('footerLogo');
$toggle_fatfooter = get_theme_mod('toggle_fatfooter', 'on');
$toggle_socialFooter = get_theme_mod('toggle_socialFooter', 'on');
$toggle_footerNav = get_theme_mod('toggle_footerNav', 'on');
$copyrightNotice = $energy_options['opt-copyrightNotice'];
$socialFooterCTA = get_theme_mod('socialFooterCTA', esc_attr__( 'Connect with us!', 'energytheme' )); 

//Business info
$facebooklink = get_theme_mod('facebooklink', '');
$twitterlink = get_theme_mod('twitterlink', '');
$googlelink = get_theme_mod('googlelink', '');
$linkedinLink = get_theme_mod('linkedinLink', '');
$vimeolink = get_theme_mod('vimeolink', '');
$youtubelink = get_theme_mod('youtubelink', '');
$dribbblelink = get_theme_mod('dribbblelink', '');
$pinterestlink = get_theme_mod('pinterestlink', '');
$instagramlink = get_theme_mod('instagramlink', '');
$skypelink = get_theme_mod('skypelink', '');
$flickrlink = get_theme_mod('flickrlink', '');
$tumblrlink = get_theme_mod('tumblrlink', '');
$stumbleuponlink = get_theme_mod('stumbleuponlink', '');
$redditlink = get_theme_mod('redditlink', '');
$rssLink = get_theme_mod('rssLink', '');

$toggleParallaxFooter = get_theme_mod('toggleParallaxFooter', 'on');


//Layout Options
$footerLayout = get_theme_mod('footerLayout', 'footer-four-columns');


?>

		<?php if($toggle_fatfooter == 'on') { ?>
            
            <div class="pm-fat-footer<?php echo $toggleParallaxFooter === 'on' ? ' pm-parallax-panel' : ''; ?>"  <?php echo $toggleParallaxFooter === 'on' ? 'data-stellar-background-ratio="0.5"' : ''; ?>>
                
                <div class="container">
                    <div class="row">
                    
                    	<!-- Widget layouts -->   
                        
                        <?php if($footerLayout == 'footer-three-wide-left') { ?>
                    
                            <div class="col-lg-6 col-md-6 col-sm-6 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column 1")) ; ?>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column 2")) ; ?>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column 3")) ; ?>
                            </div>
                                            
                        <?php } ?>
                        
                        <?php if($footerLayout == 'footer-three-wide-right') { ?>
                        
                            <div class="col-lg-3 col-md-3 col-sm-3 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column 1")) ; ?>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column 2")) ; ?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column 3")) ; ?>
                            </div>
                                            
                        <?php } ?>
                        
                        <?php if($footerLayout == 'footer-one-column') { ?>
                        
                            <div class="col-lg-12 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column 1")) ; ?>
                            </div>
                                            
                        <?php } ?>
                        
                        <?php if($footerLayout == 'footer-two-columns') { ?>
                        
                            <div class="col-lg-6 col-md-6 col-sm-6 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column 1")) ; ?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column 2")) ; ?>
                            </div>
                                            
                        <?php } ?>
                    
                        <?php if($footerLayout == 'footer-three-columns') { ?>
                        
                            <div class="col-lg-4 col-md-4 col-sm-4 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column 1")) ; ?>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column 2")) ; ?>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column 3")) ; ?>
                            </div>
                                            
                        <?php } ?>
                        
                        <?php if($footerLayout == 'footer-four-columns') { ?>
                                                        
                                <div class="col-lg-3 col-md-6 col-sm-12 pm-widget-footer">
                                    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column 1")) ; ?>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12 pm-widget-footer">
                                    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column 2")) ; ?>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12 pm-widget-footer">
                                    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column 3")) ; ?>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12 pm-widget-footer">
                                    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column 4")) ; ?>
                                </div>
                        
                        <?php } ?>
                        
                        <!-- Widget layouts end -->                    
                        
                    </div>	
                </div>
                
            </div>
        
        <?php } ?>
    
		<?php if($toggle_socialFooter == 'on') { ?>

        
            <footer>
            
                <div class="pm-footer-triangle-data">
                
                    <ul class="pm-footer-social-icons">
                    
                    	<?php if($facebooklink !== '') : ?>
                            <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Facebook', 'energytheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top fb' : 'fb' ?>">
                            	<div class="pm-social-icon-diamond"></div>
                            	<a href="<?php echo esc_html($facebooklink); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                            </li>
                        <?php endif; ?>
                        
                        <?php if($twitterlink !== '') : ?>
                            <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Twitter', 'energytheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top tw' : 'tw' ?>">
                            	<div class="pm-social-icon-diamond"></div>
                                <a href="<?php echo esc_html($twitterlink); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                            </li>
                        <?php endif; ?>
                        
                        <?php if($googlelink !== '') : ?>
                            <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Google Plus', 'energytheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top gp' : 'gp' ?>">
                            	<div class="pm-social-icon-diamond"></div>
                                <a href="<?php echo esc_html($googlelink); ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
                            </li>
                        <?php endif; ?>
                    
                        <?php if($linkedinLink !== '') : ?>
                            <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Linkedin', 'energytheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top linked' : 'linked' ?>">
                            	<div class="pm-social-icon-diamond"></div>
                                <a href="<?php echo esc_html($linkedinLink); ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
                            </li>
                        <?php endif; ?>
                        
                        <?php if($vimeolink !== '') : ?>
                            <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Vimeo', 'energytheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top vimeo' : 'vimeo' ?>">
                            	<div class="pm-social-icon-diamond"></div>
                                <a href="<?php echo esc_html($vimeolink); ?>" target="_blank"><i class="fa fa-vimeo-square"></i></a>
                            </li>
                        <?php endif; ?>
                        
                        <?php if($youtubelink !== '') : ?>
                            <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('YouTube', 'energytheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top yt' : 'yt' ?>">
                            	<div class="pm-social-icon-diamond"></div>
                                <a href="<?php echo esc_html($youtubelink); ?>" target="_blank"><i class="fa fa-youtube"></i></a>
                            </li>
                        <?php endif; ?>
                        
                        <?php if($dribbblelink !== '') : ?>
                            <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Dribbble', 'energytheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top dribbble' : 'dribbble' ?>">
                            	<div class="pm-social-icon-diamond"></div>
                                <a href="<?php echo esc_html($dribbblelink); ?>" target="_blank"><i class="fa fa-dribbble"></i></a>
                            </li>
                        <?php endif; ?>
                        
                        <?php if($pinterestlink !== '') : ?>
                            <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Pinterest', 'energytheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top pinterest' : 'pinterest' ?>">
                            	<div class="pm-social-icon-diamond"></div>
                                <a href="<?php echo esc_html($pinterestlink); ?>" target="_blank"><i class="fa fa-pinterest"></i></a>
                            </li>
                        <?php endif; ?>
                        
                        
                        <?php if($instagramlink !== '') : ?>
                            <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Instagram', 'energytheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top instagram' : 'instagram' ?>">
                            	<div class="pm-social-icon-diamond"></div>
                                <a href="<?php echo esc_html($instagramlink); ?>" target="_blank"><i class="fa fa-instagram"></i></a>
                            </li>
                        <?php endif; ?>
                        
                        <?php if($skypelink !== '') : ?>
                            <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Skype', 'energytheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top skype' : 'skype' ?>">
                            	<div class="pm-social-icon-diamond"></div>
                                <a href="skype:<?php echo esc_html($skypelink); ?>?call" target="_blank"><i class="fa fa-skype"></i></a>
                            </li>
                        <?php endif; ?>
                        
                        <?php if($flickrlink !== '') : ?>
                            <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Flickr', 'energytheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top flickr' : 'flickr' ?>">
                            	<div class="pm-social-icon-diamond"></div>
                                <a href="<?php echo esc_html($flickrlink); ?>" target="_blank"><i class="fa fa-flickr"></i></a>
                            </li>
                        <?php endif; ?>
                        
                        <?php if($tumblrlink !== '') : ?>
                            <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Tumblr', 'energytheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top tumblr' : 'tumblr' ?>">
                            	<div class="pm-social-icon-diamond"></div>
                                <a href="<?php echo esc_html($tumblrlink); ?>" target="_blank"><i class="fa fa-tumblr"></i></a>
                            </li>
                        <?php endif; ?>
                        
                        <?php if($stumbleuponlink !== '') : ?>
                            <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('StumbleUpon', 'energytheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top stumbleupon' : 'stumbleupon' ?>">
                            	<div class="pm-social-icon-diamond"></div>
                                <a href="<?php echo esc_html($stumbleuponlink); ?>" target="_blank"><i class="fa fa-stumbleupon"></i></a>
                            </li>
                        <?php endif; ?>
                        
                        <?php if($redditlink !== '') : ?>
                            <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Reddit', 'energytheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top reddit' : 'reddit' ?>">
                            	<div class="pm-social-icon-diamond"></div>
                                <a href="<?php echo esc_html($redditlink); ?>" target="_blank"><i class="fa fa-reddit"></i></a>
                            </li>
                        <?php endif; ?>
                        
                        <?php if($rssLink !== '') : ?>
                            <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('RSS Feed', 'energytheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top rss' : 'rss' ?>">
                            	<div class="pm-social-icon-diamond"></div>
                                <a href="<?php echo esc_html($rssLink); ?>" target="_blank"><i class="fa fa-rss"></i></a>
                            </li>
                        <?php endif; ?>
                        
                    </ul>
                    
                    <?php if($socialFooterCTA !== '') : ?>
                    	<h6><?php echo esc_attr($socialFooterCTA); ?></h6>
                    <?php endif; ?>
                    
                    <a class="fa fa-chevron-up" id="pm-back-to-top"></a>
                
            </div>
    
                    
            </footer>
        
        <?php } ?>
    
		<?php if($toggle_footerNav == 'on') { ?>
        
            <div class="pm-footer-copyright">
                
                <div class="container">
                    <div class="row">
                        
                        <div class="col-lg-12 pm-footer-copyright-col pm-column-spacing">
                        	<?php if($footerLogo !== '') : ?>
                            	<a href="<?php echo $companyLogoURL !== '' ? esc_html($companyLogoURL) : site_url(); ?>"><img src="<?php echo esc_html($footerLogo); ?>" class="img-responsive pm-header-logo" alt="<?php echo $companyLogoAltTag; ?>"></a> 
                            <?php endif ?>
                                  
                            
                            <?php 
                            
                                if($copyrightNotice !== ''){ ?>
                                    <p class="pm-footer-copyright-info">&copy; <?php echo date_i18n("Y"); ?> <?php echo $copyrightNotice; ?></p>
                                <?php } else { ?>
                                    <p class="pm-footer-copyright-info">&copy; <?php echo date_i18n("Y"); ?> <?php bloginfo('name');  ?></p>
                                <?php }
                            
                            ?> 
                            
                        </div>
                        
                        <div class="col-lg-12 pm-footer-navigation-col">
                        	<?php
								wp_nav_menu(array(
									'container' => '',
									'container_class' => '',
									'menu_class' => 'pm-footer-navigation',
									'menu_id' => 'pm-footer-nav',
									'theme_location' => 'footer_menu',
									'fallback_cb' => 'pm_ln_footer_menu',
								   )
								);
							?>
                        </div>
                    </div>
                </div>
                
            </div>
        
        <?php } ?>
       
    
	</div><!-- /pm_layout_wrapper -->
                
		<?php wp_footer(); ?> 
    </body>
</html>