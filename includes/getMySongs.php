<?php

require_once("../classes/Song_class.php");

session_start();
$userId = $_SESSION['user']['id'];

$mySongs = Song::getSongsBasedOnUserId($userId);
$sMySongs = json_encode($mySongs);

echo '{"status": 1, "items": ' . $sMySongs . '}';
