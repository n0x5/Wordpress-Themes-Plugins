<?php
/*
Plugin Name: Nox Custom Posts 2
Version: 0.7
Plugin URI:
Description: Plugin to add custom post types
Author: Nox
Author URI:
*/

add_filter( 'xmlrpc_enabled', '__return_false' );

function wpdocs_scripts_method() {
    wp_register_script( 'custom-script-2', plugin_dir_url( __FILE__ ) . 'jquery.min.js', array(), false, true );
    wp_enqueue_script( 'custom-script-2', plugin_dir_url( __FILE__ ) . 'jquery.min.js', array(), false, true );
    wp_register_script( 'custom-script-3', plugin_dir_url( __FILE__ ) . 'jquery.fancybox.min.js', array(), false, true );
    wp_enqueue_script( 'custom-script-3', plugin_dir_url( __FILE__ ) . 'jquery.fancybox.min.js', array(), false, true );
    wp_register_script( 'custom-script-1', plugin_dir_url( __FILE__ ) . 'box.js', array(), false, true );
    wp_enqueue_script( 'custom-script-1', plugin_dir_url( __FILE__ ) . 'box.js', array(), false, true );
}
add_action( 'wp_enqueue_scripts', 'wpdocs_scripts_method' );


function exclude_category( $query ) { if ( $query->is_home() && $query->is_main_query() ) { $query->set( 'cat', '-261' );
add_action( 'wp_enqueue_scripts', 'wpdocs_scripts_method' );}
}

add_action( 'pre_get_posts', 'exclude_category' );

function organic_origin_gutenberg_styles() {
    wp_register_style( 'custom-script-6',  plugin_dir_url( __FILE__ ) . 'nblock-styles.css' );
    wp_enqueue_style( 'custom-script-6'   );
}
add_action( 'enqueue_block_editor_assets', 'organic_origin_gutenberg_styles' );

function nox_custom_scripts() {
    wp_register_style( 'custom-script-4',  plugin_dir_url( __FILE__ ) . 'jquery.fancybox.min.css' );
    wp_enqueue_style( 'custom-script-4'   );
    wp_register_style( 'custom-script-5',  plugin_dir_url( __FILE__ ) . 'nox-style.css' );
    wp_enqueue_style( 'custom-script-5'   );
    wp_register_style( 'custom-script-6',  plugin_dir_url( __FILE__ ) . 'nblock-styles.css' );
    wp_enqueue_style( 'custom-script-6'   );
}
add_action( 'wp_enqueue_scripts', 'nox_custom_scripts' );

function all_settings_link() {
    add_options_page(__('All Settings'), __('All Settings'), 'administrator', 'options.php');
   }
add_action('admin_menu', 'all_settings_link');

add_filter( 'big_image_size_threshold', '__return_false' );


function modify_attachment_link( $markup, $id, $size, $permalink, $icon, $text )

{
        $_post = get_post( $id );

        if ( empty( $_post ) || ( 'attachment' !== $_post->post_type ) || ! wp_get_attachment_url( $_post->ID ) ) {
                return __( 'Missing Attachment' );
        }

        $url = wp_get_attachment_url( $_post->ID );

        if ( $permalink ) {
                $url = get_attachment_link( $_post->ID );
        }

        if ( $text ) {
                $link_text = $text;
        } elseif ( $size && 'none' !== $size ) {
                $link_text = wp_get_attachment_image( $_post->ID, $size, $icon, $attr );
        } else {
                $link_text = '';
        }

        if ( '' === trim( $link_text ) ) {
                $link_text = $_post->post_title;
        }

        if ( '' === trim( $link_text ) ) {
                $link_text = esc_html( pathinfo( get_attached_file( $_post->ID ), PATHINFO_FILENAME ) );
        }
        if ( is_attachment() ) {
        return "<a href='" . esc_url( $url ) . "'>$link_text</a>";
        }
    else {
     return "<a data-fancybox='gallery' href='" . esc_url( $url ) . "'>$link_text</a>";
    }
}

add_filter( 'wp_get_attachment_link', 'modify_attachment_link', 10, 6, );

