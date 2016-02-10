<!DOCTYPE HTML>
<html>
    <head>
        <meta charset= "utf-8" />
        <link rel = "stylesheet" href="css/insc-i.css"/>
        <link rel = "stylesheet" href="css/global.css"/>
        <title> Inscription - Intervenant </title>
      
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
                
                <h2 class="titrePage">Inscription intervenant :</h2>
                <div class="formulaire">
                    <form action="<?php $_PHP_SELF ?>" method="post">
                        <h4>Coordonnées</h4>
                        <p><span>Nom *</span> : <input class="txtbox" type="text" name="AddNom" required/></p>
                        <p><span>Prénom *</span> : <input class="txtbox" type="text" name="AddPrenom" required/></p>
                        <p><span>N° Téléphone *</span> : <input class="txtbox" type="text" name="AddTel" required/></p>
                        <p><span>Fax</span> : <input class="txtbox" type="text" name="AddFax"/></p>
                        <p><span>Email *</span> : <input class="txtbox" type="text" name="AddMail" required/></p>
                        
                        <span id="notabene">Les lignes possédant une étoile (*) sont obligatoires pour l'inscription.</span>
                        <h4>Compétences</h4>
                        <?php
                        $dbConn = mysqli_connect('localhost', 'root', 'toor');
                        mysqli_select_db($dbConn, 'compfundationdb');                    
                        $Querydomaine = mysqli_query($dbConn, "SELECT * FROM domaine");
                        
                        $compteur = 1;
                        print("<table><tr>");
                        while($row = mysqli_fetch_assoc($Querydomaine))
                        {
                            
                            print("<td><input name='checkbox[]' id='chkbx".$compteur."' type='checkbox' value='".$row['dom_id']."'>".$row['dom_libelle']."");
                            
                            $Querylvl = mysqli_query($dbConn, "SELECT * FROM niveau");
                            print('<select name="niveau[]" >');
                            while($row1 = mysqli_fetch_assoc($Querylvl))
                            {
                                print('<option value="'. $row1['niv_id'] . '">'. $row1['niv_libelle'] . '</option>'); 
                            }
                            
                            print('</select>');
                            if($compteur % 3 == 0)
                            {
                                print("</td></tr><tr>");
                            }
                            else
                            {
                                print("</td>");
                            }
                            $compteur += 1;
                            
                        }
                        print("</tr></table>");
                        mysqli_free_result($Querydomaine);
                        ?>
                        <input class="btVal" type="submit" text="Valider">
                        
                    </form>
                </div>
                <div class="push"></div>
            </div>
        </div>   
        <div class="footer">
            <a onclick="funcMentionsLegales()">Mentions légales</a> --- Copyright &#169 Comp Foundation - 2015-2016
        </div>
    </body>
    <?php
    if(count($_POST) > 0)
    {
        $nom = "";
        $prenom = "";
        $tel = "";
        $fax = "";
        $mail = "";
        if(empty($_POST['checkbox']))
        {
            print('<script>alert("Il faut cocher au moins une compétence pour valider votre inscription.");</script>');  
        }
        else{
            $nom = $_POST['AddNom'];
            $prenom = $_POST['AddPrenom'];
            $tel = $_POST['AddTel'];
            if(isset($_POST['AddFax'])){
                $fax = $_POST['AddFax'];}
            $mail = $_POST['AddMail'];
            
            $AddInter = "INSERT INTO intervenant(int_nom, int_prenom, int_email, int_telephone, int_fax, int_statutcotisation) VALUES ('".$nom."',' ".$prenom."', '".$mail."', '".$tel."', '".$fax."', 0)";
            
            mysqli_query($dbConn, $AddInter);
            
            $selectLastId = mysqli_query($dbConn, "SELECT LAST_INSERT_ID()");
            $lastIDar = mysqli_fetch_array($selectLastId);
            $lastID = $lastIDar[0];
            $niveauArr = $_POST['niveau'];
            /*print_r($lastID);
            print_r($_POST['checkbox']);
            print_r($_POST['niveau']);*/
            
            
            foreach($_POST['checkbox'] as $domIndex=>$idDom)
            {
                $SQLQuery = "INSERT INTO estcompetent(comp_iddomaine, comp_idniveau, comp_idintervant) VALUES('" . $idDom . "','".$niveauArr[$domIndex]."','" . $lastID . "')";
                mysqli_query($dbConn, $SQLQuery);
                
            }
            
            print('<script>alert("Vous avez été ajouté à notre base de données. Cliquez sur Ok pour être redirigé.");</script>');
            
        }
    }
    
    ?>
</html>