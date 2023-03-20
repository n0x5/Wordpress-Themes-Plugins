<?php
/**
 * Plugin Name: n0x Archive
 */

function n0x_archive_register_block( $block_attributes, $content ) {
global $wpdb;
$sql = "select * from  $wpdb->posts where post_type = 'post' and post_status = 'publish' order by id desc";
$recent_posts = $wpdb->get_results($sql);

foreach ($recent_posts as $post) {
    $p_id = $post->ID;
    $final_post = $final_post . '<div class="post1">' . $post->post_date . ' -> <a href="' . get_permalink($p_id) . '">'.get_the_title($p_id).'</a></div><br>';
    }

return $final_post;
}

function n0x_archive() {
    $asset_file = include( plugin_dir_path( __FILE__ ) . 'block.asset.php');

    wp_register_script(
        'n0x/archive',
        plugins_url( 'block.js', __FILE__ ),
        $asset_file['dependencies'],
        $asset_file['version']
    );

    register_block_type( 'n0x/archive', array(
        'api_version' => 2,
        'editor_script' => 'n0x/archive',
        'render_callback' => 'n0x_archive_register_block'
    ) );

}
add_action( 'init', 'n0x_archive' );


