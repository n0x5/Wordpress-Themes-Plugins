<div class="header">
<?php get_header(); ?>
<h4><?php get_sidebar('Sidebar-1'); ?></h4>
</div>
<hr>

<div id="content">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="post">
<h3 style="display:inline;"><?php get_the_date(); ?> - </h3><h2 style="display:inline;"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><br>
<?php wp_link_pages('before=Sections:&next_or_number=number&pagelink=Page %'); ?>
<?php the_content(); ?>
</div>
<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>

</div>
<div id="nav"><?php next_posts_link(__('&laquo; Older Posts |', 'code8')) ?>  <?php previous_posts_link(__('Newer Posts &raquo;','code8')); ?></div>
<?php get_footer(); ?>
