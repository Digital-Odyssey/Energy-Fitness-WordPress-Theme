<?php

require_once( ABSPATH . WPINC . '/class-wp-customize-control.php' );

class PM_LN_Customizer {
	
	public static function register ( $wp_customize ) {
		
		/*** Remove default wordpress sections ***/
		$wp_customize->remove_section('background_image');
		$wp_customize->remove_section('colors');
		$wp_customize->remove_section('header_image');
		
		/**** Google Options ****/
		$wp_customize->add_section( 'google_options' , array(
			'title'    => esc_html__( 'Google Options', 'luxortheme' ),
			'priority' => 1,
		));
		
		$wp_customize->add_setting(
			'googleAPIKey', array(
				'default' => "",
				'sanitize_callback' => 'esc_attr'
			)
		);

		$wp_customize->add_control(
			'googleAPIKey',
			 array(
				'label' => esc_html__( 'API KEY', 'luxortheme' ),
			 	'section' => 'google_options',
				'description' => __('Insert your Google API key (browser key) to activate Google services such as Google Maps and Google Places.', 'luxortheme'),
				'priority' => 1,
			 )
		);
				
		/**** Header Options ****/
		$wp_customize->add_section( 'header_options' , array(
			'title'    => esc_html__( 'Header Options', 'energytheme' ),
			'priority' => 20,
		));
		
		//Upload Options
		$wp_customize->add_setting( 'companyLogo', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'companyLogo', 
			array(
				'label'    => esc_html__( 'Company Logo', 'energytheme' ),
				'section'  => 'header_options',
				'settings' => 'companyLogo',
				'priority' => 1,
				) 
			) 
		);
		
