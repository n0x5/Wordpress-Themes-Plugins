<?php get_header(); ?>
<div id="main">
	<?php
if ( $post->post_parent ) {
    $children = wp_list_pages( array(
        'title_li' => '',
        'child_of' => $post->post_parent,
        'echo'     => 0
    ) );
   $page_link = get_page_link( $post->post_parent );
    $title = get_the_title( $post->post_parent );
} else {
    $children = wp_list_pages( array(
        'title_li' => '',
        'child_of' => $post->ID,
        'echo'     => 0
    ) );
    $page_link = get_page_link( $post->post_parent );
    $title = get_the_title( $post->ID );
}

if ( $post->post_parent ) : ?>
    <h2><?php // echo $title ; ?></h2>
    <h2><?php echo '<a href="/blog">Home</a> -> <a href=' . $page_link .'>' . $title . '</a>'; ?> -> <?php the_title(); ?></h2>
    <ul>
        <?php // echo $children; ?>
    </ul>

<?php else : ?>
<h2><a href="/blog">Home</a></h2>

<h2 style="text-align: center;"><?php the_title() ; ?></h2>

<?php endif; ?>


	<?php if (have_posts()) : ?><?php while (have_posts()) : the_post(); ?>
	<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
	<div id="content">

<div class="content">
		


		<div class="entry">
			<div class="navigation">
            	<br clear="all" />
			</div>
			<h2><?php // the_title(); ?></h2><br>
			
			<?php the_content(); ?>
			<br clear="left" />
		</div>
	</div>
	</div>
	<div class="time2"><?php the_time('F jS, Y') ?></div>
	<?php endwhile; ?>
	<?php endif; ?>
</div>
<?php get_footer(); ?>
