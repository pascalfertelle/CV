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
			<p>Présentez vous s'il vous plait<p />
			<p>Madame<input type= "radio" name="sexe" 
			<?php 
			if (isset($_POST["sexe"])) 
			{ 
			  if ($_POST["sexe"] == "Madame") 
			  {
				  echo "checked";
			  }
			}
			?>value="Madame">
			Monsieur<input type= "radio" name="sexe"
			<?php 
			if (isset($_POST["sexe"])) 
			{ 
			  if ($_POST["sexe"] == "Monsieur") 
			  {
				  echo "checked";
			  }
			}
			?>value="Monsieur"></p>
			<p>Votre nom : <input type = "text" name = "nom"> </p>
			<input type = "submit" value = "Envoyer">
		</form>
		<div class="élément">
		<h1 id="haut_de_page"> Bienvenue sur mon <strong>cv</strong> <?php if (isset($_POST["sexe"])) { echo $_POST["sexe"]; }?><?php if (isset($_POST["nom"])) 
		{ echo $_POST["nom"];}?><br /> conçu par apprentissage avec <a href="https://openclassrooms.com/"
		target="_blank" title="CLiquez ici pour découvrir OpenClassrooms"><em>OpenClassrooms </a></br></h1>
		<?php 
		$monfichier = fopen('compteur.txt', 'r+');
		$monfichier2 = fopen('adresse_ip.txt' , 'a');
		$date= date('l j F Y, H:i');
		$pages_vues = fgets($monfichier); // On lit la première ligne (nombre de pages vues)
		if (!isset ($_COOKIE['ip']))
		{
		$pages_vues += 1; // On augmente de 1 ce nombre de pages vues
		fseek($monfichier, 0); // On remet le curseur au début du fichier
		fputs($monfichier, $pages_vues); // On écrit le nouveau nombre de pages vues
		fclose($monfichier);
		}
		fwrite($monfichier2, $_SERVER['REMOTE_ADDR']);
		fwrite($monfichier2, ' ');
        fwrite($monfichier2, $date);
        fwrite($monfichier2, ' ');
        fwrite($monfichier2, "\r\n");
        fclose($monfichier2);
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
				<li>2011 - 2014 : cours d'analyse économique et financière au CNAM Ile-de-France en cours du soir et en formation à distance </br>
				Cliquer<a href="attestations_cnam.php?sexe=<?php echo $sexe;?>"><em> ici </em></a>pour télécharger mes attestations du CNAM.<img src="image/cnam_logo.jpg" alt="cnam" 
				title="Conservatoire National des arts et métiers"/></li>
				<li>2004 : Diplôme Universitaire en télécommunications spatiales et mobiles (université-Toulon-Var)</li>
				<li>2002 : Titre RNCP Niveau III Technicien supérieur de maintenance et d’exploitation en télécommunication, option câble, option réseau 
				hertzien</li>
				<li>1997 : Titre RNCP Niveau IV Technicien d’équipement de télécommunications hertziennes</li>
				<li>1995 : Baccalauréat scientifique option mathématiques</li>
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
