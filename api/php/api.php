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

if ($requestMethod == 'OPTIONS')
{
header('HTTP/1.1 200 OK');
exit;
}

//On récupère l'id dans l'URL
$id= array_shift($request); //id du commentaire
if ($id == '')    $id= NULL;

//Si on veut les cyclistes
if($requestRessource=='cyclistes'){
    if($requestMethod=='GET'){
        $data=dbRequestCyclistes($db,$user->getClub(),$user->getAdmin());
    }
    if($requestMethod=='PUT'){
        parse_str(file_get_contents('php://input'), $_PUT);
        if(isset($_PUT['mail']) && isset($_PUT['nom']) && isset($_PUT['prenom'])&& isset($_PUT['num_licence'])
                && isset($_PUT['date']) && isset($_PUT['club']) && isset($_PUT['valide'])){  

            $data=dbModifyCyclist($db,$_PUT['mail'],$_PUT['nom'],$_PUT['prenom'],
                $_PUT['num_licence'],$_PUT['date'],$_PUT['club'],$_PUT['valide']);

        }
    }
}

//Si on veut les code INSEE
if($requestRessource=='code_insee'){
    if($requestMethod=='GET'){
        $data=dbRequestCodeInsee($db);
    }
}

//Si on veut les code INSEE
if($requestRessource=='club'){
    if($requestMethod=='GET'){
        $data=dbRequestClub($db);
    }
}

//Si on veut les courses
if($requestRessource=='courses'){
    if($requestMethod=='GET'){
        if(!$id){
            $data=dbRequestRaces($db);
        }else{
            $data=dbRequestCyclistOnRace($db,$user->getClub(),$user->getAdmin(),$id);
        }        
    }

    if($requestMethod=='POST'){
        if (isset($_POST['id']) && isset($_POST['mail'])) {
            $data=dbAddCyclistOnRace($db,$_POST['mail'],$_POST['id']);
        }
    }

    if($requestMethod=='DELETE'){
        if($id){
            $datat=dbDeleteCyclistOnRace($db,$id); //Pas sûr
        }
    }
}


sendJsonData($data,$requestMethod);





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

