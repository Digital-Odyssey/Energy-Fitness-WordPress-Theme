<?php /* Template Name: Events Template */ ?>
<?php get_header(); ?>


<?php if($content = $post->post_content) { ?>

    <div class="container pm-containerPadding-top-80">
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
	$terms = get_terms('event_categoriess');
?>



<?php
	//global $paged;
	$eventsPostOrder = get_theme_mod('eventsPostOrder', 'DESC');
	$eventsPostOrderByEventDate = get_theme_mod('eventsPostOrderByEventDate', 'on');
	
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	
	$todaysDate = date_i18n( 'Y-m-d' ); //This date format is required by WordPress to match dates

	if($eventsPostOrderByEventDate === 'on'){
		
		//orderby event date
		$arguments = array(
			'post_type' => 'post_event',
			'post_status' => 'publish',
			'paged' => $paged,
			'orderby' => 'meta_value',
			'meta_key' => 're_start_date_event',
			'order' => $eventsPostOrder,
			'posts_per_page' => -1,
			//'tag' => get_query_var('tag')
			'meta_query' => array(
				array(
					'key' => 'is_expired',
					'value' => 'true',
					'compare' => '!=',
				)
			),
		);
		
	} else {
	
		//default wordpress orderby
		$arguments = array(
			'post_type' => 'post_event',
			'post_status' => 'publish',
			'paged' => $paged,
			'order' => $eventsPostOrder,
			'posts_per_page' => -1,
			//'tag' => get_query_var('tag')
			'meta_query' => array(
				array(
					'key' => 'is_expired',
					'value' => 'true',
					'compare' => '!=',
				)
			),
		);
		
	}
	
	

	$blog_query = new WP_Query($arguments);

	pm_ln_set_query($blog_query);
	
	$count_posts = wp_count_posts('post_event');
	
	
	//Check for total number of posts that aren't expired
	$count_args = array(
			'post_type' => 'post_event',
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

<!-- PANEL 1 -->
<?php if($published_posts >= 1) : ?>

	<?php if($content = $post->post_content) { ?>
        <div class="container pm-containerPadding-top-30 pm-containerPadding-bottom-60">
    <?php } else { ?>
        <div class="container pm-containerPadding-top-30 pm-containerPadding-bottom-60">
    <?php } ?>
    
    	<?php if( !empty($terms) ) : ?>
        
        	<div class="row">
        
                <div class="col-lg-12">
                
                    <!-- Filter menu -->
                    <ul class="pm-isotope-filter-system">
                        <li class="pm-isotope-filter-system-expand"><?php esc_attr_e('Currently viewing', 'energytheme'); ?> <i class="fa fa-angle-down"></i></li>
                        <li><a href="#" class="current" id="all"><?php esc_attr_e('All', 'energytheme'); ?></a></li>
                        <?php
                            foreach ($terms as $term) {
                                echo '<li><a href="#" id="'.$term->slug.'">'.ucfirst($term->name).'</a></li>';	
                            }
                        ?>
                    </ul>
                    <!-- Filter menu end -->
                    
                </div><!-- /.col-lg-12 -->
                                        
            </div><!-- /.row -->
        
        <?php endif; ?>
        
    </div>
    
<?php endif; ?>
<!-- PANEL 1  end-->

<!-- PANEL 2 -->
<div class="container pm-containerPadding-bottom-60">

    <div class="row">
        
		<?php if($published_posts >= 1) { ?>
        
            <div id="pm-isotope-item-container">
        
                <?php if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                
                    <?php get_template_part( 'content', 'eventpost' ); ?>
                
                <?php endwhile; else: ?>
                     <p><?php esc_attr_e('No events posts were found.', 'energytheme'); ?></p>
                <?php endif; ?>
            
            </div>
        
        <?php } else { ?>
    
            <div class="col-lg-12">
                <p><?php esc_attr_e('All events have expired.', 'energytheme'); ?></p>
            </div>
    
        <?php } ?>
                    
        <?php pm_ln_restore_query(); ?> 
        

	</div>

</div>



<?php get_footer(); ?>