<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"> <h1 style="color:grey;">UNSUPPORTED BROWSER. PLEASE UPGRADE YOUR BROWSER TO <a href="http://windows.microsoft.com/en-CA/internet-explorer/downloads/ie-9/worldwide-languages">IE 9 OR HIGHER</a></h1> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"> <h1 style="color:grey;">UNSUPPORTED BROWSER. PLEASE UPGRADE YOUR BROWSER TO <a href="http://windows.microsoft.com/en-CA/internet-explorer/downloads/ie-9/worldwide-languages">IE 9 OR HIGHER</a></h1> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"> <h1 style="color:grey;">UNSUPPORTED BROWSER. PLEASE UPGRADE YOUR BROWSER TO <a href="http://windows.microsoft.com/en-CA/internet-explorer/downloads/ie-9/worldwide-languages">IE 9 OR HIGHER</a></h1> <![endif]-->
<html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        
	<!-- Atoms & Pingback -->
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
    <link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
    <link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />    
    
    <?php 
		
	//Redux options
	global $energy_options;
	//print_r($energy_options);
		
	?> 
                        
    <?php wp_head(); ?>
</head>

<?php 

$enableTooltip = get_theme_mod('enableTooltip', 'on');

//Color sampler
$colorSampler = get_theme_mod('colorSampler', 'off');

//Layout Options
$enableBoxMode = get_theme_mod('enableBoxMode', 'off');

//Header options
$companyLogo = get_theme_mod('companyLogo', get_template_directory_uri() . '/img/energy-fitness.png');
$companyLogoAltTag = get_theme_mod('companyLogoAltTag', "Energy Fitness");
$companyLogoURL = get_theme_mod('companyLogoURL', "");
$enableLanguageSelector = get_theme_mod('enableLanguageSelector', 'off');
$enableCart = get_theme_mod('enableCart', 'off');
$enableAddress = get_theme_mod('enableAddress', 'on');
$enableHours = get_theme_mod('enableHours', 'on');
$enableSearch = get_theme_mod('enableSearch', 'on');
$enableSubMenu = get_theme_mod('enableSubMenu', 'on');


//Business info
$businessPhone = get_theme_mod('businessPhone', "(1) 800 555-5555");
$businessEmail = get_theme_mod('businessEmail', "info@energyfitness.com");

//Pulse slider options
$enablePulseSlider = get_theme_mod('enablePulseSlider', 'on');
$enableControlNav = get_theme_mod('enableControlNav', 'true');
$enableFixedHeight = get_theme_mod('enableFixedHeight', 'true');

//Energy options
$customSlider = $energy_options['opt-custom-slider'];

$woocommShopLayout = get_theme_mod('woocommShopLayout', 'no-sidebar');
$woocommLayout = 'woocomm-' . $woocommShopLayout;

?>

<body <?php body_class($woocommLayout); ?>>

<?php if($colorSampler === 'on') { ?>

	<?php get_template_part('content', 'themesampler'); ?>

<?php } ?>

