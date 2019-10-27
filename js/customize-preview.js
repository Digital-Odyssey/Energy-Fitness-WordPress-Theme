/**
 * File customize-preview.js.
 *
 * Instantly live-update customizer settings in the preview for improved user experience.
 */

(function( $ ) {

	// Collect information from customize-controls.js about which panels are opening.
	wp.customize.bind( 'preview-ready', function() {

		// Initially hide the theme option placeholders on load
		$( '.panel-placeholder' ).hide();

		wp.customize.preview.bind( 'section-highlight', function( data ) {

			// Only on the front page.
			if ( ! $( 'body' ).hasClass( 'procast_theme-front-page' ) ) {
				return;
			}

			// When the section is expanded, show and scroll to the content placeholders, exposing the edit links.
			if ( true === data.expanded ) {
				$( 'body' ).addClass( 'highlight-front-sections' );
				$( '.panel-placeholder' ).slideDown( 200, function() {
					$.scrollTo( $( '#panel1' ), {
						duration: 600,
						offset: { 'top': -70 } // Account for sticky menu.
					});
				});

			// If we've left the panel, hide the placeholders and scroll back to the top.
			} else {
				$( 'body' ).removeClass( 'highlight-front-sections' );
				// Don't change scroll when leaving - it's likely to have unintended consequences.
				$( '.panel-placeholder' ).slideUp( 200 );
			}
		});
	});
	
	//Header textfields
	wp.customize( 'headerPostsListSelector', function( value ) {
		value.bind( function( to ) {
			$( '#pro-cast-posts-selector li.activator' ).text( to );
		});
	});
	
	//Reviews textfields
	wp.customize( 'keyRating1Text', function( value ) {
		value.bind( function( to ) {
			$( '.pro-cast-review-rating-score-bar.level-one p' ).text( to );
		});
	});
	
	
	//Footer textfields
	wp.customize( 'newsletterFieldText', function( value ) {
		value.bind( function( to ) {
			$( '.pro-cast-newsletter-field' ).val( to );
		});
	});
		
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		});
	});
		
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		});
	});
	
	
	//Header slider options	
	wp.customize( 'headerHeight', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( 'header' ).css({
					height : to + 'px',
					//opacity : to / 100
				});				
			}			
		});		
	});
	
	wp.customize( 'headerPadding', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
	
				$( 'header' ).css({
					paddingTop : to + 'px',
					paddingBottom : to  + 'px'
					//opacity : to / 100
				});				
			}			
		});		
	});
	
	//Header Colors
	wp.customize( 'mainNavBackgroundColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( 'header' ).css({
					backgroundColor : to
				});	
				
				/*$( '.pro-cast-social-icons li' ).css({
					borderLeft : '1px solid' + to
					borderRight : '1px solid' + to
					borderBottom : '1px solid' + to
				});*/
				
				/*$( '.pro-cast-general-info' ).css({
					color : to
				});	*/
				
			}			
		});		
	});	
		
	wp.customize( 'navDropDownBorderColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				
				$( '.sf-menu ul li' ).css({
					borderBottom : '1px solid' + to
				});	
				$( '.pm-dropmenu-active ul li' ).css({
					borderBottom : '1px solid' + to
				});	
				
			}			
		});		
	});	
	
	
	wp.customize( 'subMenuBackgroundColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.pm-sub-menu-container' ).css({
					backgroundColor : to
				});	
				
			}			
		});		
	});	
	
	
	wp.customize( 'mobileNavBackgroundColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.mean-container .mean-bar' ).css({
					backgroundColor : to
				});	
				$( '.mean-container .mean-nav' ).css({
					backgroundColor : to
				});	
				
			}			
		});		
	});	
	
	wp.customize( 'mobileNavToggleColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.mean-container a.meanmenu-reveal span' ).css({
					backgroundColor : to
				});	
				$( '.mean-container a.meanmenu-reveal' ).css({
					color : to
				});	
				$( '.mean-expand' ).css({
					color : to
				});	
				
			}			
		});		
	});	
	
	
	wp.customize( 'subpageHeaderBackgroundColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.pm-sub-header-container' ).css({
					backgroundColor : to
				});	
				
			}			
		});		
	});	
	
	wp.customize( 'searchFieldTextColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.pm-search-field-input' ).css({
					color : to
				});	
				$( '.pm-search-field-icons li a' ).css({
					color : to
				});	
				
			}			
		});		
	});	
	
	
	wp.customize( 'expandableDivColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.pm-hours-container' ).css({
					backgroundColor : to
				});	
				$( '.pm-address-container' ).css({
					backgroundColor : to
				});	
				
			}			
		});		
	});		
	//end Header Colors
	
	
	//Global options
	wp.customize( 'pageBackgroundColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( 'body' ).css({
					backgroundColor : to
				});	
				
			}			
		});		
	});		
	
	wp.customize( 'boxedModeContainerColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.pm-boxed-mode' ).css({
					backgroundColor : to
				});	
				
			}			
		});		
	});	
	
	
	wp.customize( 'primaryColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);
				$( '.pm-isotope-filter-system-expand' ).css({
					backgroundColor : to
				});	
				
				$( '.sf-menu ul' ).css({
					borderTop : '3px solid' + to
				});	
				
				$( '.woocommerce .widget_price_filter .ui-slider .ui-slider-range' ).css({
					backgroundColor : to
				});	
				
				$( '.woocommerce span.onsale' ).css({
					backgroundColor : to
				});	
				
				$( '.woocommerce .star-rating span' ).css({
					color : to
				});
				
				$( '.page-numbers.current' ).css({
					backgroundColor : to
				});	
				
				$( '.page-numbers.current' ).css({
					backgroundColor : to
				});	
				
				$( '.product_meta > span > a' ).css({
					color : to
				});
				
				$( '.woocommerce div.product .woocommerce-tabs ul.tabs li' ).css({
					backgroundColor : to
				});
				
				$( '.woocommerce div.product form.cart .reset_variations' ).css({
					backgroundColor : to
				});
				
				$( '.nav-tabs > li.active' ).css({
					borderTop : '3px solid' + to
				});
				
				$( '.pm-added-to-cart-icon' ).css({
					backgroundColor : to
				});
				
				$( '.pm-store-item-diamond' ).css({
					backgroundColor : to
				});
				
				$( '.pm-store-item-divider' ).css({
					backgroundColor : to
				});
				
				$( '.pm-store-item-add-to-cart-diamond' ).css({
					backgroundColor : to
				});
				
				$( '.pm-store-item-divider-diamond' ).css({
					borderTop : '15px solid' + to
				});
				
				$( '.pm_quick_contact_field.invalid_field' ).css({
					border : '1px solid' + to
				});
				
				$( '.pm_quick_contact_textarea.invalid_field' ).css({
					border : '1px solid' + to
				});
				
				$( '.pm-news-post-sticky-icon i' ).css({
					backgroundColor : to
				});
				
				$( '.owl-item .pm-brand-item span' ).css({
					backgroundColor : to
				});
				
				$( '.pm-staff-profile-item-view-profile' ).css({
					color : to
				});
				
				$( '.pm-tweet-list ul li a' ).css({
					color : to
				});
				
				$( '.pm_quick_contact_submit' ).css({
					backgroundColor : to
				});
				
				$( '.pm-progress-bar .pm-progress-bar-outer' ).css({
					backgroundColor : to
				});
				
				$( '.pm-progress-bar-diamond' ).css({
					backgroundColor : to
				});
				
				$( '.pm-sub-header-breadcrumb-list li' ).css({
					color : to
				});
				
				$( '.pm-flexslider-details a' ).css({
					color : to
				});
				
				$( '.pm-event-recurring-status-icon' ).css({
					borderTop : '35px solid' + to,
					borderRight : '35px solid' + to
				});
				
				$( '.pm-gallery-widget-view-more' ).css({
					color : to
				});
				
				$( '.pm_mailchimp_widget a' ).css({
					color : to
				});
				
				$( '.pm-widget-footer .pm-comments-count' ).css({
					color : to
				});
				
				$( '.pm-required' ).css({
					color : to
				});
				
				$( '.pm-sub-menu-info p i' ).css({
					color : to
				});
				
				$( '.pm-dropmenu i' ).css({
					color : to
				});
				
				$( '.pm-cart-icon-count' ).css({
					backgroundColor : to
				});
				
				$( '.pm-sub-menu-container' ).css({
					borderBottom : '2px solid' + to
				});
				
				$( '.pm-dropmenu-active ul' ).css({
					borderTop : '2px solid' + to
				});
				
				$( '.pm-search-container' ).css({
					backgroundColor : to
				});
				
				$( '.pm-hours-exit' ).css({
					color : to
				});
				
				$( '.pm-address-exit' ).css({
					color : to
				});
				
				$( '.pm-dots span.pm-currentDot' ).css({
					backgroundColor : to
				});
				
				$( '.sf-sub-indicator' ).css({
					color : to
				});
				
				$( '.pm-caption h1 span' ).css({
					color : to
				});
				
				$( '.pm-widget-footer #wp-calendar tbody td' ).css({
					border : '1px solid' + to
				});
				
				$( '.pm-widget-footer #wp-calendar tbody tr td#today' ).css({
					backgroundColor : to
				});
				
				$( '.pm-widget-footer .pm-sidebar-search-container i' ).css({
					color : to
				});
				
				$( '.pm-sidebar-title-divider' ).css({
					backgroundColor : to
				});
				
				$( '.pm-sidebar-title-diamond' ).css({
					borderTop : '15px solid' + to
				});
				
				$( '.pm-sidebar-search-container i' ).css({
					color : to
				});
				
				$( '.pm-news-post-date-bg' ).css({
					borderTop : '150px solid' + to
				});
				
				$( '.pm-author-bio-img' ).css({
					border : '3px solid' + to
				});
				
				$( '.pm-staff-profile-item-details-btn' ).css({
					backgroundColor : to
				});
				
				$( '.pm-staff-item-social-icon-diamond' ).css({
					backgroundColor : to
				});
				
				$( '.pm-isotope-filter-system li a.current' ).css({
					backgroundColor : to,
					borderTop : '3px solid' + to
				});
				
				$( '.pm-schedule-post-expand-btn' ).css({
					color : to
				});
				
				$( '.pm-pagination li.current' ).css({
					backgroundColor : to,
					border : '3px solid' + to
				});
				
				$( '.woocommerce-pagination .page-numbers li span.current' ).css({
					backgroundColor : to,
					border : '3px solid' + to
				});
				
				$( '.pm-class-post-details-btn' ).css({
					backgroundColor : to
				});
				
				$( '.pm-class-post-diamond' ).css({
					borderBottom : '20px solid' + to
				});
				
				$( '.pm-class-post-divider' ).css({
					backgroundColor : to
				});
				
				$( '.pm-class-post-info .excerpt a' ).css({
					color : to
				});
				
				$( '.pm-gallery-post-like-diamond' ).css({
					backgroundColor : to
				});
				
				$( '.pm-gallery-post-details-diamond' ).css({
					backgroundColor : to
				});
				
				$( '.pm-gallery-post-title-container a' ).css({
					backgroundColor : to
				});
				
				$( '.pm-gallery-post-details-excerpt a' ).css({
					color : to
				});
				
				$( '.pm-primary-address strong' ).css({
					color : to
				});
				
				$( '.pm-view-all-addresses a' ).css({
					color : to
				});
				
				$( '.pm-mailchimp-submit' ).css({
					backgroundColor : to
				});
				
				$( '.pm-footer-copyright a' ).css({
					color : to
				});
				
				$( '.pm-hours-day' ).css({
					color : to
				});
				
				$( '.pm-schedule-post-info .title' ).css({
					color : to
				});
				
				$( '.pm-schedule-post-info a' ).css({
					color : to
				});
				
				$( '.pm-news-post-link' ).css({
					backgroundColor : to
				});
				
				$( '.pm-title-divider' ).css({
					backgroundColor : to
				});
				
				$( '.pm-author-title' ).css({
					color : to
				});
				
				$( '.pm-comment-avatar' ).css({
					borderBottom : '3px solid' + to
				});
				
				$( '.pm-event-post-img-title' ).css({
					borderTop : '3px solid' + to
				});
				
				$( '.pm-event-post-img-diamond' ).css({
					backgroundColor : to
				});
				
				$( '.pm-gallery-widget-item-expand' ).css({
					backgroundColor : to
				});
				
				$( '.pm-widget-event-post-img-diamond' ).css({
					backgroundColor : to
				});
				
				$( '.pm-class-post-info.single-post' ).css({
					borderTop : '3px solid' + to
				});
				
				$( '.pm-trial-form-title' ).css({
					backgroundColor : to
				});
				
				$( '.pm-trial-form-title-diamond' ).css({
					borderTop : '50px solid' + to
				});
				
				$( '.pm-trial-form-submit' ).css({
					backgroundColor : to
				});
				
				$( '.pm-pricing-table-featured' ).css({
					borderTop : '80px solid' + to
				});
				
				$( '.pm-pricing-table-btn' ).css({
					color : to
				});
				
				$( '.pm-testimonial-name' ).css({
					color : to
				});
				
				$( '.pm-testimonials-arrows a' ).css({
					color : to
				});
				
				$( '.flexslider .flex-prev' ).css({
					borderBottom : '90px solid' + to
				});
				
				$( '.flexslider .flex-next' ).css({
					borderTop : '90px solid' + to
				});
				
				$( '.pm-event-item-date-bg' ).css({
					backgroundColor : to
				});
				
				$( '.pm-event-item-details p span' ).css({
					color : to
				});
				
				$( 'a.pm-primary' ).css({
					color : to
				});
				
				$( '.pm-primary' ).css({
					color : to
				});
				
				$( '.pm-standalone-news-post-link' ).css({
					backgroundColor : to
				});
				
				$( '.pm-standalone-news-title' ).css({
					borderRight : '3px solid' + to
				});
				
				$( '.pm-standalone-news-title h6 span' ).css({
					color : to
				});
				
				$( '.pm-standalone-news-post-date-bg' ).css({
					borderTop : '150px solid' + to
				});
				
				$( '.pm-video-activator-bg' ).css({
					backgroundColor : to
				});
				
				$( '.pm-rounded-btn' ).css({
					backgroundColor : to
				});
				
				$( '.pm-rounded-btn.flip_color' ).css({
					backgroundColor : to
				});
				
				$( '.pm-form-textarea.invalid_field' ).css({
					backgroundColor : to,
					borderBottom : '3px solid' + to
				});
				
				$( '.pm-form-textfield.invalid_field' ).css({
					backgroundColor : to,
					borderBottom : '3px solid' + to
				});
				
				$( '#pm-contact-form-response' ).css({
					color : to
				});
				
				$( '#pm-trial-form-response' ).css({
					color : to
				});
				
				$( '.pm-trial-form-field.invalid_field' ).css({
					border : '3px solid' + to
				});
				
				$( '.comment-form-rating .stars span a i.activated' ).css({
					color : to
				});
				
				$( '.pm-widget-star-rating li i' ).css({
					color : to
				});
				
				$( '.pagination_multi li' ).css({
					backgroundColor : to,
					border : '3px solid' + to
				});
				
				$( '.pm-event-item-details p span' ).css({
					color : to
				});
				
				$( '.pm-flexslider-details .title' ).css({
					color : to
				});
				
				$( '.tweet_list li a' ).css({
					color : to
				});
				
				$( '.pm-widget-footer .textwidget a' ).css({
					color : to
				});
				
				$( '.pm-woocomm-item-sale-tag' ).css({
					backgroundColor : to
				});
				
				$( '.pm-nav-tabs > li.active' ).css({
					backgroundColor : to
				});
				
				$( '.panel-title i' ).css({
					backgroundColor : to
				});
				
				$( '.pm-rounded-btn.cta-btn' ).css({
					backgroundColor : to
				});
				
				$( '.pm-widget-footer .widget_recent_comments ul li span' ).css({
					color : to
				});
				
				$( '.pm-widget-footer .widget_recent_comments ul li' ).css({
					color : to
				});
				
				$( '.pm-icon-bundle i' ).css({
					color : to
				});
				
				$( '.pm-news-title h6 span' ).css({
					color : to
				});
				
				$( '.pm-news-title' ).css({
					borderRight : '3px solid' + to
				});
				
				$( '.pm-news-post-like-diamond' ).css({
					backgroundColor : to
				});
				
				$( '.pm-news-title' ).css({
					borderLeft : '4px solid' + to
				});
				
				$( '.pm-pricing-table-title' ).css({
					borderBottom : '3px solid' + to
				});
				
				$( '.pm-pricing-table-btn' ).css({
					color : to
				});
				
			}			
		});		
	});	
	
	wp.customize( 'secondaryColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.woocommerce .widget_price_filter .ui-slider .ui-slider-handle' ).css({
					backgroundColor : to
				});
				
				$( '.woocommerce ul.products li.product .price' ).css({
					color : to
				});	
				
				$( '.woocommerce div.product .woocommerce-tabs ul.tabs li.active > a' ).css({
					backgroundColor : to
				});
				
				$( '.woocommerce p.stars a' ).css({
					color : to
				});
				
				$( '.woocommerce-review-link' ).css({
					color : to
				});
				
				$( '.woocommerce form .form-row.woocommerce-invalid .select2-container' ).css({
					borderColor : to
				});
				
				$( '.woocommerce form .form-row.woocommerce-invalid input.input-text' ).css({
					borderColor : to
				});
				
				$( '.woocommerce form .form-row.woocommerce-invalid select' ).css({
					borderColor : to
				});
				
				$( '.woocommerce form .form-row.woocommerce-invalid label' ).css({
					color : to
				});
				
				$( '.woocommerce form .form-row .required' ).css({
					color : to
				});
				
				$( '.woocommerce a.remove' ).css({
					backgroundColor : to
				});
				
				$( '.woocommerce-error' ).css({
					borderTop : '3px solid' + to
				});
				
				$( '.woocommerce-info' ).css({
					borderTop : '3px solid' + to
				});
				
				$( '.woocommerce-message' ).css({
					borderTop : '3px solid' + to
				});
				
				$( '.woocommerce ul.products li.product .price' ).css({
					color : to
				});
				
				$( '.woocommerce form .form-row.woocommerce-validated .select2-container' ).css({
					borderColor : to
				});
				
				$( '.woocommerce form .form-row.woocommerce-validated input.input-text' ).css({
					borderColor : to
				});
				
				$( '.woocommerce form .form-row.woocommerce-validated select' ).css({
					borderColor : to
				});
				
				$( '.woocommerce #respond input#submit' ).css({
					backgroundColor : to
				});
				
				$( '.woocommerce a.button' ).css({
					backgroundColor : to
				});
				
				$( '.woocommerce button.button' ).css({
					backgroundColor : to
				});
				
				$( '.woocommerce input.button' ).css({
					backgroundColor : to
				});
				
				$( '.woocommerce div.product p.price' ).css({
					color : to
				});
				
				$( '.woocommerce div.product span.price' ).css({
					color : to
				});
				
				$( '.nav-tabs > li.active a' ).css({
					color : to
				});
				
				$( '.woocommerce-page .woocommerce-message' ).css({
					backgroundColor : to
				});
				
				$( '.woocommerce-page .woocommerce-error' ).css({
					backgroundColor : to
				});
				
				$( '#pm-back-to-top' ).css({
					color : to
				});
				
				$( '.pm-single-post-panel-title.pm-secondary' ).css({
					color : to
				});
				
				$( '.pm-secondary' ).css({
					color : to
				});
				
				$( '.pm-pricing-table-price' ).css({
					backgroundColor : to
				});
				
				$( '.pm-pricing-table-title' ).css({
					backgroundColor : to
				});
				
				$( '.pm-pricing-table-btn' ).css({
					backgroundColor : to
				});
				
				$( '.pm-rounded-btn' ).css({
					backgroundColor : to
				});
				
				$( '.pm-flexslider-details' ).css({
					backgroundColor : convertHex(to,95)
				});
				
				$( '.pm-event-item-container' ).css({
					backgroundColor : convertHex(to,80)
				});
				
				$( '.pm-rounded-submit-btn' ).css({
					backgroundColor : to
				});
				
				$( '#place_order' ).css({
					backgroundColor : to
				});
				
				$( '.pm-checkout-tabs > li.active > a' ).css({
					backgroundColor : to
				});
				
				$( '.pm-checkout-tabs > li.active > a' ).css({
					backgroundColor : to
				});
				
				$( '.pm-nav-tabs > li > a' ).css({
					backgroundColor : to
				});
				
				$( '.pm-nav-tabs > li.active > a' ).css({
					border : '3px solid' + to
				});
				
				$( '.panel-default > .panel-heading' ).css({
					backgroundColor : to
				});
				
				$( '.pm-icon-element' ).css({
					backgroundColor : to
				});
				
				$( '.pm-icon-bundle' ).css({
					backgroundColor : to
				});
				
				$( '.tinynav' ).css({
					backgroundColor : to
				});
				
				$( '.pm-brand-carousel-btns a' ).css({
					color : to
				});
				
			}			
		});		
	});	
	
	wp.customize( 'linkColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( 'a' ).css({
					color : to
				});	
				
			}			
		});		
	});		
	
	wp.customize( 'dividerColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.woocommerce table.shop_table tbody th' ).css({
					borderTop : '1px solid' + to
				});	
				
				$( '.woocommerce table.shop_table tfoot td' ).css({
					borderTop : '1px solid' + to
				});	
				
				$( '.woocommerce table.shop_table tfoot th' ).css({
					borderTop : '1px solid' + to
				});
				
				$( '.woocommerce .widget_shopping_cart .total' ).css({
					borderTop : '1px solid' + to
				});	
				
				$( '.woocommerce.widget_shopping_cart .total' ).css({
					borderTop : '1px solid' + to
				});	
				
				$( '.woocommerce .woocommerce-ordering select' ).css({
					border : '1px solid' + to
				});	
				
				$( '.woocommerce #reviews #comment' ).css({
					border : '1px solid' + to
				});	
				
				$( '.input-text.qty.text' ).css({
					border : '1px solid' + to
				});	
				
				$( '.woocommerce #reviews #comments ol.commentlist li .comment-text' ).css({
					border : '1px solid' + to
				});	
				
				$( '.woocommerce div.product form.cart .variations select' ).css({
					border : '1px solid' + to
				});	
				
				$( '.woocommerce table.shop_table' ).css({
					border : '1px solid' + to
				});
				
				$( '.woocommerce table.shop_table td' ).css({
					borderTop : '1px solid' + to
				});
				
				$( '.woocommerce form .form-row input.input-text' ).css({
					border : '1px solid' + to
				});
				
				$( '.woocommerce form .form-row textarea' ).css({
					border : '1px solid' + to
				});
				
				$( '.woocommerce form .form-row select' ).css({
					border : '1px solid' + to
				});
				
				$( '.shop_table thead' ).css({
					border : '1px solid' + to
				});
				
				$( '.single_variation' ).css({
					borderTop : '1px solid' + to
				});
				
				$( '.pm-container-border' ).css({
					borderRight : '1px solid' + to
				});
				
				$( '.pm-pricing-table-container ul' ).css({
					border : '1px solid' + to
				});
				
				$( '.pm-pricing-table-container ul li' ).css({
					borderBottom : '1px solid' + to
				});
				
				$( '.pm-staff-item-divider' ).css({
					backgroundColor : to
				});
				
				$( '.woocommerce-page .woocommerce-message' ).css({
					borderBottom : '1px solid' + to,
					borderTop : '1px solid' + to
				});
				
				$( '.pm-pagination-page-counter' ).css({
					borderTop : '1px solid' + to
				});
				
				$( '.pm-related-blog-post-thumb-diamond' ).css({
					color : to
				});
				
				$( '.pm-staff-profile-item-details-divider' ).css({
					backgroundColor : to
				});
				
				$( 'input[type=text]#coupon_code' ).css({
					border : '1px solid' + to
				});
				
				$( '.pm-share-post-container' ).css({
					borderTop : '1px solid' + to
				});
				
				$( '.woocommerce-pagination' ).css({
					borderTop : '1px solid' + to
				});
				
				$( '.pm-nav-tabs > li > a' ).css({
					border : '3px solid' + to
				});
				
			}			
		});		
	});		
	
	
	wp.customize( 'tooltipColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '#pm_marker_tooltip.pm_tip_arrow_bottom' ).css({
					backgroundColor : to
				});
				
				$( '#pm_marker_tooltip.pm_tip_arrow_top' ).css({
					backgroundColor : to
				});
				
			}			
		});		
	});	
	
	wp.customize( 'blockQuoteColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( 'blockquote' ).css({
					borderTop : '5px solid' + to,
					borderBottom : '5px solid' + to
				});
				
				
			}			
		});		
	});	
	
	wp.customize( 'widgetsPostBtnColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.pm-square-btn.event' ).css({
					border : '3px solid' + to,
					color : to
				});
				
				$( '.pm-square-btn.class-widget' ).css({
					border : '3px solid' + to,
					color : to
				});
				
				$( '.pm-square-btn.facebook' ).css({
					border : '3px solid' + to,
					color : to
				});
				
			}			
		});		
	});	


	//Footer options
	
	//footer colors
	wp.customize( 'socialIconColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.pm-social-icon-diamond' ).css({
					backgroundColor : to
				});
				
			}			
		});		
	});	
	
	wp.customize( 'fatFooterBackgroundColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.pm-fat-footer' ).css({
					backgroundColor : to
				});
				
			}			
		});		
	});	
	
	wp.customize( 'footerBackgroundColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.pm-footer-copyright' ).css({
					backgroundColor : to
				});
				
			}			
		});		
	});	
	
	wp.customize( 'socialFooterBackgroundColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( 'footer' ).css({
					backgroundColor : to
				});
				
			}			
		});		
	});	

	//footer slider options	
	wp.customize( 'socialFooterHeight', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( 'footer' ).css({
					height : to,
				});				
			}			
		});		
	});
	
	
	
	//Post options
	
	//post colors
	wp.customize( 'postExcerptDividerColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-woocom-item-short-description' ).css({
					borderBottom : '1px solid' + to,
					borderTop : '1px solid' + to,
				});	
				$( '.product_meta' ).css({
					borderTop : '1px solid' + to,
				});	
				$( '.pm-product-share-container' ).css({
					borderTop : '1px solid' + to,
				});
				$( '.pm-news-post-divider' ).css({
					backgroundColor : to,
				});
				$( '.pm-standalone-news-post-divider' ).css({
					backgroundColor : to,
				});				
			}			
		});		
	});
	 
	 wp.customize( 'postMetaLinksColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-news-post-tags-and-excerpt p a' ).css({
					color : to
				});	
				$( '.pm-standalone-news-post-tags-and-excerpt p a' ).css({
					color : to
				});	
				$( '.pm-standalone-news-excerpt a' ).css({
					color : to
				});		
			}			
		});		
	});
	
	wp.customize( 'singlePostSocialIconColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-post-social-icon-diamond' ).css({
					backgroundColor : to
				});	
			}			
		});		
	});
	
	wp.customize( 'authorCommentsBoxColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '#pm-author-panel' ).css({
					backgroundColor : to
				});	
				$( '#pm-comments-responses-panel' ).css({
					backgroundColor : to
				});	
			}			
		});		
	});
	
	wp.customize( 'authorBorderColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-author-bio-img-bg' ).css({
					backgroundColor : to
				});	
			}			
		});		
	});
	
	
	//Custom post type options
	
	//colors
	wp.customize( 'calendarIconColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-schedule-post-date i' ).css({
					color : to
				});	
				$( '.pm-event-post-img-diamond-date i' ).css({
					color : to
				});	
				$( '.pm-event-item-date i' ).css({
					color : to
				});	
			}			
		});		
	});
	
	//Shortcode options
	wp.customize( 'tabContentBgColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-tab-content' ).css({
					backgroundColor : to
				});	
			}			
		});		
	});
	
	wp.customize( 'accordionContentBgColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.panel-group .panel-heading + .panel-collapse .panel-body' ).css({
					backgroundColor : to
				});	
			}			
		});		
	});
	
	wp.customize( 'data_table_title_color', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-workshop-table-title' ).css({
					backgroundColor : to
				});	
			}			
		});		
	});
	
	wp.customize( 'data_table_info_color', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-workshop-table-content' ).css({
					backgroundColor : to
				});	
			}			
		});		
	});
	
	wp.customize( 'trial_form_bg_color', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-trial-form-container' ).css({
					backgroundColor : convertHex(to,80)
				});	
			}			
		});		
	});
	
	wp.customize( 'sliderButtonColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-slide-btn' ).css({
					color : to,
					border : "3px solid" + to
				});	
			}			
		});		
	});
	
	wp.customize( 'bulletColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-dots span' ).css({
					backgroundColor : to
				});	
			}			
		});		
	});
	
	wp.customize( 'bulletBgColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-dots' ).css({
					backgroundColor : convertHex(to,95)
				});	
			}			
		});		
	});
	
	wp.customize( 'arrowColor', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-slider div.pm-prev' ).css({
					color : to
				});
				$( '.pm-slider div.pm-next' ).css({
					color : to
				});	
			}			
		});		
	});
	
	
	
	
	

	// Page layouts.
	/*wp.customize( 'page_layout', function( value ) {
		value.bind( function( to ) {
			if ( 'one-column' === to ) {
				$( 'body' ).addClass( 'page-one-column' ).removeClass( 'page-two-column' );
			} else {
				$( 'body' ).removeClass( 'page-one-column' ).addClass( 'page-two-column' );
			}
		} );
	} );*/
	
	//convertHex('#A7D136',50)
	function convertHex(hex,opacity){
		hex = hex.replace('#','');
		r = parseInt(hex.substring(0,2), 16);
		g = parseInt(hex.substring(2,4), 16);
		b = parseInt(hex.substring(4,6), 16);
	
		result = 'rgba('+r+','+g+','+b+','+opacity/100+')';
		return result;
	}

	//Whether a header image is available.
	function hasHeaderImage() {
		var image = wp.customize( 'header_image' )();
		return '' !== image && 'remove-header' !== image;
	}

	//Whether a header video is available.
	function hasHeaderVideo() {
		var externalVideo = wp.customize( 'external_header_video' )(),
			video = wp.customize( 'header_video' )();

		return '' !== externalVideo || ( 0 !== video && '' !== video );
	}

	// Toggle a body class if a custom header exists.
	/*$.each( [ 'external_header_video', 'header_image', 'header_video' ], function( index, settingId ) {
		wp.customize( settingId, function( setting ) {
			setting.bind(function() {
				if ( hasHeaderImage() ) {
					$( document.body ).addClass( 'has-header-image' );
				} else {
					$( document.body ).removeClass( 'has-header-image' );
				}

				if ( ! hasHeaderVideo() ) {
					$( document.body ).removeClass( 'has-header-video' );
				}
			} );
		} );
	} );*/

} )( jQuery );