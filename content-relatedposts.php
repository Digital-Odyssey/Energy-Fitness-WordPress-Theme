<?php
	//The default template for retrieving related blog post(s)
?>
<div class="pm-single-blog-post-related-posts">

	
        <?php  
            $tags = wp_get_post_tags(get_the_ID());  
			
			$numOfRelatedPosts = get_theme_mod('numOfRelatedPosts');
			
			//print_r($tags);
              
            if ($tags) {  
			            
                $tag_ids = array();  
            
                foreach($tags as $individual_tag) {
                    $tag_ids[] = $individual_tag->term_id; 
                }
             
                $args = array(  
                    'tag__in' => $tag_ids,  
                    'post__not_in' => array(get_the_ID()),  
                    'posts_per_page' => $numOfRelatedPosts, // Number of related posts to display.  
                    'ignore_sticky_posts' => 1  
                );  
              
                $my_query = new wp_query( $args );  
				
				if(!$my_query->have_posts()){
					echo '<p>'.esc_attr__('There are currently no articles related to this post.', 'energytheme').'</p>';	
				}
				
				echo '<ul class="pm-related-blog-posts">';
          
					while( $my_query->have_posts() ) {  
						$my_query->the_post();  
						
						if ( has_post_thumbnail() ) {
						   $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'small');
						}
						
					?>  
                       <li>
                         	<div class="pm-related-blog-post-thumb-diamond"></div>
                            <?php if(has_post_thumbnail()) { ?>
                                    <div class="pm-related-blog-post-thumb" style="background-image:url(<?php echo esc_html($image_url[0]); ?>);"></div>
                            <?php } else { ?>
                           			<!-- no thumb to display -->
                            <?php } ?>
                            
                            <div class="pm-related-blog-post-details">
                                <a href="<?php the_permalink()?>"><?php the_title(); ?></a>
                                <p class="pm-comments-count"><?php comments_number( '', '1 Comment', '% Comments' ); ?></p>
                            </div>
                        </li>
				  
					<?php } 
				
				echo '</ul>'; 
            }  
            wp_reset_query();  
        ?>

</div>