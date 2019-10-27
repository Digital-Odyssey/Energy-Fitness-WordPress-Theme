<?php /* Template Name: Schedules Template */ ?>
<?php get_header(); ?>

<?php 
	$schedules_posts_per_page = get_theme_mod('schedules_posts_per_page', '3');
?>

<?php if($content = $post->post_content) { ?>

    <div class="container pm-containerPadding-top-20">
        <div class="row">
            <div class="col-lg-12">
            
                <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
                    
                    <?php the_content(); ?>
                
                <?php endwhile; else: ?>
                     
                <?php endif; ?> 
            
            </div>
        </div>
    </div>

<?php } ?>





<?php

	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	$arguments = array(
			'post_type' => 'post_schedules',
			'post_status' => 'publish',
			'order' => 'DESC',
			/*'orderby' => 'meta_value',
			'meta_key' => 're_start_date_event',*/
			'paged' => $paged,
			'posts_per_page' => $schedules_posts_per_page,
			'meta_query' => array(
				array(
					'key' => 'is_expired',
					'value' => 'true',
					'compare' => '!=',
				)
			)
			//'tag' => get_query_var('tag')
	);
	

	$blog_query = new WP_Query($arguments);
	pm_ln_set_query($blog_query);
	

	$count_posts = wp_count_posts('post_event');
	
	//Check for total number of posts that aren't expired
	$count_args = array(
			'post_type' => 'post_schedules',
			'post_status' => 'publish',
			'meta_query' => array(
				array(
					'key' => 'is_expired',
					'value' => 'true',
					'compare' => '!=',
				)
			),
		);
	
	$my_query = new WP_Query( $count_args );
				
	$published_posts = $my_query->found_posts;
	
?>



<!-- POSTS PANEL -->
<div class="container pm-containerPadding-top-80 pm-containerPadding-bottom-60">

    <div class="row">
    
    	<?php if($published_posts >= 1) { ?>
        
            <div id="pm-isotope-item-container">
        
                <?php if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                
                    <?php get_template_part( 'content', 'schedulespost' ); ?>
                
                <?php endwhile; else: ?>
                     <p><?php esc_attr_e('No scheduled programs were found.', 'energytheme'); ?></p>
                <?php endif; ?>
            
            </div>
        
        <?php } else { ?>
    
            <div class="col-lg-12">
                <p><?php esc_attr_e('All programs have expired.', 'energytheme'); ?></p>
            </div>
    
        <?php } ?>
        
                                
        <?php pm_ln_restore_query(); ?> 
        
        
	</div>

</div>
<!-- POSTS PANEL end -->

<!-- Load more -->
<?php if($published_posts > $schedules_posts_per_page) { ?>

	<div class="container pm-containerPadding-bottom-80">
        <div class="row">
            <div class="col-lg-12">
                
                <ul class="pm-post-loaded-info">
                    <li>
                        <p><?php esc_attr_e('Viewing', 'energytheme') ?> <span class="pm-load-more-container-current-count"><?php echo $schedules_posts_per_page; ?></span> <?php esc_attr_e('of', 'energytheme') ?> <?php echo $published_posts; ?></p>
                    </li>
                    <li>
                        <a href="#" id="pm-load-more" name="schedules"><span><?php esc_attr_e('Load More', 'energytheme') ?></span> &nbsp; <i class="fa fa-cloud-download"></i></a>
                    </li>
                </ul>
                
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>


<?php } ?>
<!-- Load more end -->

<?php get_footer(); ?>