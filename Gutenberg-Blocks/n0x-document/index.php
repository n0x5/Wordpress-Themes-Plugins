<?php
/**
 * Plugin Name: n0x document
 */

function n0x_document_register_block( $block_attributes, $content ) {

if (isset($_GET['doc'])) {
    $srch = $_GET['doc'];
    } 
else {
    $srch = $_POST['doc'];
}
// access $srch by adding "?doc=SEARCHWORD" to end of url

if (isset($_POST['doc'])) {
    $redir = add_query_arg( 'doc', $srch );
    wp_safe_redirect($redir); 
    exit();
}


$dir = '/home/coax/websites/secondsight/wp-content/documents/websites/';
$files1 = scandir($dir);

foreach ($files1 as $file) {
    if ($file != '.' and $file != '..') {
        $files2 = scandir($dir . '/' . $file, SCANDIR_SORT_ASCENDING);
        $html2 = $html2 . '<!-- wp:details {"summary":'.$file.'"} -->
        <details class="wp-block-details"><summary>'.ucfirst($file).'</summary><!-- wp:paragraph {"placeholder":"Type / to add a hidden block"} -->';
        foreach ($files2 as $html) {
            if (str_contains($files2, '.html') and $html != '.' and $html != '..' and strpos($html, '_images') == false and strpos($html, '_files') == false) {
                $full_folder = '<a href="' . '/wp-content/documents/websites/' . $file . '/' . $html . '">' . $html . '</a>';
                $html2 = $html2 . '<div class="questionmain">' . $full_folder . '</div>';
                }
            }
        $html2 = $html2 . '<!-- /wp:paragraph --></details><!-- /wp:details -->';
        }
    }
return $html2;
}

function n0x_document() {
    $asset_file = include( plugin_dir_path( __FILE__ ) . 'block.asset.php');

    wp_register_script(
        'n0x/document',
        plugins_url( 'block.js', __FILE__ ),
        $asset_file['dependencies'],
        $asset_file['version']
    );

    register_block_type( 'n0x/document', array(
        'api_version' => 2,
        'editor_script' => 'n0x/document',
        'render_callback' => 'n0x_document_register_block'
    ) );

}
add_action( 'init', 'n0x_document' );
