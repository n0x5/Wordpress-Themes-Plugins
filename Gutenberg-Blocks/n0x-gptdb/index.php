<?php
/**
 * Plugin Name: n0x gpt
 */

function n0x_gpt_register_block( $block_attributes, $content ) {


$dir = 'sqlite:/home/coax/websites/secondsight/wp-content/gpt.db';
$dbh  = new PDO($dir, null, null, [PDO::SQLITE_ATTR_OPEN_FLAGS => PDO::SQLITE_OPEN_READONLY]) or die("cannot open the database");
$query = "select main_question, question, answer, followup from prompt_suggestions order by main_question asc";
foreach ($dbh->query($query) as $row) {
    $stuff = $stuff . '<!-- wp:details {"summary":'.$row[0].'"} -->
<details class="wp-block-details"><summary>'.$row[1].' ('.$row[0].')</summary><!-- wp:paragraph {"placeholder":"Type / to add a hidden block"} -->
<p>'.$row[2].'</p><p>'.$row[3].'</p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->';
    }
    
return $stuff;
}

function n0x_gpt() {
    $asset_file = include( plugin_dir_path( __FILE__ ) . 'block.asset.php');

    wp_register_script(
        'n0x/gpt',
        plugins_url( 'block.js', __FILE__ ),
        $asset_file['dependencies'],
        $asset_file['version']
    );

    register_block_type( 'n0x/gpt', array(
        'api_version' => 2,
        'editor_script' => 'n0x/gpt',
        'render_callback' => 'n0x_gpt_register_block'
    ) );

}
add_action( 'init', 'n0x_gpt' );


