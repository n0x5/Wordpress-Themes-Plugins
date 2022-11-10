<?php
/*
Template Name: Archive
*/
?>

<div class="header">
<?php get_header(); ?>
<h4><?php get_sidebar('Sidebar-1'); ?></h4>
</div>
<hr>
<div id="content">
<?php
$args = array(
'post_type' => 'post',
'post_status' => 'publish',
'posts_per_page' => -1,
);

$the_query = new WP_Query( $args );

if ( $the_query->have_posts() ):

while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

	<h2 style="line-height: 80%;"><h3 style="display:inline;"><?php echo get_the_date(); ?></h3><a style="line-height: 80%;" href="<?php echo get_permalink(); ?>"> - <?php echo get_the_title(); ?></a></h2>

<?php endwhile; ?>
<?php wp_reset_postdata(); ?>

<?php else : ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>
</div>
<?php get_footer(); ?>