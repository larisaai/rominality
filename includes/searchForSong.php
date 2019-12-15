<?php

require_once('../classes/Song_class.php');
require_once("../classes/User_class.php");

$value = Song::searchSong($_GET['currentSearch']);

$songWithImage = array();

foreach ($value as $song) {
    array_push($song, User::getUserImageById($song['user_id']));
    array_push($songWithImage, $song);
}

$sValue = json_encode($songWithImage);

echo '{"status": 1, "items": ' . $sValue . '}';
