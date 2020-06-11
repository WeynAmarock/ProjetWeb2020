<!--  -->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Courses</title>
        <?php 
            include('include.php');           
            //include('header.php');
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
                        
                    </table>
                    
                    
                </form>
            </section>
            
        </div>

    </body>
</html>
