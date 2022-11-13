<?php
/**
 * Plugin Name: n0x Sub Pages
 */

function n0x_subpages_register_block( $block_attributes, $content ) {
 $pages = get_pages(array('parent'  => get_the_id(), 'post_status' => array('publish', 'private')));
    $result = wp_list_pluck( $pages, 'ID' );
    foreach ($result as $thumb) {
        $wp_query2 = new WP_Query(array(
            'post_parent' => $thumb,
            'post_type' => array('attachment', 'page'),
            'post_status' => 'any'
            ));
        $count = $wp_query2->found_posts;
        $perma = get_permalink($thumb);
        $title = get_the_title($thumb);
        $thumbnail = get_the_post_thumbnail($thumb, 'thumbnail');
        $sizes = wp_get_registered_image_subsizes();
        $img_width = $sizes['thumbnail']['width'];
        if (!empty(get_the_post_thumbnail($thumb, 'thumbnail') )) {
          $thumb = '<div class="nox-item"><div class="n0x-lnk"><a href="'.$perma.'">'.$thumbnail.'</a></div><div class="n0x-title"><a href="'.$perma.'">'.$title . ' <br>(' . $count .  ' items)</a></div></div>';

            $lnks = $lnks . $thumb;
			
        }
        else {
            $thumb = '<a href="'.$perma.'">'.$title.'</a><br>';
            $lnks = $lnks . $thumb;
        }
    }
    return '<div class="stuf">' . $lnks . '</div>';
}

function n0x_subp() {
    $asset_file = include( plugin_dir_path( __FILE__ ) . 'block.asset.php');

    wp_register_script(
        'n0x/subpages',
        plugins_url( 'block.js', __FILE__ ),
        $asset_file['dependencies'],
        $asset_file['version']
    );

    register_block_type( 'n0x/subpages', array(
        'api_version' => 2,
        'editor_script' => 'n0x/subpages',
        'render_callback' => 'n0x_subpages_register_block'
    ) );

}
add_action( 'init', 'n0x_subp' );


