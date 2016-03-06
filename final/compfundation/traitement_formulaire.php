<meta charset="utf-8" />
<?php
/*
	********************************************************************************************
	CONFIGURATION
	********************************************************************************************
*/
// destinataire est votre adresse mail. Pour envoyer à plusieurs à la fois, séparez-les par une virgule
if(isset($_GET['ActID']))
{
    $destinataire = 'romain.valeye@gmail.com';
    $dbConn = mysqli_connect('localhost', 'root', 'toor');
    mysqli_select_db($dbConn, 'compfundationdb');
    
    $action = $_GET['ActID'];
    $typeAct = substr($action, 0, 1);
    
    if($typeAct == '2')
    {
        $Requete = "SELECT int_email FROM intervenant WHERE int_id = ".substr($action, 1);
        $Select = mysqli_query($dbConn, $Requete);
        $rowI = mysqli_fetch_row($Select);
        $destinataire = $rowI[0];
        // récup un intervenant
    }
    else if($typeAct == '3')
    {
        $Requete = "SELECT org_email FROM organisme WHERE org_id = ".substr($action ,1);
        $Select = mysqli_query($dbConn, $Requete);
        $rowA = mysqli_fetch_row($Select);
        $destinataire = $rowA[0];
        // récup une annonce
    }
}

// copie ? (envoie une copie au visiteur)
$copie = 'oui'; // 'oui' ou 'non'
 
 
/*
	********************************************************************************************
	FIN DE LA CONFIGURATION
	********************************************************************************************
*/
 
// on teste si le formulaire a été soumis
if (!isset($_POST['envoi']))
{
	// formulaire non envoyé
	
	print('<script>alert("Vous devez d\'abord envoyer le formulaire");</script>');
    //METTRE UN ALERT
    print('<meta http-equiv="refresh" content="0;url=contact.php" />');
}
else
{
	/*
	 * cette fonction sert à nettoyer et enregistrer un texte
	 */
	function Rec($text)
	{
		$text = htmlspecialchars(trim($text), ENT_QUOTES);
		if (1 === get_magic_quotes_gpc())
		{
			$text = stripslashes($text);
		}
 
		$text = nl2br($text);
		return $text;
	};
 
	/*
	 * Cette fonction sert à vérifier la syntaxe d'un email
	 */
	function IsEmail($email)
	{
		$value = preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', $email);
		return (($value === 0) || ($value === false)) ? false : true;
	}
 
	// formulaire envoyé, on récupère tous les champs.
	$nom     = (isset($_POST['nom']))     ? Rec($_POST['nom'])     : '';
    $prenom     = (isset($_POST['prenom']))     ? Rec($_POST['prenom'])     : '';
	$email   = (isset($_POST['email']))   ? Rec($_POST['email'])   : '';
	$objet   = (isset($_POST['objet']))   ? Rec($_POST['objet'])   : '';
	$message = (isset($_POST['message'])) ? Rec($_POST['message']) : '';
 
	// On va vérifier les variables et l'email ...
	$email = (IsEmail($email)) ? $email : ''; // soit l'email est vide si erroné, soit il vaut l'email entré
 
	if (($nom != '') && (($prenom !='')) && ($email != '') && ($objet != '') && ($message != ''))
	{
		// les 4 variables sont remplies, on génère puis envoie le mail
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'From:'.$nom.' '.$prenom.' <'.$email.'>' . "\r\n" .
				'Reply-To:'.$email. "\r\n" .
				'Content-Type: text/plain; charset="utf-8"; DelSp="Yes"; format=flowed '."\r\n" .
				'Content-Disposition: inline'. "\r\n" .
				'Content-Transfer-Encoding: 7bit'." \r\n" .
				'X-Mailer:PHP/'.phpversion();
	
		// envoyer une copie au visiteur ?
		if ($copie == 'oui')
		{
			$cible = $destinataire.','.$email;
		}
		else
		{
			$cible = $destinataire;
		};
 
		// Remplacement de certains caractères spéciaux
		$message = str_replace("&#039;","'",$message);
		$message = str_replace("&#8217;","'",$message);
		$message = str_replace("&quot;",'"',$message);
		$message = str_replace('<br>','',$message);
		$message = str_replace('<br />','',$message);
		$message = str_replace("&lt;","<",$message);
		$message = str_replace("&gt;",">",$message);
		$message = str_replace("&amp;","&",$message);
 
		// Envoi du mail
		if (ini_set($message, $headers))
		{
			
			print('<script>alert("Votre message a été envoyé.");</script>');
			print('<meta http-equiv="refresh" content="0;url=contact.php" />');
		
                //METTRE UN ALERT
		}
		else
		{
			
                //METTRE UN ALERT
            print('<script>alert("Votre message n\'a pas été envoyé.");</script>');
			print('<meta http-equiv="refresh" content="0;url=contact.php" />');
		}
	}
	else
	{
		// une des 3 variables (ou plus) est vide ...
		
		print('<script>alert("Vérifiez que tous les champs soient bien remplis et que l\'email soit sans erreur.");</script>');
		print('<meta http-equiv="refresh" content="0;url=contact.php" />');
		
            //METTRE UN ALERT
		
	};
}; // fin du if (!isset($_POST['envoi']))
	
?>
