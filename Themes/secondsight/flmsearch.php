<html>
<style>
p, h4 {
margin: 0px;
padding: 0px;
font-weight: 400;
font-size: 13px;
font-family: monospace;
}
h2 {
margin: 0px;
padding: 0px;

}
.expanded {
  animation-duration: 0.3s;
}
.movie2 {
margin-left: 30px;
}
b {
color: #0058c9;
}
</style>
<title>List of films</title>
<body>
<div id="content" style="width:900px">
<h1>List of films</h1>
<hr>
<?php
$dir = 'sqlite:/home/coax/websites/mc/flm_search_combine.db';
$dbh  = new PDO($dir, null, null, [PDO::SQLITE_ATTR_OPEN_FLAGS => PDO::SQLITE_OPEN_READONLY]) or die("cannot open the database");
$query = "select country, count(country) as c, imdb_id from flm_combine group by country order by c desc";

foreach ($dbh->query($query) as $row3) {
    echo '<h4><a href="#'. $row3[0] . '">' . $row3[0] . '</a> (' . $row3[1] . ' titles)</h4>';
}
echo '<hr>';
foreach ($dbh->query($query) as $row) {
    echo '<details><summary><h2 id="'. $row[0] .'">' . $row[0] . ' (' . $row[1] . ' titles)</h2></summary>';
    $query2 = sprintf("select * from flm_combine where country == '%s' and country not like '' order by title_year desc, actress asc", $row[0]);
    foreach ($dbh->query($query2) as $row2) {
            $txt = sprintf(
            '<div style="background-color:#c9c9c9;color:black;padding:3px;margin:5px;font-size:13px;margin-left:55px;" class="movie">
            <h2 style="color:#bd0000;">%s (%s years old)</h2>
            <div class="movie2">
            <p style="font-size:15px;font-weight:bold;">%s (%s)</hp>
            <p><b>Country:</b> %s</p>
            <p><b>Language:</b> %s</p>
            <p><b>Description:</b> %s</p>
            <p><b>Keywords:</b> %s</p>
            <p><b>Genres:</b> %s</p>
            <p><b>Age rating:</b> %s</p>
            </div>
            </div>',
            $row2[0], $row2[8], $row2[4], $row2[6], $row2[9], $row2[10], $row2[12], $row2[15], $row2[14], $row2[13]);

            echo $txt;
    }
echo '</details><hr>';
}
?>

</div>
</body>
</html>

