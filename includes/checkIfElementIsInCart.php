<?php
session_start();

$songId = $_GET['song_id'];

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
