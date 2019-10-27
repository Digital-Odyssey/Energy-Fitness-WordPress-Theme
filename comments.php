<?php

/**

 * @package WordPress
 * @subpackage Default_Theme
 */

// Do not delete these lines

	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))

		die ('Please do not load this page directly. Thanks!');

	if (post_password_required()) {
    ?>

    <p class="nocomments"><?php esc_attr_e('This post is password protected. Enter the password to view comments.', 'energytheme'); ?></p>

    <?php
    return;
}

global $id;
$id = $post->ID;

?>



<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>

	<h4 class="pm-single-post-panel-title"><?php comments_number('No Responses', 'One Response', '% Responses' );?> to &#8220;<?php the_title(); ?>&#8221;</h4>
    <div class="pm-title-divider"></div>
     
    <div class="pm-comments-container">
     
        <ol class="commentlist">
            <?php wp_list_comments('callback=pm_ln_mytheme_comment'); ?>
        </ol>
    
    </div>
    <!-- /.pm-comments-container --> 
    
<?php else : // this is displayed if there are no comments so far ?>
 
<?php if ('open' == $post->comment_status) : ?>
<!-- If comments are open, but there are no comments. -->
 
	<?php else : // comments are closed ?>
    <!-- If comments are closed. -->
    <p class="nocomments">Comments are closed.</p>
     
<?php endif; ?>

<?php endif; ?>
 
