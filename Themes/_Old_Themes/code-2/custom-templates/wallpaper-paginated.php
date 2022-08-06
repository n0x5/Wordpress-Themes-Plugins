<?php
/*
Template Name: Wallpaper Paginated
*/
?>

<body>
<style type="text/css">
.mainbody {
margin-left: auto;
margin-right: auto;
}
body {
background-color: black;
color: white;
}
.post-entry {
}
.categoryl {
height: 1045px;
width: 430px;
}

.category2 {
height: 100px;
width: 430px;
display: block;
}
a.titlecat2 {
font-size: 13px;
color: #e91e63;
}
a.titlecat3 {
font-size: 13px;
color: white;
}
h2 {
text-align: center;
}
a {
color: white;
text-decoration: none;
}
a:visited {
color: #c1c1c1;
}
.grid-item {
}
a.titlecat {
font-size: 30px;
color: #e91e63;
}

.headtitle {
text-align: center;
font-size: 80px;
}
.descr {
text-align: center;
font-size: 20px;
}

p.recent {
font-size: 12px;
}
.banner{
margin-bottom: 20px;
}
.galleries {
text-align: center;
margin-bottom: 20px;
}

.gallerytitle {
font-size: 20px;
}
.galleryinfo {

}
.pagination {
font-size: 25px;
text-align: center;
width: 100%;
display: inline-block;
margin-left: auto;
margin-right: auto;
font-size: 35px;
letter-spacing: 5px;
margin-bottom: 25px;
}
}

</style>
    
    
<title><?php echo esc_html(get_the_title()); ?></title>
<div class="mainbody">
<?php
if ( is_user_logged_in() ) { ?>

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

if ( $children ) : ?>
   <h2><?php // if (get_the_title() != "Gallery") echo 'Part of gallery: <a href=' . $page_link .'>' . $title . '</a>'; ?></h2>

<?php endif; ?>

<h2><a href="/">Home</a> -> <?php the_title(''); ?></h2>

<div class="banner"><?php // echo get_the_post_thumbnail($post_id, 'large', array( 'class' => 'alignleft' )); ?></div>



<?php the_content(); ?>

<?php 

$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

$args = array(
'post_type' => 'attachment',
'post_status' => 'any',
'meta_query' => array(
       array(
           'key' => 'width',
           'value' => '1920',
           'compare' => '=',
       ),
      array(
           'key' => 'height',
           'value' => '1080',
           'compare' => '=',
       ),
   ),
'orderby' => array('date' => 'desc'),
'paged' => $paged,
);

$the_query = new WP_Query( $args ); ?>

<?php if ( $the_query->have_posts() ) : ?>
	<div id="count"><?php $count = $the_query->found_posts; echo $count . ' wallpapers'; ?></div>

<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
<?php $url3 = esc_url(wp_get_attachment_url()); ?>
<?php $trunc_nfo = substr(get_the_title(),0,18); ?>
<?php echo '<div class="galleries"> <a href="'.$url3.'" title="'.get_the_title().'">'.wp_get_attachment_image( get_the_ID(), 'large' ).'</a>'.'<div class="gallerytitle"><a href="'.get_permalink().'">'.$trunc_nfo.'</a></div>'; ?> 
    <?php $metadata2 = wp_get_attachment_metadata(); ?>
    <?php
$width2 = $metadata2['width'];
$height2 = $metadata2['height'];
                                
?>
    <div class="galleryinfo"> <?php echo $width2.x.$height2; ?> </div> </div>

<?php endwhile; ?>
<div class="pagination">
<?php
$big = 999999999;
 
echo paginate_links( array(
    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
    'format' => '?paged=%#%',
    'current' => max( 1, get_query_var('paged') ),
    'total' => $the_query->max_num_pages,
    'prev_next'    => true,
    'prev_text'    => sprintf( '<i></i> %1$s', __( '<-', 'text-domain' ) ),
    'next_text'    => sprintf( '%1$s <i></i>', __( '->', 'text-domain' ) ),
) );
?>
</div>
    
<?php wp_reset_postdata(); ?>

<?php else : ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>


<?php
} else {
    echo 'Private page';
}

?>