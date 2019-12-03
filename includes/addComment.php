<?php


session_start();
require_once('../classes/Comment_class.php');

$userId = $_SESSION['user']['id'];
$songId = $_GET['songId'];
$commentBody = $_GET['commentBody'];

$comment = Comment::create($userId, $songId, $commentBody);

echo '{"status": 1, "message": "all good"}';
