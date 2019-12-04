<?php

require_once("../classes/Song_class.php");

$randomSongs = Song::getRandomSongs();
$sRandomSongs = json_encode($randomSongs);

echo '{"status": 1, "items": ' . $sRandomSongs . '}';
