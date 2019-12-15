<?php

require_once("../classes/Invoice_class.php");
require_once("../classes/User_class.php");

session_start();
$userId = $_SESSION['user']['id'];

$songWithImage = array();

$boughtSongs = Invoice::getSongsBasedOnBuyerId($userId);

foreach ($boughtSongs as $song) {
    array_push($song, User::getUserImageById($song['user_id']));
    array_push($songWithImage, $song);
}

$sBoughtSongs = json_encode($songWithImage);

echo '{"status": 1, "items": ' . $sBoughtSongs . '}';