<?php if($enableBoxMode === 'on') { ?>
     <div class="pm-boxed-mode" id="pm_layout_wrapper">
<?php } else { ?>
     <div class="pm-full-mode" id="pm_layout_wrapper">
<?php }?>
	
		<!-- Sub-Menu -->
        <div class="pm-sub-menu-container<?php echo $enableSubMenu === 'on' ? '' : ' hide-sub-menu'; ?>">
    
            <div class="container">
            
                <div class="row">
                    
                    <div class="col-lg-6 col-md-6 col-sm-6">
                    
                        <div class="pm-sub-menu-mobile-logo">
                            
                            <a href="<?php echo $companyLogoURL !== "" ? esc_html($companyLogoURL) : site_url(); ?>">
                                <img src="<?php echo esc_html($companyLogo); ?>" class="img-responsive" alt="<?php echo esc_attr($companyLogoAltTag); ?>">
                            </a>  
                            
                        </div>
                        
                        <div class="pm-sub-menu-info">
                        
                            <?php if($businessPhone !== '') : ?>
                                <p class="pm-contact"><i class="fa fa-mobile-phone"></i> <a href="tel:<?php echo esc_attr($businessPhone); ?>"><?php echo esc_attr($businessPhone); ?></a></p>
                            <?php endif; ?> 
                            
                            <?php if($businessEmail !== '') : ?>
                                <p class="pm-address"><i class="fa fa-envelope"></i> <a href="mailto:<?php echo esc_attr($businessEmail); ?>"><?php echo esc_attr($businessEmail); ?></a></p>
                            <?php endif; ?>    	
                                                        
                        </div>
                                                
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <ul class="pm-sub-navigation">
                        
                            <?php if($enableLanguageSelector === 'on') : ?>
                            
                                <?php pm_ln_icl_post_languages(); ?> 
                                
                            <?php endif; ?> 
                            
                            <?php if($enableCart === 'on' && function_exists('is_shop')) : ?>
                            
                                <?php global $woocommerce; ?>
                                
                                <li>
                                    <a href="<?php echo site_url('cart'); ?>" id="pm-cart-btn">
                                        <i class="typcn typcn-shopping-cart"></i>
                                        <div class="pm-cart-icon-count"><?php echo $woocommerce->cart->cart_contents_count; ?></div>
                                    </a>
                                </li>
                            <?php endif; ?> 
                            
                            <?php if($enableHours === 'on') : ?>
                                
                                <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Hours', 'energytheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_bottom' : '' ?>">
                                    <a href="#" id="pm-hours-btn"><i class="fa fa-clock-o"></i></a>
                                </li>
                            <?php endif; ?> 
                            
                            <?php if($enableAddress === 'on') : ?>
                                <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Location', 'energytheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_bottom' : '' ?>">
                                    <a href="#" id="pm-location-btn"><i class="typcn typcn-location"></i></a>
                                </li>
                            <?php endif; ?> 
                            
                            <?php if($enableSearch === 'on') : ?>
                                <li <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Search', 'energytheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_bottom' : '' ?>">
                                    <a href="#" id="pm-search-btn"><i class="fa fa-search"></i></a>
                                </li>
                            <?php endif; ?> 
                            
                            
                        </ul>
                    </div>
                    
                    
                </div>
            
            </div>
            
        </div>
        <!-- /Sub-header -->
        
        <!-- Expandable fields -->        
        <div class="pm-search-container" id="pm-search-container">
        	
            <div class="container">
            	
                <div class="row">
                
                	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                    	
                        <?php $searchFieldText = get_theme_mod('searchFieldText', esc_attr__('Type Keywords...','energytheme')); ?>
                        
                        <form name="searchform" id="pm-searchform" method="get" action="<?php echo home_url( '/' ); ?>">
                        	<input type="text" class="pm-search-field-input" name="s" placeholder="<?php echo esc_attr($searchFieldText); ?>">
                        </form>
                        
                    </div>
                    
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    	
                        <ul class="pm-search-field-icons">
                        
                            <li><a href="#" class="fa fa-close" id="pm-search-exit"></a></li>
                        
                        </ul>
                        
                    </div>
                
                </div>
                
            </div>
            
        </div>
        
        <?php 
		
			$hours_column1 = $energy_options['opt-hours-column1']; 
			$hours_column2 = $energy_options['opt-hours-column2']; 
			$hours_column3 = $energy_options['opt-hours-column3']; 
			$hours_column4 = $energy_options['opt-hours-column4']; 
			$hours_column5 = $energy_options['opt-hours-column5']; 
		
		?>
        
        <div class="pm-hours-container" id="pm-hours-container">
        
        	<div class="container">
            
            	<div class="row">
                
                	<div class="col-lg-2 col-md-2 col-sm-6 pm-hour-col">
                    	<?php echo html_entity_decode($hours_column1); ?>
                    </div>
                    
                    <div class="col-lg-2 col-md-2 col-sm-6 pm-hour-col">
                    	<?php echo html_entity_decode($hours_column2); ?>
                    </div>
                    
                    <div class="col-lg-2 col-md-2 col-sm-6 pm-hour-col">
                    	<?php echo html_entity_decode($hours_column3); ?>
                    </div>
                    
                    <div class="col-lg-2 col-md-2 col-sm-6 pm-hour-col">
                    	<?php echo html_entity_decode($hours_column4); ?>
                    </div>
                    
                    <div class="col-lg-2 col-md-2 col-sm-6 pm-hour-col">
                    	<?php echo html_entity_decode($hours_column5); ?>
                    </div>
                    
                    <div class="col-lg-2 col-md-2 col-sm-12 pm-close-col">
                    	<a href="#" class="pm-hours-exit fa fa-close" id="pm-hours-exit"></a>
                    </div>
                
                </div>
            
            </div>
        
        </div>
        
        <div class="pm-address-container" id="pm-address-container">
        
        	<div class="container">
            
            	<div class="row">
                
                	<?php 
						$location_switch = $energy_options['opt-location-switch']; 
						$more_locations_link = $energy_options['opt-more-locations-link']; 
						$location_address = $energy_options['opt-location-address']; 
						$location_map = $energy_options['opt-location-map']; 
					?>
                
                	<div class="col-lg-9 col-md-9 col-sm-9">
                    	<p class="pm-primary-address"><?php echo $location_address; ?></p>
                    </div>
                    
                    <div class="col-lg-3 col-md-3 col-sm-3">
                    	<a href="#" class="pm-address-exit fa fa-close" id="pm-address-exit"></a>
                        
                        <?php if($location_switch) : ?>
                        	<p class="pm-view-all-addresses"><a href="<?php echo esc_html($more_locations_link); ?>"><?php esc_attr_e('View all locations','energytheme') ?></a></p>
                        <?php endif ?>
                    	
                    </div>
                                    
                </div>
            
            </div>
            
            <?php if($location_map !== '') : ?>
            
            	<div class="pm-google-map-box">
					<?php echo html_entity_decode($location_map); ?>
                </div>
            
            <?php endif ?>
        
        </div>
        <!-- Expandable fields end -->
    
    	<!-- Main navigation -->
        <header class="<?php echo $enableFixedHeight === 'false' ? ' scalable' : '' ?>">
                
        	<div class="container">
            
            	<div class="row">
                	
                    <div class="col-lg-4 col-md-4 col-sm-12">
                    	
                        <div class="pm-header-logo-container">
                    		<a href="<?php echo $companyLogoURL !== "" ? esc_html($companyLogoURL) : site_url(); ?>">
                            	<img src="<?php echo esc_html($companyLogo); ?>" class="img-responsive pm-header-logo" alt="<?php echo esc_attr($companyLogoAltTag); ?>">
                            </a> 
                        </div>
                        
                        <div class="pm-header-mobile-btn-container"></div>
                    
                    </div>
                    
                    <div class="col-lg-8 col-md-8 col-sm-8 pm-main-menu">
                                        
                    	<nav class="navbar-collapse collapse" id="pm-main-navigation">
                        
                        	<?php
                                wp_nav_menu(array(
                                    'container' => '',
                                    'container_class' => '',
                                    'menu_class' => 'sf-menu pm-nav',
                                    'menu_id' => 'pm-main-nav',
                                    'theme_location' => 'main_menu',
                                    'fallback_cb' => 'pm_ln_main_menu',
                                   )
                                );
                            ?>
                        
                        </nav>  
                                              
                    </div>
                    
                </div>
            
            </div>
                    
        </header>
        <!-- /Main navigation -->
    
    <?php if(is_home() || is_front_page()) {//Display Pulse Slider ?>
    
    	<!-- SLIDER AREA -->
        <?php if($enablePulseSlider === 'on') : ?>
        
			<?php 
				global $energy_options;
				
				$slides = '';
				
				if( isset($energy_options['opt-pulse-slider-slides']) && !empty($energy_options['opt-pulse-slider-slides']) ){
					$slides = $energy_options['opt-pulse-slider-slides'];
				}
			?>
            
            <?php 
			
				
				$allowed_html = array(
					'strong' => array(),
					'span' => array(),
				);
							
				
				$sliderCounter = 0;
				
				if(is_array($slides)) :
					
					if(count($slides) > 0){
					
						echo '<div class="pm-pulse-container" id="pm-pulse-container">';
						
							echo '<div id="pm-pulse-loader"><img src="'.get_template_directory_uri().'/js/pulse/img/ajax-loader.gif" alt="slider loading" /></div>';
							
							echo '<div id="pm-slider" class="pm-slider'. ($enableFixedHeight === 'false' ? ' scalable' : '') .'">';
							
								echo '<div id="pm-slider-progress-bar"></div>';
								
								echo '<ul class="pm-slides-container" id="pm_slides_container">';
								
									foreach($slides as $s) {
										
										$btnText = '';
										$btnUrl = '';
										
										if(!empty($s['url'])){
											
											if( strrchr ( $s['url'] , " - " ) ){
												$pieces = explode(" - ", $s['url']);
												$btnText = $pieces[0];
												$btnUrl = $pieces[1];
											}
											
										}
										
										echo '<li data-thumb="'.esc_url(esc_html($s['image'])).'" class="pmslide_'.$sliderCounter.'"><img src="'.esc_url(esc_html($s['image'])).'" alt="Slider image '.$sliderCounter.'" />';
							
											echo '<div class="pm-holder-bg'. ($enableFixedHeight === 'false' ? ' scalable' : '') .'">';
											
												echo '<div class="pm-holder'. ($enableFixedHeight === 'false' ? ' scalable' : '') .'">';
													echo '<div class="pm-caption'. ($enableFixedHeight === 'false' ? ' scalable' : '') .'">';
														  if( !empty($s['title']) ){
															  echo '<h1>'.wp_kses($s['title'], $allowed_html).'</h1>';
														  }
														  if( !empty($s['description']) ){
															  echo '<span class="pm-caption-decription'. ($enableFixedHeight === 'false' ? ' scalable' : '') .'">';
																echo esc_attr($s['description']);
															  echo '</span>';
														  }
														  
														  if($btnText !== ''){
															 echo '<a href="'.esc_html($btnUrl).'" class="pm-slide-btn'. ($enableFixedHeight === 'false' ? ' scalable' : '') .'">'.esc_attr($btnText).'</a>'; 
														  }
													echo '</div>';
												echo '</div>';
											
											echo '</div>';										
										
										echo '</li>';
										
										$sliderCounter++;
												
									}
																
								echo '</ul>';
							
							echo '</div>';
							
							if($enableControlNav === 'true') :
								echo '<div class="pm-pulse-arrow"></div>';
							endif;
						
						echo '</div>';
						
					}//end of if
					
				endif;//end if
			
				
			
			?> 
        
        <?php endif; ?>
        
        <?php 
		
			if($customSlider !== '' && $enablePulseSlider === 'off') { 
        	   echo do_shortcode($customSlider);
        	} 
			
		?>
            
    <?php } else {//display sub-header ?>
        
        <?php $displaySubHeader = get_theme_mod('displaySubHeader','on'); ?>
        
        <?php if($displaySubHeader === 'on') : ?>
        	<?php get_template_part('content', 'subheader'); ?>
        <?php endif; ?>
            
<?php } ?>