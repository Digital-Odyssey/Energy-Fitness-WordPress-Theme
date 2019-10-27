<?php get_header(); ?>


<?php
/* Start the Loop */
while ( have_posts() ) : the_post();

	get_template_part( 'content', 'singlepost' );

endwhile; // End of the loop.
?>


<?php get_footer(); ?>