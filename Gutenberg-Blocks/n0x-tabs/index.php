<?php
/**
 * Plugin Name: n0x Tabs
 */

function n0x_tabs_register_block( $block_attributes, $content ) {
wp_register_style( 'custom-script-tabs',  plugin_dir_url( __FILE__ ) . 'n0x-tabs.css' );
wp_enqueue_style( 'custom-script-tabs'   );
$args = array(
'post_type' => 'page',
'posts_per_page' => 500,
'orderby' => 'title',
);

$my_wp_query = new WP_Query();
$all_wp_pages = $my_wp_query->query($args);
$parent_id = wp_get_post_parent_id($post->ID);
$parents = get_page_children($parent_id, $all_wp_pages);
//var_dump($parents);
$title2 = get_the_title($post->ID);
$page_link2 = get_page_link($post->ID);
$url = get_bloginfo('url');
$title3 = get_the_title($url);
$url3 = esc_url(wp_get_attachment_url());

foreach ($parents as $value) {
    $title = get_the_title($value);
    $page_link = get_page_link($value);
    $page_url = '<div class="link5"><a href=' . $page_link .'>' . $title . '</a></div>';
    $item_output1 = $page_url .'<div class="tabs3"> | </div>'. $item_output1;
    }

$page_url2 = '<a href=' . $page_link2 .'>' . $title2 . '</a>';
$page_url3 = '<a href=' . $url .'>' . 'Home' . '</a>';
$beforecontent = '<h4><div class="sep4">'. $item_output1 . '</h4>';
$aftercontent = '';
$fullcontent = $beforecontent .'' . '' . $content . $aftercontent;

return $fullcontent;
}

function n0x_tabs() {
    $asset_file = include( plugin_dir_path( __FILE__ ) . 'block.asset.php');

    wp_register_script(
        'n0x/tabs',
        plugins_url( 'block.js', __FILE__ ),
        $asset_file['dependencies'],
        $asset_file['version']
    );

    register_block_type( 'n0x/tabs', array(
        'api_version' => 2,
        'editor_script' => 'n0x/tabs',
        'render_callback' => 'n0x_tabs_register_block'
    ) );

}
add_action( 'init', 'n0x_tabs' );


