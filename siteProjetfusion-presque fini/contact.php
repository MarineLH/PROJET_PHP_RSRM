<!DOCTYPE HTML>
<html>
    <head>
        <meta charset= "utf-8" />
        <link rel = "stylesheet" href="css/contact.css"/>
        <link rel = "stylesheet" href="css/global.css"/>
        <title> Contact </title>    
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
                    session_start();
                    if (!isset($_SESSION['email']) || empty($_SESSION['email'])) 
                    {
                        print('<script>alert("Vous n\'êtes pas connecté. Vous devez être connecté pour accéder à cette page.");</script>');
                        print('<meta http-equiv="refresh" content="0;url=index.php?lastpage=contact.php" />');
                    }
                    else
                    {
                        $mail = $_SESSION['email'];
                        $categorie = $_SESSION['categorie'];
                        $prenom = $_SESSION['prenom'];
                        $nom = $_SESSION['nom'];
                    print('
                    
				<div class="contact">
					<form id="contact" method="post" action="traitement_formulaire.php">
						<fieldset><legend>Vos coordonnées</legend>                   
                                <p><label for="nom">Nom :</label><input type="text" id="nom" name="nom" tabindex="1" value="'.$nom.'"/></p>
                                               
                                <p><label for="nom">Prenom :</label><input type="text" id="prenom" name="prenom" tabindex="2" value="'.$prenom.'"/></p>              
                                <p><label for="email">Email :</label><input type="text" id="email" name="email" tabindex="3" value="'.$mail.'"/></p>          
                        </fieldset>
						  <fieldset><legend>Votre message :</legend>
						      <p><label for="objet">Objet :</label><input type="text" id="objet" name="objet" tabindex="4" /></p>
						  <p><label for="message">Message :</label><textarea id="message" name="message" tabindex="5" cols="30" rows="8"></textarea></p>
						  </fieldset>
                        
                        
						<div style="text-align:center;"><input type="submit" name="envoi" value="Envoyer le formulaire !" /></div>
					</form> 
                </div>
                ');
                }
                ?>
                <div class="push"></div>
            </div>
        </div>   
        <div class="footer">
            <a onclick="funcMentionsLegales()">Mentions légales</a> --- Copyright &#169 Comp Foundation - 2015
        </div>
    </body>
</html>