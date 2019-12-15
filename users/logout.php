<?php
session_start();
$_SESSION['cartItems'] = array();
session_destroy();
header('Location: login.php');
