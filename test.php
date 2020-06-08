<?php

define('DB_USER', 'prjwebcir2');
define('DB_PASSWORD', 'userproject');
define('DB_NAME', 'prjwebcir2');
define('DB_SERVER', 'localhost');

function dbConnect()
  {
    try
    {
      $db = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_NAME.';charset=utf8',
        DB_USER, DB_PASSWORD);
    }
    catch (PDOException $exception)
    {
      error_log('Connection error: '.$exception->getMessage());
      return false;
    }
    return $db;
  }

//Connexion à la base de donnéee
$db= dbConnect();
if($db == false){
    echo 'fuck';
}else {
    echo 'yes';
}