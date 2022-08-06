<?php

$firstname = explode(" ",the_title('','',false));
$firstname1 = $firstname[0]._.$firstname[1]._.$post->ID;
$lastname = $firstname[1];
$title = $firstname1;
$zipname1 = "$title.zip";
$time2 = get_post_time('Y/m');
$uploads = wp_upload_dir($time2);
$uploa3 = $uploads['path'];
$uploa3url = $uploads['url'];
$zipname = "$uploa3/$zipname1";
$zipnameurl = "$uploa3url";

if (file_exists($zipname)) {
  echo "<div class=\"zipit\"><a href=\"$zipnameurl/$firstname1.zip\">$firstname1.zip</a></div>";

} else {
echo "<div class=\"zipit\">No zip file found, open post to create!</div>";
}

?>
