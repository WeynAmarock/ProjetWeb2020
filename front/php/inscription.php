
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Inscriptions</title>
        <!-- <link type="text/css" rel="stylesheet" href="css/main.css"> -->
        <?php 
            include('include.php');           
            // include('header.php');
            include('footer.php');
        ?>
    </head>
    <body>
        <div id="header">
			
            <div id="navbar">
                        
                <img id="logo" src="../images/velo.png" style=" width: 10%">
            
                <ul id="menu">
                    <li><a href="../index.html">Accueil</a></li>
                    <li><a href="coureurs.php">Mes Coureurs</a></li>
                    <li><a href="courses.php" class="active">Mes Courses</a></li>
                    <li><a href="classements.php">Mes Classements</a></li>
                </ul>

            </div>
        </div>
        <div id="content">
           
            <section>
                <form id="formulaire" method="POST">
                    <h1>Coureurs inscrits pour</h1>
                    <div id="course_name"></div>
                    <table id="inscrits" class="table table-stripped">
                        <tr>
                            <th>Nom </th>
                            <th>Prénom </th>
                            <th>Club</th>
                            <th>Numéro de licence</th>
                            <th>Mail</th>
                            <th>Inscription</th>
                        </tr>
                        <tr>
                           
                    </table>
                    <h1>Coureurs non inscrits</h1>
                    <table id="non_inscrits" class="table table-stripped">
                        <tr>
                            <th>Nom </th>
                            <th>Prénom </th>
                            <th>Club</th>
                            <th>Numéro de licence</th>
                            <th>Mail</th>
                            <th>Inscription</th>
                        </tr>
                        <tr>
                           
                    </table>
                    <button type="submit" name="btnSub" class="button">Valider</button>
                </form>
            </section>
            
        </div>

    </body>
</html>
