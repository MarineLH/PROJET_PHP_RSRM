<!DOCTYPE HTML>
<html>
    <head>
        <meta charset= "utf-8" />
        <link rel = "stylesheet" href="css/index.css"/>
        <link rel = "stylesheet" href="css/global.css"/>
		<link rel = "stylesheet" href="css/contact.css"/>
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
				<div class="contact">
					<form id="contact" method="post" action="traitement_formulaire.php">
						<fieldset><legend>Vos coordonnées</legend>
                    
                            
                                <p><label for="nom">Nom :</label><input type="text" id="nom" name="nom" tabindex="1" /></p>
                            
                            
                           
                                <p><label for="nom">Prenom :</label><input type="text" id="prenom" name="prenom" tabindex="2" /></p>
                            
                              
                            
                                <p><label for="email">Email :</label><input type="text" id="email" name="email" tabindex="3" /></p>
                            
                            
                        </fieldset>
                        
                        
						  <fieldset><legend>Votre message :</legend>
						      <p><label for="objet">Objet :</label><input type="text" id="objet" name="objet" tabindex="4" /></p>
						  <p><label for="message">Message :</label><textarea id="message" name="message" tabindex="5" cols="30" rows="8"></textarea></p>
						  </fieldset>
                        
                        
						<div style="text-align:center;"><input type="submit" name="envoi" value="Envoyer le formulaire !" /></div>
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