<?php

session_start();
require_once('../classes/Song_class.php');


if (empty($_SESSION['cartItems'])) {
    $_SESSION['cartItems'] = array();
}

$items = json_encode($_SESSION['cartItems']);

echo '{"status": 1, "items": ' . $items . '}';
