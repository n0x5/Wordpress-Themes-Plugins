<?php 
require('./wp-blog-header.php');
include(get_template_directory() . '/header.php');
?>



<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<?php the_date('','<h2 class="the-date">','</h2>'); ?>
	
<div class="post">
	 
	
	
	<div class="storycontent">
		<?php the_content(); ?>
	</div>
	
	<div class="feedback">
            <?php wp_link_pages(); ?>
            <?php comments_popup_link(__('Comments (0)'), __('Comments (1)'), __('Comments (%)')); ?>
	</div>
	
	<!--
	<?php trackback_rdf(); ?>
	-->
</div>

<?php comments_template(); /* Get wp-comments.php template */ ?>

<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>

<div id="nav"><?php next_posts_link(__('&laquo; Older Posts |', 'code8')) ?>  <?php previous_posts_link(__('Newer Posts &raquo;','code8')); ?></div>


<?php include(get_template_directory() . '/footer.php'); ?>