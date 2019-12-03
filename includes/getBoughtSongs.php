<?php

require_once("../classes/Invoice_class.php");

session_start();
$userId = $_SESSION['user']['id'];

$boughtSongs = Invoice::getSongsBasedOnBuyerId($userId);
$sBoughtSongs = json_encode($boughtSongs);

echo '{"status": 1, "items": ' . $sBoughtSongs . '}';
