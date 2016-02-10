<!DOCTYPE HTML>
<html>
    <head>
        <meta charset= "utf-8" />
        <link rel = "stylesheet" href="css/insc-o.css"/>
        <link rel = "stylesheet" href="css/global.css"/>
        <title> Inscription - Organisme </title>
      
    </head>
    <script src="script/global.js"></script>
    <body>
        <div class="contenu">
            <header>
                <div class="top">
                    <img href="index.php" src="images/logofinal.png" width="200px" height="200px"/>
                    <h1 id ="slogan">Comp Foundation<br/>Opportunity, Quality, Achievement</h1>
                </div>
                <div class="nav">
                    <ul id="menu">
                        <li><a href="index.php">Accueil</a>
                        <li><a>Inscription</a>
                            <ul>
                                <li><a href="insc-i.php">Intervenant</a></li>
                                <li><a href="insc-o.php">Organisme</a></li>
                                <li><a href="insc-cont-org.php">Contact d'organisme</a></li>
                            </ul>
                        </li>
                        <li><a href="recherche.php">Recherche</a></li>
                        <li><a href="post-a.php">Poster une annonce</a></li>
                        <li><a href="contact.php">Contact</a>
                    </ul>
                </div>
            </header>
            <div class="wrapper">
           
               <h1>Organisme : </h1>
                
               <form action="<?php $_PHP_SELF?>" method ="post">
               <?php
               $dbConn = mysqli_connect('localhost', 'root', 'toor');
                mysqli_select_db($dbConn, 'compfundationdb');               
                print('<p>Nom *: <input type ="text" name="editNom" required ></p>');
                print('<p>Email *: <input type ="text" name="editMail" id ="email" required></p>');
                print('<p>Téléphone *: <input type ="text" name="editTel" required></p>');
                print('<p>Code Postal *: <input type ="text" name="editCP"required ></p>');
                print('<p>Ville *: <input type ="text" name="editVille" required> </p>');
                print('<p> Les champs possédant une étoile (*) sont obligatoires. </p>');

                   if (count($_POST) > 0) {
                       $nom = $_POST['editNom'];
                       $mail = $_POST['editMail'];
                       $tel = $_POST['editTel'];
                       $cp = $_POST['editCP'];
                       $ville = $_POST['editVille'];
                       $SQLQuery = "INSERT INTO organisme (org_nom ,org_email,  org_telephone  , org_codepostal, org_ville) VALUES('" . $nom . "','" . $mail . "','" . $tel . "','" . $cp . "','" . $ville . "')";
                       mysqli_query($dbConn, $SQLQuery);
                       $selectlastID = mysqli_query($dbConn, "SELECT LAST_INSERT_ID()");
                       $lastID = mysqli_fetch_array($selectlastID);
                       $id = $lastID[0];
                       print('<p>Organisme inscrit, redirection ...</p>');
                       print('<meta http-equiv="refresh" content="3;url=insc-cont-org.php?id='.$id.'" />');
                   }
                ?>
                   
                <div class = "bouton">
                <a href="insc-o.php"><input class = "valider" type ="submit" value="Valider !"></a>
                </div>
                </form>
            </div>
            <div class="push"></div>
        </div>
        </div>
        <div class="footer">
            <a onclick="funcMentionsLegales()">Mentions légales</a> --- Copyright &#169 Comp Foundation - 2015
        </div>
    </body>
</html>
