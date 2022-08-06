<?php
/*
Template Name: Blog Index
*/
?>
<body>

<?php /* get_header(); */ ?>

<title>Blog - Found Angels - Where beauty meets magic and mystery</title>


<center><img width="300" src="/wp-content/themes/foundangels/images/fa-logo.jpg" />
<div class="descr">Galleries of beautiful girls.</div>
<p><a href="/">Home</a></p>
<h1>Blog posts</h2>


<div class="lists">
<div class="categoryl">

<?php
    $args = array( 'category' => 42, 'post_type' => 'post', 'orderby' => 'modified', 'order' => 'DESC', 'numberposts' => '7' );
    $postslist = get_posts( $args );
    foreach ($postslist as $post) :
    setup_postdata($post); ?>
    <h2><a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail( $post_id, 'thumbnail', array( 'class' => 'alignleft' ) ); ?><?php the_title(); ?></a></h2>
    <?php endforeach; ?>
</div>
</div>

</center>
</body>