		$wp_customize->add_setting( 'globalHeaderImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'globalHeaderImage', 
			array(
				'label'    => esc_html__( 'Global Header Image (Pages and Posts)', 'energytheme' ),
				'section'  => 'header_options',
				'settings' => 'globalHeaderImage',
				'priority' => 2,
				) 
			) 
		);
		
		$wp_customize->add_setting( 'globalHeaderImage2', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'globalHeaderImage2', 
			array(
				'label'    => esc_html__( 'Global Header Image (Archives, 404, etc.)', 'energytheme' ),
				'section'  => 'header_options',
				'settings' => 'globalHeaderImage2',
				'priority' => 3,
				) 
			) 
		);
		
		$wp_customize->add_setting( 'mainNavBackgroundImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'mainNavBackgroundImage', 
			array(
				'label'    => esc_html__( 'Main Nav Background Image', 'energytheme' ),
				'section'  => 'header_options',
				'settings' => 'mainNavBackgroundImage',
				'priority' => 4,
				) 
			) 
		);
		
		$wp_customize->add_setting( 'breadcrumbsBackgroundImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'breadcrumbsBackgroundImage', 
			array(
				'label'    => esc_html__( 'Breadcrumbs Background Image', 'energytheme' ),
				'section'  => 'header_options',
				'settings' => 'breadcrumbsBackgroundImage',
				'priority' => 5,
				) 
			) 
		);
		
		//Radio Options		
		$wp_customize->add_setting('enableStickyNav', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('enableStickyNav', array(
			'label'      => esc_html__('Sticky Navigation', 'energytheme'),
			'section'    => 'header_options',
			'settings'   => 'enableStickyNav',
			'description' => esc_html__('Setting this option to "ON" wlll make the main navigation stick to the top of the screen upon page scroll.', 'energytheme'),
			'priority' => 6,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
					
		$wp_customize->add_setting('enableBreadCrumbs', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('enableBreadCrumbs', array(
			'label'      => esc_html__('Breadcrumbs', 'energytheme'),
			'section'    => 'header_options',
			'settings'   => 'enableBreadCrumbs',
			'description' => esc_html__('Show or hide the breadcrumbs navigation on sub-pages.', 'energytheme'),
			'priority' => 7,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));

		
		$wp_customize->add_setting('enableLanguageSelector', array(
			'default' => 'off',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('enableLanguageSelector', array(
			'label'      => esc_html__('Display WPML Language selector?', 'energytheme'),
			'section'    => 'header_options',
			'settings'   => 'enableLanguageSelector',
			'description' => esc_html__('Show or hide the language selector in the sub-menu area. This option only applies if the WPML plugin is installed and active.', 'energytheme'),
			'priority' => 9,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('enableCart', array(
			'default' => 'off',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('enableCart', array(
			'label'      => esc_html__('Display Cart Icon?', 'energytheme'),
			'section'    => 'header_options',
			'description' => esc_html__('Show or hide the shopping cart button in the sub-menu area. This option only applies if Woocommerce is installed and active.', 'energytheme'),
			'settings'   => 'enableCart',
			'priority' => 10,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('enableAddress', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('enableAddress', array(
			'label'      => esc_html__('Display Address?', 'energytheme'),
			'section'    => 'header_options',
			'settings'   => 'enableAddress',
			'description' => esc_html__('Show or hide the company address button in the sub-menu area.', 'energytheme'),
			'priority' => 11,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('enableHours', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('enableHours', array(
			'label'      => esc_html__('Display Hours?', 'energytheme'),
			'section'    => 'header_options',
			'settings'   => 'enableHours',
			'description' => esc_html__('Show or hide the company hours button in the sub-menu area.', 'energytheme'),
			'priority' => 12,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('enableSearch', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('enableSearch', array(
			'label'      => esc_html__('Display Search?', 'energytheme'),
			'section'    => 'header_options',
			'settings'   => 'enableSearch',
			'description' => esc_html__('Show or hide the search button in the sub-menu area.', 'energytheme'),
			'priority' => 13,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('enableSubMenu', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('enableSubMenu', array(
			'label'      => esc_html__('Display Sub-Menu?', 'energytheme'),
			'section'    => 'header_options',
			'settings'   => 'enableSubMenu',
			'description' => esc_html__('Show or hide the sub-menu header. NOTE: setting this option to "OFF" will still display the sub-menu area on mobile resolutions but will only display the company logo.', 'energytheme'),
			'priority' => 14,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('displaySubHeader', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('displaySubHeader', array(
			'label'      => esc_html__('Display Sub-Header?', 'energytheme'),
			'section'    => 'header_options',
			'settings'   => 'displaySubHeader',
			'priority' => 15,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		
		//Textfields
		$wp_customize->add_setting(
			'searchFieldText', array(
				'default' => esc_html__( 'Type Keywords...', 'energytheme' ),
				'sanitize_callback' => 'esc_attr'
			)
		);

		$wp_customize->add_control(
			'searchFieldText',
			 array(
				'label' => esc_html__( 'Search field text (applies globally)', 'energytheme' ),
			 	'section' => 'header_options',
				'priority' => 16,
			 )
		);

		
		$wp_customize->add_setting(
			'companyLogoAltTag', array(
				'default' => "",
				'sanitize_callback' => 'esc_attr'
			)
		);

		$wp_customize->add_control(
			'companyLogoAltTag',
			 array(
				'label' => esc_html__( 'Company Logo Alt Tag', 'energytheme' ),
			 	'section' => 'header_options',
				'priority' => 17,
			 )
		);
		
		$wp_customize->add_setting(
			'companyLogoURL', array(
				'default' => "",
				'sanitize_callback' => 'esc_attr'
			)
		);

		$wp_customize->add_control(
			'companyLogoURL',
			 array(
				'label' => esc_html__( 'Company Logo URL', 'energytheme' ),
			 	'section' => 'header_options',
				'priority' => 18,
			 )
		);	
		
		$wp_customize->add_setting(
			'dropMenuIndicator', array(
				'default' => "fa-angle-down",
				'sanitize_callback' => 'esc_attr'
			)
		);

		$wp_customize->add_control(
			'dropMenuIndicator',
			 array(
				'label' => esc_html__( 'Drop Menu Indicator', 'energytheme' ),
			 	'section' => 'header_options',
				'priority' => 19,
			 )
		);	
		
		
		
		
		
		
		
		
		
		/*$wp_customize->add_setting(
			'mainNavBgOpacity', array(
				'default' => 90,
				'sanitize_callback' => 'esc_attr'
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Sliderui_Control( 
			$wp_customize, 'mainNavBgOpacity', 
				array(
					'label'   => esc_html__( 'Main Nav Background opacity', 'energytheme' ),
					'section' => 'header_options',
					'settings'   => 'mainNavBgOpacity',
					'priority' => 20,
					'choices'  => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 2,
					),
				) 
			) 
		);*/
		
		$wp_customize->add_setting( 'mainNavBgOpacity', array(
			'default' => 90,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'mainNavBgOpacity', array(
			'type' => 'range',
			'section' => 'header_options',
			'label'   => esc_html__( 'Main Navigation Opacity', 'energytheme' ),
			'description' => esc_html__('Adjust the background opacity of the main navigation. This field only applies if the main navigation background image field is empty. (Requires window refresh)', 'energytheme'),
			'priority' => 20,
			'input_attrs' => array(
				'min' => 0,
				'max' => 200,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );
		
		
		
		$wp_customize->add_setting( 'mainNavDropMenuOpacity', array(
			'default' => 90,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'mainNavDropMenuOpacity', array(
			'type' => 'range',
			'section' => 'header_options',
			'label'   => esc_html__( 'Drop Down Menu Opacity', 'energytheme' ),
			'description' => esc_html__('Adjust the background opacity of the main navigation drop down menu. (Requires window refresh)', 'energytheme'),
			'priority' => 21,
			'input_attrs' => array(
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );
		
		
		$wp_customize->add_setting( 'pageTitleOpacity', array(
			'default' => 70,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'pageTitleOpacity', array(
			'type' => 'range',
			'section' => 'header_options',
			'label'   => esc_html__( 'Page Title opacity', 'energytheme' ),
			'description' => esc_html__('Adjust the background opacity of the page title container. (Requires window refresh)', 'energytheme'),
			'priority' => 22,
			'input_attrs' => array(
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );
		
		
		$wp_customize->add_setting( 'headerHeight', array(
			'default' => 170,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage',
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'headerHeight', array(
			'type' => 'range',
			'section' => 'header_options',
			'label'   => esc_html__( 'Header Height', 'energytheme' ),
			'description' => esc_html__('Adjust the vertical height amount of the main header element.', 'energytheme'),
			'priority' => 23,
			'input_attrs' => array(
				'min' => 50,
				'max' => 300,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );
		
		
		$wp_customize->add_setting( 'headerPadding', array(
			'default' => 70,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage',
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'headerPadding', array(
			'type' => 'range',
			'section' => 'header_options',
			'label'   => esc_html__( 'Header Padding', 'energytheme' ),
			'description' => esc_html__('Adjust the vertical padding amount of the main header element.', 'energytheme'),
			'priority' => 23,
			'input_attrs' => array(
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );
		
		
		
				
		//Header Option Colors
		$headerOptionColors = array();
		
		$headerOptionColors[] = array(
			'slug'=>'mainNavBackgroundColor', 
			'default' => '#000000',
			'transport' => 'postMessage',
			'label' => esc_html__('Navigation Background Color', 'energytheme'),
			'description' => esc_html__('Adjust the background color of the main navigation.', 'energytheme'),
		);
		$headerOptionColors[] = array(
			'slug'=>'navDropDownColor', 
			'default' => '#000000',
			'transport' => 'refresh',
			'label' => esc_html__('Navigation Drop Down Color', 'energytheme'),
			'description' => esc_html__('Adjust the background color of the main navigation drop down menu. This option also applies to the mobile navigation. (Requires window refresh)', 'energytheme'),
		);
		$headerOptionColors[] = array(
			'slug'=>'navDropDownHoverColor', 
			'default' => '#f6d600',
			'transport' => 'refresh',
			'label' => esc_html__('Navigation Drop Down Hover Color', 'energytheme'),
			'description' => esc_html__('Adjust the hover color of the main navigation drop down menu. This option also applies to the mobile navigation. (Requires window refresh)', 'energytheme'),
		);
		$headerOptionColors[] = array(
			'slug'=>'navDropDownBorderColor', 
			'default' => '#2d2d2c',
			'transport' => 'postMessage',
			'label' => esc_html__('Navigation Drop Down Border Color', 'energytheme'),
			'description' => esc_html__('Adjust the border color of the main navigation drop down menu. This option also applies to the mobile navigation.', 'energytheme'),
		);
		$headerOptionColors[] = array(
			'slug'=>'subMenuBackgroundColor', 
			'default' => '#242B34',
			'transport' => 'postMessage',
			'label' => esc_html__('Micro Menu Color', 'energytheme'),
			'description' => esc_html__('Adjust the background color of the micro menu area.', 'energytheme'),
		);
		$headerOptionColors[] = array(
			'slug'=>'mobileNavBackgroundColor', 
			'default' => '#0C1923',
			'transport' => 'postMessage',
			'label' => esc_html__('Mobile Navigation Color', 'energytheme'),
			'description' => esc_html__('Adjust the background color of the mobile navigation menu.', 'energytheme'),
		);
		$headerOptionColors[] = array(
			'slug'=>'mobileNavToggleColor', 
			'default' => '#FFFFFF',
			'transport' => 'postMessage',
			'label' => esc_html__('Mobile Nav Toggle Color', 'energytheme'),
			'description' => esc_html__('Adjust the color of the mobile navigation toggle switch and sub-menu toggle switch.', 'energytheme'),
		);
		$headerOptionColors[] = array(
			'slug'=>'subpageHeaderBackgroundColor', 
			'default' => '#666666',
			'transport' => 'postMessage',
			'label' => esc_html__('Sub-page Header Background Color', 'energytheme'),
			'description' => esc_html__('Adjust the background color of the sub-page header.', 'energytheme'),
		);
		$headerOptionColors[] = array(
			'slug'=>'pageTitleBackgroundColor', 
			'default' => '#000000',
			'transport' => 'refresh',
			'label' => esc_html__('Page Title Background Color', 'energytheme'),
			'description' => esc_html__('Adjust the background color of the page title. (Requires window refresh)', 'energytheme'),
		);
		
		$headerOptionColors[] = array(
			'slug'=>'searchFieldTextColor', 
			'default' => '#000000',
			'transport' => 'postMessage',
			'label' => esc_html__('Search Field Text Color', 'energytheme'),
			'description' => esc_html__('Adjust the text color of the search field.', 'energytheme'),
		);
		
		$headerOptionColors[] = array(
			'slug'=>'expandableDivColor', 
			'default' => '#111111',
			'transport' => 'postMessage',
			'label' => esc_html__('Micro Menu slider box color', 'energytheme'),
			'description' => esc_html__('Adjust the background color of the micro menu slider box.', 'energytheme'),
		);
		
		$priorityHeaderColors = 25;
		
		foreach( $headerOptionColors as $color ) {
			
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'type' => 'option', 
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr',
					'transport' => $color['transport'],
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'section' => 'header_options',
					'priority' => $priorityHeaderColors,
					'description' => $color['description'],
					'settings' => $color['slug'])
				)
			);
			
			$priorityHeaderColors++;
			
		}//end of foreach
		
		
			
		/**** Layout Options ****/
		$wp_customize->add_section( 'layout_options' , array(
			'title'    => esc_html__( 'Layout Options', 'energytheme' ),
			'priority' => 60,
		));
		
		//Radio Options
		$wp_customize->add_setting('enableBoxMode',  array(
			'default' => 'off',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('enableBoxMode', array(
			'label'      => esc_html__('1170 Boxed Mode', 'energytheme'),
			'section'    => 'layout_options',
			'settings'   => 'enableBoxMode',
			'priority' => 10,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting(
			'homepageLayout', array(
				'default' => 'no-sidebar',
				'sanitize_callback' => 'esc_attr'
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Radio_Control( 
			$wp_customize, 'homepageLayout', 
				array(
					'label'   => esc_html__( 'Homepage Layout', 'energytheme' ),
					'section' => 'layout_options',
					'settings'   => 'homepageLayout',
					'type'     => 'radio',
					'mode'     => 'image',
					'choices'  => array(
						'no-sidebar' => get_template_directory_uri() . '/css/img/layouts/no-sidebar.png',
						'left-sidebar' => get_template_directory_uri() . '/css/img/layouts/left-sidebar.png',
						'right-sidebar' => get_template_directory_uri() . '/css/img/layouts/right-sidebar.png',
					),
				) 
			) 
		);
		
		$wp_customize->add_setting(
			'universalLayout', array(
				'default' => 'no-sidebar',
				'sanitize_callback' => 'esc_attr'
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Radio_Control( 
			$wp_customize, 'universalLayout', 
				array(
					'label'   => esc_html__( 'Universal Layout (Tag - Archive - Category)', 'energytheme' ),
					'section' => 'layout_options',
					'settings'   => 'universalLayout',
					'type'     => 'radio',
					'mode'     => 'image',
					'choices'  => array(
						'no-sidebar' => get_template_directory_uri() . '/css/img/layouts/no-sidebar.png',
						'left-sidebar' => get_template_directory_uri() . '/css/img/layouts/left-sidebar.png',
						'right-sidebar' => get_template_directory_uri() . '/css/img/layouts/right-sidebar.png',
					),
				) 
			) 
		);
		
		$wp_customize->add_setting(
			'footerLayout', array(
				'default' => 'footer-four-columns',
				'sanitize_callback' => 'esc_attr'
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Radio_Control( 
			$wp_customize, 'footerLayout', 
				array(
					'label'   => esc_html__( 'Footer Layout', 'energytheme' ),
					'section' => 'layout_options',
					'settings'   => 'footerLayout',
					'type'     => 'radio',
					'mode'     => 'image',
					'choices'  => array(
						'footer-one-column' => get_template_directory_uri() . '/css/img/layouts/footer-one-column.png',
						'footer-two-columns' => get_template_directory_uri() . '/css/img/layouts/footer-two-columns.png',
						'footer-three-columns' => get_template_directory_uri() . '/css/img/layouts/footer-three-columns.png',
						'footer-four-columns' => get_template_directory_uri() . '/css/img/layouts/footer-four-columns.png',
						'footer-three-wide-left' => get_template_directory_uri() . '/css/img/layouts/footer-three-wide-left.png',
						'footer-three-wide-right' => get_template_directory_uri() . '/css/img/layouts/footer-three-wide-right.png',
					),
				) 
			) 
		);
		
		
		/**** Footer Options ****/
		$wp_customize->add_section( 'footer_options' , array(
			'title'    => esc_html__( 'Footer Options', 'energytheme' ),
			'priority' => 70,
		));
			
		//Images
		$wp_customize->add_setting( 'footerLogo', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'footerLogo', 
			array(
				'label'    => esc_html__( 'Footer Logo', 'energytheme' ),
				'section'  => 'footer_options',
				'settings' => 'footerLogo',
				'priority' => 1,
				) 
			) 
		);
		
		$wp_customize->add_setting( 'fatFooterBackgroundImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'fatFooterBackgroundImage', 
			array(
				'label'    => esc_html__( 'Fat Footer Background Image', 'energytheme' ),
				'section'  => 'footer_options',
				'settings' => 'fatFooterBackgroundImage',
				'priority' => 2,
				) 
			) 
		);
		
		$wp_customize->add_setting( 'socialFooterBackgroundImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'socialFooterBackgroundImage', 
			array(
				'label'    => esc_html__( 'Social Footer Background Image', 'energytheme' ),
				'section'  => 'footer_options',
				'settings' => 'socialFooterBackgroundImage',
				'priority' => 3,
				) 
			) 
		);
			
		//Radio Options
		$wp_customize->add_setting('toggle_fatfooter', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('toggle_fatfooter', array(
			'label'      => esc_html__('Fat Footer', 'energytheme'),
			'section'    => 'footer_options',
			'settings'   => 'toggle_fatfooter',
			'type'       => 'radio',
			'priority' => 4,
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		
		$wp_customize->add_setting('toggle_socialFooter', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('toggle_socialFooter', array(
			'label'      => esc_html__('Social Footer', 'energytheme'),
			'section'    => 'footer_options',
			'settings'   => 'toggle_socialFooter',
			'type'       => 'radio',
			'priority' => 5,
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('toggle_footerNav', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('toggle_footerNav', array(
			'label'      => esc_html__('Footer Copyright and Navigation', 'energytheme'),
			'section'    => 'footer_options',
			'settings'   => 'toggle_footerNav',
			'type'       => 'radio',
			'priority' => 6,
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('displaySocialFooterBgColor', array(
			'default' => 'off',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('displaySocialFooterBgColor', array(
			'label'      => esc_html__('Display Social Footer background color?', 'energytheme'),
			'section'    => 'footer_options',
			'settings'   => 'displaySocialFooterBgColor',
			'type'       => 'radio',
			'priority' => 7,
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('displaySocialFooterBgImage', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('displaySocialFooterBgImage', array(
			'label'      => esc_html__('Display Social Footer background image?', 'energytheme'),
			'section'    => 'footer_options',
			'settings'   => 'displaySocialFooterBgImage',
			'type'       => 'radio',
			'priority' => 8,
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('addSpacingOnFooter', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('addSpacingOnFooter', array(
			'label'      => esc_html__('Add spacing on footer?', 'energytheme'),
			'section'    => 'footer_options',
			'settings'   => 'addSpacingOnFooter',
			'type'       => 'radio',
			'priority' => 9,
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('toggleParallaxFooter', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('toggleParallaxFooter', array(
			'label'      => esc_html__('Run Parallax on Fat Footer?', 'energytheme'),
			'section'    => 'footer_options',
			'settings'   => 'toggleParallaxFooter',
			'type'       => 'radio',
			'priority' => 10,
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		//Slider options	
		
		$wp_customize->add_setting( 'socialFooterHeight', array(
			'default' => 400,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage',
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'socialFooterHeight', array(
			'type' => 'range',
			'section' => 'footer_options',
			'label'   => esc_html__( 'Social Footer Height', 'energytheme' ),
			'description' => esc_html__('Adjust the height of the social footer container.', 'energytheme'),
			'priority' => 11,
			'input_attrs' => array(
				'min' => 100,
				'max' => 400,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );
				
		
		//Textfields
		$wp_customize->add_setting(
			'socialFooterCTA', array(
				'default' => esc_html__( 'Connect with us!', 'energytheme' ),
				'sanitize_callback' => 'esc_attr'
			)
		);

		$wp_customize->add_control(
			'socialFooterCTA',
			 array(
				'label' => esc_html__( 'Social Footer Call To Action', 'energytheme' ),
			 	'section' => 'footer_options',
				'priority' => 12,
			 )
		);

		
		$FooterColors = array();
		
		$FooterColors[] = array(
			'slug'=>'socialIconColor', 
			'default' => '#232830',
			'transport' => 'postMessage',
			'label' => esc_html__('Social Icon Color', 'energytheme'),
			'description' => esc_html__('Adjust the color for the social icons in the footer area.', 'energytheme'),
		);
		$FooterColors[] = array(
			'slug'=>'fatFooterBackgroundColor', 
			'default' => '#292D38',
			'transport' => 'postMessage',
			'label' => esc_html__('Fat Footer Background Color', 'energytheme'),
			'description' => esc_html__('Adjust the background color of the fat footer. Only applies if there is no background image assigned to the fat footer.', 'energytheme'),
		);
		$FooterColors[] = array(
			'slug'=>'footerBackgroundColor', 
			'default' => '#272D36',
			'transport' => 'postMessage',
			'label' => esc_html__('Footer Background Color', 'energytheme'),
			'description' => esc_html__('Adjust the background color of the footer.', 'energytheme'),
		);
		$FooterColors[] = array(
			'slug'=>'socialFooterBackgroundColor', 
			'default' => '#ffffff',
			'transport' => 'refresh',
			'label' => esc_html__('Social Footer Background Color', 'energytheme'),
			'description' => esc_html__('Adjust the background color of the social footer. Only applies if the social footer background color option is enabled. (Requires page refresh)', 'energytheme'),
		);
		
		$FooterColorsCounter = 20;
		
		
		foreach( $FooterColors as $color ) {
			
			$FooterColorsCounter += 10;
			
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'description' => $color['description'],
					'transport' => $color['transport'],
					'type' => 'option', 
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr'
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'description' => $color['description'],
					'transport' => $color['transport'],
					'section' => 'footer_options',
					'priority' => $FooterColorsCounter,
					'settings' => $color['slug'])
				)
			);
			
			
		}//end of foreach
		
		
		/**** Global Options ****/
		$wp_customize->add_section( 'global_options' , array(
			'title'    => esc_html__( 'Global Options', 'energytheme' ),
			'priority' => 80,
		));
		
		$wp_customize->add_setting( 'pageBackgroundImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'pageBackgroundImage', 
			array(
				'label'    => esc_html__( 'Background image', 'energytheme' ),
				'section'  => 'global_options',
				'settings' => 'pageBackgroundImage',
				'priority' => 1,
				) 
			) 
		);
		
		$wp_customize->add_setting('repeatBackground',  array(
			'default' => 'repeat',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('repeatBackground', array(
			'label'      => esc_html__('Background Repeat', 'energytheme'),
			'section'    => 'global_options',
			'settings'   => 'repeatBackground',
			'priority' => 2,
			'type'       => 'radio',
			'choices'    => array(
				'repeat'  => 'Repeat',
				'repeat-x'  => 'Repeat X',
				'repeat-y'  => 'Repeat Y',
				'no-repeat'   => 'No Repeat',
			),
		));

		
		$wp_customize->add_setting('enableTooltip', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('enableTooltip', array(
			'label'      => esc_html__('ToolTip', 'energytheme'),
			'section'    => 'global_options',
			'settings'   => 'enableTooltip',
			'type'       => 'radio',
			'priority' => 4,
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('colorSampler',  array(
			'default' => 'off',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('colorSampler', array(
			'label'      => esc_html__('Theme Sampler', 'energytheme'),
			'section'    => 'global_options',
			'settings'   => 'colorSampler',
			'priority' => 5,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));


		$wp_customize->add_setting('retinaSupport',  array(
			'default' => 'off',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('retinaSupport', array(
			'label'      => esc_html__('Retina Support', 'energytheme'),
			'section'    => 'global_options',
			'settings'   => 'retinaSupport',
			'priority' => 6,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		
		$wp_customize->add_setting(
			'ulListIcon', array(
				'default' => 'f105',
				'sanitize_callback' => 'esc_attr'
			)
		);
		
		$wp_customize->add_control( 'ulListIcon', array(
			'label'   => esc_html__('UL List Icon', 'energytheme'),
			'section' => 'global_options',
			'settings' => 'ulListIcon',
			'priority' => 7,
			'type'    => 'text',
		) );
		
		$GlobalColors = array();
		
		$GlobalColors[] = array(
			'slug'=>'pageBackgroundColor', 
			'default' => '#FFFFFF',
			'transport' => 'postMessage',
			'label' => esc_html__('Background Color', 'energytheme'),
			'description' => esc_html__('Adjust the background color of the theme.', 'energytheme'),
		);
		$GlobalColors[] = array(
			'slug'=>'boxedModeContainerColor', 
			'default' => '#FFFFFF',
			'transport' => 'postMessage',
			'label' => esc_html__('Boxed Mode Container Color', 'aayattheme'),
			'description' => esc_html__('Adjust the background color of the theme container for boxed mode. Only applies if Boxed Mode is enabled.', 'energytheme'),
		);
		$GlobalColors[] = array(
			'slug'=>'primaryColor', 
			'default' => '#f6d600',
			'transport' => 'postMessage',
			'label' => esc_html__('Primary Color', 'energytheme'),
			'description' => esc_html__('Adjust the primary color of the theme. This color applies to components throughout the theme for a consistent design. Please note that not all elements update in real time - please save your settings and view the final changes on the front-end.', 'energytheme'),
		);
		$GlobalColors[] = array(
			'slug'=>'secondaryColor', 
			'default' => '#2a313a',
			'transport' => 'postMessage',
			'label' => esc_html__('Secondary Color', 'energytheme'),
			'description' => esc_html__('Adjust the secondary color of the theme. This color applies to components throughout the theme for a consistent design. Please note that not all elements update in real time - please save your settings and view the final changes on the front-end.', 'energytheme'),
		);
		$GlobalColors[] = array(
			'slug'=>'linkColor', 
			'default' => '#9c8d00',
			'transport' => 'postMessage',
			'label' => esc_html__('Link Color', 'energytheme'),
			'description' => esc_html__('Adjust the global link color.', 'energytheme'),
		);
		$GlobalColors[] = array(
			'slug'=>'dividerColor', 
			'default' => '#d3d3d3',
			'transport' => 'postMessage',
			'label' => esc_html__('Divider/Border Color', 'energytheme'),
			'description' => esc_html__('Adjust the global divider/border color of the theme. This color applies to components throughout the theme for a consistent design.', 'energytheme'),
		);
		$GlobalColors[] = array(
			'slug'=>'tooltipColor', 
			'default' => '#242b34',
			'transport' => 'postMessage',
			'label' => esc_html__('ToolTip Color', 'energytheme'),
			'description' => esc_html__('Adjust the background color of the tooltip element.', 'energytheme'),
		);
		$GlobalColors[] = array(
			'slug'=>'blockQuoteColor', 
			'default' => '#dbc164',
			'transport' => 'postMessage',
			'label' => esc_html__('Blockquote Color', 'energytheme'),
			'description' => esc_html__('Adjust the color of the blockquote element.', 'energytheme'),
		);
		
		$GlobalColors[] = array(
			'slug'=>'widgetsPostBtnColor', 
			'default' => '#c8c8c8',
			'transport' => 'postMessage',
			'label' => esc_html__('Button Color', 'energytheme'),
			'description' => esc_html__('Adjust the color for global button elements displayed in widgets, posts, etc.', 'energytheme'),
		);
		
		$GlobalColors[] = array(
			'slug'=>'ulListIconColor', 
			'default' => '#c8c8c8',
			'transport' => 'refresh',
			'label' => esc_html__('UL List icon color', 'energytheme'),
			'description' => esc_html__('Adjust the color for unordered list icon. (Requires page refresh)', 'energytheme'),
		);
		
		/*$GlobalColors[] = array(
			'slug'=>'filterMenuColor', 
			'default' => '#c8c8c8',
			'transport' => 'postMessage',
			'label' => esc_html__('Filter Drop Menu color', 'energytheme'),
			'description' => esc_html__('Adjust the color for the filter drop down menu found on gallery style templates such as videos, events, gallery etc.', 'energytheme'),
		);	*/	
		
		$priority = 0;
		
		foreach( $GlobalColors as $color ) {
			
			$priority = $priority + 10;
			
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'type' => 'option', 
					'settings' => $color['slug'],
					'transport' => $color['transport'],
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr'
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'description' => $color['description'], 
					'section' => 'global_options',
					'settings' => $color['slug'],
					'transport' => $color['transport'],
					'priority' => $priority,
					)
				)
			);
		}//end of foreach
					
				
		/**** Business Info ****/
		$wp_customize->add_section( 'business_info' , array(
			'title'    => esc_html__( 'Business Info', 'energytheme' ),
			'priority' => 100,
		));
		
		//Textfields
		$wp_customize->add_setting(
			'businessPhone', array(
				'default' => '1-888-555-5555',
				'sanitize_callback' => 'esc_attr'
			)
		);
				
		$wp_customize->add_control( 'businessPhone', array(
			'label'   => esc_html__( 'Business Phone', 'energytheme' ),
			'section' => 'business_info',
			'settings' => 'businessPhone',
			'type'    => 'text',
		) );
		
		$wp_customize->add_setting(
			'businessEmail', array(
				'default' => 'info@energyfitness.com',
				'sanitize_callback' => 'esc_attr'
			)
		);
				
		$wp_customize->add_control( 'businessEmail', array(
			'label'   => esc_html__( 'Email Address', 'energytheme' ),
			'section' => 'business_info',
			'settings' => 'businessEmail',
			'type'    => 'text',
		) );
		
		//Facebook Icon
		$wp_customize->add_setting(
			'facebooklink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr'
			)
		);
				
		$wp_customize->add_control( 'facebooklink', array(
			'label'   => esc_html__( 'Facebook URL', 'energytheme' ),
			'section' => 'business_info',
			'settings' => 'facebooklink',
			'type'    => 'text',
		) );
		
		//Twitter Icon
		$wp_customize->add_setting(
			'twitterlink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr'
			)
		);
				
		$wp_customize->add_control( 'twitterlink', array(
			'label'   => esc_html__( 'Twitter URL', 'energytheme' ),
			'section' => 'business_info',
			'settings' => 'twitterlink',
			'type'    => 'text',
		) );
		
		//G Plus Icon
		$wp_customize->add_setting(
			'googlelink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr'
			)
		);
				
		$wp_customize->add_control( 'googlelink', array(
			'label'   => esc_html__( 'Google Plus URL', 'energytheme' ),
			'section' => 'business_info',
			'settings' => 'googlelink',
			'type'    => 'text',
		) );
		
		//Linkedin Icon
		$wp_customize->add_setting(
			'linkedinLink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr'
			)
		);
				
		$wp_customize->add_control( 'linkedinLink', array(
			'label'   => esc_html__( 'Linkedin URL', 'energytheme' ),
			'section' => 'business_info',
			'settings' => 'linkedinLink',
			'type'    => 'text',
		) );
		
		//Vimeo Icon
		$wp_customize->add_setting(
			'vimeolink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr'
			)
		);
				
		$wp_customize->add_control( 'vimeolink', array(
			'label'   => esc_html__( 'Vimeo URL', 'energytheme' ),
			'section' => 'business_info',
			'settings' => 'vimeolink',
			'type'    => 'text',
		) );
		
		//Youtube Icon
		$wp_customize->add_setting(
			'youtubelink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr'
			)
		);
				
		$wp_customize->add_control( 'youtubelink', array(
			'label'   => esc_html__( 'YouTube URL', 'energytheme' ),
			'section' => 'business_info',
			'settings' => 'youtubelink',
			'type'    => 'text',
		) );
		
		//Dribbble Icon
		$wp_customize->add_setting(
			'dribbblelink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr'
			)
		);
				
		$wp_customize->add_control( 'dribbblelink', array(
			'label'   => esc_html__( 'Dribbble URL', 'energytheme' ),
			'section' => 'business_info',
			'settings' => 'dribbblelink',
			'type'    => 'text',
		) );
		
		//Pinterest Icon
		$wp_customize->add_setting(
			'pinterestlink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr'
			)
		);
				
		$wp_customize->add_control( 'pinterestlink', array(
			'label'   => esc_html__( 'Pinterest URL', 'energytheme' ),
			'section' => 'business_info',
			'settings' => 'pinterestlink',
			'type'    => 'text',
		) );
		
		//Instagram Icon
		$wp_customize->add_setting(
			'instagramlink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr'
			)
		);
				
		$wp_customize->add_control( 'instagramlink', array(
			'label'   => esc_html__( 'Instagram URL', 'energytheme' ),
			'section' => 'business_info',
			'settings' => 'instagramlink',
			'type'    => 'text',
		) );

		
		//Skype Icon
		$wp_customize->add_setting(
			'skypelink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr'
			)
		);
				
		$wp_customize->add_control( 'skypelink', array(
			'label'   => esc_html__( 'Skype Name', 'energytheme' ),
			'section' => 'business_info',
			'settings' => 'skypelink',
			'type'    => 'text',
		) );
		
		//Flickr Icon
		$wp_customize->add_setting(
			'flickrlink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr'
			)
		);
				
		$wp_customize->add_control( 'flickrlink', array(
			'label'   => esc_html__( 'Flickr URL', 'energytheme' ),
			'section' => 'business_info',
			'settings' => 'flickrlink',
			'type'    => 'text',
		) );
		
		//Tumblr Icon
		$wp_customize->add_setting(
			'tumblrlink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr'
			)
		);
				
		$wp_customize->add_control( 'tumblrlink', array(
			'label'   => esc_html__( 'Tumblr URL', 'energytheme' ),
			'section' => 'business_info',
			'settings' => 'tumblrlink',
			'type'    => 'text',
		) );
		
		//Stumbleupon
		$wp_customize->add_setting(
			'stumbleuponlink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr'
			)
		);
				
		$wp_customize->add_control( 'stumbleuponlink', array(
			'label'   => esc_html__( 'StumbleUpon URL', 'energytheme' ),
			'section' => 'business_info',
			'settings' => 'stumbleuponlink',
			'type'    => 'text',
		) );
		
		//Reddit
		$wp_customize->add_setting(
			'redditlink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr'
			)
		);
				
		$wp_customize->add_control( 'redditlink', array(
			'label'   => esc_html__( 'Reddit URL', 'energytheme' ),
			'section' => 'business_info',
			'settings' => 'redditlink',
			'type'    => 'text',
		) );
		
		//RSS Icon
		$wp_customize->add_setting(
			'rssLink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr'
			)
		);
				
		$wp_customize->add_control( 'rssLink', array(
			'label'   => esc_html__( 'RSS URL', 'energytheme' ),
			'section' => 'business_info',
			'settings' => 'rssLink',
			'type'    => 'text',
		) );
		
		
		
		/**** Woocommerce Options ****/
		$wp_customize->add_section( 'woo_options' , array(
			'title'    => esc_html__( 'Woocommerce Options', 'energytheme' ),
			'priority' => 110,
		));
		
		//Upload Options
		$wp_customize->add_setting( 'wooCategoryHeaderImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
			new WP_Customize_Image_Control( 
			$wp_customize, 
			'wooCategoryHeaderImage', 
			array(
				'label'    => esc_html__( 'Category/Tag Page Header Image', 'energytheme' ),
				'section'  => 'woo_options',
				'priority' => 1,
				'settings' => 'wooCategoryHeaderImage',
				) 
			) 
		);
		
		
		
		$wp_customize->add_setting('products_per_page',
			array(
				'default' => '4',
				'sanitize_callback' => 'esc_attr'
			)
		);
		
		$wp_customize->add_control('products_per_page',
			array(
				'type' => 'select',
				'label' => esc_html__( 'Products Per Page', 'energytheme' ),
				'section' => 'woo_options',
				'choices' => array(
					'4' => '4',
					'8' => '8',
					'12' => '12',
					'16' => '16',
					'20' => '20',
					'-1' => esc_html__('Show All', 'energytheme')
				),
			)
		);
		
		$wp_customize->add_setting(
			'woocommShopLayout', array(
				'default' => 'no-sidebar',
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Radio_Control( 
			$wp_customize, 'woocommShopLayout', 
				array(
					'label'   => esc_attr__('Woocommerce layout', 'energytheme' ),
					'section' => 'woo_options',
					'settings'   => 'woocommShopLayout',
					'type'     => 'radio',
					'mode'     => 'image',
					'description' => esc_attr__('Applies to the Woocommerce shop template, product template and product category template.', 'energytheme' ),
					'choices'  => array(
						'no-sidebar' => get_template_directory_uri() . '/css/img/layouts/no-sidebar.png',
						'left-sidebar' => get_template_directory_uri() . '/css/img/layouts/left-sidebar.png',
						'right-sidebar' => get_template_directory_uri() . '/css/img/layouts/right-sidebar.png',
					),
				) 
			) 
		);
		
				
		/*$woocommColors = array();

		
		$woocommColors[] = array(
			'slug'=>'woo_tabs_bg_color', 
			'default' => '#182434',
			'label' => esc_html__('Tab system background color', 'energytheme'),
		);
		
		
		foreach( $woocommColors as $color ) {
			
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'type' => 'option', 
					'capability' => 'edit_theme_options'
				)
			);
			
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'section' => 'woo_options',
					'settings' => $color['slug'],
					)
				)
			);
			
		}*///end of foreach
		
		
		/**** Post Options ****/
		$wp_customize->add_section( 'post_options' , array(
			'title'    => esc_html__( 'Post Options', 'energytheme' ),
			'priority' => 120,
		));
		
		/* Upload options */
		$wp_customize->add_setting( 'authorBackgroundImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'authorBackgroundImage', 
			array(
				'label'    => esc_html__( 'Author Background Image', 'energytheme' ),
				'section'  => 'post_options',
				'settings' => 'authorBackgroundImage',
				'priority' => 1,
				) 
			) 
		);
		
		//Radio options
		$wp_customize->add_setting('toggleParallaxAuthor', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('toggleParallaxAuthor', array(
			'label'      => esc_html__('Run Parallax on Author Profile?', 'energytheme'),
			'section'    => 'post_options',
			'settings'   => 'toggleParallaxAuthor',
			'type'       => 'radio',
			'priority' => 2,
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('displayAuthorProfile', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('displayAuthorProfile', array(
			'label'      => esc_html__('Display Author Profile?', 'energytheme'),
			'section'    => 'post_options',
			'settings'   => 'displayAuthorProfile',
			'type'       => 'radio',
			'priority' => 3,
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('displayRelatedPosts', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('displayRelatedPosts', array(
			'label'      => esc_html__('Display Related Posts?', 'energytheme'),
			'section'    => 'post_options',
			'settings'   => 'displayRelatedPosts',
			'type'       => 'radio',
			'priority' => 4,
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('displayComments', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('displayComments', array(
			'label'      => esc_html__('Display Comments?', 'energytheme'),
			'section'    => 'post_options',
			'settings'   => 'displayComments',
			'type'       => 'radio',
			'priority' => 5,
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('displaySocialFeatures', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('displaySocialFeatures', array(
			'label'      => esc_html__('Display Social Features?', 'energytheme'),
			'section'    => 'post_options',
			'settings'   => 'displaySocialFeatures',
			'type'       => 'radio',
			'priority' => 6,
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		

		
		//List options
		$wp_customize->add_setting('numOfRelatedPosts',
			array(
				'default' => '2',
				'sanitize_callback' => 'esc_attr'
			)
		);
		
		$wp_customize->add_control('numOfRelatedPosts',
			array(
				'type' => 'select',
				'priority' => 7,
				'label' => esc_html__( 'Number of Related Posts to display', 'energytheme' ),
				'section' => 'post_options',
				'choices' => array(
					'2' => '2',
					'4' => '4',
					'6' => '6',
					'8' => '8',
					'12' => '12'
				),
			)
		);
		
		
		
		
		$wp_customize->add_setting( 'postTitleOpacity', array(
			'default' => 80,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'postTitleOpacity', array(
			'type' => 'range',
			'section' => 'post_options',
			'label'   => esc_html__( 'Post Title Opacity', 'energytheme' ),
			'description' => esc_html__('Adjust the background opacity of the news post title. (Requires window refresh)', 'energytheme'),
			'priority' => 20,
			'input_attrs' => array(
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );
		
		
		
		$PostColors = array();
		
		$PostColors[] = array(
			'slug'=>'postTitleBGColor', 
			'default' => '#000000',
			'transport' => 'refresh',
			'label' => esc_html__('Post Title Background Color', 'energytheme'),
			'description' => esc_html__('Adjust the background color of the news post title. (Requires page refresh)', 'energytheme'),
		);
				
		$PostColors[] = array(
			'slug'=>'postExcerptDividerColor', 
			'default' => '#d3d3d3',
			'transport' => 'postMessage',
			'label' => esc_html__('Post Excerpt Divider Color', 'energytheme'),
			'description' => esc_html__('Adjust the divider color of the news post which seperates the excerpt.', 'energytheme'),
		);
		
		$PostColors[] = array(
			'slug'=>'postMetaLinksColor', 
			'default' => '#9c8d00',
			'transport' => 'postMessage',
			'label' => esc_html__('Post Meta Links Color', 'energytheme'),
			'description' => esc_html__('Adjust the meta links color for news posts.', 'energytheme'),
		);
		
		$PostColors[] = array(
			'slug'=>'singlePostSocialIconColor', 
			'default' => '#cacaca',
			'transport' => 'postMessage',
			'label' => esc_html__('Social Icon Color (Post Template)', 'energytheme'),
			'description' => esc_html__('Adjust the background color for social sharing links on the single news post template.', 'energytheme'),
		);
		
		$PostColors[] = array(
			'slug'=>'authorCommentsBoxColor', 
			'default' => '#182433',
			'transport' => 'postMessage',
			'label' => esc_html__('Author/Comments Box Color', 'energytheme'),
			'description' => esc_html__('Adjust the background color of the author profile container on the single news post template.', 'energytheme'),
		);
		
		$PostColors[] = array(
			'slug'=>'authorBorderColor', 
			'default' => '#283442',
			'transport' => 'postMessage',
			'label' => esc_html__('Author Border Color', 'energytheme'),
			'description' => esc_html__('Adjust the border color of the author profile avatar on the single news post template.', 'energytheme'),
		);
		
		
		$priority = 30;
		
		foreach( $PostColors as $color ) {
			
			$priority = $priority + 10;
			
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'transport' => $color['transport'],
					'description' => $color['description'],
					'type' => 'option', 
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr'
				)
			);
			
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'transport' => $color['transport'],
					'description' => $color['description'],
					'section' => 'post_options',
					'settings' => $color['slug'],
					'priority' => $priority,
					)
				)
			);
			
		}//end of foreach
		
		
		/**** Custom Post Type Options ****/
		$wp_customize->add_section( 'custom_post_type_options' , array(
			'title'    => esc_html__( 'Custom Post Type Options', 'energytheme' ),
			'priority' => 130,
		));
		
		/* Upload options */
		/*$wp_customize->add_setting( 'authorBackgroundImage' );
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'authorBackgroundImage', 
			array(
				'label'    => esc_html__( 'Author Background Image', 'energytheme' ),
				'section'  => 'post_options',
				'settings' => 'authorBackgroundImage',
				'priority' => 1,
				) 
			) 
		);*/
				
				
		//List options

		
		$wp_customize->add_setting('galleryPostOrder', array(
			'default' => 'DESC',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('galleryPostOrder', array(
			'label'      => esc_html__('Gallery Post Order', 'energytheme'),
			'section'    => 'custom_post_type_options',
			'settings'   => 'galleryPostOrder',
			'type'       => 'radio',
			'priority' => 2,
			'choices'    => array(
				'ASC'   => 'Ascending',
				'DESC'  => 'Descending',
			),
		));
	
		
		//Radio options
		$wp_customize->add_setting('eventsPostOrder', array(
			'default' => 'DESC',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('eventsPostOrder', array(
			'label'      => esc_html__('Events Post Order', 'energytheme'),
			'section'    => 'custom_post_type_options',
			'settings'   => 'eventsPostOrder',
			'type'       => 'radio',
			'priority' => 4,
			'choices'    => array(
				'ASC'   => 'Ascending',
				'DESC'  => 'Descending',
			),
		));
		
		
		$wp_customize->add_setting('classes_posts_per_load',
			array(
				'default' => '3',
				'sanitize_callback' => 'esc_attr'
			)
		);
		
		$wp_customize->add_control('classes_posts_per_load',
			array(
				'type' => 'select',
				'priority' => 6,
				'label' => esc_html__( 'Class Posts Per Page', 'energytheme' ),
				'section' => 'custom_post_type_options',
				'choices' => array(
					'3' => '3',
					'6' => '6',
					'9' => '9',
					'12' => '12',
					'15' => '15',
					'-1' => esc_html__('Show All', 'energytheme')
				),
			)
		);
		
		$wp_customize->add_setting('programs_posts_per_load',
			array(
				'default' => '3',
				'sanitize_callback' => 'esc_attr'
			)
		);
		
		$wp_customize->add_control('programs_posts_per_load',
			array(
				'type' => 'select',
				'priority' => 6,
				'label' => esc_html__( 'Program Posts Per Page', 'energytheme' ),
				'section' => 'custom_post_type_options',
				'choices' => array(
					'3' => '3',
					'6' => '6',
					'9' => '9',
					'12' => '12',
					'15' => '15',
					'-1' => esc_html__('Show All', 'energytheme')
				),
			)
		);
		
		$wp_customize->add_setting('schedules_posts_per_page',
			array(
				'default' => '3',
				'sanitize_callback' => 'esc_attr'
			)
		);
		
		$wp_customize->add_control('schedules_posts_per_page',
			array(
				'type' => 'select',
				'priority' => 7,
				'label' => esc_html__( 'Schedule Posts Per Page', 'energytheme' ),
				'section' => 'custom_post_type_options',
				'choices' => array(
					'3' => '3',
					'6' => '6',
					'9' => '9',
					'12' => '12',
					'15' => '15',
					'-1' => esc_html__('Show All', 'energytheme')
				),
			)
		);
		

		
		$CustomPostTypeColors = array();
		
		$CustomPostTypeColors[] = array(
			'slug'=>'calendarIconColor', 
			'default' => '#000000',
			'transport' => 'postMessage',
			'label' => esc_html__('Calendar Icon Color (events and schedules)', 'energytheme'),
			'description' => esc_html__('Adjust the color of the calendar icon which appears on events and schedule posts.', 'energytheme'),
		);

		
		foreach( $CustomPostTypeColors as $color ) {
			
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'transport' => $color['transport'],
					'description' => $color['description'],
					'type' => 'option', 
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr'
				)
			);
			
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'transport' => $color['transport'],
					'description' => $color['description'],
					'section' => 'custom_post_type_options',
					'settings' => $color['slug'],
					)
				)
			);
			
		}//end of foreach
				
		
		/**** Shortcode Options ****/
		$wp_customize->add_section( 'shortcode_options' , array(
			'title'    => esc_html__( 'Shortcode Options', 'energytheme' ),
		));
		
		//range options
		
		$wp_customize->add_setting( 'postCarouselSpeed', array(
			'default' => 0,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'postCarouselSpeed', array(
			'type' => 'range',
			'section' => 'shortcode_options',
			'label'   => esc_html__( 'Post Carousel Speed', 'energytheme' ),
			'description' => esc_html__('Adjust the post carousel speed for the news posts shortcode. Leave this value set at 0 to disable the post carousel feature. (Requires window refresh)', 'energytheme'),
			'priority' => 1,
			'input_attrs' => array(
				'min' => 0,
				'max' => 10000,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );

		
		$wp_customize->add_setting( 'testimonialCarouselSpeed', array(
			'default' => 2000,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'testimonialCarouselSpeed', array(
			'type' => 'range',
			'section' => 'shortcode_options',
			'label'   => esc_html__( 'Testimonials Carousel Speed', 'energytheme' ),
			'description' => esc_html__('Adjust the testimonials carousel speed for the testimonials shortcode. (Requires window refresh)', 'energytheme'),
			'priority' => 2,
			'input_attrs' => array(
				'min' => 2000,
				'max' => 15000,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );
		
		
		
				
		//Shortcode Option Colors
		$shortcodeOptionColors = array();
		
		$shortcodeOptionColors[] = array(
			'slug'=>'tabContentBgColor', 
			'default' => '#eeeeee',
			'transport' => 'postMessage',
			'label' => esc_html__('Tab content color', 'energytheme'),
			'description' => esc_html__('Adjust the background color of the tab system content area.', 'energytheme'),
		);
		
		$shortcodeOptionColors[] = array(
			'slug'=>'accordionContentBgColor', 
			'default' => '#ffffff',
			'transport' => 'postMessage',
			'label' => esc_html__('Accordion content color', 'energytheme'),
			'description' => esc_html__('Adjust the background color of the accordion system content area.', 'energytheme'),
		);
		
		$shortcodeOptionColors[] = array(
			'slug'=>'quote_box_color', 
			'default' => '#2A313A',
			'transport' => 'refresh',
			'label' => esc_html__('Quote box color', 'energytheme'),
			'description' => esc_html__('Adjust the background color of quote box shortcode. (Requires window refresh)', 'energytheme'),
		);
		
		$shortcodeOptionColors[] = array(
			'slug'=>'data_table_title_color', 
			'default' => '#0084a5',
			'transport' => 'postMessage',
			'label' => esc_html__('Data Table title color', 'energytheme'),
			'description' => esc_html__('Adjust the background color of the data table title column.', 'energytheme'),
		);
		
		$shortcodeOptionColors[] = array(
			'slug'=>'data_table_info_color', 
			'default' => '#E8E8E8',
			'transport' => 'postMessage',
			'label' => esc_html__('Data Table info color', 'energytheme'),
			'description' => esc_html__('Adjust the background color of the data table info column.', 'energytheme'),
		);
		
		$shortcodeOptionColors[] = array(
			'slug'=>'trial_form_bg_color', 
			'default' => '#0F1926',
			'transport' => 'postMessage',
			'label' => esc_html__('Trial Form Background Color', 'energytheme'),
			'description' => esc_html__('Adjust the background color of the trial form.', 'energytheme'),
		);

				
		foreach( $shortcodeOptionColors as $color ) {
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'transport' => $color['transport'],
					'description' => $color['description'],
					'type' => 'option', 
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr'
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'transport' => $color['transport'],
					'description' => $color['description'],
					'section' => 'shortcode_options',
					'settings' => $color['slug'])
				)
			);
		}//end of foreach
		
		
		/**** Alert Options ****/
		$wp_customize->add_section( 'alert_options' , array(
			'title'    => esc_html__( 'Alert Options', 'energytheme' ),
		));
				
		$alertColors = array();
		
		$alertColors[] = array(
			'slug'=>'alert_success_color', 
			'default' => '#2c5e83',
			'label' => esc_html__('Success Color', 'energytheme')
		);
		$alertColors[] = array(
			'slug'=>'alert_info_color', 
			'default' => '#cbb35e',
			'label' => esc_html__('Info Color', 'energytheme')
		);
		$alertColors[] = array(
			'slug'=>'alert_warning_color', 
			'default' => '#ea6872',
			'label' => esc_html__('Warning Color', 'energytheme')
		);
		$alertColors[] = array(
			'slug'=>'alert_danger_color', 
			'default' => '#5f3048',
			'label' => esc_html__('Danger Color', 'energytheme')
		);
		$alertColors[] = array(
			'slug'=>'alert_notice_color', 
			'default' => '#49c592',
			'label' => esc_html__('Notice Color', 'energytheme')
		);
		
		$priority = 0;
		
		foreach( $alertColors as $color ) {
			
			$priority = $priority + 10;
			
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'type' => 'option', 
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr'
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'section' => 'alert_options',
					'settings' => $color['slug'],
					'priority' => $priority,
					)
				)
			);
		}//end of foreach
		
		/**** Micro Slider Options ****/
		$wp_customize->add_section( 'pulseslider_options' , array(
			'title'    => esc_html__( 'Micro Slider Options', 'energytheme' ),
		));
		
		//Upload Options
		$wp_customize->add_setting( 'sliderBackgroundImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'sliderBackgroundImage', 
			array(
				'label'    => esc_html__( 'Slider Text Background Image', 'energytheme' ),
				'section'  => 'pulseslider_options',
				'settings' => 'sliderBackgroundImage',
				'priority' => 1,
				) 
			) 
		);		
		
		$wp_customize->add_setting('enablePulseSlider', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('enablePulseSlider', array(
			'label'      => esc_html__('Enable Micro Slider?', 'energytheme'),
			'section'    => 'pulseslider_options',
			'settings'   => 'enablePulseSlider',
			'type'       => 'radio',
			'priority' => 2,
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('enableFixedHeight', array(
			'default' => 'true',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('enableFixedHeight', array(
			'label'      => esc_html__('Fixed Height?', 'energytheme'),
			'section'    => 'pulseslider_options',
			'settings'   => 'enableFixedHeight',
			'type'       => 'radio',
			'priority' => 3,
			'choices'    => array(
				'true'   => 'ON',
				'false'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('enableSlideShow', array(
			'default' => 'true',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('enableSlideShow', array(
			'label'      => esc_html__('Enable SlideShow?', 'energytheme'),
			'section'    => 'pulseslider_options',
			'settings'   => 'enableSlideShow',
			'type'       => 'radio',
			'priority' => 4,
			'choices'    => array(
				'true'   => 'ON',
				'false'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('slideLoop', array(
			'default' => 'true',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('slideLoop', array(
			'label'      => esc_html__('Loop Slides?', 'energytheme'),
			'section'    => 'pulseslider_options',
			'settings'   => 'slideLoop',
			'type'       => 'radio',
			'priority' => 5,
			'choices'    => array(
				'true'   => 'ON',
				'false'  => 'OFF',
			),
		));

		$wp_customize->add_setting('enableControlNav', array(
			'default' => 'true',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('enableControlNav', array(
			'label'      => esc_html__('Enable Bullets?', 'energytheme'),
			'section'    => 'pulseslider_options',
			'settings'   => 'enableControlNav',
			'priority' => 6,
			'type'       => 'radio',
			'choices'    => array(
				'true'   => 'ON',
				'false'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('pauseOnHover', array(
			'default' => 'true',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('pauseOnHover', array(
			'label'      => esc_html__('Pause on hover?', 'energytheme'),
			'section'    => 'pulseslider_options',
			'settings'   => 'pauseOnHover',
			'type'       => 'radio',
			'priority' => 7,
			'choices'    => array(
				'true'   => 'ON',
				'false'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('showArrows', array(
			'default' => 'true',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('showArrows', array(
			'label'      => esc_html__('Display arrows?', 'energytheme'),
			'section'    => 'pulseslider_options',
			'settings'   => 'showArrows',
			'type'       => 'radio',
			'priority' => 8,
			'choices'    => array(
				'true'   => 'ON',
				'false'  => 'OFF',
			),
		));

		$wp_customize->add_setting('animationType', array(
			'default' => 'slide',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('animationType', array(
			'label'      => esc_html__('Animation Type', 'energytheme'),
			'section'    => 'pulseslider_options',
			'settings'   => 'animationType',
			'type'       => 'radio',
			'priority' => 9,
			'choices'    => array(
				'fade'   => 'Fade',
				'slide'  => 'Slide',
			),
		));
		
		$wp_customize->add_setting( 'slideShowSpeed', array(
			'default' => 8000,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'slideShowSpeed', array(
			'type' => 'range',
			'section' => 'pulseslider_options',
			'label'   => esc_html__( 'Slide Show Speed', 'energytheme' ),
			'description' => esc_html__('Adjust the slideshow speed of the Micro Slider. Only applies if the slideshow option is enabled. (Requires window refresh)', 'energytheme'),
			'priority' => 10,
			'input_attrs' => array(
				'min' => 1000,
				'max' => 10000,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );
		
		
		$wp_customize->add_setting( 'slideSpeed', array(
			'default' => 500,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'slideSpeed', array(
			'type' => 'range',
			'section' => 'pulseslider_options',
			'label'   => esc_html__( 'Slide Speed', 'energytheme' ),
			'description' => esc_html__('Adjust the slide speed of the Micro Slider. (Requires window refresh)', 'energytheme'),
			'priority' => 11,
			'input_attrs' => array(
				'min' => 500,
				'max' => 1000,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );
		
		
		
		$wp_customize->add_setting( 'sliderHeight', array(
			'default' => 945,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'sliderHeight', array(
			'type' => 'range',
			'section' => 'pulseslider_options',
			'label'   => esc_html__( 'Slider Height', 'energytheme' ),
			'description' => esc_html__('Adjust the height of the Micro Slider. (Requires window refresh)', 'energytheme'),
			'priority' => 12,
			'input_attrs' => array(
				'min' => 300,
				'max' => 1000,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );
		
		
		$wp_customize->add_setting( 'sliderTitleBackgroundOpacity', array(
			'default' => 90,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'sliderTitleBackgroundOpacity', array(
			'type' => 'range',
			'section' => 'pulseslider_options',
			'label'   => esc_html__( 'Title background opacity', 'energytheme' ),
			'description' => esc_html__('Adjust the background opacity of the slide title. (Requires window refresh)', 'energytheme'),
			'priority' => 13,
			'input_attrs' => array(
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );
		
		
		$wp_customize->add_setting( 'sliderMessageBackgroundOpacity', array(
			'default' => 90,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'sliderMessageBackgroundOpacity', array(
			'type' => 'range',
			'section' => 'pulseslider_options',
			'label'   => esc_html__( 'Message background opacity', 'energytheme' ),
			'description' => esc_html__('Adjust the background opacity of the slide message. (Requires window refresh)', 'energytheme'),
			'priority' => 14,
			'input_attrs' => array(
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );
		
				
		$PulseSliderColors = array();
		
		$PulseSliderColors[] = array(
			'slug'=>'sliderTitleBackgroundColor', 
			'default' => '#2c323b',
			'transport' => 'refresh',
			'label' => esc_html__('Title background color', 'energytheme'),
			'description' => esc_html__('Adjust the background color of the slide title. (Requires window refresh)', 'energytheme'),
		);
		
		$PulseSliderColors[] = array(
			'slug'=>'sliderMessageBackgroundColor', 
			'default' => '#2c323b',
			'transport' => 'refresh',
			'label' => esc_html__('Message background color', 'energytheme'),
			'description' => esc_html__('Adjust the background color of the slide message. (Requires window refresh)', 'energytheme'),
		);
		
		$PulseSliderColors[] = array(
			'slug'=>'sliderButtonColor', 
			'default' => '#ffffff',
			'transport' => 'postMessage',
			'label' => esc_html__('Button color', 'energytheme'),
			'description' => esc_html__('Adjust the color of the slide button.', 'energytheme'),
		);
		
		$PulseSliderColors[] = array(
			'slug'=>'sliderButtonHoverColor', 
			'default' => '#333333',
			'transport' => 'refresh',
			'label' => esc_html__('Button Hover color', 'energytheme'),
			'description' => esc_html__('Adjust the hover color of the slide button. (Requires window refresh)', 'energytheme'),
		);
		
		$PulseSliderColors[] = array(
			'slug'=>'bulletColor', 
			'default' => '#494949',
			'transport' => 'refresh',
			'label' => esc_html__('Bullet color', 'energytheme'),
			'description' => esc_html__('Adjust the color of the slider bullets. (Requires window refresh)', 'energytheme'),
		);
		
		$PulseSliderColors[] = array(
			'slug'=>'bulletBgColor', 
			'default' => '#252F3E',
			'transport' => 'refresh',
			'label' => esc_html__('Bullets Background color', 'energytheme'),
			'description' => esc_html__('Adjust the background color of the slider bullets container. (Requires window refresh)', 'energytheme'),
		);
		
		$PulseSliderColors[] = array(
			'slug'=>'arrowColor', 
			'default' => '#ffffff',
			'transport' => 'postMessage',
			'label' => esc_html__('Arrow color', 'energytheme'),
			'description' => esc_html__('Adjust the color of the arrow icons for the slider bullets system.', 'energytheme'),
		);
		
		$pulseSliderColorsCounter = 20;
		
		foreach( $PulseSliderColors as $color ) {
			
			$pulseSliderColorsCounter += 10;
			
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'transport' => $color['transport'],
					'description' => $color['description'],
					'type' => 'option', 
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr'
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'section' => 'pulseslider_options',
					'transport' => $color['transport'],
					'description' => $color['description'],
					'priority' => $pulseSliderColorsCounter,
					'settings' => $color['slug'])
				)
			);
		}//end of foreach
				
   }//end of function
   
}//end of class


if (class_exists('WP_Customize_Control')) {
	
	//Custom radio with image support
	class pm_ln_Customize_Radio_Control extends WP_Customize_Control {

		public $type = 'radio';
		public $description = '';
		public $mode = 'radio';
		public $subtitle = '';
	
		public function enqueue() {
	
			if ( 'buttonset' == $this->mode || 'image' == $this->mode ) {
				wp_enqueue_script( 'jquery-ui-button' );
				wp_register_style('customizer-styles', get_template_directory_uri() . '/css/customizer/pulsar-customizer.css');  
				wp_enqueue_style('customizer-styles');
			}
	
		}
	
		public function render_content() {
	
			if ( empty( $this->choices ) ) {
				return;
			}
	
			$name = '_customize-radio-' . $this->id;
	
			?>
			<span class="customize-control-title">
				<?php echo esc_html( $this->label ); ?>
				
			</span>
            
            <?php if ( isset( $this->description ) && '' != $this->description ) { ?>
                <p><?php echo strip_tags( esc_html( $this->description ) ); ?></p>
            <?php } ?>
	
			<div id="input_<?php echo $this->id; ?>" class="<?php echo $this->mode; ?>">
				<?php if ( '' != $this->subtitle ) : ?>
					<div class="customizer-subtitle"><?php echo $this->subtitle; ?></div>
				<?php endif; ?>
				<?php
	
				// JqueryUI Button Sets
				if ( 'buttonset' == $this->mode ) {
	
					foreach ( $this->choices as $value => $label ) : ?>
						<input type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" id="<?php echo $this->id . $value; ?>" <?php $this->link(); checked( $this->value(), $value ); ?>>
							<label for="<?php echo $this->id . $value; ?>">
								<?php echo esc_html( $label ); ?>
							</label>
						</input>
						<?php
					endforeach;
	
				// Image radios.
				} elseif ( 'image' == $this->mode ) {
	
					foreach ( $this->choices as $value => $label ) : ?>
						<input class="image-select" type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" id="<?php echo $this->id . $value; ?>" <?php $this->link(); checked( $this->value(), $value ); ?>>
							<label for="<?php echo $this->id . $value; ?>">
								<img src="<?php echo esc_html( $label ); ?>">
							</label>
						</input>
						<?php
					endforeach;
	
				// Normal radios
				} else {
	
					foreach ( $this->choices as $value => $label ) :
						?>
						<label class="customizer-radio">
							<input class="kirki-radio" type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
							<?php echo esc_html( $label ); ?><br/>
						</label>
						<?php
					endforeach;
	
				}
				?>
			</div>
			<?php if ( 'buttonset' == $this->mode || 'image' == $this->mode ) { ?>
				<script>
				jQuery(document).ready(function($) {
					$( '[id="input_<?php echo $this->id; ?>"]' ).buttonset();
				});
				</script>
			<?php }
	
		}
	}
	
	//jQuery UI Slider class
	class pm_ln_Customize_Sliderui_Control extends WP_Customize_Control {

		public $type = 'slider';
		public $description = '';
		public $subtitle = '';
	
		public function enqueue() {
	
			wp_enqueue_script( 'jquery-ui-core' );
			wp_enqueue_script( 'jquery-ui-slider' );
	
		}
	
		public function render_content() { ?>
			<label>
	
				<span class="customize-control-title">
					<?php echo esc_html( $this->label ); ?>
					<?php if ( isset( $this->description ) && '' != $this->description ) { ?>
						<a href="#" class="button tooltip" title="<?php echo strip_tags( esc_html( $this->description ) ); ?>">?</a>
					<?php } ?>
				</span>
	
				<?php if ( '' != $this->subtitle ) : ?>
					<div class="customizer-subtitle"><?php echo $this->subtitle; ?></div>
				<?php endif; ?>
	
				<input type="text" class="kirki-slider" id="input_<?php echo $this->id; ?>" disabled value="<?php echo $this->value(); ?>" <?php $this->link(); ?>/>
	
			</label>
	
			<div id="slider_<?php echo $this->id; ?>" class="ss-slider"></div>
			<script>
			jQuery(document).ready(function($) {
				$( '[id="slider_<?php echo $this->id; ?>"]' ).slider({
						value : <?php echo $this->value(); ?>,
						min   : <?php echo $this->choices['min']; ?>,
						max   : <?php echo $this->choices['max']; ?>,
						step  : <?php echo $this->choices['step']; ?>,
						slide : function( event, ui ) { $( '[id="input_<?php echo $this->id; ?>"]' ).val(ui.value).keyup(); }
				});
				$( '[id="input_<?php echo $this->id; ?>"]' ).val( $( '[id="slider_<?php echo $this->id; ?>"]' ).slider( "value" ) );
			});
			</script>
			<?php
	
		}
	}
	
	//Custom classes for extending the theme customizer
	class pm_ln_Customize_Textarea_Control extends WP_Customize_Control {
		public $type = 'textarea';
	 
		public function render_content() {
			?>
				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
				</label>
			<?php
		}
	}

}


add_action( 'customize_register' , array( 'PM_LN_Customizer' , 'register' ) );

?>