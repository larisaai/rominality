<?php


session_start();
require_once('../classes/Comment_class.php');

$allComments = Comment::read();

$sAllComments = json_encode($allComments);

echo '{"status":1 ,"comments":' . $sAllComments . '}';
