<?php

add_action('wp_insert_post', 'set_default_custom_fields');
function set_default_custom_fields($post_id){
if ( $_GET['post_type'] == 'films' ) {
    add_post_meta($post_id, 'actress_db', '', true);
	add_post_meta($post_id, 'actress_db', '', true);
    add_post_meta($post_id, 'english_title', '', true);
    add_post_meta($post_id, 'imdb', '', true);
	add_post_meta($post_id, 'country', '', true);
    add_post_meta($post_id, 'language', '', true);
    add_post_meta($post_id, 'plot', '', true);
    add_post_meta($post_id, 'year', '', true);
	add_post_meta($post_id, 'genre', '', true);
    }
if ( $_GET['post_type'] == 'girls' ) {
    add_post_meta($post_id, 'actress_born', '', true);
    add_post_meta($post_id, 'actress_country', '', true);
    add_post_meta($post_id, 'actress_imdb', '', true);
    }
return true;
}

function code2center_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Sidebar 1', 'code2center' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Add widgets here to appear in your sidebar.', 'code2center' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'code2center_widgets_init' );

function add_block_template_part_support() {
    add_theme_support( 'block-template-parts' );
}
 
add_action( 'after_setup_theme', 'add_block_template_part_support' );
