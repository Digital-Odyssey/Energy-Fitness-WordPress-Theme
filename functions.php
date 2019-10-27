<?php

/* Add filters, actions, and theme-supported features after theme is loaded */
add_action( 'after_setup_theme', 'pm_ln_theme_setup' );

function pm_ln_theme_setup() {
		
	//Define content width
	if ( !isset( $content_width ) ) $content_width = 1170;
	
	/***** LOAD REDUX FRAMEWORK ******/
	if ( !class_exists( 'ReduxFramework' ) && file_exists( get_template_directory() . '/ReduxFramework/ReduxCore/framework.php' ) ) {
		require_once( get_template_directory() . '/ReduxFramework/ReduxCore/framework.php' );
	}
	if ( !isset( $redux_demo ) && file_exists( get_template_directory() . '/ReduxFramework/energy/energy-config.php' ) ) {
		require_once( get_template_directory() . '/ReduxFramework/energy/energy-config.php' );
	}
	
		
	/***** REQUIRED INCLUDES ***************************************************************************************************/
	
	include_once(get_template_directory() . '/includes/cpt-programs.php'); //Custom post type
	include_once(get_template_directory() . '/includes/cpt-classes.php'); //Custom post type
	include_once(get_template_directory() . '/includes/cpt-gallery.php'); //Custom post type
	include_once(get_template_directory() . '/includes/cpt-staff.php'); //Custom post type
	include_once(get_template_directory() . '/includes/cpt-videos.php'); //Custom post type
	include_once(get_template_directory() . '/includes/shortcodes/shortcodes.php'); //Shortcodes
		
	//Widgets
	include_once(get_template_directory() . "/includes/widget-twitter.php"); //twitter
	include_once(get_template_directory() . "/includes/widget-facebook.php"); //facebook
	include_once(get_template_directory() . "/includes/widget-video.php"); //video
	include_once(get_template_directory() . "/includes/widget-flickr.php"); //flickr
	include_once(get_template_directory() . "/includes/widget-mailchimp.php"); //mailchimp
	include_once(get_template_directory() . "/includes/widget-quickcontact.php"); //quick contact form
	include_once(get_template_directory() . "/includes/widget-recentposts.php"); //recent posts
	include_once(get_template_directory() . "/includes/widget-events.php"); //event posts
	include_once(get_template_directory() . "/includes/widget-classes.php"); //class posts
	include_once(get_template_directory() . "/includes/widget-gallery.php"); //gallery posts
	
	//Theme update notifications library
	require_once(get_template_directory() . "/includes/theme-update-checker.php");
	
	//TGM plugin
	require_once(get_template_directory() . "/includes/tgm/class-tgm-plugin-activation.php");
	
	//Bootstrap 3 nav support
	include_once(get_template_directory() . '/includes/pm_ln_bootstrap_navwalker.php');
	
	//Customizer class
	include_once(get_template_directory() . "/includes/classes/PM_LN_Customizer.class.php");
	
	//Custom functions
	include_once(get_template_directory() . "/includes/wp-functions.php");
	
	//Theme metaboxes
	include_once(get_template_directory() . "/includes/theme-metaboxes.php");
	
	/***** CUSTOM VISUAL COMPOSER SHORTCODES ********************************************************************************/
	if ( pm_ln_is_plugin_active( 'visual-composer/js_composer.php' ) || pm_ln_is_plugin_active( 'js_composer/js_composer.php' ) ) {

		if(!class_exists('WPBakeryShortCode')) return;
	
		$de_block_dir = get_template_directory().'/includes/vc_blocks/';
		
		require_once( $de_block_dir . 'alert.php' );
		require_once( $de_block_dir . 'classes_carousel.php' );
		require_once( $de_block_dir . 'client_carousel.php' );
		require_once( $de_block_dir . 'column_title.php' );
		require_once( $de_block_dir . 'contact_form.php' );
		require_once( $de_block_dir . 'countdown.php' );
		require_once( $de_block_dir . 'cta_box.php' );
		require_once( $de_block_dir . 'divider.php' );
		require_once( $de_block_dir . 'event_posts.php' );
		require_once( $de_block_dir . 'gallery_posts.php' );
		require_once( $de_block_dir . 'google_map.php' );
		require_once( $de_block_dir . 'html_video.php' );
		require_once( $de_block_dir . 'icon_box.php' );
		require_once( $de_block_dir . 'icon_element.php' );
		require_once( $de_block_dir . 'milestone.php' );
		require_once( $de_block_dir . 'newsletter_registration.php' );
		require_once( $de_block_dir . 'panels_carousel.php' );
		require_once( $de_block_dir . 'piechart.php' );
		require_once( $de_block_dir . 'post_items.php' );
		require_once( $de_block_dir . 'pricing_table.php' );
		require_once( $de_block_dir . 'progress_bar.php' );
		require_once( $de_block_dir . 'quote_box.php' );
		require_once( $de_block_dir . 'staff_profile.php' );
		require_once( $de_block_dir . 'standard_button.php' );
		require_once( $de_block_dir . 'stat_box.php' );
		require_once( $de_block_dir . 'testimonial_profile.php' );
		require_once( $de_block_dir . 'testimonials.php' );
		require_once( $de_block_dir . 'trial_form.php' );
		require_once( $de_block_dir . 'video_box.php' );
		require_once( $de_block_dir . 'vimeo_video.php' );
		require_once( $de_block_dir . 'youtube_video.php' );

		
		//Nested elements go last
		require_once( $de_block_dir . 'accordion_group.php' );
		require_once( $de_block_dir . 'datatable_group.php' );
		require_once( $de_block_dir . 'tab_group.php' );
		require_once( $de_block_dir . 'slider_carousel.php' );				
	
	}
		
	/***** MENUS ***************************************************************************************************/
	
	register_nav_menu('main_menu', 'Main Menu');
	register_nav_menu('footer_menu', 'Footer Menu');
	
	/***** THEME SUPPORT ***************************************************************************************************/
	
	add_theme_support('post-thumbnails');
	add_theme_support('automatic-feed-links');
	add_theme_support('custom-header');
	add_theme_support('custom-background');	
	add_theme_support('title-tag');
		
	/***** CUSTOM FILTERS AND HOOKS ***************************************************************************************************/
	
	//Add your sidebars function to the 'widgets_init' action hook.
	add_action( 'widgets_init', 'pm_ln_register_custom_sidebars' );
	
	//Load front-end scripts
	add_action( 'wp_enqueue_scripts', 'pm_ln_scripts_styles' );
	
	//Load admin scripts
	add_action( 'admin_enqueue_scripts', 'pm_ln_load_admin_scripts' );
	
	add_filter('excerpt_more', 'pm_ln_new_excerpt_more');
		
	//Add content and widget text shortcode support
	add_filter('the_content', 'do_shortcode');
	add_filter('widget_text', 'do_shortcode');
		
	//Retrieve only Posts from Search function
	add_filter('pre_get_posts','pm_ln_search_filter');
	
	//Show Post ID's
	add_filter('manage_posts_columns', 'pm_ln_posts_columns_id', 5);
	add_action('manage_posts_custom_column', 'pm_ln_posts_custom_id_columns', 5, 2);
	
	//Show Page ID's
	add_filter('manage_pages_columns', 'pm_ln_posts_columns_id', 5);
    add_action('manage_pages_custom_column', 'pm_ln_posts_custom_id_columns', 5, 2);
			
	//Custom paginated posts
	add_filter('wp_link_pages_args','pm_ln_custom_nextpage_links');
	
	//Remove REL tag from posts (this will eliminate HTML5 validation error) 
	add_filter( 'wp_list_categories', 'pm_ln_remove_category_list_rel' );
	add_filter( 'the_category', 'pm_ln_remove_category_list_rel' );
	
	//Remove title attributes from WordPress navigation
	add_filter( 'wp_list_pages', 'pm_ln_remove_title_attributes' );
	
	//Ajax Scripts
	add_action('wp_enqueue_scripts', 'pm_ln_register_user_scripts');
	
	//Ajax loader function
	add_action('wp_ajax_pm_ln_load_more', 'pm_ln_load_more');
	add_action('wp_ajax_nopriv_pm_ln_load_more', 'pm_ln_load_more');
	
	add_action('wp_ajax_pm_ln_load_more_posts', 'pm_ln_load_more_posts');
	add_action('wp_ajax_nopriv_pm_ln_load_more_posts', 'pm_ln_load_more_posts');
	
	//Ajax Contact form
	add_action('wp_ajax_send_contact_form', 'pm_ln_send_contact_form');
	add_action('wp_ajax_nopriv_send_contact_form', 'pm_ln_send_contact_form');
	
	//Ajax Quick Contact form
	add_action('wp_ajax_send_quick_contact_form', 'pm_ln_send_quick_contact_form');
	add_action('wp_ajax_nopriv_send_quick_contact_form', 'pm_ln_send_quick_contact_form');
	
	//Ajax Trial form
	add_action('wp_ajax_send_trial_form', 'pm_ln_send_trial_form');
	add_action('wp_ajax_nopriv_send_trial_form', 'pm_ln_send_trial_form');
	
	//Like feature
	add_action('wp_ajax_pm_ln_retrieve_likes', 'pm_ln_retrieve_likes');
	add_action('wp_ajax_nopriv_pm_ln_retrieve_likes', 'pm_ln_retrieve_likes');
	
	add_action('wp_ajax_pm_ln_like_feature', 'pm_ln_like_feature');
	add_action('wp_ajax_nopriv_pm_ln_like_feature', 'pm_ln_like_feature');
	
	//Custom Admin fields
	add_action( 'show_user_profile', 'pm_show_extra_profile_fields' );
	add_action( 'edit_user_profile', 'pm_show_extra_profile_fields' );
	
	add_action( 'personal_options_update', 'pm_save_extra_profile_fields' );
	add_action( 'edit_user_profile_update', 'pm_save_extra_profile_fields' );
	
	add_action('init', 'app_output_buffer');
	
	//Custom login styles
	//add_action('login_head', 'pm_ln_custom_login');
	
	/**** THEME CUSTOMIZER - NEW in WP 3.4+ ****/
		
	//Output CSS to head section
	add_action ('wp_head', 'pm_ln_customizer_css', 130);
	add_action( 'customize_preview_init', 'pm_ln_customize_preview_js' );
	//add_action( 'customize_controls_enqueue_scripts', 'pm_ln_panels_js' );
	//add_action( 'wp_enqueue_scripts', 'pm_ln_customizer_styles_cache', 130 );
	//add_action( 'customize_save_after', 'pm_ln_reset_style_cache_on_customizer_save' );
	
	/**** WOOCOMMERCE ***/
	
	//Declare Woocommerce support
	add_theme_support('woocommerce');
	
	//Woocommerce gallery support for version 3.0
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	
	//Remove Woocommerce breadcrumbs
	add_action( 'init', 'pm_ln_remove_wc_breadcrumbs' );
	
	//Remove default Woocommerce wrapper
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
	
	//Add wrapper to Woocommerce pages - applies to product-archive.php and single-product.php
	add_action('woocommerce_before_main_content', 'pm_ln_woo_wrapper_start', 10);
	add_action('woocommerce_after_main_content', 'pm_ln_woo_wrapper_end', 10);
	
	//Display empty star rating
	add_filter('woocommerce_product_get_rating_html', 'pm_ln_woo_get_rating_html', 10, 2);
	
	//Display number of items per page
	$products_per_page = get_theme_mod('products_per_page', '4');
		
	add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '.$products_per_page.';' ), 20 );
	
	//Dashboard customization
	add_filter( 'admin_footer_text', 'pm_ln_remove_footer_admin' );//footer info
	add_action( 'login_enqueue_scripts', 'pm_ln_login_logo' );//login logo
	add_filter( 'login_headerurl', 'pm_ln_login_logo_url' );//login logo url
	add_filter( 'login_headertitle', 'pm_ln_login_logo_url_title' );//login logo title
	
	//TGM plugin activation
	add_action( 'tgmpa_register', 'pm_ln_register_required_plugins' );
	
	//Theme updates
	//add_action('init', 'pm_ln_check_for_theme_updates');
	
	//Custom settings page for purchase verification
	add_action( 'admin_menu', 'pm_ln_theme_settings_admin_menu' );
	
	//Create theme update options
	add_option('pm_ln_theme_marketplace','');
	add_option('pm_ln_micro_themes_user_email','');
	add_option('pm_ln_micro_themes_purchase_code_themeforest','');
	add_option('pm_ln_micro_themes_purchase_code_mojo','');
				
}//end of after_theme_setup

//localization support - NOTE: This has to be outside of after theme setup method in order to work - THEMEFOREST reviewers do not pick up on this!
add_action('after_setup_theme', 'pm_ln_localization_setup');

if( !function_exists('pm_ln_customize_preview_js') ) {
	
	function pm_ln_customize_preview_js() {
		wp_enqueue_script( 'hope-customize-preview', get_theme_file_uri( '/js/customize-preview.js' ), array( 'customize-preview' ), '1.0', true );
	}
	
}

if( !function_exists('pm_ln_panels_js') ) {
	
	function pm_ln_panels_js() {
		wp_enqueue_script( 'hope-customize-controls', get_theme_file_uri( '/js/customize-controls.js' ), array(), '1.0', true );
	}
	
}

