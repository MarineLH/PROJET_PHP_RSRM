<!DOCTYPE HTML>
<html>
    <head>
        <meta charset= "utf-8" />
        <link rel = "stylesheet" href="css/index.css"/>
        <link rel = "stylesheet" href="css/global.css"/>
        <title> Détails </title>
      
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
                
                if(!isset($_GET['idAnn']) and !isset($_GET['idInt']))
                {
                    print('<script>alert("Aucun détail ne peut être affiché. Redirection ...");</script>');
                    print('<meta http-equiv="refresh" content="0;url=index.php" />');
                }
                else if(isset($_GET['idAnn']))
                {
                    $SQLAnnonce = "SELECT * FROM recherche INNER JOIN concerne ON rec_id = conc_idrecherche INNER JOIN domaine ON conc_iddomaine = dom_id INNER JOIN organisme ON rec_idorganisme = org_id WHERE rec_id = ".$_GET['idAnn'];
                    
                    $Result = mysqli_query($dbConn, $SQLAnnonce);
                    while($row= mysqli_fetch_assoc($Result))
                    {
                        $date = date('d-m-Y', strtotime($row['rec_datelimiteintervention']));
                        print('<fieldset><legend>Annonce : '.$row["rec_titre"].'</legend>');
                        print('<p>Organisme créateur de l\'annonce : '.$row['org_nom']);
                        print('<p>Lieu de travail : '.$row['rec_ville']);
                        print('<p>Domaine de compétence : '.$row['dom_libelle']);
                        print('<p>Date limite de candidature : '.$date);
                        print('<p>Description de l\'annonce : '.$row['rec_description']);
                        
                        print('<p><a class="repondre" href="contact.php?idOrg='.$_GET['idAnn'].'">Répondre à l\'annonce</a>');
                        print('</fieldset>');
                    }
                }
                else // GET idInt
                {
                    $SQLinter = "SELECT * FROM intervenant LEFT JOIN estcompetent ON int_id = comp_idintervenant LEFT JOIN domaine ON comp_iddomaine = dom_id LEFT JOIN niveau ON comp_idniveau = niv_id WHERE int_id = ".$_GET['idInt'];
                    
                    $ResultI = mysqli_query($dbConn, $SQLinter);
                    $rowI = mysqli_fetch_assoc($ResultI);
                    print('<fieldset><legend><h4>Intervenant : '.$rowI["int_prenom"].' '.$rowI['int_nom'].'</h4></legend>');
                    print('<p><b>Domaine</b> : '.$rowI['dom_libelle'].' - <b>Niveau</b> : '.$rowI['niv_libelle']); 
                    while($rowI= mysqli_fetch_assoc($ResultI))
                    {
                        print('<p><b>Domaine</b> : '.$rowI['dom_libelle'].' - <b>Niveau</b> : '.$rowI['niv_libelle']);   
                    }
                    print('<p><a class="repondre" href="contact.php?idInt='.$_GET['idInt'].'">Contacter</a>');
                    print('</fieldset>');
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