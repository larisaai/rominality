<?php

try{
  $sUserName = 'root';
  $sPassword = '';
  $sConnection = "mysql:host=localhost; dbname=rominimal; charset=utf8";

  $aOptions = array(
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  );
  $db = new PDO( $sConnection, $sUserName, $sPassword, $aOptions );

}catch( PDOException $e){
  echo '{"status":"err","message":"cannot connect to database"}';
  exit();
}