add_filter( 'use_default_gallery_style', '__return_false' );
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
        'order'      => 'DESC',
        'orderby'    => 'menu_order ID',
        'id'         => $post->ID,
        'itemtag'    => 'div',
        'icontag'    => 'div',
        'captiontag' => 'p',
        'columns'    => 1,
        'size'       => 'medium',
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
                 $lr3nfo = wp_get_attachment_metadata($id);
                 $cam = $lr3nfo[image_meta][camera];
                 $lr2nfo = "$lr3nfo[width] x $lr3nfo[height]";
                 $lr5nfo = $lr3nfo[file];
                 $lr6nfo = substr($lr5nfo, strpos($lr5nfo, "/") + 1);
                 $lr4nfo = substr($lr6nfo, strpos($lr6nfo, "/") + 1);
                 $trunc_nfo = $string = substr($lr4nfo,0,45);
                 $date5 = get_the_date('M d, Y', $attachment);

        $link = wp_get_attachment_link($id, 'medium', false, false);

        $output .= "
                         <div class='imgc'>
                $link <div class=\"dimensions\">$lr2nfo
                <div class=\"dlc\"> <div title=\"$lr4nfo\" class=\"filename1\">$trunc_nfo</div></div>
                     
                      <div class=\"uploaded\">Uploaded: $date5</div>
            </div></div>";
        $output .= "";
    }
    $output .= "</div>\n";
    return $output;
}



add_filter('wp_generate_attachment_metadata', 'add_metac', 10, 2);


function add_metac($meta, $id){

    update_post_meta($id, 'height', (int) $meta['height']);
    update_post_meta($id, 'width', (int) $meta['width']);
    update_post_meta($id, 'camera', (string) $meta['image_meta']['camera']);
    update_post_meta($id, 'date_taken', (string) $meta['image_meta']['created_timestamp']);
    update_post_meta($id, 'credit', (string) $meta['image_meta']['credit']);
    update_post_meta($id, 'copyright', (string) $meta['image_meta']['copyright']);
    update_post_meta($id, 'file', (string) $meta['file']);
    return $meta;

}

add_action( 'admin_menu', 'wpse_91693_register' );

function wpse_91693_register()
{
    add_menu_page(
        'Edit top level pages',     // page title
        'Top level pages',     // menu title
        'manage_options',   // capability
        'include-text',     // menu slug
        'wpse_91693_render' // callback function
    );
}

function wpse_91693_render()
{
    global $title;

    
    print "<h1>$title</h1>";

    $file = plugin_dir_path( __FILE__ ) . "included.html";

    if ( file_exists( $file ) )
        require $file;

    print "";

 
}

/* Block styles */

register_block_style(
    'core/gallery',
    array(
        'name'         => 'nbgimage',
        'label'        => __( 'nBGImage', 'textdomain' ),
        'style_handle' => 'custom-script-6',
    )
);
register_block_style(
    'core/image',
    array(
        'name'         => 'nrotate',
        'label'        => __( 'nRotate', 'textdomain' ),
        'style_handle' => 'custom-script-6',
    )
);

register_block_style(
    'core/image',
    array(
        'name'         => 'nghostly',
        'label'        => __( 'nGhostly', 'textdomain' ),
        'style_handle' => 'custom-script-6',
    )
);

register_block_style(
    'core/heading',
    array(
        'name'         => 'nsmoke',
        'label'        => __( 'nSmoke', 'textdomain' ),
        'style_handle' => 'custom-script-6',
    )
);

register_block_style(
    'core/image',
    array(
        'name'         => 'npath1',
        'label'        => __( 'nPath1', 'textdomain' ),
        'style_handle' => 'custom-script-6',
    )
);

register_block_style(
    'core/image',
    array(
        'name'         => 'nshattered',
        'label'        => __( 'nShattered', 'textdomain' ),
        'style_handle' => 'custom-script-6',
    )
);

register_block_style(
    'core/image',
    array(
        'name'         => 'nframe1',
        'label'        => __( 'nFrame 1', 'textdomain' ),
        'style_handle' => 'custom-script-6',
    )
);

register_block_style(
    'core/image',
    array(
        'name'         => 'nframe2',
        'label'        => __( 'nFrame 2', 'textdomain' ),
        'style_handle' => 'custom-script-6',
    )
);

register_block_style(
    'core/image',
    array(
        'name'         => 'nframe3',
        'label'        => __( 'nFrame 3', 'textdomain' ),
        'style_handle' => 'custom-script-6',
    )
);

register_block_style(
    'core/image',
    array(
        'name'         => 'nframe4',
        'label'        => __( 'nFrame 4', 'textdomain' ),
        'style_handle' => 'custom-script-6',
    )
);

register_block_style(
    'core/paragraph',
    array(
        'name'         => 'ConBG1',
        'label'        => __( 'Background 1', 'textdomain' ),
        'style_handle' => 'custom-script-6',
    )
);

