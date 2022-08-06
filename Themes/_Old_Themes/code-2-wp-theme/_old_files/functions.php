<?php
if ( function_exists('register_sidebar') )
    register_sidebar();

add_theme_support( 'title-tag' );
add_theme_support( 'automatic-feed-links' );
add_filter( 'use_default_gallery_style', '__return_false' );

if ( ! isset( $content_width ) ) $content_width = 900;

add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );

$markup = array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', );
add_theme_support( 'html5', $markup );	
function comby_scripts() {
	
wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.0.2' );
wp_enqueue_style( 'code2-style', get_stylesheet_uri(), array( 'genericons' ) );

wp_enqueue_script( 'code2-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20131209', true );

}
add_action( 'wp_enqueue_scripts', 'comby_scripts' );


function exclude_category_home( $query ) {
if ( $query->is_home ) {
$query->set( 'cat', '-224' );
}
return $query;
}
 
add_filter( 'pre_get_posts', 'exclude_category_home' );



function remove_header_info() {
    remove_action( 'wp_head', 'rsd_link' );
    remove_action( 'wp_head', 'wlwmanifest_link' );
    remove_action( 'wp_head', 'wp_generator' );
    remove_action( 'wp_head', 'start_post_rel_link' );
    remove_action( 'wp_head', 'index_rel_link' );
    remove_action( 'wp_head', 'adjacent_posts_rel_link' );         // for WordPress < 3.0
    remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' ); // for WordPress >= 3.0
}
add_action( 'init', 'remove_header_info' );



?>
