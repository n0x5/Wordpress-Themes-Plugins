<?php
/**
 * Plugin Name: n0x films year
 */

function n0x_films_year_register_block( $block_attributes, $content ) {
    global $wpdb;
    $sql = "select * from $wpdb->posts join $wpdb->postmeta on ID = post_id and meta_key = 'year' where post_type = 'films' group by post_title order by meta_value desc";
    $recent_posts = $wpdb->get_results($sql);
    //print_r($recent_posts);
    foreach ($recent_posts as $post) {
        $p_id = $post->ID;
        $meta = get_post_meta($p_id);
        $p_title = get_the_title($post->ID);
        $final_post = $final_post . '<div class="post1"><a href="' . get_permalink($p_id) . '">' . get_the_post_thumbnail($p_id, 'thumbnail')
                             . '</a><div class="ptitle">' . get_the_title($p_id) . ' (' . $meta['year'][0] . ') </div></div>';
        }

    return $final_post;
}

function n0x_films_year() {
    $asset_file = include( plugin_dir_path( __FILE__ ) . 'block.asset.php');

    wp_register_script(
        'n0x/filmsyear',
        plugins_url( 'block.js', __FILE__ ),
        $asset_file['dependencies'],
        $asset_file['version']
    );

    register_block_type( 'n0x/filmsyear', array(
        'api_version' => 2,
        'editor_script' => 'n0x/filmsyear',
        'render_callback' => 'n0x_films_year_register_block'
    ) );

}
add_action( 'init', 'n0x_films_year' );

