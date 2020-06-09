<?php
function dbConnect()
{
    require_once('constants.php');
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
function AfficheElements($bdd){     //fonction permettant de récupérer les élements de la table à l'écran sous forme de tableau
    try {
        $request = 'SELECT * FROM cycliste';
        $statement = $bdd->prepare($request);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $exception) {
        error_log('Request error: ' .$exception->getMessage());
        return false;
    }
    return $result;
}

// function UpdateBDD($bdd, $nom, $mail){        //fonction censée permettre de mettre à jour les élements de la base de données
    
// }

$bdd = dbConnect();
    if (!$bdd) {
    	echo "Problème de connexion à la bdd.";
    	exit();
    }

    // On récupère les types et leurs états
    $result = AfficheElements($bdd);

    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Coureurs</title>
        <!-- <link type="text/css" rel="stylesheet" href="css/main.css"> -->
        
    </head>
    <body>
        <?php 
            include('include.php');           
            include('header.php');
        ?>
        <div id="content">
            <h1>Liste des coureurs</h1>
            <section>
                <form id="formulaire" method="POST">
                    <table id="coureurs" class="table table-stripped">
                        <tr>
                            <th>Nom </th>
                            <th>Prénom </th>
                            <th>Club</th>
                            <th>Mail</th>
                            <th>Date de Naissance</th>
                            <th>Numéro de licence</th>
                        </tr>
                        <tr>
                            <!-- affichage à l'écran sous forme de tableau -->
                            <?php foreach($result as $elt):?>
                        </tr>
                        <tr>
                            <td><input type="text" value="<?= $elt['nom'] ?>"></td>
                            <td><input type="text" value="<?= $elt['prenom'] ?>"></td>
                            <td><input type="text" value="<?= $elt['club'] ?>"></td>
                            <td><input type="text" value="<?= $elt['mail'] ?>"></td>
                            <td><input type="text" value="<?= $elt['date_naissance'] ?>"></td>
                            <td><input type="text" value="<?= $elt['num_licence'] ?>"></td>
                        </tr>
                            <?php endforeach; ?>
                    </table>
                    <button type="submit" class="button" name="btnSub">Valider</button>
                    
                </form>
            </section>
            
        </div>



        <?php
            include('footer.php');
        ?>

    </body>
</html>