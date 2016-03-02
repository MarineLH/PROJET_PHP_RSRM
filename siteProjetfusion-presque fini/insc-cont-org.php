<!DOCTYPE HTML>
<html>
    <head>
        <meta charset= "utf-8" />
        <link rel = "stylesheet" href="css/insc-cont-o.css"/>
        <link rel = "stylesheet" href="css/global.css"/>
        <title> Inscription - Contact </title>
      
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
		
			if (isset($_GET["id"])) {
				print ('<h2 class="titrePage">Renseignement du contact de l\'organisme :</h2>');
			}
			else {
				print('<h2>Inscription Contact Organisme :</h2>');
			}

		?>
		
        <div class="contactOrg">

        	<form action="<?php $_PHP_SELF?>" method ="post">
				<?php
					$dbConn = mysqli_connect('localhost', 'root', 'toor');
				  	mysqli_select_db($dbConn, 'compfundationdb');

            
				  	if (isset($_GET["id"])) {
						
						$id = $_GET["id"];
						$recupNomOrg = mysqli_query($dbConn, "SELECT org_nom FROM organisme WHERE org_id = $id");
						$orgTab = mysqli_fetch_array($recupNomOrg);
						$nomOrg = $orgTab[0];
					


						print('<fieldset><legend><h4>Coordonnées ' .$nomOrg.'  </h4></legend>');
						print('<p><span>Nom *: </span><input type ="text" name="editNom" required ></p>');
						print('<p><span>Prenom *: </span><input type ="text" name="editPrenom" required ></p>');
						print('<p><span>Email *: </span><input type ="text" name="editMail" id ="email" required></p>');
						print('<p><span>Téléphone *: </span><input type ="text" name="editTel" required></p>');
						print('<p class="notabene" >Les champs possédant une étoile (*) sont obligatoires. </p>');
						
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
				}
				else{
					print('<fieldset><legend><h4>Coordonnées </h4></legend>');
					print('<br>');
					print("Sélectionnez l'organisme auquel vous appartenez :");
					print('</br>');
					print('<br>');
					$QueryOrganisme = mysqli_query($dbConn, "SELECT * FROM organisme");
					print('<span></span><select id="cborganisme" name="organisme" onchange="getId(this);" >');
					while($row1 = mysqli_fetch_assoc($QueryOrganisme))
					{
						print('<option value="'. $row1['org_id'] . '">'. $row1['org_nom'] . '</option>'); 
					}
    	                        
					print('</select>');
					print('<p><span>Nom *: </span><input type ="text" name="editNom" required ></p>');
					print('<p><span>Prenom *: </span><input type ="text" name="editPrenom" required ></p>');
					print('<p><span>Email *: </span><input type ="text" name="editMail" id ="email" required></p>');
					print('<p><span>Téléphone *: </span><input type ="text" name="editTel" required></p>');
					print('<p class="notabene"> Les champs possédant une étoile (*) sont obligatoires. </p>');
					
					if (count($_POST) > 0) {
						$nom = $_POST['editNom'];
						$prenom  = $_POST['editPrenom'];
						$mail = $_POST['editMail'];
						$tel = $_POST['editTel'];
						$id = $_POST['organisme'];
                
						$SQLQuery = "INSERT INTO contact (ctc_nom ,ctc_prenom ,ctc_email,  ctc_telephone  , ctc_idorganisme) VALUES('" . $nom . "','".$prenom."','" . $mail . "','" . $tel . "','" . $id . "')";
						mysqli_query($dbConn, $SQLQuery);
						print('<p>Contact inscrit, redirection ...</p>');
						print('<meta http-equiv="refresh" content="3;url=index.php" />');
						}
       	         

					}
				?>

            <div class = "bouton">
                <a href="insc-o.php"><input class = "valider" type ="submit" value="Valider !"></a>
				</fieldset>
				</fieldset>
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
