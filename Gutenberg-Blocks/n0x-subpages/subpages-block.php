<?php
/**
 * Plugin Name: Subpages List Block
 * Description: A Gutenberg block to list sub-pages with featured images if available.
 * Version: 1.0.0
 * Author: Your Name
 * Text Domain: subpages-block
 */

defined( 'ABSPATH' ) || exit;

function subpages_block_register() {
    wp_register_script(
        'subpages-block-editor-script',
        plugins_url( 'js/block.js', __FILE__ ),
        array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-server-side-render' ),
        filemtime( plugin_dir_path( __FILE__ ) . 'js/block.js' )
    );

    wp_register_style(
        'subpages-block-style',
        plugins_url( 'css/style.css', __FILE__ ),
        array(),
        filemtime( plugin_dir_path( __FILE__ ) . 'css/style.css' )
    );

    register_block_type( 'custom/subpages-list', array(
        'editor_script'   => 'subpages-block-editor-script',
        'style'           => 'subpages-block-style',
        'editor_style'    => 'subpages-block-style',
        'render_callback' => 'subpages_block_render_callback',
    ) );
}
add_action( 'init', 'subpages_block_register' );

function subpages_block_render_callback( $attributes, $content ) {
    global $post;

    if ( ! is_page() || ! isset( $post ) ) {
        return '';
    }

    $child_pages = get_pages( array(
        'post_type'   => 'page',
        'post_status' => 'publish',
        'parent'      => $post->ID,
        'sort_column' => 'menu_order, post_title',
        'sort_order'  => 'ASC',
    ) );

    if ( empty( $child_pages ) ) {
        return '';
    }

    $output = '<ul class="wp-block-subpages-list">';

    foreach ( $child_pages as $child_page ) {
        $link = get_permalink( $child_page->ID );

        if ( has_post_thumbnail( $child_page->ID ) ) {
            $image = get_the_post_thumbnail( $child_page->ID, 'thumbnail', array( 'alt' => esc_attr( $child_page->post_title ) ) );
            $output .= '<li><a href="' . esc_url( $link ) . '">' . $image . '</a></li>';
        } else {
            $output .= '<li><a href="' . esc_url( $link ) . '">' . esc_html( $child_page->post_title ) . '</a></li>';
        }
    }

    $output .= '</ul>';

    return $output;
}
