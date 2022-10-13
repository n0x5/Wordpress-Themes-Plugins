<div class="header">
<?php get_header(); ?>
<h4><?php get_sidebar('Sidebar-1'); ?></h4>
</div>
<hr>

<div id="content">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php wp_link_pages('before=Sections:&next_or_number=number&pagelink=Page %'); ?>
<?php the_content(); ?>
<?php wp_link_pages('before=Sections:&next_or_number=number&pagelink=Page %'); ?>
<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>
</div>
<?php get_footer(); ?>
