<!DOCTYPE HTML>
<html>
    <head>
        <meta charset= "utf-8" />
        <link rel = "stylesheet" href="css/rech-a.css"/>
        <link rel = "stylesheet" href="css/global.css"/>
        <title> Recherche - Annonces </title>
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
                <form method="post" action="<?php $_PHP_SELF ?>">
                <?php 
                    $dbconn=mysqli_connect('localhost','root','toor');
                    mysqli_select_db($dbconn,'compfundationdb');
                    
                    if(empty($_POST))
                    {
                    print('<h4>Sélectionnez le (ou les) domaine(s) de votre recherche.</h4>');
                     $result = mysqli_query($dbconn, "SELECT * FROM domaine");
                        $compteur = 1;
                        print("<table class='tabledom'><tr>");
                        while($row = mysqli_fetch_assoc($result))
                        {
                            
                            print("<td><input name='chckDom[]' value=".$row['dom_id']." class='chkbox' type='checkbox'>".$row['dom_libelle']."");                 
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
                        print('<input type="submit" class ="rechercher"name="recherche" value="Rechercher"/>');
                        mysqli_free_result($result);
                    }
                    else
                    {
                        if(isset($_POST['recherche'])){  
                            ?>
                            <table align='center' class="tableAnn">
                                <tr>
                                    <th> Domaine </th>
                                    <th> Nom organisme </th>
                                    <th> Ville organisme </th>
                                    <th> Code postal </th>
                                    <th> Titre de l'annonce </th>
                                    <th> Date de limite de candidature </th>
                                    <th> Desciption de l'annonce </th>
                                    <th> Répondre à l'annonce </th>
                                </tr>
                            <?php 
                            foreach ($_POST['chckDom'] as $index=>$value)
                            {
                                $SQLQuery = mysqli_query($dbconn,"SELECT org_id, org_nom, org_ville, org_codepostal, rec_datelimiteintervention, rec_description, dom_libelle, rec_titre, rec_id
                               FROM organisme INNER JOIN recherche ON organisme.org_id = rec_idorganisme
                               INNER JOIN concerne ON recherche.rec_id = concerne.conc_idrecherche
                               INNER JOIN domaine ON concerne.conc_iddomaine = domaine.dom_id
                               WHERE rec_active = 1 AND dom_id = ".$value);


                                while($row=mysqli_fetch_assoc($SQLQuery))
                                {
                                    print('<tr>');
                                    print('<td>'.$row['dom_libelle'].'</td><td>'.$row['org_nom'].'</td><td>' .$row['org_ville'].'</td><td>'.$row['org_codepostal'].'</td><td>'.$row['rec_titre'].'</td><td>'.$row['rec_datelimiteintervention'].'</td><td>'.$row['rec_description'].'</td><td class="repondre"><a href="contact.php?idAnn='.$row['rec_id'].'">Répondre</a></td></tr>');
                                }
                            }
                            print('</table></form>');
                        }
                    }
                ?>
                                            
                </form>
               <br/>
                <br>
                <div>
                </div>
                <div class="push"></div>
            </div>
        </div>   
        <div class="footer">
            <a onclick="funcMentionsLegales()">Mentions légales</a> --- Copyright &#169 Comp Foundation - 2015
        </div>
    </body>
</html>