if( !function_exists('pm_ln_register_required_plugins') ){

	function pm_ln_register_required_plugins() {
		
		/*
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array(
	
			// This is an example of how to include a plugin bundled with a theme.
			array(
				'name'               => 'Visual Composer', // The plugin name.
				'slug'               => 'js_composer', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/includes/lib/codecanyon-242431-visual-composer-page-builder-for-wordpress-wordpress-plugin.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
			
			array(
				'name'               => 'Woocommerce', // The plugin name.
				'slug'               => 'woocommerce', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/includes/lib/woocommerce.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
	
			array(
				'name'               => 'Customizer Export/Import', // The plugin name.
				'slug'               => 'customizer-export-import', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/includes/lib/customizer-export-import.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
			
			array(
				'name'               => 'Energy Events Post Type', // The plugin name.
				'slug'               => 'premium-events', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/includes/lib/custom_post_types/premium-events.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
			
			array(
				'name'               => 'Energy Schedules Post Type', // The plugin name.
				'slug'               => 'premium-schedules', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/includes/lib/custom_post_types/premium-schedules.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
			
			array(
				'name'               => 'Premium PayPal Manager', // The plugin name.
				'slug'               => 'premium-paypal-manager', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/includes/lib/premium-paypal-manager.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
			
			
			
	
		);
	
		/*
		 * Array of configuration settings. Amend each line as needed.
		 *
		 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
		 * strings available, please help us make TGMPA even better by giving us access to these translations or by
		 * sending in a pull-request with .po file(s) with the translations.
		 *
		 * Only uncomment the strings in the config array if you want to customize the strings.
		 */
		$config = array(
			'id'           => 'energytheme',                 // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',                      // Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'parent_slug'  => 'themes.php',            // Parent menu slug.
			'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
	
			
		);
	
		tgmpa( $plugins, $config );
	}

}

function pm_ln_login_logo_url() {
	return esc_url( 'https://www.pulsarmedia.ca' );
}

function pm_ln_login_logo_url_title() {
	return esc_html__('Pulsar Media :: Interactive Design Studio', "energytheme");
}

function pm_ln_login_logo() { ?>
	<style type="text/css">
		body.login div#login h1 a {
			background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/pulsar-media-login.png );
			padding-bottom: 0px;
			width:321px !important;
			background-size:100%;
		}
	</style>
<?php }

function pm_ln_remove_footer_admin () {
	echo '<span id="footer-thankyou">'. esc_html__('Developed by', "energytheme") .' <a href="http://www.pulsarmedia.ca/" target="_blank">'. esc_html__('Pulsar Media', "energytheme") .'</a> :: '. esc_html__('Interactive Design Studio', "energytheme") .' - '. esc_html__('Visit our', "energytheme") .' <a href="https://github.com/PulsarMedia" target="_blank">'. esc_html__('GitHub account', "energytheme") . '</a> ' . esc_html__('for more FREE WordPress themes and plugins', 'energytheme');
}

function pm_ln_remove_dashboard_widget () {
    remove_meta_box ( 'dashboard_quick_press', 'dashboard', 'side' );
	
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
}

function pm_ln_add_dashboard_widgets() {
	wp_add_dashboard_widget(
		'pm_ln_dashboard_widget', // Widget slug.
		esc_html__('Micro Themes - Latest News', 'energytheme'), // Title.
		'pm_ln_dashboard_widget_function' // Display function.
	);
}

function pm_ln_dashboard_widget_function() {
	
	$news_file = wp_remote_get( 'https://www.microthemes.ca/files/theme-news/news.html' );
	
	if( is_array($news_file) ) {
						
	  $header = $news_file['headers']; // array of http header lines
	  $body = $news_file['body']; // use the content
	  
	  $args = array(
			'a' => array(
				'href' => array(),
				'title' => array()
			),
			'br' => array(),
			'em' => array(),
			'strong' => array(),
			'p' => array(),
			'h2' => array(),
		);
	  
	  echo wp_kses($body, $args) ;
	  
	}
	
}


if( !function_exists('pm_ln_check_for_theme_updates') ){
	
	function pm_ln_check_for_theme_updates() {
	
		$theme_update_checker = new ThemeUpdateChecker(
			'energy-theme',
			'http://updates.microthemes.ca/theme-updates/energy-theme-updater.php'
		);
		
		$theme_update_checker->checkForUpdates();
			
	}
	
}



if( !function_exists('pm_ln_theme_settings_admin_menu') ){	
	function pm_ln_theme_settings_admin_menu() {	
		add_options_page( esc_attr__('Theme Updates', 'energytheme'), esc_attr__('Theme Updates', 'energytheme'), 'manage_options', 'myplugin/myplugin-admin-page.php', 'pm_ln_theme_settings_admin_page', 'dashicons-tickets', 6 );
	}
}


if( !function_exists('pm_ln_theme_settings_admin_page') ){

	function pm_ln_theme_settings_admin_page(){		

		if(isset($_POST['pm_ln_verify_account_update'])){			
			update_option('pm_ln_theme_marketplace', sanitize_text_field($_POST['pm_ln_theme_marketplace']));
			update_option('pm_ln_micro_themes_user_email', sanitize_text_field($_POST['pm_ln_micro_themes_user_email']));
			update_option('pm_ln_micro_themes_purchase_code_themeforest', sanitize_text_field($_POST['pm_ln_micro_themes_purchase_code_themeforest']));
			update_option('pm_ln_micro_themes_purchase_code_mojo', sanitize_text_field($_POST['pm_ln_micro_themes_purchase_code_mojo']));	
			update_option('pm_ln_micro_themes_purchased_product', 0);//Corresponds to products array in verify account script		
		}

		$pm_ln_micro_themes_user_email = get_option('pm_ln_micro_themes_user_email');
		$pm_ln_theme_marketplace = get_option('pm_ln_theme_marketplace');
		$pm_ln_micro_themes_purchase_code_themeforest = get_option('pm_ln_micro_themes_purchase_code_themeforest');	
		$pm_ln_micro_themes_purchase_code_mojo = get_option('pm_ln_micro_themes_purchase_code_mojo');	
		$pm_ln_micro_themes_purchased_product = get_option('pm_ln_micro_themes_purchased_product');		
		
		//Validate account
		$queryArgs = array();
		$queryArgs['customer_email'] = $pm_ln_micro_themes_user_email;	
		$queryArgs['customer_marketplace'] = $pm_ln_theme_marketplace;
		$queryArgs['customer_themeforest_purchase_code'] = $pm_ln_micro_themes_purchase_code_themeforest;
		$queryArgs['customer_mojo_purchase_code'] = $pm_ln_micro_themes_purchase_code_mojo;
		$queryArgs['customer_product'] = $pm_ln_micro_themes_purchased_product;
		
		$account_valid = false;
		
		//args for wp_remote_get
		$options = array(
			'timeout' => 10, //seconds
		);
		
		$url = 'http://updates.microthemes.ca/theme-updates/verify-account.php'; 
		//$url = 'http://staging.microthemes.ca/theme-updates/verify-account.php'; 
		if ( !empty($queryArgs) ){
			$url = add_query_arg($queryArgs, $url); //rebuild url with arguments
		}
		
		//Send the request to Micro Themes
		$response = wp_remote_get($url, $options);
				
		if( is_array($response) ) {
			
		  $header = $response['headers']; // array of http header lines
		  $body = $response['body']; // use the content
		  
		  if( strstr($body, "success") ){
			  $account_valid = true;
		  }
		  
		}

		?>

		<div class="wrap">
        
        	<div class="wpmm-wrapper">
            
            	<div id="content" class="wrapper-cell">
            
					<?php if(isset($_POST['pm_ln_verify_account_update'])){?>
    
                        <div class="notice notice-success is-dismissible">
                            <p><?php esc_attr_e('Your settings were updated', 'energytheme'); ?></p>
                        </div>
                        
                    <?php } ?>	
        
                    <h2><?php esc_attr_e('Theme verification', 'energytheme'); ?></h2>
                    <p><?php esc_attr_e('Use the form below to verify your Micro Themes account - this will verify your account for automatic updates.', 'energytheme'); ?></p>            
        
                    <form method="post" action="">            
        
                        <p><label><?php esc_attr_e('Select your marketplace for purchase verification', 'energytheme'); ?>:</label></p>                
        
                        <select name="pm_ln_theme_marketplace" id="pm_ln_verify_marketplace_selection">
                            <option value="default" <?php if ( 'default' == $pm_ln_theme_marketplace ) echo 'selected="selected"'; ?>>-- <?php esc_attr_e('Choose Marketplace', 'energytheme'); ?> --</option>
                            <option value="microthemes" <?php if ( 'microthemes' == $pm_ln_theme_marketplace ) echo 'selected="selected"'; ?>><?php esc_attr_e('Micro Themes', 'energytheme'); ?></option>
                            <option value="themeforest" <?php if ( 'themeforest' == $pm_ln_theme_marketplace ) echo 'selected="selected"'; ?>><?php esc_attr_e('Themeforest', 'energytheme'); ?></option>
                            <option value="mojo" <?php if ( 'mojo' == $pm_ln_theme_marketplace ) echo 'selected="selected"'; ?>><?php esc_attr_e('Mojo Marketplace', 'energytheme'); ?></option>
                        </select>                
        
                        <div id="pm_ln_micro_themes_purchase_code_themeforest" class="pm_ln_micro_themes_purchase_code <?php echo $pm_ln_theme_marketplace == 'themeforest' ? 'active' : ''; ?>">
                            <p><label><?php esc_attr_e('Themeforest item purchase code', 'energytheme'); ?>:</label></p>
                            <input class="pm-admin-theme-verify-text-field" type="text" name="pm_ln_micro_themes_purchase_code_themeforest" value="<?php esc_attr_e($pm_ln_micro_themes_purchase_code_themeforest); ?>" maxlength="200" />
                        </div> 
                        
                        <div id="pm_ln_micro_themes_purchase_code_mojo" class="pm_ln_micro_themes_purchase_code <?php echo $pm_ln_theme_marketplace == 'mojo' ? 'active' : ''; ?>">
                            <p><label><?php esc_attr_e('Mojo item purchase code', 'energytheme'); ?>:</label></p>
                            <input class="pm-admin-theme-verify-text-field" type="text" name="pm_ln_micro_themes_purchase_code_mojo" value="<?php esc_attr_e($pm_ln_micro_themes_purchase_code_mojo); ?>" maxlength="200" />
                        </div>                
        
                        <p><label><?php esc_attr_e('Micro Themes account email address', 'energytheme'); ?>:</label></p>
                        <input class="pm-admin-theme-verify-text-field" type="text" value="<?php esc_attr_e($pm_ln_micro_themes_user_email); ?>" name="pm_ln_micro_themes_user_email" maxlength="200" />             
        
                        <input type="hidden" name="pm_ln_micro_themes_installed_theme" value="Medical-Link" />    
                        <p id="pm_ln_micro_themes_verfication_status"><?php esc_attr_e('Account status', 'energytheme'); ?>: <span><b><?php echo $account_valid == true ? esc_attr('Verified', 'energytheme') : esc_attr('Unverified', 'energytheme'); ?></b></span></p>
        
                        <br />                
        
                        <input name="pm_ln_verify_account_update" class="button button-primary button-large" value="<?php esc_attr_e('Verify Account', 'energytheme'); ?>" type="submit">            
        
                    </form>
                
                </div><!-- /.wrapper-cell -->
    
                <div id="sidebar" class="wrapper-cell">
                
                    <div class="sidebar_box themes_box">
                        <h3><?php esc_attr_e('More Themes by Micro Themes', 'energytheme'); ?>:</h3>
                        <div class="inside">
                            <ul>
                            	<li>
                                	<a href="http://demos.microthemes.ca/?product=hope" target="_blank" title="Hope WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/hope.jpg" alt="Hope WordPress Themes"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=quantum" target="_blank" title="Quantum WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/quantum.jpg" alt="Quantum WordPress Themes"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=vienna" target="_blank" title="Vienna WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/vienna.jpg" alt="Vienna WordPress Themes"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=medical-link" target="_blank" title="Medical-Link WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/medical-link.jpg" alt="Medical-Link WordPress Themes"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=energy" target="_blank" title="Energy WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/energy.jpg" alt="Energy WordPress Themes"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=luxor" target="_blank" title="Luxor WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/luxor.jpg" alt="Luxor WordPress Themes"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=moxie" target="_blank" title="Moxie WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/moxie.jpg" alt="Moxie WordPress Themes"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=pro-cast" target="_blank" title="Pro-Cast WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/pro-cast.jpg" alt="Pro-Cast WordPress Themes"></a>
                                </li>	
                                			
                            </ul>
                        </div>
                        
                        <h3><?php esc_attr_e('Plug-ins by Micro Themes', 'energytheme'); ?>:</h3>
                        <div class="inside">
                            <ul>
                            	<li>
                                	<a href="http://demos.microthemes.ca/?product=easy-social-stream" target="_blank" title="Easy Social Stream"><img src="http://microthemes.ca/images/theme-ads/easy-social-stream.jpg" alt="Easy Social Stream"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=easy-social-login" target="_blank" title="Easy Social Login"><img src="http://microthemes.ca/images/theme-ads/easy-social-login.jpg" alt="Easy Social Login"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=premium-presentations" target="_blank" title="Premium Presentations"><img src="http://microthemes.ca/images/theme-ads/premium-presentations.jpg" alt="Premium Presentations"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=premium-paypal-manager" target="_blank" title="Premium Paypal Manager"><img src="http://microthemes.ca/images/theme-ads/premium-paypal-manager.jpg" alt="Premium Paypal Manager"></a>
                                </li>                                			
                            </ul>
                        </div>
                        
                    </div>
                
                </div><!-- /.wrapper-cell #sidebar -->
            
            </div><!-- /.wpmm-wrapper -->

		</div><!-- /.wrap -->

		<?php
	}
}


