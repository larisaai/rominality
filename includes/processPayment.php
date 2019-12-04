<?php

//get array cart items and start creating the invoices
//we want to create the invoice for the user
//each invoice has the song id
require_once("../classes/Invoice_class.php");
//create a class that creates the invoice for the user and contains the seller id and number of items
session_start();
$cartItems = $_SESSION['cartItems'];

Invoice::create($_SESSION['user']['id'], count($cartItems), $cartItems);

$_SESSION['cartItems'] = array();

echo 'Invoice created. Payment complete.';
