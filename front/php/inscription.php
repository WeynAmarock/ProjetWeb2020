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
        <title>Inscriptions</title>
        <!-- <link type="text/css" rel="stylesheet" href="css/main.css"> -->
        
    </head>
    <body>
        <?php 
            include('include.php');           
            include('header.php');
        ?>
        <div id="content">
            <h1>Coureurs inscrits</h1>
            <section>
                <form id="formulaire" method="POST">
                    <table id="coureurs" class="table table-stripped">
                        <tr>
                            <th>Nom </th>
                            <th>Prénom </th>
                            <th>Club</th>
                            <th>Numéro de licence</th>
                            <th>Mail</th>
                            <th>Inscription</th>
                        </tr>
                        <tr>
                            <!-- affichage à l'écran sous forme de tableau -->
                            <?php foreach($result as $elt):?>
                        </tr>
                        <tr>
                            <td><?= $elt['nom'] ?></td>
                            <td><?= $elt['prenom'] ?></td>
                            <td><?= $elt['club'] ?></td>
                            <td><?= $elt['num_licence'] ?></td>
                            <td><?= $elt['mail'] ?></td>
                            <td><input type="checkbox" name="<?php echo 'n°'.$elt['num_licence'];?>"></td>
                    
                        </tr>
                            <?php endforeach; ?>
                    </table>
                    <button type="submit" name="btnSub" class="button">Valider</button>
                </form>
            </section>
            
        </div>



        <?php
            include('footer.php');
        ?>

    </body>
</html>