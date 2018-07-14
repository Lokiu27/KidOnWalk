<?php

/*tgress
* Define PostgreSQL database server connect parameters.
*/
define('PGHOST','127.0.0.1');
define('PGPORT',5432);
define('PGDATABASE','playgroundsmap');
define('PGUSER', 'postgres');
define('PGPASSWORD', 'dr2709');
define('PGCLIENTENCODING','UNICODE');
define('ERROR_ON_CONNECT_FAILED','Sorry, can not connect the database server now!');

//получаем координаты
$coor=$_GET["coor"];
$coor=trim($coor, "()");
$YX=explode(", ", $coor);
$XY=$YX[1]." ".$YX[0];
$handle = fopen("file.txt", "w");
fwrite($handle, $XY);
fclose ($handle);

/*
* Merge connect string and connect db server with default parameters.
*/
$dbconn=pg_pconnect('host=' . PGHOST . ' port=' . PGPORT . ' dbname=' . PGDATABASE . ' user=' . PGUSER . ' password=' . PGPASSWORD);

// Выполнение SQL запроса
$query='select osm_id, ST_X(ST_Transform(p.way,4326)) as X, 
ST_Y(ST_Transform(p.way,4326)) as Y  from planet_osm_point p where 
leisure=\'playground\' order by ST_Distance(p.way, ST_GeomFromText(\'POINT('.$XY.')\', 3857)) limit 15;';
$result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());

// Start XML file, create parent node

$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each

while ($row = @pg_fetch_assoc($result)){
  // Add to XML document node
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("name",$row['osm_id']);
  $newnode->setAttribute("lat", $row['y']);
  $newnode->setAttribute("lng", $row['x']);
}

echo $dom->saveXML();

// Очистка результата
pg_free_result($result);

// Закрытие соединения
pg_close($dbconn);


?>

