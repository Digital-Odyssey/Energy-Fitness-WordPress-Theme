<?php /* Template Name: Programs Template */ ?>
<?php get_header(); ?>


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
	//global $paged;
	
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	
	$programs_posts_per_load = get_theme_mod('programs_posts_per_load', '3');

	$arguments = array(
			'post_type' => 'post_programs',
			'post_status' => 'publish',
			'paged' => $paged,
			'orderby' => 'title',
			'order' => 'ASC',
			'posts_per_page' => $programs_posts_per_load,
			//'tag' => get_query_var('tag')
		);
	

	$blog_query = new WP_Query($arguments);

	pm_ln_set_query($blog_query);

	
?>

<!-- PANEL 1 -->
<div class="container pm-containerPadding-top-80 pm-containerPadding-bottom-80">

    <div class="row">
        
		<?php if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                    
            <?php get_template_part( 'content', 'programpost' ); ?>
        
        <?php endwhile; else: ?>
             <p><?php esc_attr_e('No gallery posts were found.', 'energytheme'); ?></p>
        <?php endif; ?>
        
        <?php get_template_part('content', 'standardpagination'); ?>
                    
        <?php pm_ln_restore_query(); ?> 
        
	</div>

</div>
<!-- PANEL 1 end -->

<?php get_footer(); ?>