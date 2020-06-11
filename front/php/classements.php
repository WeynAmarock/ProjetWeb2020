<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Classements</title>
        <link type="text/css" rel="stylesheet" href="css/main.css">

    </head>
    <body>
        <?php 
            include('include.php');
            // include('header.php');
        ?>
        <div id="header">
			
            <div id="navbar">
                        
                <img id="logo" src="../images/velo.png" style=" width: 10%">
            
                <ul id="menu">
                    <li><a href="../index.html">Accueil</a></li>
                    <li><a href="coureurs.php">Mes Coureurs</a></li>
                    <li><a href="courses.php">Mes Courses</a></li>
                    <li><a href="classements.php" class="active">Mes Classements</a></li>
                </ul>

            </div>
        </div>
        <div id="contenu">
            <h1>Classements</h1>
        </div>




        <?php
            include('footer.php');
        ?>

    </body>
</html>
