<!DOCTYPE HTML>
<html>
<head>
    <meta charset= "utf-8" />
    <link rel = "stylesheet" href="css/index.css"/>
    <link rel = "stylesheet" href="css/global.css"/>
    <title> Contact - Organisme </title>
</head>
<script src="script/global.js"></script>
<body>
<div class="contenu">
    <header>
        <div class="top">
            <img href="index.php" src="images/logofinal.png" width="200px" height="200px"/>
            <h1 id ="slogan">Comp Foundation<br/>Connecting people</h1>
        </div>
        <div class="nav">
            <ul id="menu">
                <li><a href="index.php">Accueil</a>
                <li><a>Inscription</a>
                    <ul>
                        <li><a href="insc-i.php">Intervenant</a></li>
                        <li><a href="insc-o.php">Organisme</a></li>
                    </ul>
                </li>
                <li><a>Recherche</a>
                    <ul>
                        <li><a href="rech-i.php">Intervenant</a></li>
                        <li><a href="rech-o.php">Organisme</a></li>
                    </ul>
                </li>
                <li><a href="contact.php">Contact</a>
            </ul>
        </div>
    </header>
    <div class="wrapper">


        <form action="<?php $_PHP_SELF?>" method ="post">
            <?php
            $dbConn = mysqli_connect('localhost', 'root', 'toor');
            mysqli_select_db($dbConn, 'compfundationdb');

            $id = $_GET["id"];
            $recupNomOrg = mysqli_query($dbConn, "SELECT org_nom FROM organisme WHERE org_id = $id");
            $orgTab = mysqli_fetch_array($recupNomOrg);
            $nomOrg = $orgTab[0];








            print(' <h1>Contact - '.$nomOrg.' : </h1>');
            print('<p>Nom *: <input type ="text" name="editNom" required ></p>');
            print('<p>Prenom *: <input type ="text" name="editPrenom" required ></p>');
            print('<p>Email *: <input type ="text" name="editMail" id ="email" required></p>');
            print('<p>Téléphone *: <input type ="text" name="editTel" required></p>');
            print('<p> Les champs possédant une étoile (*) sont obligatoires. </p>');

            if (count($_POST) > 0) {
                $nom = $_POST['editNom'];
                $prenom  = $_POST['editPrenom'];
                $mail = $_POST['editMail'];
                $tel = $_POST['editTel'];


                $SQLQuery = "INSERT INTO contact (ctc_nom ,ctc_prenom ,ctc_email,  ctc_telephone  , ctc_idorganisme) VALUES('" . $nom . "','".$prenom."','" . $mail . "','" . $tel . "','" . $id . "')";
                mysqli_query($dbConn, $SQLQuery);
                print('<p>Contact inscrit, redirection ...</p>');
                print('<meta http-equiv="refresh" content="3;url=index.php" />');
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
    <a href="" onclick="funcMentionsLegales()">Mentions légales</a> --- Copyright &#169 Comp Foundation - 2015
</div>
</body>
</html>
