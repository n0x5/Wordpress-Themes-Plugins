<?php
/**
 * Plugin Name: n0x Query
 */

function n0x_query_register_block( $block_attributes, $content ) {
global $wpdb;
$sql = "select * from  $wpdb->posts where post_type = 'post' order by id desc limit 10";
$recent_posts = $wpdb->get_results($sql);

foreach ($recent_posts as $post) {
    $p_id = $post->ID;
    $final_post = $final_post . '<div class="post1">' . $post->post_date . ' -> ' . get_the_title($p_id) . '</div><br>';
    }

return $final_post;
}

function n0x_dynamic() {
    $asset_file = include( plugin_dir_path( __FILE__ ) . 'block.asset.php');

    wp_register_script(
        'n0x/query',
        plugins_url( 'block.js', __FILE__ ),
        $asset_file['dependencies'],
        $asset_file['version']
    );

    register_block_type( 'n0x/query', array(
        'api_version' => 2,
        'editor_script' => 'n0x/query',
        'render_callback' => 'n0x_query_register_block'
    ) );

}
add_action( 'init', 'n0x_dynamic' );


