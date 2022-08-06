<?php
/*
Template Name: Search Page Template Test 2
*/
?>

<p><a href="/">Home</a></p>


<form method='post' action='/search-page'>
<div><input type='text' name='fname' placeholder='File name'>
<input type='submit'>
</div>
</form>




<?php
if(isset($_GET['fname'])) {
    $srch = $_GET['fname'];
} else {
    $srch = $_POST["fname"];;

echo "search term: $srch <br><br>";
}
?>

<title><?php echo "$srch results page"; ?></title>
<p><?php echo "<a href='/search-page?fname=$srch'>/search-page?fname=$srch<a><br><br>" ?>


<?php
// function courtesy of https://stackoverflow.com/a/2510459
function formatBytes($bytes, $precision = 2) {
    $units = array('B', 'KB', 'MB', 'GB', 'TB');

    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);

    // Uncomment one of the following alternatives
    // $bytes /= pow(1024, $pow);
     $bytes /= (1 << (10 * $pow));

    return round($bytes, $precision) . ' ' . $units[$pow];
}
?>

<?php
global $wpdb;

$wild = '%';
$fin = $wild . $wpdb->esc_like($srch) . $wild;
$sql = "SELECT * FROM  $wpdb->posts WHERE post_type = 'attachment' and SUBSTR(guid, 45) LIKE replace(%s, ' ', '%') ORDER BY id desc";
$result  = $wpdb->get_results($wpdb->prepare($sql, $fin));

$count = count($result);
$cur_dir = getcwd();
//echo $cur_dir;
echo "Images found: $count <br><br>";
foreach ( $result as $posts ) {
   $result2 = $wpdb->get_results("SELECT * FROM $wpdb->postmeta WHERE post_id = '$posts->ID'");
    foreach ( $result2 as $metastuff ) {
      $attachment_data_array=unserialize($metastuff->meta_value);
      $width = $attachment_data_array['width'];
      $height = $attachment_data_array['height'];
      $file = $attachment_data_array['file'];
      $caption = $attachment_data_array['image_meta']['caption'];
      $copyright = $attachment_data_array['image_meta']['copyright'];
      $aperture = $attachment_data_array['image_meta']['aperture'];
      $camera = $attachment_data_array['image_meta']['camera'];
      $time = $attachment_data_array['image_meta']['created_timestamp'];
      $credit = $attachment_data_array['image_meta']['credit'];
      $title = $attachment_data_array['image_meta']['title'];
      $keywords2 = $attachment_data_array['image_meta']['keywords'][0];
      $keywords = $attachment_data_array['image_meta']['keywords'];
      //echo 'image meta:<br>';
     //print_r( $attachment_data_array);
      //echo "$width $height";
   }
   $time2 = gmdate('Y-m-d', $time);
   //print_r( $attachment_data_array);
   $file2 = $cur_dir . '/wp-content/uploads/' . $file;
   $fsize1 = filesize($file2);
   $fsize = formatBytes($fsize1);
   foreach ($keywords as $columnName => $columnData);
   echo "<a href='$posts->guid'><img height='230' src='$posts->guid' /></a>File: $file, Dimensions: $width x $height, File size: $fsize, Title: $title, Caption: $caption, Copyright: $copyright, Camera: $camera, Date: $time2, Keywords: $keywords2, $columnData, Credit: $credit";
   echo " <a href='?p=$posts->post_parent'>?p=$posts->post_parent<a/><br><br>";
}
?>