function pm_ln_register_user_scripts() {
	
	$debug = false;
	$ext = $debug ? '.' : '.min.';
	
	if(pm_ln_has_shortcode('contactForm') || pm_ln_is_plugin_active('js_composer/js_composer.php') ) {	
		//Contact Form
		wp_enqueue_script( 'pulsar-contactform', get_template_directory_uri() . '/js/ajax-contact/ajax-email' . $ext . 'js', array('jquery'), '1.0', true );
	}
	
	if(pm_ln_has_shortcode('trialForm') || pm_ln_is_plugin_active('js_composer/js_composer.php')) {	
		//Contact Form
		wp_enqueue_script( 'pulsar-trialform', get_template_directory_uri() . '/js/ajax-trial-form/ajax-trial-form' . $ext . 'js', array('jquery'), '1.0', true );
	}
	
	
	if(is_active_widget( '', '', 'pm_ln_quickcontact_widget')) {
		//Quick contact widget
		wp_enqueue_script( 'pulsar-ajaxemail', get_template_directory_uri() . '/js/ajax-quick-contact/ajax-quick-email' . $ext . 'js', array('jquery'), '1.0', true );
	}
	
	//Define AJAX URL and pass to JS
	$js_file = get_template_directory_uri() . '/js/wordpress.js'; 
	wp_enqueue_script( 'pm_ln_register_script', $js_file );
		$array = array( 
			'pm_ln_ajax_url' => admin_url('admin-ajax.php'),
	);
		
	wp_localize_script( 'pm_ln_register_script', 'pm_ln_register_vars', $array );	

}

/******* Custom Admin fields *****/
function pm_show_extra_profile_fields( $user ) { ?>

	<?php $author_title = get_the_author_meta( 'author_title', $user->ID ); ?>
    <h3><?php esc_attr_e('Author Title', 'energytheme') ?></h3>
	<table class="form-table">
        <tr>
			<th><label for="user_organization"><?php esc_attr_e('Author Title', 'energytheme') ?></label></th>
			<td>
				<input name="author_title" value="<?php echo esc_attr($author_title); ?>" type="text" />
			</td>
		</tr>
	</table>
	
<?php }

function pm_save_extra_profile_fields( $user_id ) {

	if ( !current_user_can( 'manage_options' )  )
		return false;

	$author_title =  sanitize_text_field($_POST['author_title']);
	update_user_meta( $user_id, 'author_title', $author_title );
	
}

/******* Remove title atts from WordPress nav *****/
function pm_ln_remove_title_attributes($input) {
    return preg_replace('/\s*title\s*=\s*(["\']).*?\1/', '', $input);
}


/*** WOOCOMMERCE FUNCTIONS *****/
function pm_ln_remove_wc_breadcrumbs() {
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}

if ( ! function_exists( 'pm_ln_woo_wrapper_start' ) ) {
	
	function pm_ln_woo_wrapper_start() {
		
		  $woocommShopLayout = get_theme_mod('woocommShopLayout', 'no-sidebar');
		
		  echo '<div class="container pm-containerPadding-top-80 pm-containerPadding-bottom-80">';
			 echo '<div class="row">';
			 
				if( $woocommShopLayout === 'left-sidebar' ) {
					get_sidebar('woocommerce');
				}
			 
				echo '<div class="col-lg-'. ( $woocommShopLayout === 'no-sidebar' ? '12' : '8' ) .' col-md-'. ( $woocommShopLayout === 'no-sidebar' ? '12' : '8' ) .' col-sm-12">';	  
		  
		  echo ''; 
	  
	}
	
}

if ( ! function_exists( 'pm_ln_woo_wrapper_end' ) ) {
	
	function pm_ln_woo_wrapper_end() {
		
		$woocommShopLayout = get_theme_mod('woocommShopLayout', 'no-sidebar');
		
	  		echo '</div>';
			
			if( $woocommShopLayout === 'right-sidebar' ) {
				get_sidebar('woocommerce');
			}
			
	  	 echo '</div>';
	  echo '</div>';
	  echo ''; 
	  
	}
	
}


if( !function_exists('pm_ln_woo_get_rating_html') ){
	
	function pm_ln_woo_get_rating_html($rating_html, $rating) {
	
		if ( $rating > 0 ) {
			$title = sprintf( __( 'Rated %s out of 5', 'woocommerce' ), $rating );
		} else {
			$title = 'Not yet rated';
			$rating = 0;
		}
	
		$rating_html  = '<div class="star-rating" title="' . $title . '">';
		$rating_html .= '<span style="width:' . ( ( $rating / 5 ) * 100 ) . '%"><strong class="rating">' . $rating . '</strong> ' . __( 'out of 5', 'woocommerce' ) . '</span>';
		$rating_html .= '</div>';
		
		return $rating_html;
		
	}
	
}


/*function pm_ln_comment_fields($fields) {
	
	$commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
 
    $fields['author'] =
        '<p class="comment-form-author">
            <input required minlength="3" class="pm-textfield" maxlength="30" placeholder="Name *" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
    '" size="30"' . $aria_req . ' />
        </p>';
 
    $fields['email'] =
        '<p class="comment-form-email">
            <input required placeholder="Email *" class="pm-textfield" id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) .
    '" size="30"' . $aria_req . ' />
        </p>';
 
    $fields['url'] =
        '<p class="comment-form-url">
            <input placeholder="Website" class="pm-textfield" id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) .
    '" size="30" />
        </p>';
 
    return $fields;	
}

function pm_ln_comment_textarea_field($comment_field) {
	$comment_field =
	'<p class="comment-form-comment">
		<textarea required placeholder="Comment…" class="pm-textarea" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
	</p>';
 
    return $comment_field;
}*/


function app_output_buffer() {
  ob_start();
}



//Remove REL tag from posts (this will eliminate HTML5 validation error)
function pm_ln_remove_category_list_rel( $output ) {
	// Remove rel attribute from the category list
	return str_replace( ' rel="category tag"', '', $output );
}


//Retrieve only Posts from Search function 
function pm_ln_search_filter($query) {
	
	if( isset($_GET['post_type']) ){
		
		if($_GET['post_type'] == 'product'){
			
			if ($query->is_search) {
				$query->set('post_type',array('product'));
			}
			
		}
		
	} else {
		
		if ($query->is_search) {
			$query->set('post_type',array('post', 'page', 'post_classes', 'post_galleries', 'post_programs', 'post_staff', 'post_videos'));
		}
		
	}
		
	return $query;
}

//Show Post ID's
function pm_ln_posts_columns_id($defaults){
	$defaults['wps_post_id'] = esc_attr__('ID', 'energytheme');
	return $defaults;
}
function pm_ln_posts_custom_id_columns($column_name, $id){
		if($column_name === 'wps_post_id'){
				echo $id;
	}
}

//Excerpt filters
function pm_ln_new_excerpt_more($more) {
	global $post;
	return '';
}

//Custom paginated posts
function pm_ln_custom_nextpage_links($defaults) {
	$args = array(
		'before' => '<div class="pm_paginated-posts"><p>'. esc_attr__('Continue Reading: ', 'energytheme') .'</p><ul class="pagination_multi clearfix">',
		'after' => '</ul></div>',
		'link_before'      => '<li>',
		'link_after'       => '</li>',
	);
	$r = wp_parse_args($args, $defaults);
	return $r;
}

//Enqueue scripts and styles for admin area
function pm_ln_load_admin_scripts() {
	
	//Load Media uploader script for custom meta options
	wp_enqueue_script( 'pulsar-mediauploader', get_template_directory_uri() . '/js/media-uploader/pm-image-uploader.js', array(), '1.0', true );
	
	//Custom CSS for meta boxes
	wp_enqueue_style( 'pulsar-wpadmin', get_template_directory_uri() . '/js/wp-admin/wp-admin.css' );
	
	//JS for admin
	wp_enqueue_script( 'pulsar-wpadminjs', get_template_directory_uri() . '/js/wp-admin/wp-admin.js', array(), '1.0', true );
	
	//Time selector for events and schedule post type
	wp_enqueue_script( 'pulsar-timeselector', get_template_directory_uri() . '/js/time-selector/jquery.ptTimeSelect.js', array(), '1.0', true );
	wp_enqueue_style( 'pulsar-timeselector', get_template_directory_uri() . '/js/time-selector/jquery.ptTimeSelect.css' );
	
	//Date picker for Classes and Event post types
	wp_enqueue_script( 'jquery-ui-core' );
	wp_enqueue_script( 'jquery-ui-datepicker' );
	wp_enqueue_style( 'pulsar-datepicker', get_template_directory_uri() . '/css/datepicker/jquery-ui.min.css' );
	
	$admin_js = get_template_directory_uri() . '/js/wp-admin/wp-admin.js'; 
	
	//Pass admin path to JS
	wp_register_script( 'adminRoot', $admin_js  );
	wp_enqueue_script( 'adminRoot' );
	$array = array( 
		'adminRoot' => home_url(),
	);
	wp_localize_script( 'adminRoot', 'adminRootObject', $array ); 
	
}

