<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Coureurs</title>
        <?php include('include.php'); ?>
        <!-- <link type="text/css" rel="stylesheet" href="css/main.css"> -->
        
    </head>
    <body>
        <?php 
          
            include('header.php');
        ?>

        <div id="content">

            <h1>Liste des coureurs</h1>
            <section>
                    <table id="coureurs" class="table table-stripped">
                        <thead>
                            <tr>
                                <th>Mail</th>
                                <th>Nom </th>
                                <th>Prénom </th>
                                <th>Date de Naissance</th>
                                <th>Numéro de licence</th>
                                <th>Club</th>
                                <th>Code INSEE</th>
                                <th>Valide</th>
                                <th>Categorie Age</th>
                                <th>Categorie Valeur</th> 
                            </tr>
                        </thead>

                        <tbody id="tbody">

                        </tbody>

                    </table>

                    <button type="button" id="Modifier">Modifier</button>

            </section>
            
        </div>



        <?php
            include('footer.php');
        ?>

    </body>
</html>
