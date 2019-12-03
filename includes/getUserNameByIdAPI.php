<?php

require_once('../classes/User_class.php');

$userId = $_GET['user_id'];

$name = User::getUserFIrstnameById($userId);
$sName = json_encode($name['firstname']);

echo '{"status":1 ,"name":' . $sName . '}';
