<?php $pageHeaderMessage = get_post_meta(get_the_ID(), 'pm_header_message_meta', true);  ?>

<!-- Header Message -->
<?php if( function_exists('is_shop') ) {//Woocommerce enabled ?>

	<?php if( is_search() && is_shop() ) { ?>

			<p class="pm-sub-header-message">"<?php echo get_search_query(); ?>"</p>

	<?php } else if( is_shop() ) { ?>
	
			<?php 
				global $woocommerce;
				$pageid = get_option('woocommerce_shop_page_id');
				$pm_header_message_meta = get_post_meta($pageid, 'pm_header_message_meta', true); 
				//$pm_woocom_header_message_meta = get_post_meta(get_the_ID(), 'pm_woocom_header_message_meta', true); 
			?>
			
			 <p class="pm-sub-header-message"><?php echo esc_attr($pm_header_message_meta); ?></p>
			
	<?php } else if( is_product() ) { ?>
	
			<?php 
				$pm_woocom_header_message_meta = get_post_meta(get_the_id(), 'pm_woocom_header_message_meta', true); 
				//$pm_woocom_header_message_meta = get_post_meta(get_the_ID(), 'pm_woocom_header_message_meta', true); 
			?>
			
			 <p class="pm-sub-header-message"><?php echo esc_attr($pm_woocom_header_message_meta); ?></p>
			
	<?php } else if(  is_product_category() || is_product_tag()  ) { ?>      
		   
			 <p class="pm-sub-header-message">"<?php woocommerce_page_title(); ?>"</p>
					 
	<?php } else if(is_single()) { ?>
	
		<?php get_template_part('content', 'postnavigation'); ?>
	
	<?php } else if( is_404() ) { ?>
	
			 <p class="pm-sub-header-message"><?php esc_attr_e('Page not found', 'energytheme'); ?></p>
								
	<?php } else if( is_search() ) { ?>
	
			 <p class="pm-sub-header-message">"<?php echo get_search_query(); ?>"</p>
			
	<?php } else if(is_tag()) { ?>
	
			 <p class="pm-sub-header-message">"<?php echo get_query_var('tag'); ?>"</p>
			
	<?php } else if(is_category()) { ?>
	
			 <p class="pm-sub-header-message">"<?php $cat = get_category( get_query_var( 'cat' ) ); echo $cat->name; ?>"</p>
			
	<?php } else if( is_archive() ) { ?>
	
			<p class="pm-sub-header-message">
			<?php 
			
				if (is_day()) {
					the_time('F jS, Y');
				}
				elseif (is_month()) {
					the_time('F, Y');
				}
				elseif (is_year()) {
					the_time('Y');
				}
				elseif (is_author()) {
					echo"<li>Author Archive"; echo'</li>';
				}
			
			?>
			</p>
								
	
	<?php } else { ?>
	
		<?php if($pageHeaderMessage !== ''){ ?>
	
			  <p class="pm-sub-header-message"><?php echo esc_attr($pageHeaderMessage); ?></p>
		
		<?php } ?>
	
	<?php } ?>


<?php } else {//No woocommerce installed ?>

						 
	<?php if(is_single()) { ?>
	
		<?php get_template_part('content', 'postnavigation'); ?>
	
	<?php } else if( is_404() ) { ?>
	
			  <p class="pm-sub-header-message"><?php esc_attr_e('Page not found', 'energytheme'); ?></p>
								
	<?php } else if( is_search() ) { ?>
	
			  <p>"<?php echo get_search_query(); ?>"</p>
			
	<?php } else if(is_tag()) { ?>
	
			  <p class="pm-sub-header-message">"<?php echo get_query_var('tag'); ?>"</p>
			
	<?php } else if(is_category()) { ?>
	
			  <p class="pm-sub-header-message">"<?php $cat = get_category( get_query_var( 'cat' ) ); echo $cat->name; ?>"</p>
			
	<?php } else if( is_archive() ) { ?>
	
			<p class="pm-sub-header-message">
			<?php 
			
				if (is_day()) {
					the_time('F jS, Y');
				}
				elseif (is_month()) {
					the_time('F, Y');
				}
				elseif (is_year()) {
					the_time('Y');
				}
				elseif (is_author()) {
					echo"<li>Author Archive"; echo'</li>';
				}
			
			?>
			</div>
								
	
	<?php } else { ?>
	
		<?php if($pageHeaderMessage !== ''){ ?>
	
			   <p class="pm-sub-header-message"><?php echo esc_attr($pageHeaderMessage); ?></p>
		
		<?php } ?>
	
	<?php } ?>

<?php }  ?>