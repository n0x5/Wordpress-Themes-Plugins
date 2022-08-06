<?php
/*
Plugin Name: Nox Custom Functions
Version: 0.7
Plugin URI: 
Description: Plugin to add custom post types
Author: Nox
Author URI: 
*/

function movies_post_type() {

	$labels = array(
		'name'                => 'Movies',
		'singular_name'       => 'Movie',
		'menu_name'           => 'Movies',
		'parent_item_colon'   => 'Parent Item:',
		'all_items'           => 'All Items',
		'view_item'           => 'View Item',
		'add_new_item'        => 'Add New Item',
		'add_new'             => 'Add New',
		'edit_item'           => 'Edit Item',
		'update_item'         => 'Update Item',
		'search_items'        => 'Search Item',
		'not_found'           => 'Not found',
		'not_found_in_trash'  => 'Not found in Trash',
	);
	$args = array(
		'label'               => 'movies_post_type',
		'description'         => 'Post Type Description',
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'custom-fields', 'page-attributes', 'post-formats', ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-editor-video',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'movies_post_type', $args );

}

// Hook into the 'init' action
add_action( 'init', 'movies_post_type', 0 );

add_filter('upload_mimes', 'pixert_upload_types');
function pixert_upload_types($existing_mimes=array()){
$existing_mimes['flv'] = 'video/x-flv';
$existing_mimes['webp'] = 'image/webp';
return $existing_mimes;
}


remove_shortcode('gallery', 'gallery_shortcode');
add_shortcode('gallery', 'custom_gallery');

function custom_gallery($attr) {
	$post = get_post();
	static $instance = 0;
	$instance++;
	$attr['columns'] = 1;
	$attr['size'] = 'full';
	$attr['link'] = 'none';
	$attr['orderby'] = 'post__in';
	$attr['include'] = $attr['ids'];		
	$output = apply_filters('post_gallery', '', $attr);
	if ( $output != '' )
		return $output;
	# We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
		unset( $attr['orderby'] );
	}
	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post->ID,
		'itemtag'    => 'div',
		'icontag'    => 'div',
		'captiontag' => 'p',
		'columns'    => 1,
		'size'       => 'thumbnail',
		'include'    => '',
		'exclude'    => ''
	), $attr));
	$id = intval($id);
	if ( 'RAND' == $order )
		$orderby = 'none';
	if ( !empty($include) ) {
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}
	if ( empty($attachments) )
		return '';
	$gallery_style = $gallery_div = '';
	if ( apply_filters( 'use_default_gallery_style', true ) )
		$gallery_style = "<!-- see gallery_shortcode() in functions.php -->";
	$gallery_div = "<div class='gallery gallery-columns-1 gallery-size-full'>";
	$output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );
	foreach ( $attachments as $id => $attachment ) {
          
		$link = wp_get_attachment_link($id, 'thumbnail', false, false);
		
		$output .= "
			
                         <div class='imgc'>
				$link 
			</div>";
		if ( $captiontag && trim($attachment->post_excerpt) ) {
			$output .= "
				<p class='wp-caption-text homepage-gallery-caption'>
				" . wptexturize($attachment->post_excerpt) . "
				</p>";
		}
		$output .= "";
	}
	$output .= "</div>\n";
	return $output;
}

function nox_custom_scripts() {
    wp_register_style( 'nox-styles',  plugin_dir_url( __FILE__ ) . 'nox-style.css' );
    wp_enqueue_style( 'nox-styles' );
}
add_action( 'wp_enqueue_scripts', 'nox_custom_scripts' );
