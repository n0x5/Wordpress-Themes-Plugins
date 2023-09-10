<html>
<style>
p {
margin: 0px;
padding: 0px;
}
</style>

<body>
<div id="content" style="width:900px">
<?php
$dir = 'sqlite:/home/coax/websites/mc/movies_flm_new.db';
$dbh  = new PDO($dir, null, null, [PDO::SQLITE_ATTR_OPEN_FLAGS => PDO::SQLITE_OPEN_READONLY]) or die("cannot open the database");
$query = "select * from moviesflm order by year desc";

foreach ($dbh->query($query) as $row) {
    $obj = json_decode($row[12]);
    $txt = sprintf(
    '<div style="background-color:#c9c9c9;color:black;padding:3px;margin:5px;" class="movie">
    <img style="width:200px;" src="covers_flm/%s.jpg" />
    <h2>Title: %s (%s)</h2>
    <p>Country: %s</p>
    <p>Language: %s</p>
    <p>Description: %s</p>
    <p>Keywords: %s</p>
    <p>Age rating: %s</p>
    </div>',
    $row[0], $obj->name, $row[8], $row[10], $row[9], $obj->description, $obj->keywords, $obj->contentRating);

    echo $txt;
}
?>

</div>
</body>
</html>
