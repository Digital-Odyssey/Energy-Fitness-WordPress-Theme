<?php $enableBreadCrumbs = get_theme_mod('enableBreadCrumbs', 'on'); ?>

<!-- Breadcrumbs -->
<?php if( function_exists('is_shop') ) {//Woocommerce enabled ?>

	<?php if( is_shop() || is_product() || is_product_category() || is_product_tag()  ) { ?>
	
		<?php if($enableBreadCrumbs === 'on') : ?>
        
            <div class="pm-sub-header-breadcrumbs">
                    
                <div class="pm-sub-header-breadcrumb-bg"></div>
                
                <div class="pm-sub-header-breadcrumb-list-container">
                    <ul class="pm-sub-header-breadcrumb-list">
                        <li><a href="<?php echo site_url(); ?>"><?php esc_attr_e('Home', 'energytheme') ?></a> &nbsp; <i class="fa fa-angle-right"></i></li>
                        <li><?php woocommerce_page_title(); ?></li>
                    </ul>
                </div>
            
            </div><!-- /.pm-sub-header-breadcrumbs -->
        
        <?php endif; ?>
		
	<?php } else { ?>
	
		<?php if( !is_tax('gallerycats') && !is_tax('gallerytags') ) : ?>
			
			<?php if($enableBreadCrumbs === 'on'){ ?>
                    
                    <div class="pm-sub-header-breadcrumbs">
                
                        <div class="pm-sub-header-breadcrumb-bg"></div>
                        
                        <div class="pm-sub-header-breadcrumb-list-container">
                            <ul class="pm-sub-header-breadcrumb-list">
                            
                                <li><a href="<?php echo site_url(); ?>"><?php esc_attr_e('Home', 'energytheme') ?></a> &nbsp; <i class="fa fa-angle-right"></i></li>
                                
                                <?php if(is_category()) { ?>
                                
                                	<li><?php $cat = get_category( get_query_var( 'cat' ) ); echo $cat->name; ?></li>
                                    
                                <?php } elseif(is_single()) { ?>
                                
                                	<li><?php $the_title = get_the_title(); echo pm_ln_string_limit_words($the_title, 2) ?>...</li>
                                    
                                <?php } elseif(is_tag()) { ?>
                                
                                	<li><?php echo get_query_var('tag'); ?></li>
                                    
                                <?php } elseif(is_404()) { ?>
                            
                                	<li><?php esc_attr_e('404 Error', 'energytheme'); ?></li>
                                    
                                <?php } elseif(is_search()) { ?>
                            
                                	<li>"<?php echo get_search_query(); ?>"</li>
                                    
                                <?php } else { ?>
                                
                                    <li><?php $the_title = get_the_title(); echo pm_ln_string_limit_words($the_title, 2) ?></li>
                                
								<?php } ?>
                                
                                
                            </ul>
                        </div>
                        
                       <?php if(is_single()) : ?>
                       <ul class="pm-single-post-navigation">
                            <li title="Previous Post" class="pm_tip_static_top"><?php previous_post_link('%link', '<i class="fa fa-chevron-left"></i>'); ?></li> 
                        	<li title="Next Post" class="pm_tip_static_top"><?php next_post_link('%link', '<i class="fa fa-chevron-right"></i>'); ?></li>
                       </ul>
                       <?php endif; ?>
                    
                    </div><!-- /.pm-sub-header-breadcrumbs -->
                    
			<?php } ?>
		
		<?php endif ?>    
	
	<?php } ?>	

<?php } else {//Woocommerce not enabled ?>

	<?php if( !is_tax('gallerycats') && !is_tax('gallerytags') ) : ?>
		
		<?php if($enableBreadCrumbs === 'on'){ ?>
				
                <div class="pm-sub-header-breadcrumbs">
                
                    <div class="pm-sub-header-breadcrumb-bg"></div>
                    
                    <div class="pm-sub-header-breadcrumb-list-container">
                        <ul class="pm-sub-header-breadcrumb-list">
                            <li><a href="<?php echo site_url(); ?>"><?php esc_attr_e('Home', 'energytheme') ?></a> &nbsp; <i class="fa fa-angle-right"></i></li>
                            
                            <?php if(is_category()) { ?>
                                
                                <li><?php $cat = get_category( get_query_var( 'cat' ) ); echo $cat->name; ?></li>
                                
                            <?php } elseif(is_single()) { ?>
                            
                                <li><?php $the_title = get_the_title(); echo pm_ln_string_limit_words($the_title, 2) ?>...</li>
                                
                            <?php } elseif(is_tag()) { ?>
                            
                                <li><?php echo get_query_var('tag'); ?></li>
                                
                            <?php } elseif(is_404()) { ?>
                            
                                <li><?php esc_attr_e('404 Error', 'energytheme'); ?></li>
                                
                            <?php } elseif(is_search()) { ?>
                            
                                	<li>"<?php echo get_search_query(); ?>"</li>
                                
                            <?php } else { ?>
                            
                                <li><?php $the_title = get_the_title(); echo pm_ln_string_limit_words($the_title, 2) ?></li>
                            
							<?php } ?>
                            
                        </ul>
                    </div>
                    
                    <?php if(is_single() && 'post_schedules' !== get_post_type()) : ?>
                    <ul class="pm-single-post-navigation">
                    
                    	<li title="Previous Post" class="pm_tip_static_top"><?php previous_post_link('%link', '<i class="fa fa-chevron-left"></i>'); ?></li> 
                        <li title="Next Post" class="pm_tip_static_top"><?php next_post_link('%link', '<i class="fa fa-chevron-right"></i>'); ?></li>
                        
                    </ul>
                    <?php endif; ?>
                
                </div><!-- /.pm-sub-header-breadcrumbs -->
                
		<?php } ?>
	
	<?php endif ?>  

<?php } ?>