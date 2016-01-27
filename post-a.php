<!DOCTYPE HTML>
<html>
    <head>
        <meta charset= "utf-8" />
        <link rel = "stylesheet" href="css/index.css"/>
        <link rel = "stylesheet" href="css/global.css"/>
        <title> Poster - Annonce </title>
      
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
            <h2 class="titrePage">Poster une annonce :</h2>
                <div class="formulaire">
                    <form action="<?php $_PHP_SELF ?>" method="post">
                        <h4>Votre Organisme :
                        <?php
                        $dbConn = mysqli_connect('localhost', 'root', 'toor');
                        mysqli_select_db($dbConn, 'compfundationdb');   
                        $QueryOrganisme = mysqli_query($dbConn, "SELECT * FROM organisme");
                        print('<select id="cborganisme" name="organisme" onchange="getId(this);" >');
                            while($row1 = mysqli_fetch_assoc($QueryOrganisme))
                            {
                                print('<option value="'. $row1['org_id'] . '">'. $row1['org_nom'] . '</option>'); 
                                $ville = $row1['org_ville'];
                                $codepostal = $row1['org_codepostal'];
                            }
                            
                            print('</select>');
                        ?>
                         </h4>
                        
                        <p><span>Titre annonce</span> : <input class="txtbox" type="text" name="titre" required/></p>   
                        <p>Description :</p>
                        <textarea name="contDesc"  rows="10" cols="50" placeholder="Entrez votre description ici." ></textarea>
                        </br>
                        
                        <h4>Compétences requises</h4>
                        <?php
                        $dbConn = mysqli_connect('localhost', 'root', 'toor');
                        mysqli_select_db($dbConn, 'compfundationdb');                    
                        $Querydomaine = mysqli_query($dbConn, "SELECT * FROM domaine");
                        
                        
                        $compteur = 1;
                        print("<table><tr>");
                        while($row = mysqli_fetch_assoc($Querydomaine))
                        {
                            
                            print("<td><input name='checkbox[]' id='chkbx".$compteur."' type='checkbox' value='".$row['dom_id']."'>".$row['dom_libelle']."");
                            
                            
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
                        <p> Choisissez une date de début : </br><input type="date" name="dateDebut"> </p>
                        <p> Choisissez une date de fin : </br><input type="date" name="dateFin"> </p>
                        
                        <input class="btVal" type="submit" text="Valider">
                        
                    </form>
                </div>
                <div class="push"></div>
            </div>
        </div>   
        <div class="footer">
            <a href="" onclick="funcMentionsLegales()">Mentions légales</a> --- Copyright &#169 Comp Foundation - 2015
        </div>
    </body>
 <?php


   if(count($_POST) > 0)
    {
     if(empty($_POST['checkbox']))
        {
            print('<script>alert("Il faut cocher au moins une compétence pour valider votre inscription.");</script>');  
        }
        else{
            $id = $_POST['organisme'];
            $dbConn = mysqli_connect('localhost', 'root', 'toor');
            mysqli_select_db($dbConn, 'compfundationdb');   
            $QueryCont = mysqli_query($dbConn, "SELECT ctc_id FROM contact WHERE ctc_idorganisme ='.$id.'");
            $row3 = mysqli_fetch_assoc($QueryCont);
            $titre = $_POST['titre'];
            $desc = $_POST['contDesc'];
            $datedebut = $_POST['dateDebut'];
            $datefin = $_POST['dateFin'];
            $ndatedebut = new DateTime($datedebut);
            $ndatefin = new DateTime($datefin);
            $duree =  date_diff($ndatedebut, $ndatefin)->days;
            $heure = date('His', time());
            $date = date("Ymd");
            $active = 1;
            $idCont = $row3['ctc_id'];      
            
            $OrgRecherche = "INSERT INTO recherche( rec_date, rec_heure,rec_codepostal, rec_ville, rec_description, rec_active, rec_datelimiteintervention, rec_nombrejoursintervention, rec_idorganisme, rec_idctcorigine, rec_titre) VALUES ('".$date."',' ".$heure."', '".$codepostal."', '".$ville."', '".$desc."' ,' ".$active."',' ".$datefin."',' ".$duree."',' ".$id."',' ".$idCont."',' ".$titre."')";
           
         
            if(mysqli_query($dbConn, $OrgRecherche))
            {
              print('<script>alert("Annonce postée, redirection ...");</script>');
              print('<meta http-equiv="refresh" content="1;url=index.php" />');
            }
            $selectLastId = mysqli_query($dbConn, "SELECT LAST_INSERT_ID()");
            $lastIDar = mysqli_fetch_array($selectLastId);
            $lastID = $lastIDar[0];
            foreach($_POST['checkbox'] as $domIndex=>$idDom)
            {
                $SQLQuery = "INSERT INTO concerne(conc_iddomaine, conc_idrecherche) VALUES('" . $idDom . "','" . $lastID . "')";
                mysqli_query($dbConn, $SQLQuery);
            }            
        }
   }    
        else{
        $titre = "";
        $idOrg = "";
        $desc = "";
        $ville = "";
        $codepostal = "";     
        $heure = "";
        $date = "";
        $active = "";
        $idCont = "";
        $datedebut = "";
        $datefin = "";
        $duree = "";
        $idCont = "";
        $id = "";
        
            
            }
     
?>
</html>