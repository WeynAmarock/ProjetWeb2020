<?php

require_once('database.php');

//Connexion à la base de donnéee
$db= dbConnect();
if($db == false){
    header('HTTP/1.1 503 Service Unavailable');
    exit;
}

// Création d'un user
//C'est içi que l'on place en dur le mail du user
$mailUser = 'jlr@mental.com';
$user=dbCreateUser($db,$mailUser);


// On récupère la requete de ajax.js
$requestMethod = $_SERVER['REQUEST_METHOD'];
$request = substr($_SERVER['PATH_INFO'], 1);
$request = explode('/', $request);
$requestRessource = array_shift($request);

//On récupère l'id dans l'URL
$id= array_shift($request); //id du commentaire
if ($id == '')    $id= NULL;

//Si on veut les cyclistes
if($requestRessource=='cyclistes'){
    if($requestMethod=='GET'){
        $data=dbRequestCyclistes($db,$user.getClub(),$user.getAdmin());
    }

    sendJsonData($data,'GET');
}







function sendJsonData($data,$code){
    header('Content-Type: application/json');
    header('Cache-control: no-store, no-cache, must-revalidate');
    header('Pragma: no-cache');
    if ($data != NULL) {
        if ($code == 'POST') {
            header('HTTP/1.1 201 Created');
        } else {
            header('HTTP/1.1 200 OK');
        }
            echo json_encode($data);
    } else {
        header('HTTP/1.1 500 Internal Server Error');
    }
    exit();
}
