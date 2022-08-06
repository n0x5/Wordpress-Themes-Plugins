<?php
/*
Template Name: Blog Page
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

</style>


<div class="lists">
<div class="categoryl">
<a class="titlecat" href="https://found-angels.com/?cat=42"><h1>Blog</a>
(<?php $category = get_category(42); $count = $category->category_count; if( $count > $something ) { echo $count; } ?> posts)<h1>

<?php
    $args = array( 'category' => 42, 'post_type' => 'post', 'orderby' => 'modified', 'order' => 'DESC', 'numberposts' => '7' );
    $postslist = get_posts( $args );
    foreach ($postslist as $post) :  setup_postdata($post);
    ?>
    <?php the_time('F jS, Y') ?>
    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php echo the_excerpt(); ?>
    <?php endforeach; ?>
</div>
</div>

</body>
