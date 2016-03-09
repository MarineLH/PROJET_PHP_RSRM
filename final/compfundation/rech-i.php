<!DOCTYPE HTML>
<html>
    <head>
        <meta charset= "utf-8" />
        <link rel = "stylesheet" href="css/global.css"/>
        <link rel = "stylesheet" href="css/rech-i.css"/>       
		<title> Recherche - Intervenant </title>
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
                
                if(empty($_POST))
                {
                ?>
                <h2 class="titrePage">Rechercher un intervenant :</h2>
                
                    <form action="<?php $_PHP_SELF ?>" method="post">
                        <div class ="competences">
                        <fieldset><legend><h4>Domaines de compétences :</h4></legend>
                        <?php                            
                        $Querydomaine = mysqli_query($dbConn, "SELECT * FROM domaine");
                        
                        $compteur = 1;
                        print("<table><tr>");
                        while($row = mysqli_fetch_assoc($Querydomaine))
                        {
                            
                            print("<td><input name='checkbox[".$row['dom_id']."]' type='hidden' value='0'><input name='checkbox[".$row['dom_id']."]' class ='checkbox' type='checkbox' value='".$row['dom_id']."'/>".$row['dom_libelle']);
                            
                            
                            $Querylvl = mysqli_query($dbConn, "SELECT * FROM niveau");
                            print('<select class="niveau" name="niveau['.$row['dom_id'].']" >');
                            print('<option value="0">Tous les niveaux</option>');
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
                        print('<input class="btVal" type="submit" value="Rechercher"></fieldset></div></form>');
                }
                else
                {
                    if(count($_POST) > 0)
                    {
                        if(empty($_POST['checkbox']))
                        {
                            print('<script>alert("Il faut cocher au moins une compétence pour effectuer la recherche.");</script>');  
                            unset($_POST);
                            print('<meta http-equiv="refresh" content="0;url=rech-i.php" />');
                        }
                        else{
                            print
                            ('<form action="pdf.php" method="post">
                              ');
                            
                            $niveauArr = $_POST['niveau'];
                            
                            foreach($_POST['checkbox'] as $domIndex=>$idDom)
                            {
                                if($idDom == 0)
                                {
                                    
                                }
                                else
                                {
                                    $recupNomDom = mysqli_fetch_assoc(mysqli_query($dbConn, "SELECT dom_libelle FROM domaine WHERE dom_id = " . $idDom));
                                    $nomDom = $recupNomDom['dom_libelle'];
                                    $QueryInter = "SELECT * FROM intervenant";
                                    if ($niveauArr[$domIndex] == 0)
                                    {
                                        $QueryInter = "SELECT * FROM intervenant INNER JOIN estcompetent ON int_id = comp_idintervenant INNER JOIN niveau ON comp_idniveau = niv_id WHERE comp_iddomaine = " .$idDom. " ORDER BY comp_iddomaine";
                                    }
                                    else
                                    {
                                        $QueryInter = "SELECT * FROM intervenant INNER JOIN estcompetent ON int_id = comp_idintervenant INNER JOIN niveau ON comp_idniveau = niv_id WHERE comp_idniveau = " .$niveauArr[$domIndex]. " AND comp_iddomaine = " .$idDom;
                                    }
                                    print('<h4>Domaine : ' .$nomDom . '</h4>');
                                    print('<ul id="listeInter">');

                                    $Result = mysqli_query($dbConn, $QueryInter);
                                    while($row2 = mysqli_fetch_assoc($Result))
                                    {
                                        print('<input type="hidden" name="idintervenant['.$row2['int_id'].']" value="'.$row2['int_id'].'"/>');
                                        print('<a href="contact.php?idInt='.$row2['int_id'].'"><li>'.$row2['int_nom'].' '.$row2['int_prenom']. ' ; Niveau : '. $row2['niv_libelle'] .'</li></a>');
                                    }
                                    print('</ul>');
                                }
                            }
                            print('<input type ="submit" value= "Voir le PDF" name = "buttonpdf"/>
                            <p>Vous ne trouvez personne ? <a href="post-a.php">Déposez une annonce !</a></p>');
                            print('</form>');
                            mysqli_close($dbConn);
                        
                        }   
                    }              
                }
                ?>
                        
                </div>
                <div class="push"></div>
            </div>   
        <div class="footer">
            <a onclick="funcMentionsLegales()">Mentions légales</a> --- Copyright &#169 Comp Foundation - 2015
        </div>
    </body>
</html>