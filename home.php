<?php
// check if the user is logged
// not logged, take the user to the login page
session_start();
if( !$_SESSION['jUser'] ){
  header('Location: login.php');
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Rominimal</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/home.css">
</head>
<body>
  

<div class="container">

  <div class="top">
    <div id="logo">rominimal</div>
    <?php




    
    ?>
    
    <div><a href="logout.php">logout</a></div>
  </div>


  <div class="content">
<h1> Lastest realises</h1>

   

  </div>

</div>


<?php
  $sScript = 'home.js';
  require_once './components/bottom.php';


