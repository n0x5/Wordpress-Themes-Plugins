<?php
/*
Template Name: Category list
*/
?>
<title>site index</title>

<p><a href="/">Home</a></p>



<?php
global $wpdb;

$result  = $wpdb->get_results( "SELECT * FROM  $wpdb->terms ORDER BY name asc");
$count = count($result);
echo "Categories found: $count <br><br>";
foreach ( $result as $category ) {
    echo "$category->name <br>\n";
    $result_posts  = $wpdb->get_results( "SELECT * FROM  $wpdb->term_relationships WHERE term_taxonomy_id = '$category->term_id' ORDER BY object_id desc");
    $count = count($result);
         foreach ( $result_posts as $post ) {
           $post_title3 = $wpdb->get_results( "SELECT * FROM  $wpdb->posts WHERE ID = '$post->object_id' ORDER BY ID asc");
           foreach ( $post_title3 as $title3 ) {
             echo "&nbsp&nbsp&nbsp&nbsp&nbsp $title3->post_date &nbsp&nbsp $title3->post_title &nbsp&nbsp $title3->guid <br>\n";

}
}

}
?>

