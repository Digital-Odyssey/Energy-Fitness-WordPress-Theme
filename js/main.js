(function($) {
	
	'use strict';
	
	//Global vars
	var cookieName = '';
	
	var isMobile = {
		Android: function() {
			return navigator.userAgent.match(/Android/i);
		},
		BlackBerry: function() {
			return navigator.userAgent.match(/BlackBerry/i);
		},
		iOS: function() {
			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		},
		Opera: function() {
			return navigator.userAgent.match(/Opera Mini/i);
		},
		Windows: function() {
			return navigator.userAgent.match(/IEMobile/i);
		},
		any: function() {
			return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
		}
	};
	
	var activeMap = '',
	latLong = '';

	
	$(document).ready(function(e) {
		
		// global
		var Modernizr = window.Modernizr;
		
		// support for CSS Transitions & transforms
		var support = Modernizr.csstransitions && Modernizr.csstransforms;
		var support3d = Modernizr.csstransforms3d;
		// transition end event name and transform name
		// transition end event name
		var transEndEventNames = {
								'WebkitTransition' : 'webkitTransitionEnd',
								'MozTransition' : 'transitionend',
								'OTransition' : 'oTransitionEnd',
								'msTransition' : 'MSTransitionEnd',
								'transition' : 'transitionend'
							},
		transformNames = {
						'WebkitTransform' : '-webkit-transform',
						'MozTransform' : '-moz-transform',
						'OTransform' : '-o-transform',
						'msTransform' : '-ms-transform',
						'transform' : 'transform'
					};
					
		if( support ) {
			this.transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ] + '.PMMain';
			this.transformName = transformNames[ Modernizr.prefixed( 'transform' ) ];
			//console.log('this.transformName = ' + this.transformName);
		}
		
	/* ==========================================================================
	   Remove empty paragraph tags
	   ========================================================================== */
		$('p').each(function() {
			var $this = $(this);
			if($this.html().replace(/\s|&nbsp;/g, '').length == 0)
				$this.remove();
		});
		
	/* ==========================================================================
	   Search entry
	   ========================================================================== */
		
		if($('#pm-search-submit').length > 0){
			var $searchSubmit = $('#pm-search-submit');
			$searchSubmit.live('click', function(e) {
				$('#pm-searchform').submit();
				e.preventDefault();	
			});
		}
		
		
		if($('#pm-search-submit-page').length > 0){
			var $searchSubmitPage = $('#pm-search-submit-page');
			$searchSubmitPage.live('click', function(e) {
				$('#search-form-page').submit();
				e.preventDefault();	
			});
		}
		
		
		//Sidebar
		if($('.pm-sidebar-search-icon-btn').length > 0){
			var $submitBtn = $('.pm-sidebar-search-icon-btn');
			//alert($submitBtn.attr('id'));
			$submitBtn.live('click', function(e) {
				$('#searchform').submit();
				e.preventDefault();	
			});
		}
		
	/* ==========================================================================
	   postItems shortcode carousel
	   ========================================================================== */
	   if( $("#pm-postItems-carousel").length > 0 ){
		   
		    var postOwl = $("#pm-postItems-carousel");
			
			
			postOwl.owlCarousel({
				
				items : 3, //10 items above 1000px browser width
				itemsDesktop : [5000,3],
				itemsDesktopSmall : [991,2],
				itemsTablet: [767,2],
				itemsTabletSmall: [720,1],
				itemsMobile : [320,1],
				
				//Playback
				autoPlay : parseInt(wordpressOptionsObject.autoPlay) === 0 ? false : wordpressOptionsObject.autoPlay,
				//autoPlay : 0,
				slideSpeed : 200,
				stopOnHover : true,
				paginationSpeed : 800,
				
				//Pagination
				pagination : false,
				paginationNumbers: false,
				
		   });
		   
	   }
		
	/* ==========================================================================
	   Woocommerce add to cart icon
	   ========================================================================== */
		/*if( $('.pm-add-to-cart-btn').length > 0 ){
		   
		   $('.pm-add-to-cart-btn').each(function(index, element) {
           
		   		var $this = $(this);
				
				
				if( $this.hasClass('product_type_variable') ) {
			   
				    $this.addClass('variable');
				   
			    }
		    
           });
		   
		   
		   $('.pm-add-to-cart-btn').on('click', function(e) {
			
				var $this = $(this);
				
				if(!$this.hasClass('product_type_variable')) {
					var productID = $this.data('product_id');
				
					var post = '.post-' + productID;
					$(post).find('.pm-added-to-cart-icon').addClass('in_cart');
					
					e.preventDefault();
				}	
				
			});
		   		   
	   }*/
		
		
	/* ==========================================================================
	   Woocommerce Star rating
	   ========================================================================== */
		if( $('.comment-form-rating').length > 0 ){
			
			$('.comment-form-rating .stars span a').append('<i class="fa fa-star"></i>');
			
			$('.comment-form-rating .stars span a').on('click mousedown', function(e) {
				
				e.preventDefault();
				
				var $this = $(this);
				
				//remove previous active attribute to all a tags so we dont catch it
				$('.comment-form-rating .stars span a').removeClass('active');
				$('.comment-form-rating .stars span a i').removeClass('activated');
				
				var className = $this.attr('class');
				var currentStarIndex = className.substring(className.lastIndexOf("-") + 1);
				//console.log("currentStarIndex = " + currentStarIndex);
				
				for( var i = 0; i <= currentStarIndex; i++){
					
					var $currStar = '.star-' + i;
					$($currStar).find('i').addClass('activated');
					
				}
				
			});
			
		}
		
	/* ==========================================================================
	   Woocommerce Star rating widget
	   ========================================================================== */
		if( $('.widget_recent_reviews').length > 0 ){
			
			$('.widget_recent_reviews .product_list_widget li').each(function(index, element) {
                
				var $ratingDiv = $(element).find('.star-rating');
				var rating = $(element).find('.star-rating span strong').html();
				
				$ratingDiv.html('<ul class="pm-widget-star-rating" id="pm-widget-star-rating-'+index+'"></ul>');
				
				for (var i = 1; i <= 5; i++) {
										
					if( i > parseInt(rating) ){
						$('#pm-widget-star-rating-'+index+'').append('<li><i class="fa fa-star inactive"></i></li>');
					} else {
						$('#pm-widget-star-rating-'+index+'').append('<li><i class="fa fa-star"></i></li>');
					}
										
				}
				
            });
						
		}
		
	/* ==========================================================================
	   Woocommerce product details page star rating
	   ========================================================================== */
		if( $('.woocommerce-product-rating').length > 0 ){
			
			var $ratingDiv = $('.woocommerce-product-rating').find('.star-rating');
			
			var rating = $ratingDiv.find('span strong').html();
			
			$ratingDiv.html('<ul class="pm-widget-star-rating" id="pm-widget-star-rating-single"></ul>');
			
			for (var i = 1; i <= 5; i++) {
									
				if( i > parseInt(rating) ){
					$('#pm-widget-star-rating-single').append('<li><i class="fa fa-star inactive"></i></li>');
				} else {
					$('#pm-widget-star-rating-single').append('<li><i class="fa fa-star"></i></li>');
				}
									
			}
						
		}
		
	/* ==========================================================================
	   setDimensionsPieCharts
	   ========================================================================== */
		
		function setDimensionsPieCharts() {
	
			$(".pm-pie-chart").each(function() {
	
				var $t = $(this);
				var n = $t.parent().width();
				var r = $t.attr("data-barSize");
				
				if (n < r) {
					r = n;
				}
				
				$t.css("height", r);
				$t.css("width", r);
				$t.css("line-height", r + "px");
				
				$t.find("i").css({
					"line-height": r + "px",
					"font-size": r / 3
				});
				
			});
	
		}
		
	/* ==========================================================================
	   animatePieCharts
	   ========================================================================== */
	
		function animatePieCharts() {
	
			if(typeof $.fn.easyPieChart != 'undefined'){
	
				$(".pm-pie-chart:in-viewport").each(function() {
		
					var $t = $(this);
					var n = $t.parent().width();
					var r = $t.attr("data-barSize");
					
					if (n < r) {
						r = n;
					}
					
					$t.easyPieChart({
						animate: 1300,
						lineCap: "square",
						lineWidth: $t.attr("data-lineWidth"),
						size: r,
						barColor: $t.attr("data-barColor"),
						trackColor: $t.attr("data-trackColor"),
						scaleColor: "transparent",
						onStep: function(from, to, percent) {
							$(this.el).find('.pm-pie-chart-percent span').text(Math.round(percent));
						}
		
					});
					
				});
				
			}
	
		}
		
		
	/* ==========================================================================
	   Remove empty post pagination links to center single post link
	   ========================================================================== */
		if( $('.pm-single-post-navigation').length > 0 ){
			
			if( $('.pm-single-post-navigation').children('li').eq(0).is(':empty') ) {
				$('.pm-single-post-navigation').children('li').eq(0).remove();
			};
			
		}
		
		if( $('.pm-single-post-navigation').length > 0 ){
			
			if( $('.pm-single-post-navigation').children('li').eq(1).is(':empty') ) {
				$('.pm-single-post-navigation').children('li').eq(1).remove();
			};
			
		}

	/* ==========================================================================
	   Populate category menu list
	   ========================================================================== */
	   if(wordpressOptionsObject){
						
			var $categoryMenuItem = $('#pm-main-nav').children().find("a[title='categorylist']");
			
			$categoryMenuItem.parent().append('<ul class="sub-menu" id="pm-category-list"></ul>');
			
			var $categoryUL = $('#pm-category-list');
			
			$.each(wordpressOptionsObject.categories, function( index, value ) {
				//console.log( index + ": " + value.slug );
				$categoryUL.append("<li><a href='"+wordpressOptionsObject.urlRoot+"/category/"+value.slug+"/'>" + value.name + "</a></li>");
			});
			
			if($('.pm-sitemap-categories-list').length > 0){
				
				var $categoryList = $('.pm-sitemap-categories-list');
				
				$.each(wordpressOptionsObject.categories, function( index, value ) {
					//console.log( index + ": " + value.slug );
					$categoryList.append("<li><a href='"+wordpressOptionsObject.urlRoot+"/category/"+value.slug+"/'>" + value.name + "</a></li>");
				});
				
			}
						
	   }
		
		
	/* ==========================================================================
	   Add rollover features to Flicker widget
	   ========================================================================== */
	   if( $('.flickr_badge_image').length > 0 ){
	   	
			var flickrATag = $('.flickr_badge_image').find('a');
			flickrATag.prepend('<span></span><i class="fa fa-search-plus"></i>');
		
	   }
		
	/* ==========================================================================
	   Print page
	   ========================================================================== */
		if( $('#pm-print-btn').length > 0 ){
			var printBtn = $('#pm-print-btn');
			printBtn.click(function() {
				window.print();
				return false;	
			});
		}
		
	/* ==========================================================================
	   Initialize animations
	   ========================================================================== */
		runParallax();
		animateMilestones();
		animateProgressBars();
		animatePieCharts();
		setDimensionsPieCharts();
		
		
	/* ==========================================================================
	   Initialize WOW plugin for element animations
	   ========================================================================== */
		if( $(window).width() > 991 ){
			if( $('.wow').length > 0 ){
				new WOW().init();
			}
			
		}
		
		
	/* ==========================================================================
	   animateMilestones
	   ========================================================================== */
	
		function animateMilestones() {
	
			$(".milestone:in-viewport").each(function() {
				
				var $t = $(this);
				var	n = $t.find(".milestone-value").attr("data-stop");
				var	r = parseInt($t.find(".milestone-value").attr("data-speed"));
					
				if (!$t.hasClass("already-animated")) {
					$t.addClass("already-animated");
					$({
						countNum: $t.find(".milestone-value").text()
					}).animate({
						countNum: n
					}, {
						duration: r,
						easing: "linear",
						step: function() {
							$t.find(".milestone-value").text(Math.floor(this.countNum));
						},
						complete: function() {
							$t.find(".milestone-value").text(this.countNum);
						}
					});
				}
				
			});
	
		}
		
	/* ==========================================================================
	   animateProgressBars
	   ========================================================================== */
	
		function animateProgressBars() {
				
			$(".pm-progress-bar .pm-progress-bar-outer:in-viewport").each(function() {
				
				var $t = $(this),
				progressID = $t.attr('id'),
				numID = progressID.substr(progressID.lastIndexOf("-") + 1),
				targetDesc = '#pm-progress-bar-desc-' + numID,
				$target = $(targetDesc).find('span'),
				$diamond = $(targetDesc).find('.pm-progress-bar-diamond'),
				dataWidth = $t.attr("data-width");
								
				
				if (!$t.hasClass("already-animated")) {
					
					$t.addClass("already-animated");
					$t.animate({
						width: dataWidth + "%"
					}, 2000);
					$target.animate({
						"left" : dataWidth + "%",
						"opacity" : 1
					}, 2000);
					$diamond.animate({
						"left" : dataWidth + "%",
						"opacity" : 1
					}, 2000);
					
				}
				
			});
	
		}
		
	/* ==========================================================================
	   Initialize PrettyPhoto
	   ========================================================================== */
		methods.loadPrettyPhoto();
		
	/* ==========================================================================
	   Ajax load more posts
	   ========================================================================== */
	   if($('#pm-post-load-more').length > 0){
						
			var morebutton = $('#pm-post-load-more'),
			container = 'pm-post-item-container',
			btntext = morebutton.find('span').text(),
			page = 1;
									
			//alert($('#'+container).height());
		
			morebutton.click(function(e){
				
				e.preventDefault();
				page++;
				
				//morebutton.removeClass('fa fa-cloud-download').addClass('fa fa-spinner fa-spin');
				morebutton.find('span').text(pulsarajax.loading);//retrieved from localize script in functions.php
				//morebutton.find('i').removeClass('fa fa-cloud-download').addClass('fa fa-cog fa-spin').css({borderLeft:'0px'});
				
				$.post(pulsarajax.ajaxurl, {action:'pm_ln_load_more_posts', nonce:pulsarajax.nonce, page:page}, function(data){
					
					var content = $(data.content);
					
					$('#'+container).append(content); //appended or insert (insert appends and filters the new items)
						
					var numItems = $('article').length; 
					$('.pm-load-more-container-current-count').text(numItems);
					
					if(page >= data.pages){
						
						//all data has loaded, hide the Load More button
						morebutton.fadeOut('fast');
						morebutton.parent().css({ 'display' : 'none' });
						morebutton.unbind( "click" );
						morebutton.click(function(e) {
							e.preventDefault();
						});
						
					} else {
						//More items can be loaded, restore text on button
						morebutton.find('span').text(btntext);//retrieved from localize script in functions.php
					}
					
				},'json');
				
			});
			
		}
		
	/* ==========================================================================
	   Ajax load more - Custom post types
	   ========================================================================== */
	   if($('#pm-load-more').length > 0){
						
			var morebutton = $('#pm-load-more'),
			section = morebutton.attr('name'),
			//container = 'pm-isotope-'+section+'-container',
			container = 'pm-isotope-item-container',
			btntext = morebutton.find('span').text(),
			page = 1;
									
			//alert($('#'+container).height());
		
			morebutton.click(function(e){
				
				e.preventDefault();
				page++;
				
				//morebutton.removeClass('fa fa-cloud-download').addClass('fa fa-spinner fa-spin');
				morebutton.find('span').text(pulsarajax.loading);//retrieved from localize script in functions.php
				//morebutton.find('i').removeClass('fa fa-cloud-download').addClass('fa fa-cog fa-spin').css({borderLeft:'0px'});
				
				$.post(pulsarajax.ajaxurl, {action:'pm_ln_load_more', nonce:pulsarajax.nonce, page:page, section:section}, function(data){
					
					var content = $(data.content);
					
					$(content).imagesLoaded(function(){
						
						$('#'+container).append(content).isotope('insert',content); //appended or insert (insert appends and filters the new items)
												
						//$('.pm-load-more-status').text('Loading...');
						//morebutton.find('span').append('<i class="fa fa-cloud-download"></i>');
						//morebutton.find('i').removeClass('fa fa-cog fa-spin').addClass('fa fa-cloud-download').css({borderLeft:'1px solid black'});
						
						//methods.resetHoverPanels();
						
						var numItems = $('div.pm-isotope-item').length; 
						$('.pm-load-more-container-current-count').text(numItems);
						
						if(section == 'galleries'){
							//reset prettyPhoto for new isotope items
							methods.loadPrettyPhoto();
							methods.initializeGalleryLike();
							methods.initializeGalleryContainer();
						}
						
						if(section == 'schedules'){
							//reset prettyPhoto for new isotope items
							methods.initializeSchedulePosts();
						}
						
						if(section == 'staff'){
							//reset prettyPhoto for new isotope items
							methods.initializeStaffPosts();
						}
						
						/*if(section == 'staff'){
							var numItems = $('div.pm-isotope-item').length;
							$('.pm-load-more-container-current-count').text(numItems);
						}*/
						
					});
					
					if(page >= data.pages){
						
						//all data has loaded, hide the Load More button
						morebutton.fadeOut('fast');
						morebutton.parent().css({ 'display' : 'none' });
						morebutton.unbind( "click" );
						morebutton.click(function(e) {
							e.preventDefault();
						});
						
					} else {
						//More items can be loaded, restore text on button
						morebutton.find('span').text(btntext);//retrieved from localize script in functions.php
					}
					
				},'json');
				
			});
			
		}
		
		
	/* ==========================================================================
	   Store item main img
	   ========================================================================== */
	   if( $(".pm-woocomm-item-thumb-container").length > 0 ){
			   
			$(".pm-woocomm-item-thumb-container").hover(function(e) {
				
				var $this = $(this),
				span = $this.find('span'),
				icon = $this.find('i');
				
				 span.css({
					'height' : '100%' 
				 });
				 
				 icon.css({
					'opacity' : 1 
				 });
				
			}, function(e) {
				
				var $this = $(this),
				span = $this.find('span'),
				icon = $this.find('i');
				
				span.css({
					'height' : 0 
				 });
				 
				 icon.css({
					'opacity' : 0 
				 });
				
			});
			   
	   }
		
		
	/* ==========================================================================
	   Store item thumbs
	   ========================================================================== */
	   if( $(".pm-woocomm-item-thumbs").length > 0 ){
			
			$(".pm-woocomm-item-thumbs").children().each(function(index, element) {
				
				 var $this = $(element),
				 span = $this.find('span'),
				 icon = $this.find('i');
				 
				 $this.hover(function(e) {
					 
					 span.css({
						'height' : 200 
					 });
					 
					 icon.css({
						'opacity' : 1 
					 });
					 
				 }, function(e) {
					 
					 span.css({
						'height' : 0 
					 });
					 
					 icon.css({
						'opacity' : 0 
					 });
					 
				 });
				
			});
			
	   }
		
	/* ==========================================================================
	   Store post item
	   ========================================================================== */
	   if( $(".pm-store-item-container").length > 0 ){
			
			$(".pm-store-item-container").each(function(index, element) {
				
				 var $this = $(element),
				 expandBtn = $this.find('.pm-store-item-diamond-btn'),
				 diamondShadow = $this.find('.pm-store-item-diamond-shadow'),
				 diamond = $this.find('.pm-store-item-diamond'),
				 closeBtn = $this.find('.pm-store-item-close-btn'),
				 info = $this.find('.pm-store-item-add-to-cart-container');
				 
				 expandBtn.click(function(e) {
					 
					 e.preventDefault();
					 
					 expandBtn.css({
						'opacity' : 0
					 });
					 
					 diamondShadow.css({
						'opacity' : 0
					 });
					 
					 diamond.css({
						'opacity' : 0
					 });
					 
					 info.css({
						'opacity' : 1,
						'bottom' : 0
					 });
					 
				 });
				 
				 closeBtn.click(function(e) {
					 
					 e.preventDefault();
					 
					 expandBtn.css({
						'opacity' : 1
					 });
					 
					 diamondShadow.css({
						'opacity' : 1
					 });
					 
					 diamond.css({
						'opacity' : 1
					 });
					 
					 info.css({
						'opacity' : 0,
						'bottom' : -250
					 });
					 
				 });
				
			});
			   
	   }
		
	/* ==========================================================================
	   Schedule post item
	   ========================================================================== */
	   methods.initializeSchedulePosts();
	   
	/* ==========================================================================
	   Gallery post item
	   ========================================================================== */
	   methods.initializeGalleryContainer()
	   
		
	/* ==========================================================================
	   Class post item
	   ========================================================================== */
	   if( $(".pm-class-post").length > 0 ){
			
			$(".pm-class-post").each(function(index, element) {
				
				var $this = $(element),
				btn = $this.find('.pm-class-post-details-btn'),
				container = $this.find('.pm-class-post-details-container'),
				divider = $this.find('.pm-class-post-divider'),
				excerpt = $this.find('.excerpt'),
				readMore = $this.find('.pm-square-btn'),
				isActive = false;
				
				btn.click(function(e) {
					
					e.preventDefault();
					
					if(!isActive){
						
						isActive = true;
						
						btn.removeClass('fa fa-chevron-up').addClass('fa fa-chevron-down');
						
						container.css({
							'top' : 0	
						});
						
						divider.css({
							'width' : 90	
						});
						
						excerpt.css({
							'opacity' : 1	
						});
						
						readMore.css({
							'opacity' : 1	
						});
						
					} else {
						
						isActive = false;
						
						btn.removeClass('fa fa-chevron-down').addClass('fa fa-chevron-up');
					
						container.css({
							'top' : 260	
						});
						
						divider.css({
							'width' : 0	
						});
						
						excerpt.css({
							'opacity' : 0		
						});
						
						readMore.css({
							'opacity' : 0		
						});
					
					}
					
				});
				
			});
			
	   }
		
	/* ==========================================================================
	   Staff profile item
	   ========================================================================== */
	   methods.initializeStaffPosts();
	   		
	/* ==========================================================================
	   Testimonials carousel (homepage)
	   ========================================================================== */
	   if( $("#pm-testimonials-carousel").length > 0 ){
			  
			$("#pm-testimonials-carousel").PMTestimonials({
				speed : 500,
				slideShow : true,
				//slideShowSpeed : 7000,
				slideShowSpeed : parseInt(wordpressOptionsObject.testimonialCarouselSpeed) === 0 ? 0 : wordpressOptionsObject.testimonialCarouselSpeed,
				controlNav : false,
				arrows : true	
			});
			   
	   }
		
	/* ==========================================================================
	   Brand carousel (homepage)
	   ========================================================================== */
	   if( $("#pm-brands-carousel").length > 0 ){
		   
		    var owl = $("#pm-brands-carousel");
			var isPlaying = false;
		   
		    owl.owlCarousel({
				
				items : 4, //10 items above 1000px browser width
				itemsDesktop : [5000,4],
				itemsDesktopSmall : [991,2],
				itemsTablet: [767,2],
				itemsTabletSmall: [720,1],
				itemsMobile : [320,1],
				
				//Pagination
				pagination : false,
				paginationNumbers: false,
				
		   });
		   
		    // Custom Navigation Events
			$(".pm-owl-next").click(function(){
				owl.trigger('owl.next');
			})
			$(".pm-owl-prev").click(function(){
				owl.trigger('owl.prev');
			})
			
				
			$("#pm-owl-play").click(function(){
				
				if(!isPlaying){
					isPlaying = true;
					$(this).removeClass('fa fa-play').addClass('fa fa-stop');
					owl.trigger('owl.play',3000); //owl.play event accept autoPlay speed as second parameter
				} else {
					isPlaying = false;
					$(this).removeClass('fa fa-stop').addClass('fa fa-play');
					owl.trigger('owl.stop');
				}
				
				
			});
			
			//Hover interaction
			
			
			$('.pm-brand-item').hover(function(e) {
				
				var span = $(this).find('span'),
				aTag = $(this).find('a');
								
				span.css({
					'height' : 70	
				});
				
				aTag.css({
					'bottom' : 20	
				});
				
			}, function(e) {
				
				var span = $(this).find('span'),
				aTag = $(this).find('a');
				
				span.css({
					'height' : 0	
				});
				
				aTag.css({
					'bottom' : -30	
				});
				
			});
				
		   
	   }
		
	/* ==========================================================================
	   Flexslider (homepage)
	   ========================================================================== */
	   if( $("#pm-flexslider-classes").length > 0 ){
		   
		   $("#pm-flexslider-classes").flexslider({
				animation:"slide", 
				controlNav: false, 
				directionNav: true, 
				animationLoop: true, 
				slideshow: false, 
				arrows: true, 
				touch: false, 
				prevText : "", 
				nextText : "",
			});
		   
	   }
	   
	   if( $(".pm-post-slider").length > 0 ){
			$('.flex-direction-nav').find('li').eq(0).append('<div class="flex-prev-shadow" />');
			$('.flex-direction-nav').find('li').eq(1).append('<div class="flex-next-shadow" />');
	   }
	   
	   
	/* ==========================================================================
	   Panels carousel
	   ========================================================================== */
	   if ( $('#pm-interactive-panels-owl').length > 0 ){
			
			//Activate Own Carousel
			$("#pm-interactive-panels-owl").owlCarousel({
			
				 // Most important owl features
				items : 3,
				itemsCustom : false,
				itemsDesktop : [1200,3],
				itemsDesktopSmall : [991,2],
				itemsTablet: [767,1],
				itemsTabletSmall: [720,1],
				itemsMobile : [320,1],
				singleItem : false,
				itemsScaleUp : false,
				 
				//Basic Speeds
				slideSpeed : 800,
				paginationSpeed : 800,
				rewindSpeed : 1000,
				 
				//Autoplay
				autoPlay : false,
				stopOnHover : false,
				 
				// Responsive
				responsive: true,
				responsiveRefreshRate : 200,
				responsiveBaseWidth: window,
				 
				// CSS Styles
				baseClass : "owl-carousel",
				theme : "owl-theme",
				 
				//Lazy load
				lazyLoad : false,
				lazyFollow : true,
				lazyEffect : "fade",
				 
				//Auto height
				autoHeight : true,
				 
				//Mouse Events
				dragBeforeAnimFinish : true,
				mouseDrag : true,
				touchDrag : true,
				 
			});
			
		}
		
	/* ==========================================================================
	   PrettyPhoto activation
	   ========================================================================== */
	  if( $("a[data-rel^='prettyPhoto']").length > 0 ){
		  							
			$("a[data-rel^='prettyPhoto']").prettyPhoto({
				animation_speed: 'normal', /* fast/slow/normal */
				slideshow: 5000, /* false OR interval time in ms */
				autoplay_slideshow: false, /* true/false */
				opacity: 0.80, /* Value between 0 and 1 */
				show_title: true, /* true/false */
				//allow_resize: true, /* Resize the photos bigger than viewport. true/false */
				//default_width: 640,
				//default_height: 480,
				counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
				theme: 'dark_square', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
				horizontal_padding: 20, /* The padding on each side of the picture */
				hideflash: true, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
				wmode: 'opaque', /* Set the flash wmode attribute */
				autoplay: true, /* Automatically start videos: True/False */
				modal: false, /* If set to true, only the close button will close the window */
				deeplinking: true, /* Allow prettyPhoto to update the url to enable deeplinking. */
				overlay_gallery: true, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
				keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
				changepicturecallback: function(){}, /* Called everytime an item is shown/changed */
				
			});
			
		}	
	   
	/* ==========================================================================
	   MeanMenu (mobile menu)
	   ========================================================================== */
	    $('#pm-main-navigation').meanmenu({
			/*meanMenuContainer: '#pm-mobile-menu-container',*/
			meanScreenWidth : 	"1200",
			meanRevealPositionDistance: "0",
			meanShowChildren: true,
			meanExpandableChildren: true,
			meanExpand: "+",
			meanMenuCloseSize: "18px"
		});
		
		
	/* ==========================================================================
	   Testimonials widget
	   ========================================================================== */
	   if( $('.pm-testimonials-widget-quotes').length > 0 ){
		   
		    $('.pm-testimonials-widget-quotes').PMTestimonials({
				speed : 450,
				slideShow : true,
				slideShowSpeed : 6000,
				controlNav : false,
				arrows : true
			});
		   
	   }
		
	/* ==========================================================================
	   Homepage slider
	   ========================================================================== */
		if($('#pm-slider').length > 0){
						
			$('#pm-slider').PMSlider({
				speed : wordpressOptionsObject.slideSpeed, //get parameter fron wp
				easing : 'ease',
				loop : wordpressOptionsObject.slideLoop == 'true' ? true : false, //get parameter fron wp
				controlNav : wordpressOptionsObject.enableControlNav == 'true' ? true : false, //false = no bullets / true = bullets / 'thumbnails' activates thumbs //get parameter fron wp
				controlNavThumbs : true,
				animation : wordpressOptionsObject.animationType, //get parameter fron wp
				fullScreen : false,
				slideshow : wordpressOptionsObject.enableSlideShow == 'true' ? true : false, //get parameter fron wp
				slideshowSpeed : wordpressOptionsObject.slideShowSpeed, //get parameter fron wp
				pauseOnHover : wordpressOptionsObject.pauseOnHover == 'true' ? true : false, //get parameter fron wp
				arrows : wordpressOptionsObject.showArrows == 'true' ? true : false, //get parameter fron wp
				fixedHeight : wordpressOptionsObject.fixedHeight == 'true' ? true : false,
				fixedHeightValue : wordpressOptionsObject.sliderHeight,
				touch : true,
				progressBar : false
			});
			
		}
		
	/* ==========================================================================
	   Detect page scrolls on buttons
	   ========================================================================== */
		if( $('.pm-page-scroll').length > 0 ){
			
			$('.pm-page-scroll').click(function(e){
								
				e.preventDefault();
				var $this = $(e.target);
				var sectionID = $this.attr('href');
				
				
				$('html, body').animate({
					scrollTop: $(sectionID).offset().top - 80
				}, 1000);
				
			});
			
		}
		
	
		
	/* ==========================================================================
	   Datepicker
	   ========================================================================== */
	   if($("#datepicker").length > 0){
		   		   
		   $("#datepicker").datepicker( $.datepicker.regional[ ""+ wordpressOptionsObject.currentLocale + "" ] );
	   }
	   
	   //console.log('wordpressOptionsObject.currentLocale = ' + wordpressOptionsObject.currentLocale);
	   
	   
	/* ==========================================================================
	   Isotope activation
	   ========================================================================== */
		if($('#pm-isotope-item-container').length > 0){
			//initialize isotope
			$('#pm-isotope-item-container').isotope({
			  // options
			  itemSelector : '.pm-isotope-item',
			  layoutMode : 'fitRows',
			});	
		}
	   
	/* ==========================================================================
	   Isotope filter activation
	   ========================================================================== */
		$('.pm-isotope-filter-system').children().each(function(i,e) {
						
			if(i > 0){
				
				delay(e, 1);
				$(e).css({
					'visibility' : 'visible'	
				});
				//add click functionality
				$(e).find('a').click(function(e) {
					
					e.preventDefault();
					
					$('.pm-isotope-filter-system').children().find('a').removeClass('current');
					$(this).addClass('current');
					
					var id = $(this).attr('id');
					$('#pm-isotope-item-container').isotope({ filter: '.'+$(this).attr('id') });
					
				});
				
			}
						
			
		});
		
		var offset = 50;
		
		//must be declared at top level or immediately after a function call in "strict mode"
		function delay(element, opacity) {
			setTimeout(function(){
				$(element).animate({
					opacity: opacity, 
				}, 150);
			}, $(element).index() * offset)
		}	
		
	/* ==========================================================================
	   Isotope menu expander (mobile only)
	   ========================================================================== */
	   if($('.pm-isotope-filter-system-expand').length > 0){
		   
		   var totalHeight = 0;
		   
		   $('.pm-isotope-filter-system-expand').click(function(e) {
			   
			   var $this = $(this),
			   $parentUL = $this.parent('ul');
			   			   
			   //get the height of the total li elements
			   $parentUL.children('li').each(function(index, element) {
					totalHeight += $(this).height() + 5;
			   });
			   			   
			   if( !$parentUL.hasClass('expanded') ){
				   
				    //expand the menu
					$parentUL.addClass('expanded');
				   				  
				    $parentUL.css({
					  "height" : totalHeight	  
				    });
					
					$this.find('i').removeClass('fa-angle-down').addClass('fa-close');
				   
			   } else {
				
					//close the menu
					$parentUL.removeClass('expanded');
				   				  
				    $parentUL.css({
					  "height" : 94
				    });
					
					$this.find('i').removeClass('fa-close').addClass('fa-angle-down');
									   
			   }
			   
			   //reset totalheight
			   totalHeight = 0;
			   
		   });
		   
		   
		   $('.pm-isotope-filter-system').children().each(function(i,e) {
						
				if(i > 0){
					
					//add click functionality
					$(e).find('a').click(function(e) {
						
						e.preventDefault();
																	
						
											
						
						if( $(window).width() < 991 ){
							//Capture parent li index for list reordering
							var listItem = $(this).closest('li');
							var listItemIndex = $(this).closest('li').index();
							console.log( "Index: " +  listItemIndex );
							
							//$('.pm-isotope-filter-system').insertAfter(listItem, $('.pm-isotope-filter-system').find("li").index(0));
							
							$('.pm-isotope-filter-system').find("li").eq(0).after(listItem);
						}
											
					});
					
				}
							
				
			});
		   
		   
	   }//end of if
		
		
	/* ==========================================================================
	   Language Selector drop down
	   ========================================================================== */
		if($('.pm-dropdown.pm-language-selector-menu').length > 0){
			$('.pm-dropdown.pm-language-selector-menu').on('mouseover', methods.dropDownMenu).on('mouseleave', methods.dropDownMenu);
		}
		
	/* ==========================================================================
	   Filter system drop down
	   ========================================================================== */
		if($('.pm-dropdown.pm-filter-system').length > 0){
			$('.pm-dropdown.pm-filter-system').on('mouseover', methods.dropDownMenu).on('mouseleave', methods.dropDownMenu);
		}
		

		
	/* ==========================================================================
	   Main menu interaction
	   ========================================================================== */
		if( $('.pm-nav').length > 0 ){
						
			if( $(window).width() > 1200 ){
				
				//superfish activation
				$('.pm-nav').superfish({
					delay: 0,
					animation: {opacity:'show',height:'show'},
					speed: 300,
					dropShadows: false,
				});
			}
			
			
			$('.sf-sub-indicator').html('<i class="fa ' + wordpressOptionsObject.dropMenuIndicator + '"></i>');
			
			$('.sf-menu ul .sf-sub-indicator').html('<i class="fa ' + wordpressOptionsObject.dropMenuIndicator + '"></i>');
						
		};	
		
	/* ==========================================================================
	   Checkout expandable forms
	   ========================================================================== */
		if ($('#pm-returning-customer-form-trigger').length > 0){
			
			var $returningFormExpanded = false;
			
			$('#pm-returning-customer-form-trigger').on('click', function(e) {
				
				e.preventDefault();
				
				if( !$returningFormExpanded ) {
					$returningFormExpanded = true;
					$('#pm-returning-customer-form').fadeIn(700);
					
				} else {
					$returningFormExpanded = false;
					$('#pm-returning-customer-form').fadeOut(300);
				}
				
			});
			
		}
		
		if ($('#pm-promotional-code-form-trigger').length > 0){
			
			var $promotionFormExpanded = false;
			
			$('#pm-promotional-code-form-trigger').on('click', function(e) {
				
				e.preventDefault();
				
				if( !$promotionFormExpanded ) {
					$promotionFormExpanded = true;
					$('#pm-promotional-code-form').fadeIn(700);
					
				} else {
					$promotionFormExpanded = false;
					$('#pm-promotional-code-form').fadeOut(300);
				}
				
			});
			
		}

				
	/* ==========================================================================
	   isTouchDevice - return true if it is a touch device
	   ========================================================================== */
	
		function isTouchDevice() {
			return !!('ontouchstart' in window) || ( !! ('onmsgesturechange' in window) && !! window.navigator.maxTouchPoints);
		}
				
		
		//dont load parallax on mobile devices
		function runParallax() {
			
			//enforce check to make sure we are not on a mobile device
			if( !isMobile.any()){
							
				//stellar parallax
				$.stellar({
				  horizontalOffset: 0,
				  verticalOffset: 0,
				  horizontalScrolling: false,
				});
				
				$('.pm-parallax-panel').stellar();
								
			}
			
		}//end of function
		
	/* ==========================================================================
	   Checkout form - Account password activation
	   ========================================================================== */
	   
	   if( $('#pm-create-account-checkbox').length > 0){
			  			
			$('#pm-create-account-checkbox').change(function(e) {
				
				if( $('#pm-create-account-checkbox').is(':checked') ){
					
					$('#pm-checkout-password-field').fadeIn(500);
					
				} else {
					$('#pm-checkout-password-field').fadeOut(500);	
				}
				
			});
			   
	   }
	   
	/* ==========================================================================
	   Conact page google map interaction
	   ========================================================================== */
	   if( $(".pm-google-map-container").length > 0 ){
		   
		   $( '.pm-google-map-container' ).each(function(index, element) {
				
				var $this = $(element),
				container = $this.find('.pm-googleMap'),
				id = container.attr('id'),
				mapType = container.data('mapType'),
				zoom = container.data('mapZoom'),
				latitude = container.data('latitude'),
				longitude = container.data('longitude'),
				message = container.data('message');
																
				methods.initializeGoogleMap(id, latitude, longitude, zoom, mapType, message);
			
        	}); 			
			
			
	   }
	   
	   
	/* ==========================================================================
	   Google map reset for tabs
	   ========================================================================== */
		if( $('.pm-nav-tabs').length > 0){
			
			$('.pm-nav-tabs').children().find('a').click(function(e) {
				
				var targetId = $(this).attr('href');
				
				var targetMap = $(targetId).find('.googleMap');
				
				if(targetMap.length > 0){
					
					var id = targetMap.data('id'),
					mapType = targetMap.data('mapType'),
					zoom = targetMap.data('mapZoom'),
					latitude = targetMap.data('latitude'),
					longitude = targetMap.data('longitude'),
					message = targetMap.data('message');
					
					methods.initializeGoogleMap(id, latitude, longitude, zoom, mapType, message);
					
					$(this).on('shown.bs.tab', function(e){
						google.maps.event.trigger(activeMap, 'resize');
						activeMap.setCenter(latLong)
					});
					
				}
				
				//alert();
				
			});
			
		}
	   
	/* ==========================================================================
	   Accordion and Tabs
	   ========================================================================== */
	   
	    $('#accordion').collapse({
		  toggle: false
		})
	    $('#accordion2').collapse({
		  toggle: false
		})
	   
		if($('.panel-title').length > 0){
			
			var $prevItem = null;
			var $currItem = null;
			
			$('.pm-accordion-link').click(function(e) {
				
				var $this = $(this);
				
				if($prevItem == null){
					$prevItem = $this;
					$currItem = $this;
				} else {
					$prevItem = $currItem;
					$currItem = $this;
				}
				
				//reset Google map if found
				var targetId = $this.attr('href');
					
				var targetMap = $(targetId).find('div').find('.googleMap');
				
				if(targetMap.length > 0){
										
					var id = targetMap.data('id'),
					mapType = targetMap.data('mapType'),
					zoom = targetMap.data('mapZoom'),
					latitude = targetMap.data('latitude'),
					longitude = targetMap.data('longitude'),
					message = targetMap.data('message');
									
					methods.initializeGoogleMap(id, latitude, longitude, zoom, mapType, message);
					
					$(targetId).on('shown.bs.collapse', function(e){
						google.maps.event.trigger(activeMap, 'resize');
						activeMap.setCenter(latLong)
					});
					
				}		
				
				
				if( $currItem.attr('href') != $prevItem.attr('href') ) {
										
					//toggle previous item
					if( $prevItem.parent().find('i').hasClass('fa fa-minus') ){
						$prevItem.parent().find('i').removeClass('fa fa-minus').addClass('fa fa-plus');
					}
					
					$currItem.parent().find('i').removeClass('fa fa-plus').addClass('fa fa-minus');
					
				} else if($currItem.attr('href') == $prevItem.attr('href')) {
										
					//else toggle same item
					if( $currItem.parent().find('i').hasClass('fa fa-minus') ){
						$currItem.parent().find('i').removeClass('fa fa-minus').addClass('fa fa-plus');
					} else {
						$currItem.parent().find('i').removeClass('fa fa-plus').addClass('fa fa-minus');
					}
						
				} else {
					
					//console.log('toggle current item');
					$currItem.parent().find('i').removeClass('fa fa-plus').addClass('fa fa-minus');
					
				}
				
				
			});

			
		}
		
		//tab menu
		if($('.nav-tabs').length > 0){
			
			//actiavte first tab of tab menu
			$('.nav-tabs a:first').tab('show');
			$('.nav.nav-tabs li:first-child').addClass('active');
			$('.pm-tab-content div:first-child').addClass('active');
		}

		
	/* ==========================================================================
	   When the window is scrolled, do
	   ========================================================================== */
		$(window).scroll(function () {
			
			animateMilestones();
			animateProgressBars();
			animatePieCharts();
			
			//toggle fixed nav
			if(wordpressOptionsObject.stickyNav == 'on'){
				
				//apply sticky nav on desktop resolutions
				if( $(window).width() > 991 ){
				
					if ($(this).scrollTop() > 47) {
						
						$('header').addClass('fixed');
										
					} else {
						
						$('header').removeClass('fixed');
											
					}
				
				}
				
			}
						
		});


	
	/* ==========================================================================
	   Back to top button
	   ========================================================================== */
		$('#pm-back-to-top').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
		
	/* ==========================================================================
	   Accordion menu
	   ========================================================================== */
		if($('#accordionMenu').length > 0){
			$('#accordionMenu').collapse({
				toggle: false,
				parent: false,
			});
		}
		
		
	/* ==========================================================================
	   Tab menu
	   ========================================================================== */
		if($('.pm-nav-tabs').length > 0){
			//actiavte first tab of tab menu
			$('.pm-nav-tabs a:first').tab('show');
			$('.pm-nav-tabs li:first-child').addClass('active');
		}

	/* ==========================================================================
	   Parallax check
	   ========================================================================== */
		var $window = $(window);
		var $windowsize = 0;
		
		function checkWidth() {
			$windowsize = $window.width();
			if ($windowsize < 980) {
				//if the window is less than 980px, destroy parallax...
				$.stellar('destroy');
			} else {
				runParallax();	
			}
		}
		
		// Execute on load
		checkWidth();
		// Bind event listener
		$(window).resize(checkWidth);

		
	/* ==========================================================================
	   Window resize call
	   ========================================================================== */
		$(window).resize(function(e) {
			methods.windowResize();
		});

		
	/* ==========================================================================
	   Search button
	   ========================================================================== */
		if( $('#pm-search-btn').length > 0 ){
						
			var $searchBtn = $('#pm-search-btn');
			
			$searchBtn.click(function(e) {
				
				//Close any exisiting expandable menus first
				methods.hideHours();
				methods.hideAddress();
				methods.hideSearch();
				
				//CALL METHODS FUNCTION
				methods.displaySearch();
								
				$('#pm-search-exit').click(function(e) {
					e.preventDefault();
					methods.hideSearch();
				});
											
				e.preventDefault();
			
			});
			
		}
		
	/* ==========================================================================
	   Address button
	   ========================================================================== */
		if( $('#pm-location-btn').length > 0 ){
						
			var $locationBtn = $('#pm-location-btn');
			
			$locationBtn.click(function(e) {
				
				//Close any exisiting expandable menus first
				methods.hideHours();
				methods.hideAddress();
				methods.hideSearch();
				
				//CALL METHODS FUNCTION
				methods.displayAddress();
								
				$('#pm-address-exit').click(function(e) {
					e.preventDefault();
					methods.hideAddress();
				});
											
				e.preventDefault();
			
			});
			
		}
		
	/* ==========================================================================
	   Hours button
	   ========================================================================== */
		if( $('#pm-hours-btn').length > 0 ){
						
			var $hoursBtn = $('#pm-hours-btn');
			
			$hoursBtn.click(function(e) {
				
				//Close any exisiting expandable menus first
				methods.hideHours();
				methods.hideAddress();
				methods.hideSearch();
				
				//CALL METHODS FUNCTION
				methods.displayHours();
								
				$('#pm-hours-exit').click(function(e) {
					e.preventDefault();
					methods.hideHours();
				});
											
				e.preventDefault();
			
			});
			
		}
		
	/* ==========================================================================
	   Tooltips
	   ========================================================================== */
		if( $('.pm_tip').length > 0 ){
			$('.pm_tip').PMToolTip();
		}
		if( $('.pm_tip_static_bottom').length > 0 ){
			$('.pm_tip_static_bottom').PMToolTip({
				floatType : 'staticBottom'
			});
		}
		if( $('.pm_tip_static_top').length > 0 ){
			$('.pm_tip_static_top').PMToolTip({
				floatType : 'staticTop'
			});
		}
		
	/* ==========================================================================
	   TinyNav
	   ========================================================================== */
		$("#pm-footer-nav").tinyNav();
		
			
	}); //end of document ready

	
	/* ==========================================================================
	   Options
	   ========================================================================== */
		var options = {
			dropDownSpeed : 100,
			slideUpSpeed : 200,
			slideDownTabSpeed: 50,
			changeTabSpeed: 200,
		}
	
	/* ==========================================================================
	   Methods
	   ========================================================================== */
		var methods = {
	
			displaySearch : function(e) {
							
				var searchContainer = $("#pm-search-container");
				
				searchContainer.css({
					'height' : 50,
					'paddingTop' : 10,
					'borderBottom' : '1px solid #333' 
				});
				
			},
			
			hideSearch : function(e) {
				
				var searchContainer = $("#pm-search-container");
				
				searchContainer.css({
					'height' : 0,
					'paddingTop' : 0,
					'borderBottom' : '0px solid #333' 
				});
				
			},
			
			displayAddress : function(e) {
							
				var addressContainer = $("#pm-address-container"),
				container = addressContainer.find('.container'),
				gMap = addressContainer.find('.pm-google-map-box');
				
				if(gMap.length > 0){
					
					//Google map detected
					addressContainer.css({
					'height' : container.height() + 240,
					'borderBottom' : '1px solid #333' 
				});
					
				} else {
					
					//No map detected
					addressContainer.css({
						'height' : container.height() + 40,
						'borderBottom' : '1px solid #333' 
					});
					
				}
				
				
				
			},
			
			hideAddress : function(e) {
				
				var addressContainer = $("#pm-address-container");
				
				addressContainer.css({
					'height' : 0,
					'borderBottom' : '0px solid #333' 
				});
				
			},
			
			displayHours : function(e) {
							
				var hoursContainer = $("#pm-hours-container");
				
				var container = hoursContainer.find('.container');
				
				
				hoursContainer.css({
					'height' : container.height() + 30,
					'padding' : '15px 0',
					'borderBottom' : '1px solid #333' 
				});
				
			},
			
			hideHours : function(e) {
				
				var hoursContainer = $("#pm-hours-container");
				
				hoursContainer.css({
					'height' : 0,
					'padding' : '0',
					'borderBottom' : '0px solid #333' 
				});
				
			},

			
			dropDownMenu : function(e){  
					
				var body = $(this).find('> :last-child');
				var head = $(this).find('> :first-child');
				
				if (e.type == 'mouseover'){
					body.fadeIn(options.dropDownSpeed);
				} else {
					body.fadeOut(options.dropDownSpeed);
				}
				
			},
			
			loadPrettyPhoto : function() {
								
				if( $("a[data-rel^='prettyPhoto']").length > 0 ){
							
					$("a[data-rel^='prettyPhoto']").prettyPhoto({
						animation_speed: wordpressOptionsObject.ppAnimationSpeed.toString(), /* fast/slow/normal */
						slideshow: wordpressOptionsObject.ppSlideShowSpeed, /* false OR interval time in ms */
						autoplay_slideshow: wordpressOptionsObject.ppAutoPlay == 'false' ? false : true, /* true/false */
						opacity: 0.80, /* Value between 0 and 1 */
						show_title: wordpressOptionsObject.ppShowTitle == 'false' ? false : true, /* true/false */
						//allow_resize: true, /* Resize the photos bigger than viewport. true/false */
						//default_width: 640,
						//default_height: 480,
						counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
						theme: wordpressOptionsObject.ppColorTheme.toString(), /* light_rounded / dark_rounded / light_square / dark_square / facebook */
						horizontal_padding: 20, /* The padding on each side of the picture */
						hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
						wmode: 'opaque', /* Set the flash wmode attribute */
						autoplay: true, /* Automatically start videos: True/False */
						modal: false, /* If set to true, only the close button will close the window */
						deeplinking: true, /* Allow prettyPhoto to update the url to enable deeplinking. */
						overlay_gallery: true, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
						keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
						changepicturecallback: function(){}, /* Called everytime an item is shown/changed */
						
					});
					
				}	
				
			},
			
			initializeGalleryLike : function() {
				
								
				if($('.pm-like-this-btn').length > 0){
			
					$('.pm-like-this-btn').each(function(index, element) {
						
						var $this = $(element);
										
						$this.click(function(e) {
							
							var postID = $this.attr('id'),
							targetSpan = $('#pm-post-total-likes-count-'+postID+'');
							//alert(postID);
							cookieName = 'post_' + postID;
							//alert(cookieName);
							
							//check for cookie else increase like value and set cookie for 1 year
							var checkCookie = methods.checkCookie();
							if(!checkCookie){
								
								//set the cookie
								methods.setCookie(cookieName, postID, 365);
								
								//save the post value
								var getLikes = targetSpan.html();
								var intLikes = Number(getLikes);
								var totalLikes = intLikes + 1;
												
								//update span
								targetSpan.html(totalLikes);
								
								//console.log('about to call post');
								
								//send ajax request to WordPress to store new value
								$.post(pulsarajax.ajaxurl, {action:'pm_ln_like_feature', nonce:pulsarajax.nonce, postID:postID, likes:totalLikes}, function(data){},'json');
								
							}	
							
							e.preventDefault();
							
						});
						
					});
					
				}
				
			},
			
			setCookie : function(cname, cvalue, exdays) {
							
				var d = new Date();
				d.setTime(d.getTime() + (exdays*24*60*60*1000));
				var expires = "expires="+d.toUTCString();
				document.cookie = cname + "=" + cvalue + "; " + expires;
				
			},
			
			
			getCookie : function(cname) {
				var name = cname + "=";
				var ca = document.cookie.split(';');
				for(var i=0; i<ca.length; i++) {
					var c = ca[i];
					while (c.charAt(0)==' ') c = c.substring(1);
					if (c.indexOf(name) != -1) return c.substring(name.length, c.length);
				}
				return "";
			},
			
			
			checkCookie : function() {
		
				var post = methods.getCookie(cookieName)
				
				if (post != "") {
					//cookies exists
					return true;
				} else {
					//else set the cookie
					return false;
				}
			},
			
			initializeGalleryContainer : function() {
				
				if( $(".pm-gallery-post-container").length > 0 ){
			
					$(".pm-gallery-post-container").each(function(index, element) {
						
						var $this = $(element),
						expandBtn = $this.find('.pm-expand-gallery-post'),
						title = $this.find('.pm-gallery-post-title-container'),
						likeShadow = $this.find('.pm-gallery-post-like-diamond-shadow'),
						likeDiamond = $this.find('.pm-gallery-post-like-diamond'),
						likeBtn = $this.find('.pm-gallery-post-like-btn'),
						likeCounter = $this.find('.pm-gallery-post-like-counter'),
						details = $this.find('.pm-gallery-post-details'),
						closeBtn = $this.find('.pm-gallery-post-close');
						
						expandBtn.click(function(e) {
							
							e.preventDefault();
												
							title.css({
								'left' : -300	
							});
							
							likeShadow.css({
								'opacity' : 0
							});
							
							likeDiamond.css({
								'opacity' : 0
							});
							
							likeBtn.css({
								'opacity' : 0
							});
							
							likeCounter.css({
								'opacity' : 0
							});
							
							details.css({
								'opacity' : 1
							});
							
						});
						
						closeBtn.click(function(e) {
													
							e.preventDefault();
						
							title.css({
								'left' : 0	
							});
							
							likeShadow.css({
								'opacity' : 1
							});
							
							likeDiamond.css({
								'opacity' : 1
							});
							
							likeBtn.css({
								'opacity' : 1
							});
							
							likeCounter.css({
								'opacity' : 1
							});
							
							details.css({
								'opacity' : 0
							});
							
						});				
						
					});
					
			   }
				
			},
			
			initializeSchedulePosts : function() {
				
				if( $(".pm-schedule-post-container").length > 0 ){
			
					$(".pm-schedule-post-container").each(function(index, element) {
						
						 var $this = $(element),
						 expandBtn = $this.find('.pm-schedule-post-expand-btn'),
						 info = $this.find('.pm-schedule-post-info'),
						 excerpt = $this.find('.excerpt'),
						 viewBtn = $this.find('.schedule-btn'),
						 isActive = false;
						 
						 expandBtn.click(function(e) {
							 
							 e.preventDefault();
							 
							 if(!isActive){
								 
								 isActive = true;
								 
								 expandBtn.removeClass('fa fa-chevron-up').addClass('fa fa-close');
								 
								 info.css({
									'top' : 0	 
								 });
								 
								 excerpt.css({
									'opacity' : 1	 
								 });
								 
								 viewBtn.css({
									'opacity' : 1	 
								 });
								 
							 } else {
								 
								 isActive = false;
								 
								 expandBtn.removeClass('fa fa-close').addClass('fa fa-chevron-up');
								 
								 info.css({
									'top' : 160	 
								 });
								 
								 excerpt.css({
									'opacity' : 0	 
								 });
								 
								 viewBtn.css({
									'opacity' : 0	 
								 });
								 
							 }
							 
							 
						 });
						
					});
					   
			   }
				
			},
			
			
			initializeStaffPosts : function() {
				
				if( $(".pm-staff-profile-item-container").length > 0 ){
			  
					$(".pm-staff-profile-item-container").each(function(index, element) {
						
						var $this = $(element);
						
						var profileBtn = $this.find('.pm-staff-profile-item-details-btn'),
						profileDetails = $this.find('.pm-staff-profile-item-details'),
						excerpt = $this.find('.pm-staff-profile-item-excerpt'),
						divider = $this.find('.pm-staff-profile-item-details-divider'),
						viewProfile = $this.find('.pm-staff-profile-item-view-profile'),
						isActive = false;
						
						profileBtn.click(function(e) {
							
							e.preventDefault();
							
							if(!isActive){
								
								isActive = true;
								
								profileDetails.css({
									'top' : 0	
								});
								
								excerpt.css({
									'opacity' : 1	
								});
								
								divider.css({
									'opacity' : 1,
									'width' : 100
								});
								
								viewProfile.css({
									'opacity' : 1,
								});
								
								profileBtn.removeClass('fa fa-chevron-up').addClass('fa fa-chevron-down');
								
							} else {
								
								isActive = false;
								
								profileDetails.css({
									'top' : 260	
								});
								
								excerpt.css({
									'opacity' : 0	
								});
								
								divider.css({
									'opacity' : 0,
									'width' : 0
								});
								
								viewProfile.css({
									'opacity' : 0,
								});
								
								profileBtn.removeClass('fa fa-chevron-down').addClass('fa fa-chevron-up');
									
							}
							
							
						});
						
					});
					   
			   }
				
			},
			
			initializeGoogleMap : function(id, latitude, longitude, mapZoom, mapType, message) {
				
				  var myLatlng = new google.maps.LatLng(latitude,longitude);
				  latLong = myLatlng;
				  var myOptions = {
					center: myLatlng, 
					zoom: 13,
					mapTypeId: google.maps.MapTypeId.mapType
				  };
				  
				  //alert(document.getElementById(id).getAttribute('id'));
				  
				  //clear the html div first
				  document.getElementById(id).innerHTML = "";
				  
				  var map = new google.maps.Map(document.getElementById(id), myOptions);
				  
				  
		 
				  var contentString = message;
				  var infowindow = new google.maps.InfoWindow({
					  content: contentString
				  });
				   
				  var marker = new google.maps.Marker({
					  position: myLatlng
				  });
				   
				  google.maps.event.addListener(marker, "click", function() {
					  infowindow.open(map,marker);
				  });
				   
				  marker.setMap(map);
				  
				  activeMap = map;
				
			},
						
					
			windowResize : function() {
				//resize calls
			},
			
		};
		
	
	
})(jQuery);