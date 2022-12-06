<?php
/**
 * Plugin Name: n0x images
 */

function n0x_images_register_block( $block_attributes, $content ) {
global $wpdb;
$sql = "select * from  $wpdb->posts where post_type = 'attachment' order by id desc limit 25";
$recent_posts = $wpdb->get_results($sql);

foreach ($recent_posts as $post) {
    $p_id = $post->ID;
    $p_parent = $post->post_parent;
    $p_title = get_the_title($p_parent);
    if (strpos($p_title, 'Private:') !== false) {
        // private galleries
        }
    else {
        $final_post = $final_post . '<div class="post1"><a href="' . get_permalink($p_parent) . '">' . wp_get_attachment_image($p_id) . '</a> added in ' . get_the_title($p_parent) . '</div><br>';
        }
    }

return $final_post;
}

function n0x_images() {
    $asset_file = include( plugin_dir_path( __FILE__ ) . 'block.asset.php');

    wp_register_script(
        'n0x/images',
        plugins_url( 'block.js', __FILE__ ),
        $asset_file['dependencies'],
        $asset_file['version']
    );

    register_block_type( 'n0x/images', array(
        'api_version' => 2,
        'editor_script' => 'n0x/images',
        'render_callback' => 'n0x_images_register_block'
    ) );

}
add_action( 'init', 'n0x_images' );


