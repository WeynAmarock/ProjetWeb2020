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
        $request = 'SELECT * FROM course';
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
        <title>Courses</title>
        <!-- <link type="text/css" rel="stylesheet" href="css/main.css"> -->
        
    </head>
    <body>
        <?php 
            include('include.php');           
            include('header.php');
        ?>
        <div id="content">
            <h1>Liste des courses</h1>
            <section>
                <form id="formulaire" method="POST" action="inscription.php">
                    <table id="courses" class="table table-stripped">
                        <tr>
                            <th>Id </th>
                            <th>Libelle</th>
                            <th>Date</th>
                            <th>Nombre de tour</th>
                            <th>Distance</th>
                            <th>Nombre coureurs</th>
                            <th>Longueur du Tour</th>
                            <th>Club</th>
                        </tr>
                        <tr>
                            <!-- affichage à l'écran sous forme de tableau -->
                            <?php foreach($result as $elt):?>
                        </tr>
                        <tr>
                            <td><?= $elt['id'] ?></td>
                            <td><?= $elt['libelle'] ?></td>
                            <td><?= $elt['date'] ?></td>
                            <td><?= $elt['nb_tour'] ?></td>
                            <td><?= $elt['distance'] ?></td>
                            <td><?= $elt['nb_coureur'] ?></td>
                            <td><?= $elt['longueur_tour'] ?></td>
                            <td><?= $elt['club'] ?></td>
                            <td><button type="submit" class="button" name="Inscription">Voir +<button></td>
                        </tr>
                            <?php endforeach; ?>
                    </table>
                    
                    
                </form>
            </section>
            
        </div>



        <?php
            include('footer.php');
        ?>

    </body>
</html>