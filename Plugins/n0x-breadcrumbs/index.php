<?php
/**
 * Plugin Name: n0x Breadcrumb Links
 */

function n0x_breadcumbs_register_block( $block_attributes, $content ) {
$metadata = wp_get_attachment_metadata();
$width = $metadata['width'];
$height = $metadata['height'];
$caption = $metadata['image_meta']['caption'];
$camera = $metadata['image_meta']['camera'];
$copyright = $metadata['image_meta']['copyright'];
$aperture = $metadata['image_meta']['aperture'];
$timestamp = $metadata['image_meta']['created_timestamp'];
$credit = $metadata['image_meta']['credit'];
$title3 = $metadata['image_meta']['title'];
$focal_length = $metadata['image_meta']['focal_length'];
$iso = $metadata['image_meta']['iso'];
$shutter_speed = $metadata['image_meta']['shutter_speed'];
$orientation = $metadata['image_meta']['orientation'];
$keywords1 = $metadata['image_meta']['keywords'][0];
$keywords2 = $metadata['image_meta']['keywords'];
$mimetype = $metadata['sizes']['large']['mime-type'];
$uploaded = esc_attr(get_the_time());
$date3 = get_the_date();
$parents = get_post_ancestors( $post->ID );
$title2 = get_the_title($post->ID);
$page_link2 = get_page_link($post->ID);
$url = get_bloginfo('url');
$title3 = get_the_title($url);
$url3 = esc_url(wp_get_attachment_url());

foreach ($parents as $value) {
    $title = get_the_title($value);
    $page_link = get_page_link($value);
    $page_url = '<a href=' . $page_link .'>' . $title . '</a>';
    $item_output1 = $page_url .'<div class="sep3"> -> </div>'. $item_output1;
}

$page_url2 = '<a href=' . $page_link2 .'>' . $title2 . '</a>';
$page_url3 = '<a href=' . $url .'>' . 'Home' . '</a>';
$beforecontent = '<h4>' . $page_url3 .'<div class="sep3"> -> </div>'. $item_output1 . $title2 . '</h4>';
$aftercontent = '';
$fullcontent = $beforecontent .'<br>' . '<br>' . $content . $aftercontent;


return $fullcontent;
}

function n0x_breadcumbs() {
    $asset_file = include( plugin_dir_path( __FILE__ ) . 'block.asset.php');

    wp_register_script(
        'n0x/breadcrumbs',
        plugins_url( 'block.js', __FILE__ ),
        $asset_file['dependencies'],
        $asset_file['version']
    );

    register_block_type( 'n0x/breadcrumbs', array(
        'api_version' => 2,
        'editor_script' => 'n0x/breadcrumbs',
        'render_callback' => 'n0x_breadcumbs_register_block'
    ) );

}
add_action( 'init', 'n0x_breadcumbs' );


