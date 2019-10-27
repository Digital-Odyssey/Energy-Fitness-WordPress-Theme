<?php /* Template Name: Gallery Template */ ?>
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
	$terms = get_terms('gallerycats');
?>

<!-- PANEL 1 -->
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
                    <li><a href="#" class="current" id="all"><?php esc_attr_e('View all', 'energytheme'); ?></a></li>
                    <?php
                        foreach ($terms as $term) {
                            echo '<li><a href="#" id="'.$term->slug.'">'.ucfirst($term->name).'</a></li>';	
                        }
                    ?>
                </ul>
                <!-- Filter menu end -->
                
            </div><!-- /.col-lg-12 -->
                                    
        </div>
    <?php endif; ?>
    
</div>
<!-- PANEL 1  end-->

<?php
	//global $paged;
	$galleryPostOrder = get_theme_mod('galleryPostOrder', 'DESC');
	
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	$arguments = array(
		'post_type' => 'post_galleries',
		'post_status' => 'publish',
		'paged' => $paged,
		'order' => $galleryPostOrder,
		'posts_per_page' => -1,
		//'tag' => get_query_var('tag')
	);

	$blog_query = new WP_Query($arguments);

	pm_ln_set_query($blog_query);

	
?>

<!-- PANEL 2 -->
<div class="container pm-containerPadding-bottom-60">

    <div class="row">

		<div id="pm-isotope-item-container">
        
			<?php if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                
                <?php get_template_part( 'content', 'gallerypost' ); ?>
            
            <?php endwhile; else: ?>
                 <p><?php esc_attr_e('No gallery posts were found.', 'energytheme'); ?></p>
            <?php endif; ?>
                        
            <?php pm_ln_restore_query(); ?> 
        
        </div>

	</div>

</div>



<?php get_footer(); ?>