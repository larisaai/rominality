<?php

//get the id of the song
//add song id in session array
//echo json string
session_start();
require_once('../classes/Song_class.php');
empty($_SESSION['cartItems']) ? $_SESSION['cartItems'] = array() : $itemNumber = count($_SESSION['cartItems']);

function error()
{
    echo '{"status": 0, "itemNumber": "' . count($_SESSION['cartItems']) . '", "message":"Song has been added to the cart"}';
    exit;
}


$song = Song::getSong($_GET['songId']);
foreach ($_SESSION['cartItems'] as $item) {
    if ($item['id'] == $song['id']) {
        error();
    }
}
array_push($_SESSION['cartItems'], $song);

$itemNumber = count($_SESSION['cartItems']);

echo '{"status": 1, "itemNumber": "' . count($_SESSION['cartItems']) . '", "message":"Song has been added to the cart"}';