function add_img_s1ze( $block_content = '', $block = [] ) {
  if ( isset( $block['blockName'] ) && 'core/image' === $block['blockName'] ) {
    $args2 = wp_parse_args( $block);
    $innr = $args2['attrs']['id'];
    $metadata = wp_get_attachment_metadata($innr);
    $width = $metadata['width'];
    $height = $metadata['height'];
    $lr5nfo = esc_url(wp_get_attachment_url($innr));
    $uploaded = get_the_time('', $innr);
    $date5 = get_the_date('M d, Y', $innr);
    $url3 = explode("/", $lr5nfo);
    $url4 = end($url3);
    $html2 = str_replace('</figure>', '<div class="dimensions">' . $url4 . '<br>---<br>' . $width . 'x' . $height . '</div></figure>', $block_content);
    //$html = str_replace('<a href=', '<a data-fancybox="gallery" href=', $block_content);

    return $html2;
}
  return $block_content;
}

add_filter( 'render_block', 'add_img_s1ze', 10, 2 );


function post_static_save( $post_id, $post ) {
    $title = $post->post_title;
    $title2 = preg_replace('/\//', '_', $title);
    $date3 = $post->post_date;
    $date2 = date('Y_m_d_G_H_i_', strtotime($date3));
    $titlebig = '<h1>' . $post->post_title . '</h1>';
    $pcontent = apply_filters('the_content', $post->post_content);
    $permalink = get_permalink( $post_id );
    if($post->post_type === 'post') {
        $myfile = fopen("/home/coax/websites/rnd/wp-content/static/posts/" . $date2 . '_' . $title2 . ".html", "w") or die("Unable to open file!");
    }
    if($post->post_type === 'page') {
        $myfile = fopen("/home/coax/websites/rnd/wp-content/static/pages/" . $date2 . '_' . $title2 . ".html", "w") or die("Unable to open file!");
    }
    fwrite($myfile, $titlebig);
    fwrite($myfile, $date2);
    fwrite($myfile, $pcontent);
    fclose($myfile);
}
add_action( 'publish_post', 'post_static_save', 10, 2 );
add_action( 'publish_page', 'post_static_save', 10, 2 );

add_filter( 'wp_lazy_loading_enabled', '__return_false' );



add_theme_support( 'post-thumbnails' );



function breadcrumb_links($content) {
    $parents = get_post_ancestors( $post->ID );
    $title2 = get_the_title($post->ID);
    $page_link2 = get_page_link($post->ID);
    $url = get_bloginfo('url');
    $title3 = get_the_title($url);

    foreach ($parents as $value) {
        $title = get_the_title($value);
        $page_link = get_page_link($value);
        $page_url = '<a href=' . $page_link .'>' . $title . '</a>';
        $item_output1 = $page_url .'<div class="sep3"> -> </div>'. $item_output1;
    }

    $page_url2 = '<a href=' . $page_link2 .'>' . $title2 . '</a>';
    $page_url3 = '<a href=' . $url .'>' . 'Home' . '</a>';
    $beforecontent = '<h2>' . $page_url3 .'<div class="sep3"> -> </div>'. $item_output1 . $title2 . '</h2>';
    $aftercontent = '';
    $fullcontent = $beforecontent .'<br>' . '<br>' . $content . $aftercontent;

    if ( is_page()  and !is_front_page() ) {
        return $fullcontent;
    } else {
        return $content;
    }
}

add_filter('the_content', 'breadcrumb_links');




#### Gallery Index page shortcode
#### Put [noxindex] shortcode in any page and it will grab all child pages with
#### featured images and their title and create a grid gallery right in the page
#### can be easily used to create galleries with sub galleries
### ADDED: Support for caption. Add a custom field called 'caption' in the individual sub pages and put in a short description
### and it will show in parentheses under the gallery thumbnail.

function noxindex_shortcode($atts) {
    global $post;

    if (!is_page() || !isset($post)) {
        return '';
    }

    $child_pages = get_pages(array(
        'post_type'      => 'page',
        'post_status'    => 'publish',
        'parent'         => $post->ID,
        'sort_column'    => 'menu_order, post_title',
        'sort_order'     => 'ASC',
    ));

    if (empty($child_pages)) {
        return '';
    }

    $output = '<ul class="subpages-list">';

    foreach ($child_pages as $child_page) {
        $link = get_permalink($child_page->ID);

        if (has_post_thumbnail($child_page->ID)) {
            $image = get_the_post_thumbnail($child_page->ID, 'thumbnail', array('alt' => esc_attr($child_page->post_title)));
            $output .= '<a href="' . esc_url($link) . '">' . $image . '</a><br>';
        } else {
            $output .= '<a href="' . esc_url($link) . '">' . esc_html($child_page->post_title) . '</a><br>';
        }
    }

    $output .= '</ul>';

    return $output;
}

add_shortcode('noxindex', 'noxindex_shortcode');

