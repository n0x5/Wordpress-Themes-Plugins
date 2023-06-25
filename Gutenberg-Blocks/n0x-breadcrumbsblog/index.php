<?php
/**
 * Plugin Name: n0x Breadcrumbs Blog
 */

function breadcrumbsblog_register_block( $block_attributes, $content ) {

$home_url3 = '<a href=' . get_bloginfo('url') .'>' . 'Home' . '</a>';
$blog_url = '<a href=' . get_permalink(get_option('page_for_posts')) .'>' . 'Blog' . '</a>';
$title2 = get_the_title($post->ID);
$month = get_the_date('m');
$year = get_the_date('Y');
$ylink = get_year_link($year);
$lnkyear = '<a href="' . $ylink . '">' . $year . '</a>';
return '<h4>' . $home_url3 .'<div class="sep3"> -> </div>' . $blog_url . '<div class="sep3"> -> </div>' .  $lnkyear . '</h4>';
}

function n0x_breadcrumbsblog() {
    $asset_file = include( plugin_dir_path( __FILE__ ) . 'block.asset.php');

    wp_register_script(
        'n0x/breadcrumbsblog',
        plugins_url( 'block.js', __FILE__ ),
        $asset_file['dependencies'],
        $asset_file['version']
    );

    register_block_type( 'n0x/breadcrumbsblog', array(
        'api_version' => 2,
        'editor_script' => 'n0x/breadcrumbsblog',
        'render_callback' => 'breadcrumbsblog_register_block'
    ) );

}
add_action( 'init', 'n0x_breadcrumbsblog' );


