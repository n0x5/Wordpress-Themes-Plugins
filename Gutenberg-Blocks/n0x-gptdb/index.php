<?php
/**
 * Plugin Name: n0x gpt
 */

function n0x_gpt_register_block( $block_attributes, $content ) {


$dir = 'sqlite:/home/coax/websites/secondsight/wp-content/gpt.db';
$dbh  = new PDO($dir, null, null, [PDO::SQLITE_ATTR_OPEN_FLAGS => PDO::SQLITE_OPEN_READONLY]) or die("cannot open the database");
$query = "select distinct(lower(main_question)) from prompt_suggestions order by main_question collate NOCASE";

$cart = array();
foreach ($dbh->query($query) as $row) {

    array_push($cart, $row[0]);
    }


foreach ($cart as $quest) {
    $query2 = "select question, answer, followup, followupanswer, keywords from prompt_suggestions where main_question like '".$quest."'";
    $stuff = $stuff . '<!-- wp:details {"summary":'.$quest.'"} -->
        <details class="wp-block-details"><summary>'.ucfirst($quest).'</summary><!-- wp:paragraph {"placeholder":"Type / to add a hidden block"} -->';
    foreach ($dbh->query($query2) as $row2) {
            $stuff = $stuff . '<div class="questionmain"><p class="question2">' . $row2[0]   .'</p>' . '<p class="answer2">' . $row2[1]   .'</p>' . '<p class="followup2">' . $row2[2]   .'</p><p class="followup2">' . $row2[3]   .'</p><p class="followup3">' . $row2[4]   .'</p></div>';
        }
        $stuff = $stuff . '<!-- /wp:paragraph --></details><!-- /wp:details -->';
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


