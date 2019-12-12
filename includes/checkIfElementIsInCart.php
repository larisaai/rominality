<?php
session_start();

$songId = $_GET['song_id'];

empty($_SESSION['cartItems']) ? $_SESSION['cartItems'] = array() : $cartSongs = $_SESSION['cartItems'];

$cartSongs = $_SESSION['cartItems'];
$found = 0;

foreach ($cartSongs as $song) {
    if ($song['id'] == $songId) {
        $found = 1;
    }
}

if ($found == 1) {
    echo '{"status": "1"}';
} else {
    echo '{"status": "0"}';
}
