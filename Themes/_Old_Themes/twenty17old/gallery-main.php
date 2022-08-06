<?php
/*
Template Name: Gallery Index
*/
?>

<link rel='stylesheet' id='spooky-fonts-css'  href='https://fonts.googleapis.com/css?family=IM%20Fell%20English&#038;subset=latin' type='text/css' media='all' />
<body>
<style type="text/css">
body {
background-color: black;
color: white;
font-family: 'IM Fell English', serif !important;
}
.post-entry {
}
.categoryl {
height: 1045px;
width: 430px;
float: left;
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


.grid-item {
}
a.titlecat {
font-size: 30px;
color: #e91e63;
}
a {
font-size: 20px;
color: white;
}
.headtitle {
text-align: center;
font-size: 80px;
}
.descr {
text-align: center;
font-size: 20px;
}
.lists {
/*padding-left: 350;*/
}
p.recent {
font-size: 12px;
}
.banner{
margin-bottom: 20px;
}
.galleries {
width: 400px;
height:300px;
float: left;
}
h2 {
margin-top: -30px !important;
}
</style>

<?php get_header(); ?>
<center>

<?php
if ( $post->post_parent ) {
    $children = wp_list_pages( array(
        'title_li' => '',
        'child_of' => $post->post_parent,
        'echo'     => 0
    ) );
    $title = get_the_title( $post->post_parent );
} else {
    $children = wp_list_pages( array(
        'title_li' => '',
        'child_of' => $post->ID,
        'echo'     => 0
    ) );
    $title = get_the_title( $post->ID );
}

if ( $children ) : ?>
    <h2><?php echo $title ; ?></h2>
    <ul>
        <?php // echo $children; ?>
    </ul>
<?php endif; ?>


<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>


<div class="banner"><?php echo get_the_post_thumbnail($post_id, 'large', array( 'class' => 'alignleft' )); ?></div>

<?php the_content(); ?>

<?php
  $subs = new WP_Query(
    array(
      'posts_per_page' => -1,
      'post_parent' => $post->ID,
      'post_type' => 'page',
      'order' => 'asc',
      'meta_key' => '_thumbnail_id'
    )
  );
if( $subs->have_posts() ) :
  while( $subs->have_posts() ) :
    $subs->the_post();
    echo '<div class="galleries"> <a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_post_thumbnail($post_id, 'thumbnail', array( 'class' => 'alignleft' )).'</a>'.'<h2><a href="'.get_permalink().'">'.get_the_title().'</a></h2></div>';
  endwhile;
endif;
wp_reset_postdata(); ?>
</center>
<?php get_footer(); ?>
