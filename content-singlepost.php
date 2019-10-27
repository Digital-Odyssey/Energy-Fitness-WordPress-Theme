<?php
/**
 * The default template for displaying a single post.
 */
?>

<?php 

	 $enableTooltip = get_theme_mod('enableTooltip', 'on');

	 $categories = get_the_category();
	 $count = get_comments_number();
	 
	 if ( has_post_thumbnail()) {
	   $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
	 }
	 
	 $num_comments = get_comments_number(); // get_comments_number returns only a numeric value	 
	 
	 $displayComments = get_theme_mod('displayComments', 'on');
	 $displayRelatedPosts = get_theme_mod('displayRelatedPosts', 'on');
	 $displaySocialFeatures = get_theme_mod('displaySocialFeatures', 'on');
	              
?>

<!-- PANEL 1 -->
<?php if(!has_post_thumbnail()) { ?>
<div class="container pm-containerPadding-bottom-50">
<?php } else { ?>
<div class="container pm-containerPadding-top-20 pm-containerPadding-bottom-100">
<?php } ?>


    <div class="row">
        <div class="col-lg-12">
            
            <!-- Post image -->
            <?php if(has_post_thumbnail()) { ?>
                <div class="pm-news-post" style="background-image:url(<?php echo esc_html($image_url[0]); ?>); margin-bottom:35px;">
                
                    <div class="pm-news-post-gradient"></div>
                    <div class="pm-news-post-date-shadow"></div>
                    <div class="pm-news-post-date-bg"></div>
                    
                    <div class="pm-news-post-date">
                        <p class="month"><?php the_time( 'M' ); ?></p>
                        <p class="day"><?php the_time( 'd' ); ?></p>
                    </div>
                    
                    <div class="pm-news-title single-post">
                        <h6>
                        <?php 
                            $title = get_the_title();
                            echo pm_ln_set_primary_words($title);
                        ?>
                        </h6>
                    </div>
                    
                    <div class="pm-news-post-like-shadow"></div>
                    <div class="pm-news-post-like-diamond"></div>
                    <?php $likes = get_post_meta(get_the_ID(), 'pm_total_likes', true);?>
                    <div class="pm-news-post-like-counter" id="pm-post-total-likes-count-<?php echo get_the_ID(); ?>"><?php echo esc_attr($likes); ?></div>
                    <a href="#" class="pm-news-post-like-btn pm-like-this-btn fa fa-thumbs-up" id="<?php echo get_the_ID(); ?>"></a>
                
                </div>
            <?php } else { ?>
            	<div class="pm-news-post secondary" style="margin-bottom:35px;">

                    
                    <div class="pm-news-post-date secondary">
                        <p class="month"><?php the_time( 'M' ); ?></p>
                        <p class="day"><?php the_time( 'd' ); ?></p>
                    </div>
                    
                </div>
            <?php }  ?>
            
            
            <!-- Post image end -->
            
            <!-- Post info and tags -->
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
                                                
            </div>
            
            <div class="pm-news-post-divider"></div>
            
            <?php the_content(); ?>
			<?php 

                $pag_defaults = array(
                        'before'           => '<p>' . esc_attr__( 'READ MORE:', 'energytheme' ),
                        'after'            => '</p>',
                        'link_before'      => '',
                        'link_after'       => '',
                        'next_or_number'   => 'number',
                        'separator'        => ' ',
                        'nextpagelink'     => '',
                        'previouspagelink' => '',
                        'pagelink'         => '%',
                        'echo'             => 1
                    );
                
                wp_link_pages($pag_defaults); 
            
            ?>
                
            <div class="pm-news-post-divider" style="margin-bottom:0px !important;"></div>
                
            <div class="pm-news-post-tags-and-excerpt">
                                
                <?php if(has_tag()) : ?>
                    <p class="tags"><?php esc_attr_e('Tagged in', 'energytheme'); ?>: <?php the_tags('', ', ', ''); ?></p>
                    <div class="pm-news-post-divider"></div>
                <?php endif; ?>
                
                
                
            </div>
            <!-- Post info and tags end -->
            
            <?php if($displaySocialFeatures === 'on') : ?>
            
            	<ul class="pm-post-social-icons">
                    <li class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top tw' : 'tw' ?>" <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Twitter', 'energytheme') .'"' : '' ?>> 
                        <div class="pm-post-social-icon-diamond"></div>
                        <a href="https://twitter.com/share?url=<?php echo urlencode(get_the_permalink()); ?>&amp;text=<?php echo urlencode(get_the_title()); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                    </li>
                    
                    <li class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top fb' : 'fb' ?>" <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Facebook', 'energytheme') .'"' : '' ?>> 
                        <div class="pm-post-social-icon-diamond"></div>
                        <a href="http://www.facebook.com/share.php?u=<?php echo urlencode(get_the_permalink()); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                    </li>
                    
                    <li class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top gp' : 'gp' ?>" <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Google Plus', 'energytheme') .'"' : '' ?>> 
                        <div class="pm-post-social-icon-diamond"></div>
                        <a href="https://plus.google.com/share?url=<?php echo urlencode(get_the_permalink()); ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
                    </li>
                    <li class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top linked' : 'linked' ?>" <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Linkedin', 'energytheme') .'"' : '' ?>> 
                        <div class="pm-post-social-icon-diamond"></div>
                        <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo get_permalink(); ?>&title=<?php echo get_the_title(); ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
                    </li>
                    <li class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top yt' : 'yt' ?>" <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('Reddit', 'energytheme') .'"' : '' ?>> 
                        <div class="pm-post-social-icon-diamond"></div>
                        <a href="http://reddit.com/submit?url=<?php echo urlencode(get_the_permalink()); ?>&amp;title=<?php echo urlencode(get_the_title()); ?>" target="_blank"><i class="fa fa-reddit"></i></a>
                    </li>
                    <li class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top st' : 'st' ?>" <?php echo $enableTooltip == 'on' ? 'title="'. esc_attr__('StumbleUpon', 'energytheme') .'"' : '' ?>> 
                        <div class="pm-post-social-icon-diamond"></div>
                        <a href="http://www.stumbleupon.com/submit?url=<?php echo urlencode(get_the_permalink()); ?>&amp;title=<?php echo urlencode(get_the_title()); ?>" target="_blank"><i class="fa fa-stumbleupon"></i></a>
                    </li>
                </ul>
            
            <?php endif; ?>            
            
            <?php if( !has_post_thumbnail()) : ?>
            
            	<div class="pm-news-post-divider"></div>
    
                <div class="pm-news-post-like-diamond secondary"></div>
                <?php $likes = get_post_meta(get_the_ID(), 'pm_total_likes', true);?>
                <a href="#" class="pm-news-post-like-btn secondary pm-like-this-btn fa fa-thumbs-up" id="<?php echo get_the_ID(); ?>"></a>
                <div class="pm-news-post-like-counter secondary" id="pm-post-total-likes-count-<?php echo get_the_ID(); ?>"><?php echo esc_attr($likes); ?></div>
            
            <?php endif; ?>
            
        </div>
    </div>

</div>
<!-- PANEL 1 end -->

