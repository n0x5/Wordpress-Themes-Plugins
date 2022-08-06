<?php get_header(); ?>
<div id="wrapper">



<body <?php body_class(); ?>>
<section class="content">
	

<?php if (have_posts()) : ?><?php while (have_posts()) : the_post(); ?>
	
<div class="entry">
<h2> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <div class="title1"><?php the_time('F jS, Y g:i a') ?></div></h2>
<?php the_content('-> read more'); ?>
</div>
	
<?php endwhile; ?>
<?php endif; ?>

</section>

<?php get_sidebar(); ?>
<div id="nav">
<?php next_posts_link(__('&laquo; Previous Entries', 'code-2')) ?><br>
<?php previous_posts_link(__('Newer Entries &raquo;','code-2')); ?>
</div>
</div>

<?php get_footer(); ?>
