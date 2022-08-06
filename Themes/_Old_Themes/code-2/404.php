<?php
/**
 * The template for displaying 404 pages (not found)
 */

get_header(); ?>

<div class="wrap">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <section class="error-404 not-found">
                <header class="page-header">
                    <h1 class="page-title"><?php _e( '404 Oops! That page can&rsquo;t be found.', 'code-2' ); ?></h1>
                </header><!-- .page-header -->
                <div class="page-content">
                    <h2>Possible posts listed below:</h2><br><br>
                
<?php
$url2 = $_SERVER['REQUEST_URI'];
$url4 = explode("/", $url2);
$url7 = $url4[1];
$url5 = str_replace("-"," ", $url7);
?>

<?php
$args = array(
'post_type' => array( 'post', 'page'),
'post_status' => 'publish',
'orderby' => array('date' => 'desc'),
's' => $url5
);

$the_query = new WP_Query( $args ); ?>


<?php if ( $the_query->have_posts() ) : ?>


<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>


<p><a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail( $post_id, 'thumbnail', array() ); ?> <?php the_time('F jS, Y') ?> - <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>

<?php endwhile; ?>



    <?php wp_reset_postdata(); ?>

<?php else : ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>

<br><br>

                    
                    <p>If that wasn't the post, you can try a search:</p>

                    <?php get_search_form(); ?>

                </div><!-- .page-content -->
            </section><!-- .error-404 -->
        </main><!-- #main -->
    </div><!-- #primary -->
</div><!-- .wrap -->

<?php
get_footer();
