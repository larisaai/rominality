<?php

require_once("../classes/Song_class.php");
require_once("../classes/User_class.php");

session_start();
$userId = $_SESSION['user']['id'];

$songWithImage = array();

$mySongs = Song::getSongsBasedOnUserId($userId);

foreach ($mySongs as $song) {
    array_push($song, User::getUserImageById($song['user_id']));
    array_push($songWithImage, $song);
}
$sMySongs = json_encode($songWithImage);

echo '{"status": 1, "items": ' . $sMySongs . '}';
