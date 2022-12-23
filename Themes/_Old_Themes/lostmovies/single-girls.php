<?php
require('./wp-blog-header.php');
include(get_template_directory() . '/header.php');
?>
<?php echo '<h2 class="the-date">'.get_the_date().'</h2>'; ?>


<div class="girls">
<?php $meta = get_post_meta( get_the_ID() ); ?>
<h2><?php the_title(); ?><h2>
<div style="width:200px;" class="poster"><?php the_post_thumbnail('medium'); ?></div>
<h4 style="display:inline;">Born:</h4> <?php echo $meta['actress_born'][0]; ?><br>
<h4 style="display:inline;">Country:</h4> <?php echo $meta['actress_country'][0]; ?><br>
<h4 style="display:inline;">iMDB:</h4> <?php echo $meta['actress_imdb'][0]; ?><br>
</div>

<h2>Actress filmography:</h2>
<?php
$actr = get_the_ID();
$a = array();
global $wpdb;
$sql = "SELECT post_id FROM $wpdb->postmeta WHERE meta_key='actress_db' AND meta_value = '$actr'";
    $results = $wpdb->get_col($sql);
    foreach ($results as $post3) {
        array_push($a, $post3);
    }

if (count($a) === 0) {
    echo 'No films added';
}
    
else {
$args = array(
    'post__in' => $a,
    'post_type'    => 'any',
);

$the_query = new WP_Query( $args );
?>
<?php if ( $the_query->have_posts() ) : ?>
<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
<?php
$pid = get_the_id();
global $wpdb;
$sql = "SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'year' AND post_id = '$pid'";
    $results = $wpdb->get_col($sql);
?>
<div class="film"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?><br><div class="name"><?php the_title(); ?> (<?php echo $results[0]; ?>)</a></div></div>
<?php endwhile; ?>

<?php else : ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>
<?php } ?>

<?php include(get_template_directory() . '/footer.php'); ?>
