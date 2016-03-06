<!DOCTYPE HTML>
<html>
    <head>
        <meta charset= "utf-8" />
        <link rel = "stylesheet" href="css/index.css"/>
        <link rel = "stylesheet" href="css/global.css"/>
        <title> Accueil </title>
      
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
						<li><a href="contact.php">Contact</a></li>
						<li><a href="logout.php">Se déconnecter</a></li>
                    </ul>
                </div>
            </header>
            <div class="wrapper">
                
                <?php
                $dbConn = mysqli_connect('localhost', 'root', 'toor');
                mysqli_select_db($dbConn, 'compfundationdb');
                session_start();
                if(!count($_SESSION) > 0)
                {
                ?>
                <form method="post" action="<?php $_PHP_SELF ?>">
				    <fieldset><legend>Connexion : entrez votre email</legend>
                    <p><label for="email">Email : </label><span><input type="text" name="email" tabindex="1" required autocomplete="off"/></span><input value="Se connecter" class="button" name="bt_conn" type="submit"/></p>
                    <p>Première visite ? Inscrivez-vous ! <a href="insc-i.php">Intervenant</a> ou <a href="insc-o.php">Organisme</a></p>
                    </fieldset>
                </form>
                <?php
                }
                else
                {
                    if ($_SESSION['categorie'] == "contact")
                    {
                        $SQLIntervenants = "SELECT * FROM intervenant ORDER BY int_id DESC LIMIT 5";
                        print('<h2>Les 5 derniers intervenants inscrits :</h2>');
                        print('<ul id="listeInter">');
                                
                        $ResultI = mysqli_query($dbConn, $SQLIntervenants);
                        while($rowI = mysqli_fetch_assoc($ResultI))
                        {
                            print('<li><a href="details.php?idInt='.$rowI['int_id'].'">'.$rowI['int_nom'].' '.$rowI['int_prenom']. '</a></li>');
                        }
                        print('</ul>');
                
                    }
                    else
                    {
                        $SQLAnnonces = "SELECT * FROM recherche INNER JOIN organisme ON rec_idorganisme = org_id INNER JOIN concerne ON rec_id = conc_idrecherche INNER JOIN domaine ON conc_iddomaine = dom_id ORDER BY rec_id DESC LIMIT 5";
                        
                        print('<h2>Les 5 dernières annonces postées :</h2>');
                        print('<ul id="listeInter">');
                                
                        $ResultA = mysqli_query($dbConn, $SQLAnnonces);
                        while($rowA = mysqli_fetch_assoc($ResultA))
                        {
                            print('<li><a href="details.php?idAnn='.$rowA['rec_id'].'">'.$rowA['rec_titre'].'</a>; Date du: '.$rowA['rec_date']. '</li>');
                        }
                        print('</ul>');
                    }
                }
                ?>
            </div>
           
                <div class="push"></div>
            </div>
        </div>   
        <div class="footer">
            <a onclick="funcMentionsLegales()">Mentions légales</a> --- Copyright &#169 Comp Foundation - 2015
        </div>
    </body>
</html>
<?php
    if(count($_POST) > 0)
    {
        $SQLConnexion1 = "SELECT int_id, int_nom, int_prenom, int_email FROM intervenant WHERE int_email = '". $_POST['email']."'";
        $SQLConnexion2 = "SELECT ctc_id, ctc_nom, ctc_prenom, ctc_email FROM contact WHERE ctc_email = '". $_POST['email']."'";
    
        if(mysqli_query($dbConn, $SQLConnexion1))
        {
            $row = mysqli_fetch_assoc(mysqli_query($dbConn, $SQLConnexion1));
            if($row != null)
            {                    
                $nom = $row['int_nom'];
                $prenom = $row['int_prenom']; 
                $categorie = "intervenant";
                print('<script>alert("Vous êtes bien connecté. Bienvenue '.$prenom.' ' .$nom.'. Redirection...");</script>');
                session_start();
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['nom'] = $nom;
                $_SESSION['prenom'] = $prenom;
                $_SESSION['categorie'] = $categorie;
            }
            else
            {
                if(mysqli_query($dbConn, $SQLConnexion2))
                {
                    $row2 = mysqli_fetch_assoc(mysqli_query($dbConn, $SQLConnexion2));
                    if($row2 != null)
                    {                    
                        $nom = $row2['ctc_nom'];
                        $prenom = $row2['ctc_prenom']; 
                        $categorie = "contact";
                        print('<script>alert("Vous êtes bien connecté. Bienvenue '.$prenom.' ' .$nom.'. Redirection...");</script>');
                        session_start();
                        $_SESSION['email'] = $_POST['email'];
                        $_SESSION['nom'] = $nom;
                        $_SESSION['prenom'] = $prenom;
                        $_SESSION['categorie'] = $categorie;
                    }
                    else
                    {
                        print('<script>alert("Vous avez mal entré vos identifiants, ou n\'êtes pas dans la base de données. Veuillez réessayer. Si le problème persiste, veuillez contacter l\administrateur.");</script>');
                    }
                }
            }
        }
        if(isset($_GET['lastpage']))
        {
            print('<meta http-equiv="refresh" content="0;url='.$_GET['lastpage'].'" />');
        }
        else
        {
            print('<meta http-equiv="refresh" content="0;url=index.php" />');
        }
                }
            ?>