#### insert imdb info with shortcode (need movies-flm.db)
#### format: [noximdb imdb='tt1234567']
function n0x5_imdb($atts = [], $content = null, $tag = '') {
    $imdbid = $atts['imdb'];
    $dir = 'sqlite:/home/coax/websites/hidden3/html/databases/movies-flm.db';
    $dbh  = new PDO($dir, null, null, [PDO::SQLITE_ATTR_OPEN_FLAGS => PDO::SQLITE_OPEN_READONLY]) or die("cannot open the database");
    $query = "select * from flmlist where imdb like '%" . $imdbid . "%' group by imdb order by year desc";
    foreach ($dbh->query($query) as $row) {
        $im_final = $row[0] . '.jpg';
        $img_s = '<img width="200" src=https://hidden.machinecode.org/static/covers_flm/' . $im_final . '>' . '<br>';
        $eng_title = '<h2>' . $row[2] . ' ('. $row[8] .')'. '<br></h2>';
        $orig_title = 'English title: ' . $row[1] . '<br>';
        $director = 'Director: ' . $row[3] . '<br>';
        $year = 'Year: ' . $row[8] . '<br>';
        $plot = 'Plot: ' . $row[7] . '<br>';
        $country = 'Country: ' . $row[9] . '<br>';
        $language = 'Language: ' . $row[10] . '<br>';
        $actress = 'Actress: ' . $row[11] . '<br>';
        $genre = 'Genre: ' . $row[5] . '<br>';
        $final_value = $img_s . $eng_title . $orig_title . $director . $year . $genre . $plot . $actress . $country . $language;
        $img_dir = '/home/coax/websites/hidden3/html/static/flm_images/' . $imdbid;

    }
        if (file_exists($img_dir)) {
            $files = glob("$img_dir/*");
            sort($files, SORT_NATURAL | SORT_FLAG_CASE);
            foreach ($files as $file) {
                $file_final = explode("/", $file);
                $fil = $fil .  '<a href="https://hidden.machinecode.org/static/flm_images/' .  $file_final[8] . '/' . $file_final[9] . '"><img src="https://hidden.machinecode.org/static/flm_images/' . $file_final[8] . '/' . $file_final[9] . '" width="90" /></a>';
        	}
        }
    return '<div class="galstuff">' . $final_value . '<br>' . $fil . '</div>';
}
add_shortcode('noximdb', 'n0x5_imdb');



function dawn_content_filter( $content ) {
    return html_entity_decode( $content );
}
add_filter( 'the_content', 'dawn_content_filter', 1 );

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

function n0x_image($atts, $content = null, $tag = '') {
	# Shortcode to add a single image with metadata + custom caption
	# example: [noxi i="197" c="Building the case was relatively simple, though the PSU space was cramped"]
	# attachment id = 197, c = the caption
	# screenshot: https://i.imgur.com/iqd3M5K.png
	
	$a = shortcode_atts( array('i' => 'image', 'c' => 'the caption', ), $atts );
    $metadata = wp_get_attachment_metadata($a['i']);
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
    $url3 = wp_get_attachment_image_src($a["i"], 'full');

    return '<style>table, th, td {border: 1px solid black; border-collapse: collapse;}.meta3 {font-size: 10px;max-width: 260px;min-width:260px;}.img3 {max-width: 390px;min-width:390px;} .cap1 {font-size: 15px;}</style><div class="wp-block group"><table><tr><td class="img3"><a href="'. $url3[0] .'"><center>' . wp_get_attachment_image($a["i"], array( $attachment_size, 200 )) . '</center></a></div></td>'.
    '<div class="meta3"><td class="meta3">' .
	'<center><div class="cap1">' . $a['c'] . '</div><h3>---</h3>' .
    'Dimensions: '.$width.'x'.$height.'<br>
    Mimetype: '.$mimetype.'<br>
    Uploaded: '.$date3 .' '. $uploaded.'<br><br>
    Camera: ' .$camera.'<br>
    Copyright: ' .$copyright.'<br>
	Caption: '.$caption.'<br>
    Title: ' .$title3.'<br>
    Credit: ' .$credit.'<br><br>
    Date taken: ' .date('Y-m-d H:i:s', $timestamp).'<br>
    Aperture: ' .$aperture.'<br>
    Focal length: ' .$focal_length.'<br>
    Iso: ' .$iso.'<br>
    Shutter speed: ' .$shutter_speed.'<br>
    Orientation: ' .$orientation.'<br>
    Iso: ' .$iso.'<br>
    '
    .'</div></center></td></div></tr></table>';
}
add_shortcode('noxi', 'n0x_image');

