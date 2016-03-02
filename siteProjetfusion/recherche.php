<!DOCTYPE HTML>
<html>
    <head>
        <meta charset= "utf-8" />
        <link rel = "stylesheet" href="css/recherche.css"/>
        <link rel = "stylesheet" href="css/global.css"/>
        <title> Recherche </title>
      
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
                <form action='<?php $_PHP_SELF ?>' method="post">
                    <fieldset><legend>Entrez votre adresse e-mail</legend>
                        <input type="textbox" name="mail" required autocomplete="off"/>
                        <input type="button" name="valider" value="Envoyer"/>
                    </fieldset>
                    <?php
                        $dbConn = mysqli_connect('localhost', 'root', 'toor');
                        mysqli_select_db($dbConn, 'compfundationdb');
                      
                      
                        if(!empty($_POST))
                        {
                            $SelectContact = 'SELECT ctc_email FROM contact where ctc_email ='.$_POST['mail'];
                            $queryCtc = mysqli_query($dbConn, $SelectContact);
                            if($row = mysqli_fetch_row($queryCtc))
                            {
                                print($row[0]);
                                print('ouech');
                            }
                        }
                    ?>
                </form>
                <div class="push"></div>
            </div>
        </div>   
        <div class="footer">
            <a onclick="funcMentionsLegales()">Mentions légales</a> --- Copyright &#169 Comp Foundation - 2015
        </div>
    </body>
</html>