<?php

require_once("../classes/Song_class.php");

$rowVal = $_POST['row'];
$mySongs = Song::all($rowVal);
$sMySongs = json_encode($mySongs);

echo '{"status": 1, "items": ' . $sMySongs . '}';
