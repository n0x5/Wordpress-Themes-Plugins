<?php
/**
 * Plugin Name: n0x attachment image
 * Description: Image metadata on attachment page. Add template named "image" in site editor then add the block
 */

function n0x_attachment_image_register_block( $block_attributes, $content ) {
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

return '<div class="wp-block group"><a style="font-size: 25px;" href="'. $url3 .'">Full Size ('.$width.'x'.$height.')</a>' . wp_get_attachment_image( $post->ID, array( $attachment_size, 600 ) ) . '<br><h3>Metadata:</h3>'.
'Dimensions: '.$width.'x'.$height.'<br>
Mimetype: '.$mimetype.'<br>
Uploaded: '.$date3 .' '. $uploaded.'<br><br>
Camera: ' .$camera.'<br>
Copyright: ' .$copyright.'<br>
Title: ' .$title3.'<br>
Credit: ' .$credit.'<br><br>
Timestamp: ' .$timestamp.'<br>
Aperture: ' .$aperture.'<br>
Focal length: ' .$focal_length.'<br>
Iso: ' .$iso.'<br>
Shutter speed: ' .$shutter_speed.'<br>
Orientation: ' .$orientation.'<br>
Iso: ' .$iso.'<br>
'
.'</div>';
}

function n0x_attachment_image() {
    $asset_file = include( plugin_dir_path( __FILE__ ) . 'block.asset.php');

    wp_register_script(
        'n0x/attachmentimage',
        plugins_url( 'block.js', __FILE__ ),
        $asset_file['dependencies'],
        $asset_file['version']
    );

    register_block_type( 'n0x/attachmentimage', array(
        'api_version' => 2,
        'editor_script' => 'n0x/attachmentimage',
        'render_callback' => 'n0x_attachment_image_register_block'
    ) );

}
add_action( 'init', 'n0x_attachment_image' );


