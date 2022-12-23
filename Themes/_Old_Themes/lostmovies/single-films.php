<?php
require('./wp-blog-header.php');
include(get_template_directory() . '/header.php');
?>
<?php echo '<h2 class="the-date">'.get_the_date().'</h2>'; ?>
<div class="movie">
<?php $meta = get_post_meta( get_the_ID() ); ?>
<h2><?php the_title(); ?> (<?php echo $meta['year'][0]; ?>) <h2>


<div style="width:200px;" class="poster"><?php the_post_thumbnail('medium'); ?></div>
<h4 style="display:inline;">Year:</h4> <?php echo $meta['year'][0]; ?><br>
<h4 style="display:inline;">Genres:</h4> <?php echo $meta['genre'][0]; ?><br>
<h4 style="display:inline;">Plot:</h4> <?php echo $meta['plot'][0]; ?><br>
<h4 style="display:inline;">Country:</h4> <?php echo $meta['country'][0]; ?><br>
<h4 style="display:inline;">Language:</h4> <?php echo $meta['language'][0]; ?><br>
<h4 style="display:inline;">iMDB:</h4> <?php echo $meta['imdb'][0]; ?><br>
</div>
        <div class="images">
<h2>Images from the film:</h2>
<?php the_content(); ?>
</div>
    
<div class="girls33">
<h2>Actresses in the film:</h2>

<?php

$actr = $meta['actress_db'];
$a = array();
global $wpdb;
foreach ($actr as $post2) {
    $sql = "SELECT ID FROM $wpdb->posts WHERE ID='$post2'";
    $results = $wpdb->get_col($sql);
    foreach ($results as $post3) {
        array_push($a, $post3);
    }
}


if (count($a) === 0) {
    echo 'No actresses added';
}
    
else {
$args = array(
    'post__in' => $a,
    'post_type'    => 'any',
);
    
$the_query = new WP_Query( $args );
?>
<div class="roster">
<?php if ( $the_query->have_posts() ) : ?>
<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

<div class="actress"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?><br><div class="name"><?php the_title(); ?></a></div></div>
    

    
<?php endwhile; ?>
</div>

<?php else : ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>
<?php } ?>

</div>
<br><br>



<?php include(get_template_directory() . '/footer.php'); ?>
