
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
                            <th>Mail</th>
                            <th>Nom </th>
                            <th>Prénom </th>
                            <th>Club</th>
                            <th>Date de Naissance</th>
                            <th>Numéro de licence</th>
                            <th>Categorie Age</th>
                            <th>Categorie Valeur</th>
                            
                        </tr>
                       
                    </table>
                    
                    
                </form>
            </section>
            
        </div>



        <?php
            include('footer.php');
        ?>

    </body>
</html>
