<?php

    include 'database.php';

    // Connexion à la base de donéees
    $bdd = dbConnect();
    if (!$bdd) {
        echo "Problème de connexion à la bdd.";
        header('HTTP/1.1 503 Service Unavailable');
    	exit();
    }
    // else{
    //     echo 'OK';   //Connexion vérifiée
    // }

    // $requestMethod = $_SERVER['REQUEST_METHOD'];
    // echo $requestMethod;    //GET
    
    header('Content-Type: text/plain; charset=utf-8');
    header('Cache-control: no-store, no-cache, must-revalidate');
    header('Pragma: no-cache');
    header('HTTP/1.1 200 OK');

    