//Enqueue scripts and styles
function pm_ln_scripts_styles() {
		
	global $wp_styles;
	global $post;

	// Adds JavaScript to pages with the comment form to support sites with threaded comments (when in use).
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
	
		wp_enqueue_script( 'comment-reply' );
		
		$debug_mode = false;
		$dot = $debug_mode ? '.' : '.min.';

		//Required scripts
		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/bootstrap3/js/bootstrap.min.js', array("jquery"), '1.0', true ); //MINIMIZED
		wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.custom.js', array("jquery"), '1.0', false ); //MINIMIZED
		wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/js/jquery.fitvids.min.js', array("jquery"), '1.0', true ); //MINIMIZED
		wp_enqueue_script( 'superfish', get_template_directory_uri() . '/js/superfish/superfish.min.js', array("jquery"), '1.0', true );//MINIMIZED
		wp_enqueue_script( 'hoverIntent', get_template_directory_uri() . '/js/superfish/hoverIntent.js', array("jquery"), '1.0', true );//MINIMIZED
		wp_enqueue_script( 'tinynav', get_template_directory_uri() . '/js/tinynav.js', array("jquery"), '1.0', true );//MINIMIZED
		wp_enqueue_script( 'easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array("jquery"), '1.0', true );//MINIMIZED
		
		//Mobile menu
		wp_enqueue_script( 'meanmenu', get_template_directory_uri() . '/js/meanmenu/jquery.meanmenu.min.js', array("jquery"), '1.0', true );//MINIMIZED
		wp_enqueue_style( 'meanmenu-css', get_template_directory_uri() . '/js/meanmenu/meanmenu.min.css', array( 'pulsar-style' ), '20121010' );//MINIMIZED
		
		//Load Stellar Parallax
		wp_enqueue_script( 'stellar', get_template_directory_uri() . '/js/stellar/jquery.stellar.min.js', array("jquery"), '1.0', true );//MINIMIZED
		
		
		//Conditional scripts
		$retinaSupport = get_theme_mod('retinaSupport', 'off');
		if($retinaSupport === 'on'){
			wp_enqueue_script( 'retina', get_template_directory_uri() . '/js/retina.js', array("jquery"), '1.0', true );//MINIMIZED
		}
		
		
		if( pm_ln_has_shortcode('sliderCarousel') || pm_ln_has_shortcode('classesCarousel') || pm_ln_is_plugin_active('js_composer/js_composer.php')){
			//Flexslider
			wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/flexslider/jquery.flexslider' . $dot . 'js', array("jquery"), '1.0', true );//MINIMIZED
			wp_enqueue_style( 'flexslider-css', get_template_directory_uri() . '/js/flexslider/flexslider-post' . $dot . 'css', array( 'pulsar-style' ), '20121010' );	//MINIMIZED
		}
		
		if( is_active_widget( '', '', 'pm_galleryposts_widget') || is_page_template('template-gallery.php') || get_post_type() === 'post_galleries' || pm_ln_has_shortcode('videoBox') || is_page_template('template-videos.php') || get_post_type() === 'post_videos' || pm_ln_has_shortcode('galleryPosts') || pm_ln_is_plugin_active('js_composer/js_composer.php') ) {
			
			//PrettyPhoto
			wp_enqueue_style( 'prettyPhoto-css', get_template_directory_uri() . '/js/prettyphoto/css/prettyPhoto.min.css', array( 'pulsar-style' ), '20121010' );//MINIMIZED
			wp_enqueue_script( 'prettyphoto', get_template_directory_uri() . '/js/prettyphoto/js/jquery.prettyPhoto.js', array("jquery"), '1.0', true );//MINIMIZED
			wp_enqueue_script( 'migrate', get_template_directory_uri() . '/js/jquery-migrate-1.1.1.js', array("jquery"), '1.0', true );//MINIMIZED
			
		}
				
				
		if(is_active_widget( '', '', 'latest-tweets')) {
			wp_enqueue_script( 'twitterFetcher', get_template_directory_uri() . '/js/twitter-post-fetcher/twitterFetcher_min.js', array("jquery"), '1.0', true );//MINIMIZED
		}
		
		if( pm_ln_has_shortcode('postItems') || pm_ln_has_shortcode('panelsCarousel') || pm_ln_has_shortcode('clientCarousel') || pm_ln_is_plugin_active('js_composer/js_composer.php') ) {
			
			//load owl carousel
			wp_enqueue_style( 'owl-carousel-css', get_template_directory_uri() . '/js/owl-carousel/owl.carousel.css', array( 'pulsar-style' ), '20121010' );//MINIMIZED
			wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl-carousel/owl.carousel.min.js', array("jquery"), '1.0', true );//MINIMIZED
			
		}
		
		$toggleParallaxFooter = get_theme_mod('toggleParallaxFooter', 'on');
		$toggleParallaxAuthor = get_theme_mod('toggleParallaxAuthor', 'on');
		
		
		
		if( pm_ln_has_shortcode('piechart') || pm_ln_has_shortcode('milestone') || pm_ln_is_plugin_active('js_composer/js_composer.php') ) {
			//Load Easypiechart
			wp_enqueue_script( 'easypiechart', get_template_directory_uri() . '/js/easypiechart/jquery.easypiechart.min.js', array("jquery"), '1.0', true );//MINIMIZED
		}
		
		if( pm_ln_has_shortcode('countdown') || pm_ln_is_plugin_active('js_composer/js_composer.php') ) {
			//Load Countdown
			wp_enqueue_script( 'countdown', get_template_directory_uri() . '/js/countdown/countdown.min.js', array("jquery"), '1.0', true );//MINIMIZED
		}
		
		if( pm_ln_has_shortcode('googleMap') || pm_ln_is_plugin_active('js_composer/js_composer.php') ) {
			
			$googleAPIKey = get_theme_mod('googleAPIKey');
			
			//Google maps shortcode support
			wp_register_script('googlemaps', ('//maps.google.com/maps/api/js?key='.$googleAPIKey.''), false, null, true);
			wp_enqueue_script('googlemaps');
			
		}

		
		if( is_single() || is_page() || is_home() || is_front_page() ){
									
			//Load WOW
			wp_enqueue_style( 'wow-css', get_template_directory_uri() . '/js/wow/css/libs/animate.min.css', array( 'pulsar-style' ), '20121010' );//MINIMIZED
			wp_enqueue_script( 'wow', get_template_directory_uri() . '/js/wow/wow.min.js', array("jquery"), '1.0', true );//MINIMIZED
			
			
			//Load Viewport Selectors for jQuery
			wp_enqueue_script( 'viewmini', get_template_directory_uri() . '/js/jquery.viewport.mini.js', array("jquery"), '1.0', true );//MINIMIZED

						
		}
		
		if( is_single() || is_page() || is_home() || is_front_page() || is_archive() || is_search() || is_page_template('template-gallery.php') || is_page_template('template-blog.php')  ){
			
			//Like feature
			wp_enqueue_script( 'pulsar-like', get_template_directory_uri() . '/js/ajax-like-feature/ajax-like-feature' . $dot . 'js', array("jquery"), '1.0', true );//MINIMIZED
			$js_file = get_template_directory_uri() . '/js/wordpress.js'; 
			wp_enqueue_script( 'jcustomlike', $js_file );
			$array = array( 
				'ajaxurl' => admin_url('admin-ajax.php'),
				'like_nonce' => wp_create_nonce('like_nonce_ajax'),
				'loading' => esc_attr__('Loading...', 'energytheme')
			);
			wp_localize_script( 'jcustomlike', 'pulsarajaxlike', $array );
			
		}
		
		if(is_home() || is_front_page()){
			//Load pulse slider
			wp_enqueue_script( 'pulsar-pulseslider', get_template_directory_uri() . '/js/pulse/jquery.PMSlider' . $dot . 'js', array("jquery"), '1.0', true );//MINIMIZED
			wp_enqueue_style( 'pulsar-pulseslider', get_template_directory_uri() . '/js/pulse/pm-slider' . $dot . 'css', array( 'pulsar-style' ), '20121010' );//MINIMIZED
		}
		
		if( is_page_template('template-gallery.php') || is_page_template('template-events.php') || is_page_template('template-schedules.php') || is_page_template('template-staff.php') || is_page_template('template-videos.php') ){
			
			//load isotope
			wp_enqueue_style( 'isotope-css', get_template_directory_uri() . '/js/isotope/isotope.min.css', array( 'pulsar-style' ), '20121010' );//MINIMIZED
			wp_enqueue_script( 'isotope-js', get_template_directory_uri() . '/js/isotope/jquery.isotope.min.js', array("jquery"), '1.0', true );//MINIMIZED
			
		}
		
		if( is_page_template('template-schedules.php') ){
			
			//Load Ajax loader and nonce
			$js_file = get_template_directory_uri() . '/js/wordpress.js'; 
			
			wp_enqueue_script( 'jcustom', $js_file );
			$array = array( 
				'ajaxurl' => admin_url('admin-ajax.php'),
				'nonce' => wp_create_nonce('pulsar_ajax'),
				'loading' => esc_attr__('Loading...', 'energytheme')
			);
			wp_localize_script( 'jcustom', 'pulsarajax', $array );
			
		}
		
		if( pm_ln_has_shortcode('testimonials') || pm_ln_is_plugin_active('js_composer/js_composer.php') ) {
			//Testimonials carousel script
			wp_enqueue_script( 'pulsar-testimonials', get_template_directory_uri() . '/js/jquery.testimonials' . $dot . 'js', array("jquery"), '1.0', true );//MINIMIZED
		}
				
		//Pulsar Tooltip
		$enableTooltip = get_theme_mod('enableTooltip', 'on');
		if($enableTooltip === 'on') :
			wp_enqueue_script( 'pulsar-tooltip', get_template_directory_uri() . '/js/jquery.tooltip' . $dot . 'js', array("jquery"), '1.0', true );//MINIMIZED
		endif;
						
		
		
		//Load main theme script
		wp_enqueue_script( 'pulsar-main', get_template_directory_uri() . '/js/main' . $dot . 'js', array("jquery"), '1.0', true );//MINIMIZED
		
		
		//Load theme color selector (for sampling purposes)
		$colorSampler = get_theme_mod('colorSampler', 'off');
		if( $colorSampler == 'on' ){
			wp_enqueue_script( 'pulsar-theme-color-selector', get_template_directory_uri() . '/js/theme-color-selector/theme-color-selector' . $dot . 'js', array("jquery"), '1.0', true );//MINIMIZED
			wp_enqueue_style( 'pulsar-theme-color-selector-css', get_template_directory_uri() . '/js/theme-color-selector/theme-color-selector' . $dot . 'css', array( 'pulsar-style' ), '20121010' );//MINIMIZED
		}
				
		//Loads our main stylesheet.
		wp_enqueue_style( 'pulsar-style', get_stylesheet_uri() );
		
		wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/bootstrap3/css/bootstrap.min.css', array( 'pulsar-style' ), '20121010' );//MINIMIZED
		wp_enqueue_style( 'master-css', get_template_directory_uri() . '/css/master.css', array( 'pulsar-style' ), '20121010' );//MINIMIZED
		
	
		//Loads other stylesheets.
		wp_enqueue_style( 'superfish-css', get_template_directory_uri() . '/css/superfish/superfish.min.css', array( 'pulsar-style' ), '20121010' );//MINIMIZED
		wp_enqueue_style( 'fontawesome-css', get_template_directory_uri() . '/css/fontawesome/font-awesome.min.css', array( 'pulsar-style' ), '20121010' );//MINIMIZED
		wp_enqueue_style( 'typicons-css', get_template_directory_uri() . '/css/typicons/typicons.min.css', array( 'pulsar-style' ), '20121010' );//MINIMIZED
		
		//Responsive css - load this last
		wp_enqueue_style( 'pulsar-responsive', get_template_directory_uri() . '/css/responsive' . $dot . 'css', array( 'pulsar-style' ), '20121010' );//MINIMIZED
								
		//Load ie9 specific css - use this to fix ie 9 issues
		/*wp_enqueue_style( 'ie-nine-css', get_stylesheet_directory_uri() . '/css/ie9.css', array( 'pulsar-style' ), '20121010' );
		$wp_styles->add_data( 'ie-nine-css', 'conditional', 'IE 9' );*/
		
		
		/****** JAVASCRIPT LOCALIZATION ********/
		global $energy_options;
		
		$js_file = get_template_directory_uri() . '/js/wordpress.js'; 
		
		//Get locale and export for JS
		$getLocale = get_locale();
		$splitLocale = explode("_", $getLocale);
		$currentLocale = $splitLocale[0];

		//Retrieve categories
		$categories = get_categories();
		
		//Pass drop menu indicator to JS
		$dropMenuIndicator = get_theme_mod('dropMenuIndicator', 'fa-angle-down');
		
		//Pass stickyNav to JS
		$enableStickyNav = get_theme_mod('enableStickyNav', 'on');
		
		//Get Pulse slider settings for JS
		$enableSlideShow = get_theme_mod('enableSlideShow', 'true');
		$slideLoop = get_theme_mod('slideLoop', 'true');
		$enableControlNav = get_theme_mod('enableControlNav', 'true');
		$pauseOnHover = get_theme_mod('pauseOnHover', 'true');
		$showArrows = get_theme_mod('showArrows', 'true');
		$animationType = get_theme_mod('animationType', 'slide');
		$slideShowSpeed = get_theme_mod('slideShowSpeed', 8000);
		$slideSpeed = get_theme_mod('slideSpeed', 500);
		$sliderHeight = get_theme_mod('sliderHeight', 945);
		$enableFixedHeight = get_theme_mod('enableFixedHeight', 'true');		
		
		//Get PrettyPhoto settings
		$ppAnimationSpeed = $energy_options['ppAnimationSpeed'];
		$ppAutoPlay = $energy_options['ppAutoPlay'];
		$ppShowTitle = $energy_options['ppShowTitle'];
		$ppColorTheme = $energy_options['ppColorTheme'];
		$ppSlideShowSpeed = $energy_options['ppSlideShowSpeed'];
		
		//Pass post carousel options
		$postCarouselSpeed = get_theme_mod('postCarouselSpeed', 0);
		$testimonialCarouselSpeed = get_theme_mod('testimonialCarouselSpeed', 2000);
		
		/** Global messages **/
		$securityError = esc_attr__('Please verify that you are human.', 'energytheme');
		$successMessage = esc_attr__('Your inquiry has been received, thank you.', 'energytheme');
		$failedMessage = esc_attr__('A system error occurred. Please try again later.', 'energytheme');
		$consentError = esc_attr__('Please agree to give consent before submitting your personal information.', 'energytheme');
		
		/** Contact form **/
		$contactForm1 = esc_attr__('Please provide your first name.', 'energytheme');
		$contactForm2 = esc_attr__('Please provide your last name.', 'energytheme');
		$contactForm3 = esc_attr__('Please provide a valid email address.', 'energytheme');
		$contactForm4 = esc_attr__('Please provide a message for your inquiry.', 'energytheme');		
		
		/** Quick contact **/
		$quickContact1 = esc_attr__('Please provide your full name.', 'energytheme');
		$quickContact2 = esc_attr__('Please provide a valid email address.', 'energytheme');
		$quickContact3 = esc_attr__('Please provide a message for your inquiry.', 'energytheme');

		/** Trial form **/
		$trial1 = esc_attr__('Please provide your full name.', 'energytheme');
		$trial2 = esc_attr__('Please provide a valid email address.', 'energytheme');
		
		
		//Javascript Object	
		$wordpressOptionsArray = array( 
			'urlRoot' => home_url(),
			'templateDir' => get_template_directory_uri(),
			'categories' => $categories,
			'dropMenuIndicator' => $dropMenuIndicator,
			'stickyNav' => $enableStickyNav,
			'autoPlay' => $postCarouselSpeed,
			'testimonialCarouselSpeed' => $testimonialCarouselSpeed,
			'securityError' => $securityError,
			'successMessage' => $successMessage,
			'failedMessage' => $failedMessage,
			'fieldValidation' => esc_html__('Validating form...', 'energytheme'),
			'contactForm1' => $contactForm1,
			'contactForm2' => $contactForm2,
			'contactForm3' => $contactForm3,
			'contactForm4' => $contactForm4,
			'consentError' => $consentError,
			'quickContact1' => $quickContact1,
			'quickContact2' => $quickContact2,
			'quickContact3' => $quickContact3,
			'trial1' => $trial1,
			'trial2' => $trial2,
			'ppAnimationSpeed' => $ppAnimationSpeed,
			'ppAutoPlay' => $ppAutoPlay,
			'ppShowTitle' => $ppShowTitle,
			'ppColorTheme' => $ppColorTheme,
			'ppSlideShowSpeed' => $ppSlideShowSpeed,
			'enableSlideShow' => $enableSlideShow,
			'slideLoop' => $slideLoop,
			'enableControlNav' => $enableControlNav,
			'animationType' => $animationType,
			'pauseOnHover' => $pauseOnHover,
			'showArrows' => $showArrows,
			'slideShowSpeed' => $slideShowSpeed,
			'slideSpeed' => $slideSpeed,
			'sliderHeight' => $sliderHeight,
			'fixedHeight' => $enableFixedHeight,
			'currentLocale' => $currentLocale
		);
		
		wp_enqueue_script('wordpressOptions', get_template_directory_uri() . '/js/wordpress.js');
		wp_localize_script( 'wordpressOptions', 'wordpressOptionsObject', $wordpressOptionsArray );
		
}

function pm_ln_register_custom_sidebars() {
		
	if (function_exists('register_sidebar')) {
		
		//DEFAULT TEMPLATE
		register_sidebar(array(
								'name'          => esc_html__( 'Default Template', 'energytheme' ),
								'id'            => 'default_widget',
								'description'   => '',
								'class'         => '',
								'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="pm-widget-spacer">',
								'after_widget'  => '</div></div>',
								'before_title'  => '<h6>',
								'after_title'   => '</h6><div class="pm-sidebar-title-divider"><div class="pm-sidebar-title-diamond"></div></div>'
								
		));
		
		//HOMEPAGE
		register_sidebar(array(
								'name' => esc_html__('Home Page','energytheme'),
								'id' => 'homepage_widget',
								'description'   => '',
								'class'         => '',
								'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="pm-widget-spacer">',
								'after_widget'  => '</div></div>',
								'before_title'  => '<h6>',
								'after_title'   => '</h6><div class="pm-sidebar-title-divider"><div class="pm-sidebar-title-diamond"></div></div>'
		));

		//NEWS POSTS PAGE
		register_sidebar(array(
								'name' => esc_html__('Blog Page','energytheme'),
								'id' => 'blogpage_widget',
								'description'   => '',
								'class'         => '',
								'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="pm-widget-spacer">',
								'after_widget'  => '</div></div>',
								'before_title'  => '<h6>',
								'after_title'   => '</h6><div class="pm-sidebar-title-divider"><div class="pm-sidebar-title-diamond"></div></div>'
		));


		//NEWS SINGLE POST PAGE
		/*register_sidebar(array(
								'name' => esc_attr__('Single Blog Post','energytheme'),
								'before_widget' => '<div id="%1$s" class="%2$s pm-widget"><div class="pm-widget-spacer">',
								'after_widget' => '</div></div>',
								'before_title' => '<h6>',
								'after_title' => '</h6><div class="pm-sidebar-title-divider"><div class="pm-sidebar-title-diamond"></div></div>',
		));*/
		
				
		//FOOTER
		register_sidebar(array(
								'name' => esc_html__('Footer Column 1','energytheme'),
								'id' => 'footer_column1_widget',
								'description'   => '',
								'class'         => '',
								'before_widget' => '<div id="%1$s" class="widget %2$s">',
								'after_widget'  => '</div>',
								'before_title'  => '<h6>',
								'after_title'   => '</h6>'
		));
		
		register_sidebar(array(								
								'name' => esc_html__('Footer Column 2','energytheme'),
								'id' => 'footer_column2_widget',
								'description'   => '',
								'class'         => '',
								'before_widget' => '<div id="%1$s" class="widget %2$s">',
								'after_widget'  => '</div>',
								'before_title'  => '<h6>',
								'after_title'   => '</h6>'
		));
		
		register_sidebar(array(
								'name' => esc_html__('Footer Column 3','energytheme'),
								'id' => 'footer_column3_widget',
								'description'   => '',
								'class'         => '',
								'before_widget' => '<div id="%1$s" class="widget %2$s">',
								'after_widget'  => '</div>',
								'before_title'  => '<h6>',
								'after_title'   => '</h6>'
		));
		
		register_sidebar(array(
								'name' => esc_html__('Footer Column 4','energytheme'),
								'id' => 'footer_column4_widget',
								'description'   => '',
								'class'         => '',
								'before_widget' => '<div id="%1$s" class="widget %2$s">',
								'after_widget'  => '</div>',
								'before_title'  => '<h6>',
								'after_title'   => '</h6>'
		));
		
		//Woocommerce
		register_sidebar(array(
								'name' => esc_attr__('Woocommerce','energytheme'),
								'id' => 'woocommerce_widget',
								'description'   => '',
								'class'         => '',
								'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="pm-widget-spacer">',
								'after_widget'  => '</div></div>',
								'before_title'  => '<h6>',
								'after_title'   => '</h6><div class="pm-sidebar-title-divider"><div class="pm-sidebar-title-diamond"></div></div>'
		));
		
		
		
	}//end of if function_exists
	
}//end of pm_ln_register_custom_sidebars

//localization support - Remember to define WPLANG in wp-config.php file -> define('WPLANG', 'ja');
function pm_ln_localization_setup() {
	// Retrieve the directory for the localization files
	$lang_dir = get_template_directory() . '/languages';
	// Set the theme's text domain using the unique identifier from above
	load_theme_textdomain('energytheme', $lang_dir);
} // end custom_theme_setup
	


//Custom Pagination - http://www.kriesi.at/archives/how-to-build-a-wordpress-post-pagination-without-plugin
function pm_ln_kriesi_pagination($pages = '', $range = 2){
	
	 $showitems = ($range * 2)+1;

	 global $paged;
	 if(empty($paged)) $paged = 1;

	 if($pages == '')
	 {
		 global $wp_query;
		 $pages = $wp_query->max_num_pages;
		 if(!$pages)
		 {
			 $pages = 1;
		 }
	 }

	 if(1 != $pages){
		 
		 //echo '<div class="pm-pagination-page-counter"><p>Page '. $paged .' of '. $pages .'</p></div>';
		 echo '<div class="pm-pagination-page-counter"><p></p></div>';
		 
		 echo "<ul class='pm-pagination clearfix'>";
		 if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a class='button-small grey' href='".get_pagenum_link(1)."'>&laquo;</a></li>";
		 if($paged > 1 && $showitems < $pages) echo "<li><a class='button-small-theme' href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a></li>";

		 for ($i=1; $i <= $pages; $i++)
		 {
			 if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
			 {
				 echo ($paged == $i)? "<li class='current'><span class='current'>".$i."</span></li>":"<li class='inactive'><a class='inactive' href='".get_pagenum_link($i)."' >".$i."</a></li>";
			 }
		 }

		 if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a></li>";
		 if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'>&raquo;</a></li>";
		 
	 }
	 
	 $args = array(
		'before'           => '<li>' . esc_attr__('Pages:', 'energytheme'),
		'after'            => '</li>',
		'link_before'      => '',
		'link_after'       => '',
		'next_or_number'   => 'number',
		'nextpagelink'     => esc_attr__('Next page', 'energytheme'),
		'previouspagelink' => esc_attr__('Previous page', 'energytheme'),
		'pagelink'         => '%',
		'echo'             => 1
	);
	
	echo "</ul>\n";
}


/*** Theme Customizer CSS ****/
function pm_ln_customizer_css(){
?>
        <style type="text/css">
		<?php
		
			//Global Options
			$pageBackgroundImage = get_theme_mod('pageBackgroundImage');
			$repeatBackground = get_theme_mod('repeatBackground', 'repeat');
			$pageBackgroundColor = get_option('pageBackgroundColor', '#ffffff');
			$primaryColor = get_option('primaryColor', '#f6d600');
			$secondaryColor = get_option('secondaryColor', '#2a313a');
			$secondaryColors = pm_ln_hex2rgb($secondaryColor); //Array of colors R,G,B
			$dividerColor = get_option('dividerColor', '#e3e3e3');
			$tooltipColor = get_option('tooltipColor', '#242b34');
			$sidebarBorderImage = get_theme_mod('sidebarBorderImage');
			$blockQuoteColor = get_option('blockQuoteColor', '#dbc164');
			$commentBoxColor = get_option('commentBoxColor', '#f6f6f6');
			$commentShareBoxColor = get_option('commentShareBoxColor', '#adadad');
			$widgetsPostBtnColor = get_option('widgetsPostBtnColor', '#c8c8c8');
			$linkColor = get_option('linkColor', '#9c8d00');
			$ulListIcon = get_theme_mod('ulListIcon', 'f105');
			$ulListIconColor = get_option('ulListIconColor', '#c8c8c8');
			$boxedModeContainerColor = get_option('boxedModeContainerColor', '#ffffff');
					
			//Header Options
			$mainNavBackgroundImage = get_theme_mod('mainNavBackgroundImage', "");
			$mainNavBackgroundColor = get_option('mainNavBackgroundColor',  '#000000');
			$mainNavBackgroundColors = pm_ln_hex2rgb($mainNavBackgroundColor);
			$mainNavBgOpacity = get_theme_mod('mainNavBgOpacity', 90);
			$finalMainNavBgOpacity = $mainNavBgOpacity / 100;
			
			$navDropDownColor = get_option('navDropDownColor',  '#000000');
			$navDropDownHoverColor = get_option('navDropDownHoverColor',  '#f6d600');
			$navDropDownColors = pm_ln_hex2rgb($navDropDownColor);
			$mainNavDropMenuOpacity = get_theme_mod('mainNavDropMenuOpacity', 90);
			$finalMainNavDropMenuOpacity = $mainNavDropMenuOpacity / 100;
			
			$navDropDownBorderColor = get_option('navDropDownBorderColor',  '#2d2d2c');
			$subMenuBackgroundColor = get_option('subMenuBackgroundColor', '#242B34');
			
			$mobileNavBackgroundColor = get_option('mobileNavBackgroundColor', '#0C1923');
			$mobileNavToggleColor = get_option('mobileNavToggleColor', '#FFFFFF');
					
			$subpageHeaderBackgroundColor = get_option('subpageHeaderBackgroundColor', '#666666');
			$pageTitleBackgroundColor = get_option('pageTitleBackgroundColor', '#000000');
			$pageTitleBackgroundColors = pm_ln_hex2rgb($pageTitleBackgroundColor); //Array of colors R,G,B
			
			$pageTitleOpacity = get_theme_mod('pageTitleOpacity', 70);
			$finalPageTitleOpacity = $pageTitleOpacity / 100;
			
			$searchFieldTextColor = get_option('searchFieldTextColor', '#000000');
			$expandableDivColor = get_option('expandableDivColor', '#111111');
			
			$breadcrumbsBackgroundImage = get_theme_mod('breadcrumbsBackgroundImage');
			
			$headerPadding = get_theme_mod('headerPadding', 40);
			$headerHeight = get_theme_mod('headerHeight', 170);
			
			
			
			//Header Options styles
			echo '
				header {
					'. ( $mainNavBackgroundImage !== '' ? 'background-image:url('.$mainNavBackgroundImage.')' : 'background-color:rgba('.$mainNavBackgroundColors[0].','.$mainNavBackgroundColors[1].','.$mainNavBackgroundColors[2].','.$finalMainNavBgOpacity.')' ) .';
					height:'.$headerHeight.'px;
					padding:'.$headerPadding.'px 0;
				}
				
				
				header.fixed {
					background-color:rgba('.$mainNavBackgroundColors[0].','.$mainNavBackgroundColors[1].','.$mainNavBackgroundColors[2].','.$finalMainNavBgOpacity.');	
				}
				.pm-sub-header-title-bg {
					background-color:rgba('.$pageTitleBackgroundColors[0].','.$pageTitleBackgroundColors[1].','.$pageTitleBackgroundColors[2].', '.$finalPageTitleOpacity.');	
				}
				.sf-menu ul, .pm-dropmenu-active ul {
					background-color:rgba('.$navDropDownColors[0].','.$navDropDownColors[1].','.$navDropDownColors[2].','.$finalMainNavDropMenuOpacity.');	
				}
				.sf-menu ul {
					border-top: 3px solid '.$primaryColor.';
				}
				.sf-menu ul li, .pm-dropmenu-active ul li {
					border-bottom: 1px solid '.$navDropDownBorderColor.';	
				}
				.pm-sub-menu-container {
					background-color:'.$subMenuBackgroundColor.';	
				}
				.mean-container .mean-bar, .mean-container .mean-nav {
					background-color:'.$mobileNavBackgroundColor.';		
				}
				
				.mean-container a.meanmenu-reveal span {
					background-color:'.$mobileNavToggleColor.';			
				}
				.mean-container a.meanmenu-reveal {
					color:'.$mobileNavToggleColor.';				
				}
				.mean-expand {
					color:'.$mobileNavToggleColor.' !important;				
				}
				
				.pm-search-field-input {
					color:'.$searchFieldTextColor.';	
				}
				.pm-search-field-icons li a {
					color:'.$searchFieldTextColor.';		
				}
				.pm-hours-container, .pm-address-container {
					background-color:'.$expandableDivColor.';	
				}
				.pm-sub-header-container {
					background-color:'.$subpageHeaderBackgroundColor.';		
				}
				.pm-sub-header-breadcrumbs {
					background-image:url('.$breadcrumbsBackgroundImage.');	
				}
				
			';
			
			
			//Footer Options & Colors
			$fatFooterBackgroundImage = get_theme_mod('fatFooterBackgroundImage');
			$socialIconColor = get_option('socialIconColor', '#232830');
			$footerWidgetTitleColor = get_option('footerWidgetTitleColor', '#ffffff');
			$footerWidgetSubTitleColor = get_option('footerWidgetSubTitleColor', '#f6d600');
			$fatFooterBackgroundColor = get_option('fatFooterBackgroundColor', '#292D38');
			$footerBackgroundColor = get_option('footerBackgroundColor', '#272D36');
			$fatFooterBackgroundImage = get_theme_mod('fatFooterBackgroundImage');
			$socialFooterBackgroundColor = get_option('socialFooterBackgroundColor', '#FFFFFF');
			$displaySocialFooterBgColor = get_theme_mod('displaySocialFooterBgColor', 'off');
			$socialFooterBackgroundImage = get_theme_mod('socialFooterBackgroundImage', get_template_directory_uri() . '/img/footer/footer-bg.png');
			$displaySocialFooterBgImage = get_theme_mod('displaySocialFooterBgImage', 'on');
			$socialFooterHeight = get_theme_mod('socialFooterHeight', 400);
			$addSpacingOnFooter = get_theme_mod('addSpacingOnFooter', 'on');
			
			//Footer Options styles
			echo '
				.pm-fat-footer {
					background-color:'.$fatFooterBackgroundColor.';	
					'. ( $fatFooterBackgroundImage !== '' ? 'background-image:url('.$fatFooterBackgroundImage.')' : '' ) .'
				}
				footer {
					height:'.$socialFooterHeight.'px;
					'. ( $displaySocialFooterBgColor === 'on' ? 'background-color:'.$socialFooterBackgroundColor.';' : '' ) .'
					'. ( $displaySocialFooterBgImage === 'on' ? 'background-image:url('.$socialFooterBackgroundImage.');' : '' ) .'					
				}
				.pm-social-icon-diamond {
					background-color:'.$socialIconColor.';	
				}
				.pm-footer-copyright {
					background-color:'.$footerBackgroundColor.';	
					'. ( $addSpacingOnFooter === 'on' ? 'margin-top:-150px; padding:160px 0 0;' : 'margin-top:0px; padding:20px 0 0;' ) .'		
				}
			';
						
			
			//Global Options styles
			echo '
			
					.woocommerce .widget_price_filter .ui-slider .ui-slider-handle {
						background-color:'. $secondaryColor .';	
					}
					
					.woocommerce .widget_price_filter .ui-slider .ui-slider-range {
						background-color:'. $primaryColor .' !important;		
					}
				
					.woocommerce table.shop_table tbody th, .woocommerce table.shop_table tfoot td, .woocommerce table.shop_table tfoot th {
						border-top: 1px solid '.$dividerColor.' !important;	
					}
				
					.woocommerce .widget_shopping_cart .total, .woocommerce.widget_shopping_cart .total {
						border-top: 1px solid '.$dividerColor.';
					}
					
					.woocommerce .woocommerce-ordering select {
						border: 1px solid '.$dividerColor.';
					}
					
					.woocommerce #reviews #comment {
						border:1px solid '.$dividerColor.';
					}
					
					.input-text.qty.text {
						border:1px solid '.$dividerColor.';	
					}
					
					.woocommerce #reviews #comments ol.commentlist li .comment-text {
						border: 1px solid '.$dividerColor.';	
					}
					
					.woocommerce div.product form.cart .variations select {
						border:1px solid '.$dividerColor.';	
					}
					
					.woocommerce table.shop_table {
						border:1px solid '.$dividerColor.';	
					}
					
					.woocommerce table.shop_table td {
						border-top:1px solid '.$dividerColor.';	
					}
					
					.woocommerce form .form-row input.input-text, .woocommerce form .form-row textarea {
						border:1px solid '.$dividerColor.';	
					}
					
					#add_payment_method table.cart td.actions .coupon .input-text, .woocommerce-cart table.cart td.actions .coupon .input-text, .woocommerce-checkout table.cart td.actions .coupon .input-text {
					}
					
					.woocommerce form .form-row select {
						border:1px solid '.$dividerColor.';
					}	
					
					.woocommerce span.onsale {
						background-color:'. $primaryColor .' !important;	
					}
					
					.woocommerce ul.products li.product .price {
						color:'. $secondaryColor .';
					}
					
					.woocommerce div.product .woocommerce-tabs ul.tabs li.active > a {
						background-color: '. $secondaryColor .' !important;	
					}
					
					.woocommerce .star-rating span {
						color:'. $primaryColor .';	
					}
					
					.woocommerce p.stars a {
						color:'. $secondaryColor .';	
					}
					
					.woocommerce-review-link {
						color:'. $secondaryColor .' !important;	
					}
					
					.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover {
						background-color:'. $secondaryColor .';
						color:white;	
					}
					
					.woocommerce-info::before {
						color: '. $secondaryColor .';
					}
	
					.woocommerce form .form-row.woocommerce-invalid .select2-container, .woocommerce form .form-row.woocommerce-invalid input.input-text, .woocommerce form .form-row.woocommerce-invalid select {
						border-color: '. $secondaryColor .';
					}
					
					.woocommerce form .form-row.woocommerce-invalid label {
						color: '. $secondaryColor .';	
					}
					
					.woocommerce form .form-row .required {
						color:'. $secondaryColor .';
					}
					
					.woocommerce a.remove {
						background-color: '. $secondaryColor .';
						color: white !important;
					}
					
					.woocommerce-error, .woocommerce-info, .woocommerce-message {
						border-top:3px solid '. $secondaryColor .';
					}
										
					.woocommerce ul.products li.product .price {
						color:'. $secondaryColor .';
					}
					
					.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover {
						background-color: '. $primaryColor .';
						color: #fff;
					}
					
					.product_meta > span > a:hover {
						color: '. $secondaryColor .';
					}
					
					.woocommerce div.product form.cart .reset_variations:hover {
						background-color: '. $secondaryColor .';
					}
					
					.woocommerce form .form-row.woocommerce-validated .select2-container, .woocommerce form .form-row.woocommerce-validated input.input-text, .woocommerce form .form-row.woocommerce-validated select {
						border-color:'. $secondaryColor .';
					}				
					
					.page-numbers.current, a.page-numbers:hover {
						background-color: '.$primaryColor.' !important;
						color:white !important;		
					}
					
					.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button {
						background-color: '.$secondaryColor.';	
					}
					
					.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover {
						background-color: '. $primaryColor .' !important;	
						color:white !important;
					}
					
					.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt {
						background-color: '.$secondaryColor.';
					}
					
					.product_meta > span > a {
						color: '.$primaryColor.';
					}
					
					.woocommerce div.product .woocommerce-tabs ul.tabs li {
						background-color: '.$primaryColor.' !important;
						
					}
					
					.woocommerce #reviews #comment:focus {
						background-color:'.$primaryColor.';
					}
					
					.woocommerce div.product form.cart .reset_variations {
						background-color: '.$primaryColor.';
					}
					
					.woocommerce #respond input#submit.alt.disabled, .woocommerce #respond input#submit.alt.disabled:hover, .woocommerce #respond input#submit.alt:disabled, .woocommerce #respond input#submit.alt:disabled:hover, .woocommerce #respond input#submit.alt[disabled]:disabled, .woocommerce #respond input#submit.alt[disabled]:disabled:hover, .woocommerce a.button.alt.disabled, .woocommerce a.button.alt.disabled:hover, .woocommerce a.button.alt:disabled, .woocommerce a.button.alt:disabled:hover, .woocommerce a.button.alt[disabled]:disabled, .woocommerce a.button.alt[disabled]:disabled:hover, .woocommerce button.button.alt.disabled, .woocommerce button.button.alt.disabled:hover, .woocommerce button.button.alt:disabled, .woocommerce button.button.alt:disabled:hover, .woocommerce button.button.alt[disabled]:disabled, .woocommerce button.button.alt[disabled]:disabled:hover, .woocommerce input.button.alt.disabled, .woocommerce input.button.alt.disabled:hover, .woocommerce input.button.alt:disabled, .woocommerce input.button.alt:disabled:hover, .woocommerce input.button.alt[disabled]:disabled, .woocommerce input.button.alt[disabled]:disabled:hover {
						background-color:'.$primaryColor.';
					}
					
					.woocommerce a.remove:hover {
						background-color: '.$primaryColor.';
					}
					
					.woocommerce form .form-row input.input-text:focus, .woocommerce form .form-row textarea:focus {
						border:1px solid '.$primaryColor.';	
						background-color:'.$primaryColor.';
					}
					
					.woocommerce div.product p.price, .woocommerce div.product span.price {
						color:'. $secondaryColor .';	
					}	
				
				
					.woocommerce .woocommerce-breadcrumb a:hover, .breadcrumbs li a:hover {
						color: '. $secondaryColor .';
						text-decoration:none !important;
					}
				
				
			
				body {
					background-repeat:'.$repeatBackground.';
					background-color:'.$pageBackgroundColor.' !important;
					'. ( $pageBackgroundImage !== '' ? 'background-image:url('.$pageBackgroundImage.')' : '' ) .'	
				}
				
				.nav-tabs > li.active {
					border-top: 3px solid '.$primaryColor.';
				}
				
				.form-submit input[type="submit"]:hover {
					border: 3px solid '.$primaryColor.';
					background-color:'.$primaryColor.';	
					color:white;
				}
				
				.nav-tabs > li.active a {
					color: '.$secondaryColor.' !important;
				}
				
				.pm-added-to-cart-icon, .pm-store-item-diamond, .pm-store-item-divider, .pm-store-item-add-to-cart-diamond {
					background-color:'.$primaryColor.';	
				}
				
				.pm-store-item-divider-diamond {
					border-top: 15px solid '.$primaryColor.';
				}
				
								
				.pm-square-btn.store-btn:hover {
					border: 3px solid '.$primaryColor.';
					background-color:'.$primaryColor.';
				}
				
				.pm-added-to-cart-icon:hover {
					background-color:'.$secondaryColor.';	
				}
				
				.woocommerce-page .woocommerce-message, .woocommerce-page .woocommerce-error {
					background-color:'.$secondaryColor.';	
					color:white;
				}
								
				.shop_table thead {
					border: 1px solid '.$dividerColor.';
				}
				
				.pm_quick_contact_field.invalid_field, .pm_quick_contact_textarea.invalid_field {
					border: 1px solid '.$primaryColor.';
				}
				
				.pm-news-post-sticky-icon i {
					background-color: '.$primaryColor.';	
				}
				
				.pm-boxed-mode {
					background-color:'.$boxedModeContainerColor.';
				}
				
				.owl-item .pm-brand-item span {
    				background-color: '.$primaryColor.';
				}
				
				.pm-staff-profile-item-view-profile {
    				color: '.$primaryColor.';
				}
				
				.pm-tweet-list ul li:before, .pm-tweet-list ul li a {
					color:'.$primaryColor.';
				}
				
				.pm_quick_contact_submit {
					background-color:'.$primaryColor.';	
				}
				
				.pm-progress-bar .pm-progress-bar-outer {
					background-color:'.$primaryColor.';	
				}
				
				.pm-progress-bar-diamond {
					background-color:'.$primaryColor.';	
				}	
				
				.pm-square-btn.print:hover {
					border: 3px solid '.$primaryColor.';	
					background-color:'.$primaryColor.';	
				}	
				
				.pm-sub-header-breadcrumb-list li {
					color: '.$primaryColor.' !important;	
				}
				
				.pm-flexslider-details a {
					color:'.$primaryColor.';
				}
				
				.pm-isotope-filter-system-expand {
					background-color:'.$primaryColor.';	
				}
				
				.pm-event-recurring-status-icon {
					border-right:35px solid '.$primaryColor.';
					border-top:35px solid '.$primaryColor.';
					border-left:35px solid transparent;
					border-bottom:35px solid transparent;
				}
				
				.single_variation {
					border-top: 1px solid '.$dividerColor.';
					margin-top: 10px;
					padding-top: 10px;
				}
				.pm-container-border {
					border-right: 1px solid '.$dividerColor.' !important;
				}
				
				.pm-pricing-table-container ul {
					border: 1px solid '.$dividerColor.';	
				}
				.pm-pricing-table-container ul li {
					border-bottom: 1px solid '.$dividerColor.';
				}
				
				ul li:before {
					content: "\\'.$ulListIcon.'";
					color:'.$ulListIconColor.';
				}
				.pm-gallery-widget-view-more {
					color:'.$primaryColor.' !important;	
				}
				.pm-pricing-table-container ul li {
					color:'.$secondaryColor.';	
				}
				.pm-widget-footer a:hover {
					color:'.$primaryColor.' !important;	
				}
				.pm_mailchimp_widget a {
					color:'.$primaryColor.' !important;		
				}
				.pm-gallery-widget-items li:hover a {
					color:white !important;
				}
				.pm-widget-footer .pm-comments-count {
					color:'.$primaryColor.' !important;		
				}
				.pm-required {
					color:'.$primaryColor.';		
				}
				.pm-footer-social-icons li.rss:hover .pm-social-icon-diamond {
					background-color:'.$primaryColor.';	
				}
				.pm-sub-menu-info p i {
					color:'.$primaryColor.';	
				}
				.pm-dropmenu i {
					color:'.$primaryColor.';		
				}
				.pm-sub-navigation a i:hover {
					color:'.$primaryColor.';		
				}
				.pm-cart-icon-count {
					background-color:'.$primaryColor.';
				}
				.pm-sub-menu-container {
					border-bottom: 2px solid '.$primaryColor.';
				}
				.pm-dropmenu-active ul {
					border-top: 2px solid '.$primaryColor.';
				}
				.pm-dropmenu-active ul li a:hover {
					background-color:'.$primaryColor.';	
				}
				.pm-search-container {
					background-color:'.$primaryColor.';		
				}
				.pm-hours-exit, .pm-address-exit {
					color:'.$primaryColor.';			
				}
				.pm-dots span.pm-currentDot {
					background-color:'.$primaryColor.';			
				}
				.pm-dots span:hover {
					background-color:'.$primaryColor.';	
				}
				.pm-slider div.pm-next:hover, .pm-slider div.pm-prev:hover {
					color:'.$primaryColor.';
				}
				.sf-menu a:hover {
					color:'.$primaryColor.';	
				}
				
				.mean-container .mean-nav ul li a:hover {
					color:'.$navDropDownHoverColor.';		
				}
				.mean-container .mean-nav ul li ul li a:hover {
					background-color:'.$navDropDownHoverColor.';		
				}
				
				
				.sf-sub-indicator {
					color:'.$primaryColor.';			
				}
				.sf-menu ul li a:hover {
					background-color:'.$navDropDownHoverColor.';		
				}
				.pm-caption h1 span {
					color:'.$primaryColor.';		
				}
				#pm-back-to-top {
					color:'.$secondaryColor.';	
				}
				#pm_marker_tooltip.pm_tip_arrow_bottom, #pm_marker_tooltip.pm_tip_arrow_top { 
					background-color:'.$tooltipColor.';	
				}
				.pm-sub-menu-info a:hover {
					color:'.$primaryColor.';		
				}
				.pm-widget-footer .tagcloud a:hover { 
					background-color:'.$primaryColor.';
					border:3px solid '.$primaryColor.';
				}
				.pm-widget-footer .widget_categories ul a:before {
					color:'.$primaryColor.';	
				}
				.pm-widget-footer #wp-calendar tbody td {
					border: 1px solid '.$primaryColor.';
				}
				.pm-widget-footer #wp-calendar tbody tr td#today { 
					background-color:'.$primaryColor.';
				}
				.pm-widget-footer #wp-calendar tbody td:hover {
					background-color:'.$primaryColor.';
				}
				.pm-widget-footer #wp-calendar tbody tr td:hover a {
					color:'.$secondaryColor.';	
				}
				.pm-widget-footer .widget_archive ul li:before {
					color:'.$primaryColor.';
				}
				.pm-widget-footer .widget_pages ul li:before {
					color:'.$primaryColor.';		
				}
				.pm-widget-footer h6:after {
					border-bottom: 1px solid '.$primaryColor.';
				}
				.pm-widget-footer .pm-sidebar-search-container i {
					color:'.$primaryColor.';		
				}
				.pm-mailchimp-field:focus, .pm_quick_contact_field:focus, .pm_quick_contact_textarea:focus, .pm-trial-form-field:focus, .pm-trial-form-textarea:focus {	
					border:1px solid '.$primaryColor.';		
				}
				.pm-sidebar-title-divider {
					background-color: '.$primaryColor.';	
				}
				.pm-sidebar-title-diamond {
					border-top: 15px solid '.$primaryColor.';	
				}
				.pm-sidebar-search-container i {
					color:'.$primaryColor.';	
				}
				.pm-sidebar .widget_categories ul a:before {
					color:'.$primaryColor.';		
				}
				.pm-sidebar .widget_pages ul li:before {
					color:'.$primaryColor.';			
				}
				.widget_recent_entries .pm-widget-spacer ul li a:before {
					color:'.$primaryColor.';				
				}
				.pm-news-post-date-bg {
					border-top: 150px solid '.$primaryColor.';		
				}
				.pm-square-btn.news-post:hover {
					background-color:'.$primaryColor.' !important;	
					border:3px solid '.$primaryColor.' !important;	
				}
				.pm-author-bio-img {
					border: 3px solid '.$primaryColor.'
				}
				.pm-single-post-panel-title.pm-secondary {
					color:'.$secondaryColor.';	
				}
				.pm-comment-date a:hover {
					color:'.$primaryColor.';	
				}
				.pm-secondary {
					color:'.$secondaryColor.' !important;	
				}
				#cancel-comment-reply-link:hover {
					color:'.$primaryColor.' !important;			
				}
				.comment-form a:hover {
					color:'.$primaryColor.' !important;				
				}
				.pm-footer-navigation li a:hover {
					color:'.$primaryColor.';					
				}
				.pm-staff-profile-item-details-btn {
					background-color:'.$primaryColor.';				
				}
				.pm-staff-item-social-icon-diamond {
					background-color:'.$primaryColor.';		
				}
				.pm-staff-item-divider {
					background-color:'.$dividerColor.';	
				}
				.woocommerce-page .woocommerce-message {
					border-bottom:1px solid '.$dividerColor.';
					border-top:1px solid '.$dividerColor.';
				}
				.pm-isotope-filter-system li a.current {
					background-color: '.$primaryColor.';	
    				border: 3px solid '.$primaryColor.';
				}
				.pm-isotope-filter-system li a:hover {
					background-color: '.$primaryColor.';	
    				border: 3px solid '.$primaryColor.';
				}
				.comment-form-comment textarea:focus {
					background-color: '.$primaryColor.';	
    				border: 3px solid '.$primaryColor.';
				}
				.pm-schedule-post-info {
					border-top: 3px solid '.$primaryColor.';
				}
				.pm-schedule-post-diamond {
					background-color: '.$primaryColor.';		
				}
				.pm-schedule-post-expand-btn {
					color: '.$primaryColor.';			
				}
				.pm-pagination li.current {
					background-color: '.$primaryColor.';	
    				border: 3px solid '.$primaryColor.';	
				}
				.woocommerce-pagination .page-numbers li span.current {
					background-color: '.$primaryColor.';	
    				border: 3px solid '.$primaryColor.';	
				}
				.woocommerce-pagination .page-numbers li a:hover {
					background-color: '.$primaryColor.';	
    				border: 3px solid '.$primaryColor.';
					color:white !important;	
				}
				.pm-pagination li:hover {
					background-color: '.$primaryColor.';	
    				border: 3px solid '.$primaryColor.';	
				}
				.pm-pagination-page-counter {
					border-top: 1px solid '.$dividerColor.';	
				}
				.pm-class-post-details-btn {
					background-color: '.$primaryColor.';		
				}
				.pm-class-post-diamond {
					border-bottom: 20px solid '.$primaryColor.';
				}
				.pm-class-post-divider {
					background-color: '.$primaryColor.';		
				}
				.pm-class-post-info .excerpt a {
					color: '.$primaryColor.';	
				}
				.pm-gallery-post-like-diamond, .pm-gallery-post-details-diamond {
					background-color: '.$primaryColor.';			
				}
				.pm-gallery-post-title-container a {
					background-color: '.$primaryColor.';				
				}
				.pm-gallery-post-details-actions li a:hover {
					color: '.$primaryColor.';		
				}
				.pm-gallery-post-details-excerpt a {
					color: '.$primaryColor.';	
				}
				.pm-primary-address strong, .pm-view-all-addresses a {
					color: '.$primaryColor.';	
				}
				.pm-mailchimp-submit {
					background-color: '.$primaryColor.';		
				}
				.pm-footer-copyright a {
					color: '.$primaryColor.';			
				}
				.pm-hours-day {
					color: '.$primaryColor.';			
				}
				.pm-schedule-post-info .title, .pm-schedule-post-info a {
					color: '.$primaryColor.';
				}
				.pm-post-loaded-info li a:hover {
					color: '.$primaryColor.';	
				}
				.pm-news-post-link {
					background-color: '.$primaryColor.';	
				}
				.pm-sidebar .tagcloud a:hover {
					background-color: '.$primaryColor.';	
    				border: 3px solid '.$primaryColor.';	
				}
				.pm-sidebar a:hover {
					color:'.$secondaryColor.';	
				}
				.pm-title-divider {
					background-color: '.$primaryColor.';	
				}
				.pm-author-title {
					color: '.$primaryColor.';		
				}
				
				.pm-staff-profile-item-email-btn:hover {
					color: '.$primaryColor.';		
				}
				
				.pm-related-blog-post-details a:hover {
					color: '.$secondaryColor.';	
				}
				.pm-related-blog-post-thumb-diamond {
					color: '.$dividerColor.';		
				}
				.pm-comment-avatar {
					border-bottom: 3px solid '.$primaryColor.';
				}
				.pm-comment-form-textfield:focus, .pm-comment-form-textarea:focus {
					background-color: '.$primaryColor.';	
					border-bottom: 3px solid '.$primaryColor.';
				}
				.pm-comment-submit-btn:hover {
					background-color: '.$primaryColor.';	
    				border: 3px solid '.$primaryColor.';	
				}
				.pm-event-post-img-title {
					border-top: 3px solid '.$primaryColor.';	
				}
				.pm-event-post-img-diamond {
					background-color: '.$primaryColor.';
				}
				.pm-square-btn.event:hover, .pm-square-btn.facebook:hover, .pm-square-btn.class-widget:hover {
					background-color: '.$primaryColor.';	
    				border: 3px solid '.$primaryColor.';	
				}
				.pm-staff-profile-item-details-divider {
					background-color: '.$dividerColor.';	
				}
				.pm-gallery-widget-item-expand { 
					background-color: '.$primaryColor.';	
				}
				.pm-widget-event-post-img-diamond {
					background-color: '.$primaryColor.';	
				}
				.pm-square-btn.event, .pm-square-btn.class-widget, .pm-square-btn.facebook {
					border: 3px solid '.$widgetsPostBtnColor.';	
    				color: '.$widgetsPostBtnColor.' !important;
				}
				.pm-square-btn.store-btn, .woocommerce-pagination .page-numbers li a, .pm-square-btn.woocomm, .single_add_to_cart_button, .remove, input[type=submit].button, .checkout-button {
					border: 3px solid '.$widgetsPostBtnColor.';	
					color: '.$widgetsPostBtnColor.' !important;		
				}
				
				.remove:hover, input[type=submit].button:hover, .checkout-button:hover {
					background-color:'.$primaryColor.' !important;
					border: 3px solid '.$primaryColor.';		
					color:white !important;
				}
				
				input[type=text]#coupon_code {
					border: 1px solid '.$dividerColor.';	
				}
				
				.pm-sidebar .tagcloud a {
					border: 3px solid '.$widgetsPostBtnColor.';	
    				color: '.$widgetsPostBtnColor.' !important;	
				}
				.pm-share-post-container {
					border-top:1px solid '.$dividerColor.';	
				}
				.pm-class-post-info.single-post {
					border-top:3px solid '.$primaryColor.';		
				}
				.pm-trial-form-title {
					background-color: '.$primaryColor.';		
				}
				.pm-trial-form-title-diamond {
					border-top: 50px solid '.$primaryColor.';		
				}
				.pm-trial-form-submit {
					background-color: '.$primaryColor.';			
				}
				.pm-pricing-table-price {
					background-color: '.$secondaryColor.';		
				}
				.pm-pricing-table-title {
					background-color: '.$secondaryColor.';	
					border-bottom: 3px solid '.$primaryColor.';
				}
				.pm-pricing-table-featured {
					border-top: 80px solid '.$primaryColor.';	
				}
				.pm-pricing-table-btn {
					background-color: '.$secondaryColor.';	
					color: '.$primaryColor.' !important;			
				}
				.pm-testimonial-name {
					color: '.$primaryColor.' !important;		
				}
				.pm-testimonials-arrows a {
					color: '.$primaryColor.';	
				}
				.flexslider .flex-prev {
					border-bottom: 90px solid '.$primaryColor.';	
				}
				.flexslider .flex-next {
					border-top: 90px solid '.$primaryColor.';	
				}
				.pm-event-item-date-bg {
					background-color: '.$primaryColor.';		
				}
				.pm-event-item-details p span {
					color: '.$primaryColor.';	
				}
				a.pm-primary {
					color: '.$primaryColor.';		
				}
				.pm-primary {
					color: '.$primaryColor.';		
				}
				.pm-standalone-news-post-link {
					background-color: '.$primaryColor.';		
				}
				
				.pm-standalone-news-title h6 span {
					color: '.$primaryColor.' !important;			
				}
				.pm-standalone-news-post-date-bg {
					border-top: 150px solid '.$primaryColor.';	
				}
				.pm-video-activator-bg {
					background-color: '.$primaryColor.';	
				}
				.pm-rounded-btn {
					background-color: '.$secondaryColor.';	
				}
				.pm-rounded-btn:hover {
					background-color: '.$primaryColor.' !important;	
				}
				.pm-rounded-btn.flip_color {
					background-color: '.$primaryColor.';
					color:black !important;
				}
				.pm-rounded-btn.flip_color:hover {
					background-color: '.$secondaryColor.' !important;	
					color:white !important;
				}
				.pm-flexslider-details {
					background-color: rgba('.$secondaryColors[0].', '.$secondaryColors[1].', '.$secondaryColors[2].', 0.95);	
				}
				.pm-event-item-container {
					background-color: rgba('.$secondaryColors[0].', '.$secondaryColors[1].', '.$secondaryColors[2].', 0.8);	
				}
				.pm-form-textfield:focus, .pm-form-textarea:focus, .pm-form-textarea.invalid_field, .pm-form-textfield.invalid_field {
					background-color: '.$primaryColor.';	
					border-bottom:3px solid '.$primaryColor.';	
				}
				#pm-contact-form-response, #pm-trial-form-response {
					color: '.$primaryColor.';	
				}
				.pm-trial-form-field.invalid_field {
					border:1px solid '.$primaryColor.';	
				}
				.woocommerce-pagination {
					border-top: 1px solid '.$dividerColor.';	
				}
				.comment-form-rating .stars span a i:hover {
					color:'.$primaryColor.';	
				}
				.comment-form-rating .stars span a i.activated {
					color:'.$primaryColor.';
				}
				.pm-widget-star-rating li i {
					color:'.$primaryColor.';	
				}
				.pm-rounded-submit-btn, #place_order {
					background-color: '.$secondaryColor.' !important;		
				}
				.pm-rounded-submit-btn:hover, #place_order:hover {
					background-color: '.$primaryColor.' !important;		
				}
				.pm-checkout-tabs > li.active > a, .pm-checkout-tabs > li.active > a:hover, .pm-checkout-tabs > li.active > a:focus {
					background-color: '.$secondaryColor.' !important;			
				}
				.pm-checkout-tabs > li a:hover {
					color: '.$primaryColor.' !important;
					background-color: '.$secondaryColor.' !important;
				}
				.pagination_multi li {
					background-color: '.$primaryColor.' !important;	
					border:3px solid '.$primaryColor.';
					color:white !important;	
				}
				.pagination_multi a li:hover {
					background-color: '.$primaryColor.' !important;	
					border:3px solid '.$primaryColor.' !important;	
					color:white !important;	
				}
				blockquote {
					border-left: 7px solid transparent; 
					border-right: 7px solid transparent; 
					border-top: 5px solid '.$blockQuoteColor.';
					border-bottom: 5px solid '.$blockQuoteColor.';
				}
				.pm-event-item-details p span {
					color: '.$primaryColor.';
				}
				.pm-flexslider-details .title {
					color: '.$primaryColor.';	
				}
				.tweet_list li a, .pm-widget-footer .textwidget a {
					color:'.$primaryColor.' !important;
				}
				a {
					color: '.$linkColor.';
				}
				.pm-woocomm-item-sale-tag {
					background-color: '.$primaryColor.';	
				}
				.pm-nav-tabs > li.active {
   					background-color: '.$primaryColor.';
				}
				.pm-nav-tabs > li > a {
					background-color:'.$secondaryColor.';
					color:white;
				}
				.pm-nav-tabs > li > a:hover {
					background-color:'.$primaryColor.';
					color:black;
				}
				.pm-nav-tabs > li > a {
					border:3px solid '.$dividerColor.';		
				}
				.pm-nav-tabs > li.active > a, .pm-nav-tabs > li.active > a:hover, .pm-nav-tabs > li.active > a:focus {
					border:3px solid '.$secondaryColor.';			
				}
				.panel-default > .panel-heading {
					background-color:'.$secondaryColor.';	
				}
				.panel-default > .panel-heading:hover {
					background-color:'.$primaryColor.';	
				}
				.panel-title i {
					background-color:'.$primaryColor.';		
				}
				.pm-icon-element {
					background-color:'.$secondaryColor.';		
				}
				.pm-icon-element:hover {
					background-color:'.$primaryColor.';		
				}
				.pm-rounded-btn.cta-btn {
					background-color:'.$primaryColor.';	
				}
				.pm-widget-footer .widget_meta ul li:before {
					color:'.$primaryColor.';	
				}
				.pm-widget-footer .widget_recent_comments ul li span, .pm-widget-footer .widget_recent_comments ul li {
					color:'.$primaryColor.';		
				}
				.pm-icon-bundle i {
					color:'.$primaryColor.';
				}
				.pm-icon-bundle {
					background-color:'.$secondaryColor.';			
				}
				.pm-icon-bundle:hover {
					background-color:'.$primaryColor.';			
				}
				.pm-value-diamond {
					border-top:108px solid '.$primaryColor.';
				}
				.pm-workshop-newsletter-form-container input[type="text"]:focus {
					border:1px solid '.$primaryColor.';
				}
				.tinynav {
					background-color:'.$secondaryColor.';		
				}
				.pm-brand-carousel-btns a {
					color:'.$secondaryColor.'; !important;	
				}
				.pm-brand-carousel-btns a:hover {
					color:'.$primaryColor.'; !important;	
				}
				.pm-square-btn.woocomm:hover, .single_add_to_cart_button:hover {
					background-color: '.$primaryColor.';
					border: 3px solid '.$primaryColor.';
					color: white !important;	
				}
			';
			
			//Post Options
			$postTitleBGColor = get_option('postTitleBGColor', '#000000');
			$postTitleBGColors = pm_ln_hex2rgb($postTitleBGColor); //Array of colors R,G,B			
			$postTitleOpacity = get_theme_mod('postTitleOpacity', 80);
			$finalPostTitleOpacity = $postTitleOpacity / 100;
			$postExcerptDividerColor = get_option('postExcerptDividerColor', '#d3d3d3');
			$postMetaLinksColor = get_option('postMetaLinksColor', '#9c8d00');	
			//$viewPostBtnColor = get_option('viewPostBtnColor', '#c8c8c8');	
			$singlePostSocialIconColor = get_option('singlePostSocialIconColor', '#cacaca');	
			$authorCommentsBoxColor = get_option('authorCommentsBoxColor', '#182433');	
			$authorBorderColor = get_option('authorBorderColor', '#283442');	
			
			/*$postNavigationButtonColor = get_option('postNavigationButtonColor', '#000000');	
			$postNavigationButtonColors = pm_ln_hex2rgb($postNavigationButtonColor); //Array of colors R,G,B*/	
			

			//Post Options styles
			echo '
				.pm-woocomm-item-thumb-container {
					border: 1px solid '.$dividerColor.';		
				}
				.pm-store-item-img-container {
					border: 1px solid '.$dividerColor.';	
				}
				.pm-woocom-item-short-description {
					border-bottom: 1px solid '.$postExcerptDividerColor.';
    				border-top: 1px solid '.$postExcerptDividerColor.';	
				}
				.product_meta, .pm-product-share-container {
					border-top: 1px solid '.$postExcerptDividerColor.';	
				}
				
				.pm-news-title h6 span {
					color:'.$primaryColor.';	
				}
				.pm-news-title {
					border-right: 3px solid '.$primaryColor.';
					background-color: rgba('.$postTitleBGColors[0].', '.$postTitleBGColors[1].', '.$postTitleBGColors[2].', '.$finalPostTitleOpacity.');	
				}
				.pm-standalone-news-title {
					border-right: 3px solid '.$primaryColor.';
					background-color: rgba('.$postTitleBGColors[0].', '.$postTitleBGColors[1].', '.$postTitleBGColors[2].', '.$finalPostTitleOpacity.');
				}
				.pm-news-title.secondary {
					border-right: 3px solid '.$primaryColor.';
					border-left: 3px solid '.$primaryColor.';
				}
				.pm-news-post-like-diamond {
					background-color:'.$primaryColor.';		
				}
				.pm-news-post-divider, .pm-standalone-news-post-divider {
					background-color:'.$postExcerptDividerColor.';	
				}
				.pm-news-post-tags-and-excerpt p a, .pm-standalone-news-post-tags-and-excerpt p a {
					color:'.$postMetaLinksColor.' !important;
				}
				.pm-news-post-tags-and-excerpt p a:hover {
					color:'.$secondaryColor.' !important;
				}
				.pm-square-btn.news-post, .pm-comment-submit-btn, .pagination_multi a li {
					border: 3px solid '.$widgetsPostBtnColor.' !important;	
   					color: '.$widgetsPostBtnColor.' !important;	
				}
				.pm-post-social-icon-diamond {
					background-color:'.$singlePostSocialIconColor.';	
				}
				#pm-author-panel {
					background-color:'.$authorCommentsBoxColor.';	
				}
				#pm-comments-responses-panel {
					background-color:'.$authorCommentsBoxColor.';	
				}
				.pm-author-bio-img-bg {
					background-color:'.$authorBorderColor.';	
				}
				.pm-standalone-news-excerpt a {
					color:'.$postMetaLinksColor.';
				}
			';
			
			
			//Shortcode options
			$tabContentBgColor = get_option('tabContentBgColor', '#eeeeee');
			$accordionContentBgColor = get_option('tabContentBgColor', '#ffffff');
			$quote_box_color = get_option('quote_box_color', '#2A313A');
			$data_table_title_color = get_option('data_table_title_color', '#0084a5');
			$data_table_info_color = get_option('data_table_info_color', '#E8E8E8');
			$trial_form_bg_color = get_option('trial_form_bg_color', '#0F1926');
			$trial_form_bg_colors = pm_ln_hex2rgb($trial_form_bg_color); //Array of colors R,G,B
						
			echo '
				.pm-tab-content {
					background-color:'.$tabContentBgColor.';	
				}	
				.panel-group .panel-heading + .panel-collapse .panel-body {
					background-color:'.$accordionContentBgColor.';	
				}
				.pm-cta-message {
					border-left:4px solid '.$primaryColor.';	
				}
				.pm-single-testimonial-box:before {
					border-top:8px solid '.$quote_box_color.';	
				}
				.pm-single-testimonial-box {
					background-color:'.$quote_box_color.';		
				}
				.pm-workshop-table-title {
					background-color:'.$data_table_title_color.';	
				}
				.pm-workshop-table-content {
					background-color:'.$data_table_info_color.';	
				}
				.pm-trial-form-container {
    				background-color: rgba('.$trial_form_bg_colors[0].', '.$trial_form_bg_colors[1].', '.$trial_form_bg_colors[2].', 0.8);
				}
			';
			
			
			//Alert options
			$alert_success_color = get_option('alert_success_color', '#2c5e83');
			$alert_info_color = get_option('alert_info_color', '#cbb35e');
			$alert_warning_color = get_option('alert_warning_color', '#ea6872');
			$alert_danger_color = get_option('alert_danger_color', '#5f3048');
			$alert_notice_color = get_option('alert_notice_color', '#49c592');
			
			echo '
				.alert-warning {
					background-color:'.$alert_warning_color.';	
				}
				
				.alert-success {
					background-color:'.$alert_success_color.';	
				}
				
				.alert-danger {
					background-color:'.$alert_danger_color.';	
				}
				
				.alert-info {
					background-color:'.$alert_info_color.';	
				}
				
				.alert-notice {
					background-color:'.$alert_notice_color.';	
				}
	
			';
			
			
			//Pulse Slider options
			$sliderBackgroundImage = get_theme_mod('sliderBackgroundImage');
			
			$sliderTitleBackgroundColor = get_option('sliderTitleBackgroundColor', '#2c323b');
			$sliderTitleBackgroundColors = pm_ln_hex2rgb($sliderTitleBackgroundColor);
			
			$sliderMessageBackgroundColor = get_option('sliderMessageBackgroundColor', '#2c323b');
			$sliderMessageBackgroundColors = pm_ln_hex2rgb($sliderMessageBackgroundColor);
			
			$sliderButtonColor = get_option('sliderButtonColor', '#ffffff');
			$sliderButtonHoverColor = get_option('sliderButtonHoverColor', '#333333');
			$bulletColor = get_option('bulletColor', '#494949');
			$bulletBgColor = get_option('bulletBgColor', '#252F3E');
			$bulletBgColors = pm_ln_hex2rgb($bulletBgColor);
			$arrowColor = get_option('arrowColor', '#ffffff');
			
			$sliderTitleBackgroundOpacity = get_theme_mod('sliderTitleBackgroundOpacity', 90);
			$finalSliderTitleBackgroundOpacity = $sliderTitleBackgroundOpacity / 100;
			
			$sliderMessageBackgroundOpacity = get_theme_mod('sliderMessageBackgroundOpacity', 90);
			$finalSliderMessageBackgroundOpacity = $sliderMessageBackgroundOpacity / 100;
			
			//Pulse Slider styles
			echo '
					.pm-holder-bg {
						background-image:url('.$sliderBackgroundImage.');
					}
				';
			
			echo '
					.pm-caption h1 {						
						background-color: rgba('.$sliderTitleBackgroundColors[0].', '.$sliderTitleBackgroundColors[1].', '.$sliderTitleBackgroundColors[2].', '.$finalSliderTitleBackgroundOpacity.');	
						
					}
					.pm-caption-decription {
						background-color: rgba('.$sliderMessageBackgroundColors[0].', '.$sliderMessageBackgroundColors[1].', '.$sliderMessageBackgroundColors[2].', '.$finalSliderMessageBackgroundOpacity.');	
					}
					.pm-slide-btn {
						border: 3px solid '.$sliderButtonColor.';
    					color: '.$sliderButtonColor.';	
					}
					.pm-slide-btn:hover {
						background-color: '.$sliderButtonHoverColor.';	
					}
					.pm-dots span {
						background-color: '.$bulletColor.';		
					}
					.pm-dots {
						background-color: rgba('.$bulletBgColors[0].', '.$bulletBgColors[1].', '.$bulletBgColors[2].', 0.95);	
					}
					.pm-pulse-arrow {
						border-top: 30px solid '.$bulletBgColor.';	
					}
					.pm-slider div.pm-prev, .pm-slider div.pm-next {
						color:'.$arrowColor.';		
					}
			';
			
			
			//Custom post type options
			$calendarIconColor = get_option('calendarIconColor', '#000000');
			
			echo '
					.pm-schedule-post-date i, .pm-event-post-img-diamond-date i, .pm-event-item-date i {
						color: '.$calendarIconColor.';	
					}
			';
			
			$displaySubHeader = get_theme_mod('displaySubHeader','on');
			
			if( !is_home() && !is_front_page() ) {
				
				if($displaySubHeader === 'off') :
			
					echo '
						header {
							position:relative;
						}
					';
				
				endif;
				
			}
			
			
						
		 ?>
	</style>
    
    <?php
}

/* Cache customizer */
function pm_ln_customizer_styles_cache() {
	
	global $wp_customize;

	// Check we're not on the Customizer.
	// If we're on the customizer then DO NOT cache the results.
	if ( ! isset( $wp_customize ) ) {

		// Get the theme_mod from the database
		$data = get_theme_mod( 'my_customizer_styles', false );

		// If the theme_mod does not exist, then create it.
		if ( $data == false ) {
			// We'll be adding our actual CSS using a filter
			$data = apply_filters( 'my_styles_filter', null );
			// Set the theme_mod.
			set_theme_mod( 'my_customizer_styles', $data );
		}

	// If we're not on the customizer, get all the styles using our filter
	} else {

		$data = apply_filters( 'my_styles_filter', null );

	}

	// Add the CSS inline.
	// Please note that you must first enqueue the actual 'my-styles' stylesheet.
	// See http://codex.wordpress.org/Function_Reference/wp_add_inline_style#Examples
	wp_add_inline_style( 'pm-ln-customizer-css', $data );

}


/* Reset the cache when saving the customizer */
function pm_ln_reset_style_cache_on_customizer_save() {
	remove_theme_mod( 'my_customizer_styles' );
}