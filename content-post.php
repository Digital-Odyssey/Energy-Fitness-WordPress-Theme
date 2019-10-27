<?php
/**
 * The default template for displaying a post item.
 */
?>

<?php 

	 $categories = get_the_category();
	 $count = get_comments_number();
	 
	 if ( has_post_thumbnail()) {
	   $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
	 }
	 
	 $likes = get_post_meta(get_the_ID(), 'pm_total_likes', true);
	 
?>

<article <?php post_class(); ?> role="news-article">
                    
    <?php if(has_post_thumbnail()) { ?>
    
        <div class="pm-news-post" style="background-image:url(<?php echo esc_html($image_url[0]); ?>);">
        
            <div class="pm-news-post-gradient"></div>
            <div class="pm-news-post-date-shadow"></div>
            <div class="pm-news-post-date-bg"></div>
            
            <?php 
				if(is_sticky()){
					?>
					<div class="pm-news-post-sticky-icon thumb"><i class="fa fa-thumb-tack"></i></div>
					<?php
				}
			?>
            
            <div class="pm-news-post-date"> 
                <p class="month"><?php the_time( 'M' ); ?></p>
                <p class="day"><?php the_time( 'd' ); ?></p>
            </div>
            
            <div class="pm-news-title">
                <h6>
                <?php 
                    $title = get_the_title();
                    echo pm_ln_set_primary_words($title);
                ?>
                </h6>
                <a href="<?php the_permalink(); ?>" class="pm-news-post-link fa fa-link"></a>
            </div>
            
            
            <?php 
			
				if( get_post_type() === 'post' ) :
					echo '<div class="pm-news-post-like-shadow"></div>';
					echo '<div class="pm-news-post-like-diamond"></div>';
					echo '<a href="#" class="pm-news-post-like-btn pm-like-this-btn fa fa-thumbs-up" id="'. get_the_ID() .'"></a>';
					echo '<div class="pm-news-post-like-counter" id="pm-post-total-likes-count-'. get_the_ID() .'">'. esc_attr($likes) .'</div>';
				endif; 
			
			?>
            
        
        </div>

    <?php } else {  ?>
    
    	<div class="pm-news-post secondary">
        
        	<div class="pm-news-title secondary">
                <h6>
                <?php 
                    $title = get_the_title();
                    echo pm_ln_set_primary_words($title);
                ?>
                </h6>
            </div>
            
            <div class="pm-news-post-date secondary">
            
            	<?php 
					if(is_sticky()){
						?>
                        <div class="pm-news-post-sticky-icon"><i class="fa fa-thumb-tack"></i></div>
                        <?php
					}
				?>
            
                <p class="month"><?php the_time( 'M' ); ?></p>
                <p class="day"><?php the_time( 'd' ); ?></p>
            </div>
            
            
        </div>
    
    <?php }  ?>
        
        
                            
    <div class="pm-news-post-tags-and-excerpt">
    
        <p class="author-name"><?php esc_attr_e('Posted by', 'energytheme'); ?> <?php the_author(); ?> <?php esc_attr_e('on', 'energytheme'); ?> <?php the_time( 'M' ); ?> <?php the_time( 'd' ); ?>, <?php the_time( 'Y' ); ?> <?php esc_attr_e('in', 'energytheme'); ?> 
        <?php 
			if($categories){
				foreach($categories as $category) {
					echo '<a href="'.get_category_link( $category->term_id ).'">'.$category->cat_name.'</a>';	
				}
			}
		?>
        </p> 
        
        <div class="pm-news-post-divider"></div>
        
        <p class="pm-news-excerpt"><?php echo get_the_excerpt(); ?><a href="<?php the_permalink(); ?>"> [...]</a> </p>
        
        <div class="pm-news-post-divider"></div>
        
        <?php if(has_tag()) : ?>
        	<p class="tags"><?php esc_attr_e('Tagged in', 'energytheme'); ?>: <?php the_tags('', ', ', ''); ?></p>
        <?php endif; ?>
        
    </div>
    
    <a href="<?php the_permalink(); ?>" class="pm-square-btn news-post"><?php esc_attr_e('View Post', 'energytheme'); ?></a>
    
    <?php if( !has_post_thumbnail()) : ?>
            
        <?php 
						
			if( get_post_type() === 'post' ) :
				echo '<div class="pm-news-post-like-diamond secondary"></div>';
				echo '<a href="#" class="pm-news-post-like-btn secondary pm-like-this-btn fa fa-thumbs-up" id="'. get_the_ID() .'"></a>';
			endif; 
		
		?>
        
        <div class="pm-news-post-like-counter secondary" id="pm-post-total-likes-count-<?php echo get_the_ID(); ?>"><?php echo esc_attr($likes); ?></div>
    
    <?php endif; ?>
    
</article>