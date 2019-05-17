<?php setcookie('ip', $_SERVER['REMOTE_ADDR'], time()+24*3600);?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="style.css" type="text/css" />
<title>CV Pascal Fertelle</title>
</head>
<?php if (isset($_POST['sexe'])) 
{
$sexe = $_POST['sexe'];
}
else
{
$sexe = 'neutre';
}	
?>
<body class="<?php echo $sexe;?>" class="flexbox">
	<div class="flexbox5">
		<form method = "post" class="élément">
			<fieldset class="flexbox3">
			<legend> Vos coordonnées</legend>
			<p>Présentez vous s'il vous plait :</p>
			<p>Madame<input type= "radio" name="sexe" 
			value="Madame" <?php 
			if (isset($_POST["sexe"])) 
			{ 
			  if ($_POST["sexe"] == "Madame") 
			  {
				  echo "checked";
			  }
			}
			?>>
			Monsieur<input type= "radio" name="sexe"
			value="Monsieur" <?php 
			if (isset($_POST["sexe"])) 
			{ 
			  if ($_POST["sexe"] == "Monsieur") 
			  {
				  echo "checked";
			  }
			}
			?>></p>
			<p>Votre nom : <input type = "text" name = "nom"> </p>
			<p>Votre adresse mail : <input type = "email" name = "user_mail"></p>
			<input type = "submit" value = "Envoyer le formulaire!">
			</fieldset>
			<p class= "mail"><?php if (!empty($_POST["user_mail"]))
			{
			$Bienvenue="Bienvenue ";
			if (!empty($_POST["sexe"])) {$Bienvenue=$Bienvenue . $_POST["sexe"]." ";}
			if (!empty($_POST["nom"])) {$Bienvenue=$Bienvenue . $_POST["nom"];}
			$Bonjour="Bonjour ";
			if (!empty($_POST["sexe"])) {$Bonjour=$Bonjour . $_POST["sexe"]." ";}
			if (!empty($_POST["nom"])) {$Bonjour=$Bonjour . $_POST["nom"];}
			$confiance="Merci de votre confiance, vous allez recevoir un mail de bienvenue";
			mail($_POST["user_mail"], $Bienvenue, $Bonjour,"From:PASCAL FERTELLE <pascal.fertelle@bbox.fr>");
			echo $confiance;
			}
			?></p>
		</form>
		<div class="élément">
		<h1 id="haut_de_page"> Bienvenue sur mon <strong>cv</strong> <?php if (isset($_POST["sexe"])) { echo $_POST["sexe"]." "; }?><?php if (isset($_POST["nom"])) 
		{ echo htmlspecialchars($_POST["nom"]);}?><br /> conçu par apprentissage avec <a href="https://openclassrooms.com/"
		target="_blank" title="CLiquez ici pour découvrir OpenClassrooms"><em>OpenClassrooms </a></br>
		</h1>
		<?php 
		$monfichier = fopen('compteur.txt', 'r+');
		$monfichier2 = fopen('adresse_ip.txt' , 'a');
		$monfichier3 = fopen('formulaire.txt','a');
		$date= date('Y-m-d G:i:s'); // fotmat y-m-d G:i:s adaptée à la base de données SQL
		$pages_vues = fgets($monfichier); // On lit la première ligne (nombre de pages vues)
		if (isset ($_COOKIE['ip']))
		{
		$pages_vues = intval($pages_vues);
		$pages_vues += 1; // On augmente de 1 ce nombre de pages vues
		fseek($monfichier, 0); // On remet le curseur au début du fichier
		fputs($monfichier, $pages_vues); // On écrit le nouveau nombre de pages vues
		fclose($monfichier);
		}
		fwrite($monfichier2, $_SERVER['REMOTE_ADDR'].' '.$date."\r\n");
        fclose($monfichier2);
        if (!empty($_POST["nom"]) || !empty($_POST["user_mail"]))
        {
        $contact = "Nouveau contact ";
        fwrite($monfichier3, $_SERVER['REMOTE_ADDR'].' ');
        	if (!empty($_POST["sexe"]))
        	{
        	fwrite($monfichier3, $_POST['sexe']." ");
        	$contact = $contact . $_POST["sexe"] . " ";
        	}
        	if (!empty($_POST["nom"]))
        	{
        	fwrite($monfichier3, $_POST['nom']." ");
        		if (!empty($_POST["sexe"]))
        		{
        		$contact = $contact . $_POST["nom"] . " ";
        		}
        		else
        		{
        		$contact = $_POST["nom"] . " ";
        		}
        	}
        	if (!empty($_POST['user_mail']))
        	{
        	fwrite($monfichier3, $_POST['user_mail']." ");
        	$contact = $contact . $_POST['user_mail'];
        	}
        fwrite($monfichier3, $date."\r\n");
        //Lorsqu'on passait à la ligne, il y avait en fait deux actions : renvoyer le chariot au début de la ligne (tout à gauche), et faire avancer le papier pour bien écrire sur la ligne suivante.
        fclose($monfichier3);

        try
        {
	    $bdd = new PDO('mysql:host=localhost;dbname=id6713792_cv;charset=utf8', 'id6713792_pascal', 'Radio124f'); //On construit une instance de la classe PDO.
        }
        catch (Exception $e)
        {
        die('Erreur : ' . $e->getMessage());
        }
        $req = $bdd->prepare('INSERT INTO formulaire(nom, sexe, adresse_mail, adresse_ip, date) VALUES(:nom, :sexe, :adresse_mail, 
        :adresse_ip, :date)');
 		$req->execute(array('nom' => $_POST['nom'], 'sexe' => $_POST['sexe'], 'adresse_mail' => $_POST['user_mail'], 'adresse_ip' => $_SERVER['REMOTE_ADDR'], 'date' => $date));
		$req->closeCursor();

        mail("p.fertelle@hotmail.fr","nouveau contact CV en ligne" , $contact ,"From:PASCAL FERTELLE <pascal.fertelle@bbox.fr>" );
        }
		echo '<h2>Cette page a été vue ' . $pages_vues . ' fois !<h2>';
		?>
		Cliquer<a href="pret_immobilier.php?sexe=<?php echo $sexe;?>"><em> ici </em></a>pour votre simulation de prêt immobilier.
		</div>
	</div>
	<section class="élément">
		<h1><strong>FERTELLE PASCAL </strong> <a href="image/photo.jpg" target="_blank"><img class="photo_identite" src=
		"image/photo_mini.jpg" alt="Pascal Fertelle" title="PASCAL FERTELLE" /></a></h1>
		<span class="en_tete">6 rue de la Ferme Flahaut 62113 Labourse</span></br>                                 
		<span class="en_tete">Tel :0633260628</span></br>
		<a href="mailto:p.fertelle@hotmail.fr" title="Pour m'envoyer un mail"><em class="en_tete">p.fertelle@hotmail.fr</em></br></a>
		<img class="en_tete" src="image/twitter.png" alt="twitter"/> <a class="lien" href="https://mobile.twitter.com/pascalfertelle?lang=fr" target=
		"_blank" title="Mes tweets">@PascalFertelle</a></br>
		<img class="en_tete" src="image/linkedin.jpg" alt="linkedin"/><a class="lien" href="https://www.linkedin.com/in/fertelle-pascal-08160271" target=
		"_blank" title="Mon profil linkedin">https://www.linkedin.com/in/fertelle-pascal-08160271</a>
	</section>
	<section class="élément">
	<h2><strong>Responsable magasin et atelier de production</strong></h2>
	</section>
	<section class="élément">
		<h3>Expériences professionnelles </h3>
			<ul>
				<li>Depuis Aout 2017: <strong>Responsable magasin et atelier de production chez<a href="http://www.centaure-systems.fr/" target=
				"_blank" title="Systèmes de communication visuelle et dynamique
				par affichage électronique"> Centaure Systems</a></strong> fabricant de panneaux d’affichage électronique <img src=
				"image/logo_centaure_systems.png" alt="centaure_systems"/></li>
					<ul class="liste">
						<li>Responsable du bon déroulement, du contrôle du process de fabrication des produits neufs et des modifications des produits 
						neufs dans le respect des spécifications exigées et des délais demandés.</li>
						<li>Encadrement de 2 techniciens monteurs câbleurs.</li>
						<li>Gestion du magasin et de l’approvisionnement des pièces de fabrication en nombre et en qualité des panneaux d’affichage 
						(logiciel SAGE) avec nos fournisseurs en coordination avec le comptable de l’entreprise.</li></br>
					</ul>
				<li>Sept 2010-juil 2017 : <strong>Prescripteur marché public </strong>–<span class="militaire"> Etat-major interarmees </span><img
				src="image/dirisi.jpg" alt="dirisi"/></br>Exploitant d’un accord cadre pour la location de services de télécommunications civiles auprès 
				d’opérateurs civils pour les armées (AIRBUS DEFENCE & SPACE et ECLIPSE) dans le cadre d'un marché public :</li>
					<ul class="liste">
						<li>Établissement des bons de commande pour des services et du matériel dans différentes gammes de fréquences satellitaires en 
						fonction des besoins exprimés par les armées / Suivi Physico-financier de 3,5 M € par an / Suivi du renouvellement des commandes.
						</li>
						<li>Interlocuteur des clients de la défense et des fournisseurs pendant toute la durée des contrats.</li>
						<Li>Participation aux appels d'offres (analyse technique des lots).</li>
						<li>Suivi de la directive d’exploitation des ressources satellites civiles (respect des procédures,enregistrement des stations dans 
						le réseau…)</li>
					</ul>
				<li>Mars 2006-sept 2010 : <strong>Technicien supérieur</strong> au <span class="militaire">centre de mise en oeuvre des 
				satellites militaires</span><img src="image/dirisi.jpg" alt="dirisi"/></li>
					<ul class="liste">
						<li>Application de procédures (certifiées Thales) pour l’attribution de ressources satellites planifiés ou en urgence et la 
						supervision des liaisons (respect des consignes de fréquences et puissances allouées).</li>
						<li>Travail exercé sous forme de permanence de 24 heures avec encadrement d'une équipe de 3 personnes.</li>
					</ul>	
				<li>Sept 2002-fév 2006 : <strong>Responsable service télécom</strong> sur le bâtiment ravitailleur Marne et la frégate Aconit de la <span class="militaire">Marine Nationale </span><img src="image/marine_nationale.jpg" alt="marine_nationale"/></li>
					<ul class="liste">
						<li>Gestion des demandes de ressources satellites / Conseiller technique.</li>
						<li>Exploitation et maintenance des émetteurs/récepteurs radioélectriques.</li>
						<li>Encadrement de 3 personnes.</li></br>
					</ul>
			<li>Oct 1997-sep 2001 : <strong>Opérateur télécommunication radioélectrique</strong> sur les frégates Courbet et Surcouf de la <span class="militaire">Marine Nationale  </span><img src="image/marine_nationale.jpg" alt="marine_nationale"/></li>
					<ul class="liste">
						<li>Exploitation des systèmes de messagerie.</li>
						<Li>Mise en place des liaisons radioélectriques.</li>
						<li>Rédaction de fiches d’exploitation des équipements radioélectriques.</li></br>
					</ul>
	</ul>
		<a href="#haut_de_page">Revenir en haut de page</a>
	</section>
		<section class="élément">
			<h3>Formations</h3>
			<ul>
				<li>17 Janvier 2018 : <a href="pdf/CACES_3.pdf" target="_blank" title="Télécharger">CACES 3 R389</a></li>
				<li>2011 - 2014 : cours d'analyse économique et financière au CNAM Ile-de-France en cours du soir et en formation à distance </br>
				Cliquer<a href="attestations_cnam.php?sexe=<?php echo $sexe;?>"><em> ici </em></a>pour télécharger mes attestations du CNAM.<img src="image/cnam_logo.jpg" alt="cnam" 
				title="Conservatoire National des arts et métiers"/></li>
				<li>2004 : <a href="pdf/DU_TELECOM_ET_SPATIALES.pdf" target="_blank" title="Télécharger">Diplôme Universitaire en télécommunications spatiales et mobiles</a> (université-Toulon-Var)</li>
				<li>2002 : <a href="pdf/Diplome_TITRE3.pdf" target="_blank" title="Télécharger">Titre RNCP Niveau III</a> Technicien supérieur de maintenance et d’exploitation en télécommunication, option câble, option réseau 
				hertzien</li>
				<li>1997 : <a href="pdf/Diplome_TITRE4.pdf" target="_blank" title="Télécharger">Titre RNCP Niveau IV</a> Technicien d’équipement de télécommunications hertziennes</li>
				<li>1995 : <a href="pdf/B_A_C.pdf" target="_blank" title="Télécharger">Baccalauréat</a> scientifique option mathématiques</li>
			</ul>
			<a href="#haut_de_page">Revenir en haut de page</a>
		</section class="élément">
		<section class="élément">
			<h3>Activités extra-professionnelles</h3>
			<p>Soutien actif d’entrepreneurs audacieux et innovants </p>
			<ul>
				<li>Prises de participations dans des PMEs non cotées </li>
				<li>Suivi de l’actualité économique et politique</li>
				<Li>Démarche visant à promouvoir ces PMEs au travers de mails et des réseaux sociaux</li>
				<li>Veille internet/ proposition d’idées pour ces PMEs </li>
			</ul>
			<a href="#haut_de_page">Revenir en haut de page</a>
		</section>	
</body>
</html>
