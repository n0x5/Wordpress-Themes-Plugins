<?php

function valens_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Widget Area', 'valens' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Add widgets here to appear in your sidebar.', 'valens' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'valens_widgets_init' );


function register_my_menus() {
  register_nav_menus(
    array('header-menu' => __( 'Header Menu 1', 'valens' ) )
  );
}


add_filter( 'image_strip_meta', function() {
 return true;
});

add_theme_support( 'title-tag' );

add_theme_support( 'automatic-feed-links' );
add_theme_support( 'custom-background' );
add_theme_support( 'custom-header' );


add_theme_support( 'post-thumbnails' );

$markup = array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'html5' );
add_theme_support( $markup );   

function data_scripts() {
wp_enqueue_style( 'data-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'data_scripts' );

function gretathemes_meta_description() {
    global $post;
    if ( is_singular() ) {
        //$des_post = strip_tags( $post->post_content );
        //$des_post = strip_shortcodes( $post->post_content );
        //$des_post = str_replace( array("\n", "\r", "\t"), ' ', $des_post );
        //$des_post = mb_substr( $des_post, 0, 300, 'utf8' );
        //echo '<meta name="description" content="' . $des_post . '" />' . "\n";
        echo '<meta name="description" content="' . get_bloginfo( "description" ) . '" />' . "\n";
    }
    if ( is_home() ) {
        echo '<meta name="description" content="' . get_bloginfo( "description" ) . '" />' . "\n";
    }
    if ( is_category() ) {
        $des_cat = strip_tags(category_description());
        echo '<meta name="description" content="' . $des_cat . '" />' . "\n";
    }
}
add_action( 'wp_head', 'gretathemes_meta_description');

?>