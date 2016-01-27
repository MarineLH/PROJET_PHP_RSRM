<!DOCTYPE HTML>
<html>
    <head>
        <meta charset= "utf-8" />
        <link rel = "stylesheet" href="css/index.css"/>
        <link rel = "stylesheet" href="css/global.css"/>
        <title> Recherche - Intervenant </title>
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
                <?php 
                $dbConn = mysqli_connect('localhost', 'root', 'toor');
                mysqli_select_db($dbConn, 'compfundationdb');
                
                if(empty($_POST))
                {
                ?>
                <h2 class="titrePage">Rechercher un intervenant :</h2>
                <div class="formulaire">
                    <form action="<?php $_PHP_SELF ?>" method="post">
                        <h4>Domaines de compétences :</h4>
                        <?php                            
                        $Querydomaine = mysqli_query($dbConn, "SELECT * FROM domaine");
                        
                        $compteur = 1;
                        print("<table><tr>");
                        while($row = mysqli_fetch_assoc($Querydomaine))
                        {
                            
                            print("<td><input name='checkbox[]' id='chkbx".$compteur."' type='checkbox' value='".$row['dom_id']."'>".$row['dom_libelle']."");
                            
                            $Querylvl = mysqli_query($dbConn, "SELECT * FROM niveau");
                            print('<select name="niveau[]" >');
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
                        print('
                        <input class="btVal" type="submit" text="Valider">
                        
                    </form>');
                }
                else
                {
                    if(count($_POST) > 0)
                    {
                        if(empty($_POST['checkbox']))
                        {
                            print('<script>alert("Il faut cocher au moins une compétence pour effectuer la recherche.");</script>');  
                        }
                        else{
                            $niveauArr = $_POST['niveau'];
                            /*
                            print_r($_POST['checkbox']);
                            print_r($_POST['niveau']);*/
                            foreach($_POST['checkbox'] as $domIndex=>$idDom)
                            {
                                $recupNomDom = mysqli_fetch_assoc(mysqli_query($dbConn, "SELECT dom_libelle FROM domaine WHERE dom_id = " . $idDom));
                                $nomDom = $recupNomDom['dom_libelle'];
                                $QueryInter = "SELECT * FROM intervenant";
                                
                                print('<h4>Domaine : ' .$nomDom . '</h4>');
                                
                                if ($niveauArr[$domIndex] == 0)
                                {
                                    $QueryInter = "SELECT * FROM intervenant INNER JOIN estcompetent ON int_id = comp_idintervenant INNER JOIN niveau ON comp_idniveau = niv_id WHERE comp_iddomaine = " .$idDom. " ORDER BY comp_iddomaine";
                                }
                                else
                                {
                                    $QueryInter = "SELECT * FROM intervenant INNER JOIN estcompetent ON int_id = comp_idintervenant INNER JOIN niveau ON comp_idniveau = niv_id WHERE comp_idniveau = " .$niveauArr[$domIndex]. " AND comp_iddomaine = " .$idDom;
                                }
                                
                                print('<ul id="listeInter">');
                                
                                $Result = mysqli_query($dbConn, $QueryInter);
                                while($row2 = mysqli_fetch_assoc($Result))
                                {
                                    print('<a href="contact.php?idInt='.$row2['int_id'].'"><li>'.$row2['int_nom'].' '.$row2['int_prenom']. ' ; Niveau : '. $row2['niv_libelle'] .'</li></a>');
                                }
                                print('</ul>');
                            }
                            print('<p>Vous ne trouvez personne ? <a href="post-a.php">Déposez une annonce !</a></p>');
                            mysqli_close($dbConn);
                        }   
                    }              
                }
                ?>
                        
                </div>
                <div class="push"></div>
            </div>
        </div>   
        <div class="footer">
            <a href="" onclick="funcMentionsLegales()">Mentions légales</a> --- Copyright &#169 Comp Foundation - 2015
        </div>
    </body>
</html>