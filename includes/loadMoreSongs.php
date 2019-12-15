<?php

require_once("../classes/Song_class.php");
require_once("../classes/User_class.php");

$rowVal = $_POST['row'];
$mySongs = Song::all($rowVal);

$songWithImage = array();

foreach ($mySongs as $song) {
    array_push($song, User::getUserImageById($song['user_id']));
    array_push($songWithImage, $song);
}
$sMySongs = json_encode($songWithImage);

echo '{"status": 1, "items": ' . $sMySongs . '}';
