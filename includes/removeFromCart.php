<?php

//get the id of the song
//add song id in session array
//echo json string
session_start();
require_once('../classes/Song_class.php');

function error()
{
    echo '{"status": 0, "itemNumber": "' . count($_SESSION['cartItems']) . '", "message":"Song has been added to the cart"}';
    exit;
}

$song = Song::getSong($_GET['songId']);
$key  = array_search($_GET['songId'], array_column($_SESSION['cartItems'], 'id'));

unset($_SESSION['cartItems'][$key]);
$_SESSION['cartItems'] = array_values($_SESSION['cartItems']);

foreach ($_SESSION['cartItems'] as $song) { }

echo '{"status": 1, "message":"Song has been removed from the cart","attributes":' . $key . ', "items": ' . json_encode($_SESSION['cartItems']) . '}';
