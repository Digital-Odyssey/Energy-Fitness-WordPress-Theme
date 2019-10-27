<!-- SUBHEADER AREA -->

<?php 
		
	//Sub-header options
	//$enableParallax = get_theme_mod('enableParallax', 'on');
	$globalHeaderImage = get_theme_mod('globalHeaderImage');
	$globalHeaderImage2 = get_theme_mod('globalHeaderImage2');
	//$enableGlobalImage = get_theme_mod('enableGlobalImage', 'on');

?>
        
<!-- Subpage Header layouts -->
<?php if( function_exists( 'is_shop' ) ) {//woocommerce installed ?>

        <?php if( is_shop() ) { //Load Woocommerce shop header ?>
        
                <?php 
                    global $woocommerce;
                    $pageid = get_option('woocommerce_shop_page_id');
                    $pm_woocom_header_image_meta = get_post_meta($pageid, 'pm_header_image_meta', true); 
                ?>
                
                <?php if($pm_woocom_header_image_meta !== '') { ?>
            
                    <div class="pm-sub-header-container" style="background-image:url('<?php echo esc_html($pm_woocom_header_image_meta); ?>')">
                
                <?php } else { ?>
                
                    <div class="pm-sub-header-container">
                
                <?php } ?>
                
        <?php } elseif( is_product() ) {//Load Woocommerce product header ?>
        
                <?php 
                    global $woocommerce;
                    $pm_woocom_header_image_meta = get_post_meta(get_the_ID(), 'pm_woocom_header_image_meta', true); 
                ?>
                
                <?php if($pm_woocom_header_image_meta !== '') { ?>
            
                    	<div class="pm-sub-header-container" style="background-image:url('<?php echo esc_html($pm_woocom_header_image_meta); ?>')">
                
                <?php } else { ?>
                
                        <div class="pm-sub-header-container">
                
                <?php } ?>
        
        <?php } elseif( is_product_category() || is_product_tag() ) {//Load Woocommerce archive header ?>
        
                <?php 
                    $wooCategoryHeaderImage = get_theme_mod('wooCategoryHeaderImage'); 
                ?>
                
                <?php if($wooCategoryHeaderImage !== '') { ?>
            
                    	<div class="pm-sub-header-container" style="background-image:url('<?php echo esc_html($wooCategoryHeaderImage); ?>')">
                
                <?php } else { ?>
                
                        <div class="pm-sub-header-container">
                
                <?php } ?>
        
        <?php } elseif( is_404() || is_search() || is_tag() || is_category() || is_archive() ) { ?>
        
                <?php if($globalHeaderImage2 !== '') { ?>
            
                    	<div class="pm-sub-header-container" style="background-image:url('<?php echo esc_html($globalHeaderImage2); ?>')">
                
                <?php } else { ?>
                
                        <div class="pm-sub-header-container">
                
                <?php } ?>
            
        <?php } else { ?>
        
                <?php
                    $pageHeaderImage = get_post_meta(get_the_ID(), 'pm_header_image_meta', true); 
					//echo get_the_ID() . 'asdfsadfsdf = ' . $pageHeaderImage;
                ?>
        
                <?php if($pageHeaderImage !== '') { ?>
            
                        <div class="pm-sub-header-container" style="background-image:url('<?php echo esc_html($pageHeaderImage); ?>')">
                    
                <?php } elseif($globalHeaderImage !== '') { ?>
                
                		<div class="pm-sub-header-container" style="background-image:url('<?php echo esc_html($globalHeaderImage); ?>')">
				
				<?php } else { ?>
                
                        <div class="pm-sub-header-container">
                
                <?php } ?>
        
        <?php } ?>

<?php } else {//woocommerce not installed ?>

        <?php if( is_404() || is_search() || is_tag() || is_category() || is_archive() ) {//Display Global header image on these pages ?>
        
            <?php if($globalHeaderImage2 !== '') { ?>
            
                    <div class="pm-sub-header-container" style="background-image:url('<?php echo esc_html($globalHeaderImage2); ?>')">
            
            <?php } else { ?>
            
                    <div class="pm-sub-header-container">
            
            <?php } ?>
        
        <?php } else {//Display Page header on pages ?>
        
                <?php
                    $pageHeaderImage = get_post_meta(get_the_ID(), 'pm_header_image_meta', true); 
                ?>
        
                <?php if($pageHeaderImage !== '') { ?>
            
                        <div class="pm-sub-header-container" style="background-image:url('<?php echo esc_html($pageHeaderImage); ?>')">
                    
                <?php } elseif($globalHeaderImage !== '') { ?>
                
                		<div class="pm-sub-header-container" style="background-image:url('<?php echo esc_html($globalHeaderImage); ?>')">
				
				<?php } else { ?>
                
                        <div class="pm-sub-header-container">
                
                <?php } ?>
        
        <?php } ?>

<?php } ?>
 
    
    <!-- Header Page Title --> 
    <?php if( function_exists('is_shop') ) {//Woocommerce enabled ?>
    
            <?php if( is_search() && is_shop() ) { ?>
                    
                    <div class="pm-sub-header-title-container">
                        
                        <div class="pm-sub-header-title-bg">
                
                            <p class="pm-sub-header-title"><?php esc_attr_e('Search Results for:', 'energytheme'); ?></p>
                            <?php get_template_part('content', 'subheadermessage'); ?>
                        
                        </div><!-- /.pm-sub-header-title-bg -->
                        
                        <?php get_template_part('content', 'subheaderbreadcrumbs'); ?>
                        
                    </div>
                    
            
            <?php } else if( is_shop() ) { ?>
                     
                    <div class="pm-sub-header-title-container">
                        
                        <div class="pm-sub-header-title-bg">
                
                            <p class="pm-sub-header-title"><?php woocommerce_page_title(); ?></p>
                            <?php get_template_part('content', 'subheadermessage'); ?>
                        
                        </div><!-- /.pm-sub-header-title-bg -->
                        
                        <?php get_template_part('content', 'subheaderbreadcrumbs'); ?>
                        
                    </div>
                    
            <?php } else if( is_product() ) { ?>
                     
                    <div class="pm-sub-header-title-container">
                        
                        <div class="pm-sub-header-title-bg">
                
                            <p class="pm-sub-header-title"><?php the_title(); ?></p>
                            <?php get_template_part('content', 'subheadermessage'); ?>
                        
                        </div><!-- /.pm-sub-header-title-bg -->
                        
                        <?php get_template_part('content', 'subheaderbreadcrumbs'); ?>
                        
                    </div>
            
            <?php } else if( is_404() ) { ?>
                                
                    <div class="pm-sub-header-title-container">
                        
                        <div class="pm-sub-header-title-bg">
                
                            <p class="pm-sub-header-title"><?php esc_attr_e('404 Error', 'energytheme'); ?></p>
                        
                        </div><!-- /.pm-sub-header-title-bg -->
                        
                        <?php get_template_part('content', 'subheaderbreadcrumbs'); ?>
                        
                    </div>
            
            <?php } else if( is_search() ) { ?>
                                
                    <div class="pm-sub-header-title-container">
                        
                        <div class="pm-sub-header-title-bg">
                
                            <p class="pm-sub-header-title"><?php esc_attr_e('Search Results for:', 'energytheme'); ?></p>
                            <?php get_template_part('content', 'subheadermessage'); ?>
                        
                        </div><!-- /.pm-sub-header-title-bg -->
                        
                        <?php get_template_part('content', 'subheaderbreadcrumbs'); ?>
                        
                    </div>
                    
            <?php } else if(is_tag()) { ?>
                                
                    <div class="pm-sub-header-title-container">
                        
                        <div class="pm-sub-header-title-bg">
                
                            <p class="pm-sub-header-title"><?php esc_attr_e('News tagged with:', 'energytheme'); ?></p>
                            <?php get_template_part('content', 'subheadermessage'); ?>
                        
                        </div><!-- /.pm-sub-header-title-bg -->
                        
                        <?php get_template_part('content', 'subheaderbreadcrumbs'); ?>
                        
                    </div>
                    
            <?php } else if(is_category()) { ?>
                                
                    <div class="pm-sub-header-title-container">
                        
                        <div class="pm-sub-header-title-bg">
                
                            <p class="pm-sub-header-title"><?php esc_attr_e('News filed in:', 'energytheme'); ?></p>
                            <?php get_template_part('content', 'subheadermessage'); ?>
                        
                        </div><!-- /.pm-sub-header-title-bg -->
                        
                        <?php get_template_part('content', 'subheaderbreadcrumbs'); ?>
                        
                    </div>
                    
            <?php } else if(is_tax('gallerycats') ) { ?>
                                
                    <div class="pm-sub-header-title-container">
                        
                        <div class="pm-sub-header-title-bg">
                
                            <p class="pm-sub-header-title"><?php single_tag_title("Gallery posts filed in &quot;"); echo '&quot; '; ?></p>
                            <?php get_template_part('content', 'subheadermessage'); ?>
                        
                        </div><!-- /.pm-sub-header-title-bg -->
                        
                        <?php get_template_part('content', 'subheaderbreadcrumbs'); ?>
                        
                    </div>
                    
            <?php } else if(is_tax('gallerytags') ) { ?>
                                
                    <div class="pm-sub-header-title-container">
                        
                        <div class="pm-sub-header-title-bg">
                
                            <p class="pm-sub-header-title"><?php single_tag_title("Gallery posts tagged in &quot;"); echo '&quot; '; ?></p>
                            <?php get_template_part('content', 'subheadermessage'); ?>
                        
                        </div><!-- /.pm-sub-header-title-bg -->
                        
                        <?php get_template_part('content', 'subheaderbreadcrumbs'); ?>
                        
                    </div>
                    
            <?php } else if( is_archive() ) { ?>
                                
                    <div class="pm-sub-header-title-container">
                        
                        <div class="pm-sub-header-title-bg">
                
                            <p class="pm-sub-header-title"><?php esc_attr_e('Archive for', 'energytheme'); ?></p>
                            <?php get_template_part('content', 'subheadermessage'); ?>
                        
                        </div><!-- /.pm-sub-header-title-bg -->
                        
                        <?php get_template_part('content', 'subheaderbreadcrumbs'); ?>
                        
                    </div>
                        
            <?php } else if( is_single() ) { ?>
                                
                    <div class="pm-sub-header-title-container">
                        
                        <div class="pm-sub-header-title-bg post-title">
                
                            <p class="pm-sub-header-title post-title"><?php the_title(); ?></p>
                        
                        </div><!-- /.pm-sub-header-title-bg -->
                        
                        <?php get_template_part('content', 'subheaderbreadcrumbs'); ?>
                        
                    </div>
            
            <?php } else { ?>
            
                    <div class="pm-sub-header-title-container">
                        
                        <div class="pm-sub-header-title-bg">
                
                            <p class="pm-sub-header-title"><?php the_title(); ?></p>
                            <?php get_template_part('content', 'subheadermessage'); ?>
                        
                        </div><!-- /.pm-sub-header-title-bg -->
                        
                        <?php get_template_part('content', 'subheaderbreadcrumbs'); ?>
                        
                    </div>
            
            <?php } ?>
    
    <?php } else {//Woocommerce not enabled ?>

        
        <?php if( is_404() ) { ?>
                        
                <div class="pm-sub-header-title-container">
                        
                    <div class="pm-sub-header-title-bg">
            
                        <p class="pm-sub-header-title"><?php esc_attr_e('404 Error', 'energytheme'); ?></p>
                    
                    </div><!-- /.pm-sub-header-title-bg -->
                    
                    <?php get_template_part('content', 'subheaderbreadcrumbs'); ?>
                    
                </div>
        
        <?php } else if( is_search() ) { ?>
                
                <div class="pm-sub-header-title-container">
                        
                    <div class="pm-sub-header-title-bg">
            
                        <p class="pm-sub-header-title"><?php esc_attr_e('Search Results for:', 'energytheme'); ?></p>
                        <?php get_template_part('content', 'subheadermessage'); ?>
                    
                    </div><!-- /.pm-sub-header-title-bg -->
                    
                    <?php get_template_part('content', 'subheaderbreadcrumbs'); ?>
                    
                </div>
            
        <?php } else if(is_tag()) { ?>
        
                <div class="pm-sub-header-title-container">
                        
                    <div class="pm-sub-header-title-bg">
            
                        <p class="pm-sub-header-title"><?php esc_attr_e('News tagged with:', 'energytheme'); ?></p>
                        <?php get_template_part('content', 'subheadermessage'); ?>
                    
                    </div><!-- /.pm-sub-header-title-bg -->
                    
                    <?php get_template_part('content', 'subheaderbreadcrumbs'); ?>
                    
                </div>
                
        <?php } else if(is_category()) { ?>
        
                <div class="pm-sub-header-title-container">
                        
                    <div class="pm-sub-header-title-bg">
            
                        <p class="pm-sub-header-title"><?php esc_attr_e('News filed in:', 'energytheme'); ?></p>
                        <?php get_template_part('content', 'subheadermessage'); ?>
                    
                    </div><!-- /.pm-sub-header-title-bg -->
                    
                    <?php get_template_part('content', 'subheaderbreadcrumbs'); ?>
                    
                </div>
                
        <?php } else if(is_tax('gallerycats') ) { ?>
                                
                    <div class="pm-sub-header-title-container">
                        
                        <div class="pm-sub-header-title-bg">
                
                            <p class="pm-sub-header-title"><?php single_tag_title("Gallery posts filed in &quot;"); echo '&quot; '; ?></p>
                            <?php get_template_part('content', 'subheadermessage'); ?>
                        
                        </div><!-- /.pm-sub-header-title-bg -->
                        
                        <?php get_template_part('content', 'subheaderbreadcrumbs'); ?>
                        
                    </div>
                    
        <?php } else if(is_tax('gallerytags') ) { ?>
                                
                    <div class="pm-sub-header-title-container">
                        
                        <div class="pm-sub-header-title-bg">
                
                            <p class="pm-sub-header-title"><?php single_tag_title("Gallery posts tagged in &quot;"); echo '&quot; '; ?></p>
                            <?php get_template_part('content', 'subheadermessage'); ?>
                        
                        </div><!-- /.pm-sub-header-title-bg -->
                        
                        <?php get_template_part('content', 'subheaderbreadcrumbs'); ?>
                        
                    </div>
                
        <?php } else if( is_archive() ) { ?>
                        
                <div class="pm-sub-header-title-container">
                        
                    <div class="pm-sub-header-title-bg">
            
                        <p class="pm-sub-header-title"><?php esc_attr_e('Archive for', 'energytheme'); ?></p>
                        <?php get_template_part('content', 'subheadermessage'); ?>
                    
                    </div><!-- /.pm-sub-header-title-bg -->
                    
                    <?php get_template_part('content', 'subheaderbreadcrumbs'); ?>
                    
                </div>
                
         <?php } else if( is_single() ) { ?>
                                
                <div class="pm-sub-header-title-container">
                    
                    <div class="pm-sub-header-title-bg post-title">
            
                        <p class="pm-sub-header-title post-title"><?php the_title(); ?></p>
                    
                    </div><!-- /.pm-sub-header-title-bg -->
                    
                    <?php get_template_part('content', 'subheaderbreadcrumbs'); ?>
                    
                </div>
                    
        <?php } else { ?>
                
                <div class="pm-sub-header-title-container">
                        
                    <div class="pm-sub-header-title-bg">
            
                        <p class="pm-sub-header-title"><?php the_title(); ?></p>
                        <?php get_template_part('content', 'subheadermessage'); ?>
                    
                    </div><!-- /.pm-sub-header-title-bg -->
                    
                    <?php get_template_part('content', 'subheaderbreadcrumbs'); ?>
                    
                </div>
        
        <?php } ?>
    
    <?php } ?>
                                               
</div>
<!-- SUBHEADER AREA end -->