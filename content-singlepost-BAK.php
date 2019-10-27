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

<?php
    
	//author info
	$display_name = get_the_author_meta('display_name');
	$first_name = get_the_author_meta('first_name');
	$last_name = get_the_author_meta('last_name');
	$author_title = get_the_author_meta( 'author_title' ); 
	$description = get_the_author_meta('description');
	
	$displayAuthorProfile = get_theme_mod('displayAuthorProfile', 'on');
	$authorBackgroundImage = get_theme_mod('authorBackgroundImage');
	$toggleParallaxAuthor = get_theme_mod('toggleParallaxAuthor', 'on');
	
?> 

<?php if($displayAuthorProfile === 'on') : ?>

<!-- PANEL 2 -->
<div class="pm-column-container pm-containerPadding-bottom-50 <?php echo $toggleParallaxAuthor === 'on' ? 'pm-parallax-panel' : '' ?>" id="pm-author-panel" <?php echo $authorBackgroundImage !== '' ? 'style="background-image:url('.esc_html($authorBackgroundImage).')"' : '' ?> <?php echo $toggleParallaxAuthor === 'on' ? 'data-stellar-vertical-offset="-100" data-stellar-background-ratio="0.5"' : '' ?> >

    <div class="container pm-containerPadding80">
        <div class="row">
            <div class="col-lg-12">
                
                <h4 class="pm-single-post-panel-title"><?php esc_attr_e('About the author', 'energytheme') ?></h4>
                <div class="pm-title-divider"></div>
                
                <div class="row pm-containerPadding-top-30">
                    
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        
                        <div class="pm-author-bio-img-bg">
                            <div class="pm-author-bio-img">
                             	<?php echo get_avatar( get_the_author_meta( 'ID' ), 130 ); ?>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <p class="pm-author-name"><?php echo esc_attr($first_name); ?> <?php echo esc_attr($last_name); ?></p>
                        <p class="pm-author-title"><?php echo esc_attr($author_title); ?></p>
                        <div class="pm-author-divider"></div>
                        <p class="pm-author-bio"><?php echo esc_attr($description); ?></p>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>

</div>
<!-- PANEL 2 end -->

<?php endif; ?>



<!-- PANEL 3 -->
<?php if($displayRelatedPosts === 'on') : ?>

	<?php if ($num_comments > 0 && $displayComments === 'on') { ?>
        <div class="container pm-containerPadding-top-80 pm-containerPadding-bottom-80">
    <?php } else { ?>
        <div class="container pm-containerPadding-top-80 pm-containerPadding-bottom-60">
    <?php } ?>
    
        <div class="row">
            <div class="col-lg-12">
            
                <h4 class="pm-single-post-panel-title pm-secondary"><?php esc_attr_e('Related Posts', 'energytheme') ?></h4>
                <div class="pm-title-divider"></div>
                
                <div class="pm-single-blog-post-related-posts">
                
                    <?php get_template_part('content', 'relatedposts'); ?>
                
                </div>
                
            </div>
        </div>
    </div>

<?php endif; ?>
<!-- PANEL 3 end-->

<!-- PANEL 4 -->
<?php 

/*wp_list_comments( array(
	'walker' => new pm_ln_comments_walker,
	'style' => 'ul',
	'callback' => null,
	'end-callback' => null,
	'type' => 'all',
	'page' => null,
	'avatar_size' => 32
) );*/

?>

<?php if ($num_comments > 0 && $displayComments === 'on') : ?>

<div class="pm-column-container pm-containerPadding80" id="pm-comments-responses-panel">

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                            
                <!-- Comments --> 
                <div class="pm-comments-container">
                
                	<?php comments_template( '', true ); ?>
                
                </div>
                <!-- Comments end --> 
                
            </div>
        </div>
    </div>

</div>
<!-- PANEL 4 end -->

<?php endif; ?>


<!-- PANEL 5 -->
<?php if ($num_comments > 0 && $displayComments === 'on') { ?>
	<div class="container pm-containerPadding-top-100 pm-containerPadding-bottom-80">
<?php } else { ?>
	<div class="container pm-containerPadding-bottom-80">
<?php } ?>

    <div class="row">
        <div class="col-lg-12">
            
            <h4 class="pm-single-post-panel-title pm-secondary"><?php esc_attr_e('Submit a comment','energytheme') ?></h4>
            <div class="pm-title-divider"></div>
            
            <?php if ( !$user_ID ) : ?>
            	<p class="pm-required-comments"><?php esc_attr_e('Your email address will not be published. Required fields are marked *','energytheme') ?></p>
            <?php endif; ?>
            
            <!-- MOVE TO content-singlepost -->

			<?php if ('open' == $post->comment_status) : ?>
             
                <div id="respond">
                     
                    <div class="cancel-comment-reply" style="margin-bottom:15px;">
                        <small><?php cancel_comment_reply_link(); ?></small>
                    </div>
                 
                    <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
                        <p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php esc_attr_e('logged in', 'energytheme'); ?></a> <?php esc_attr_e('to post a comment.', 'energytheme'); ?></p>
                    <?php else : ?>
                 
                    <div class="row pm-containerPadding-top-20">
                    
                        <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" class="comment-form">
                     
                            <?php if ( $user_ID ) : ?>
                            
                            <?php 
								$user = wp_get_current_user();
							?>
                             
                            <p style="padding-left:16px;">Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo esc_attr($user->display_name); ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php esc_attr_e('Log out of this account','energytheme'); ?>">Log out &raquo;</a></p>
                             
                            <?php else : ?>
                            
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <input type="text" name="author" placeholder="<?php esc_attr_e('Name *', 'energytheme'); ?>" id="author" class="respond_author pm-comment-form-textfield" value="" size="22" tabindex="1" />
                            </div>
                            
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <input type="text" name="email"  placeholder="<?php esc_attr_e('Email *', 'energytheme'); ?>" id="email" class="respond_email pm-comment-form-textfield" value="" size="22" tabindex="2" />
                            </div>
                            
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <input type="text" name="url" placeholder="<?php esc_attr_e('Website', 'energytheme'); ?>" id="url" class="respond_url pm-comment-form-textfield" value="" size="22" tabindex="3" />
                            </div>
                
                             
                            <?php endif; ?>
                            
                            
                            <div class="col-lg-12 pm-clear-element">
                                <textarea name="comment" placeholder="<?php esc_attr_e('Comment...', 'energytheme'); ?>" id="comment" cols="100" rows="10"  class="respond_comment pm-comment-form-textarea" tabindex="4"></textarea>
                            </div>
                            
                            <div class="col-lg-12 pm-clear-element">
                                <div class="pm-comment-html-tags">
                                    <span><?php esc_attr_e('You may use these HTML tags and attributes', 'energytheme'); ?>:</span>
                                    <p><code><?php echo allowed_tags(); ?></code></p>
                                </div>
                                
                                <input name="submit" type="submit" id="submit" class="pm-comment-submit-btn"  value="<?php esc_attr_e('Submit Comment', 'energytheme'); ?>">
                                
                            </div>
                            
                             
                            <?php comment_id_fields(); ?>
                            </p>
                            
                            <?php do_action('comment_form', $post->ID); ?>
                         
                        </form>
                    
                    </div><!-- /.row -->
                 
                    
                 
                    <?php endif; // If registration required and not logged in ?>
                    
                </div>
             
            <?php endif; // if you delete this the sky will fall on your head ?>

            
        </div>
    </div>
</div>
<!-- PANEL 5 end-->