<?php

require_once("../classes/Song_class.php");
require_once("../classes/User_class.php");


$randomSongs = Song::getRandomSongs();

$songWithImage = array();

foreach ($randomSongs as $song) {
    array_push($song, User::getUserImageById($song['user_id']));
    array_push($songWithImage, $song);
}

$sRandomSongs = json_encode($songWithImage);

echo '{"status": 1, "items": ' . $sRandomSongs . '}';
