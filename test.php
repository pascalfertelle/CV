<?php 
setcookie('ip', $_SERVER['REMOTE_ADDR'], time()+24*3600);
$adresse_ip=$_SERVER['REMOTE_ADDR'];
$date = date('Y-m-d G:i:s');
?>
<link rel="stylesheet" href="style.css" type="text/css" />
<form method="post">
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
</form>

<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=cv;charset=utf8', 'root', ''); //On construit une instance de la classe PDO.
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

$reponse = $bdd->query('SELECT * FROM formulaire'); 
//methode query de la classe PDO,Exécute une requête SQL, retourne un jeu de résultats en tant qu'objet PDOStatement

while ($donnees = $reponse->fetch())
//PDOStatement::fetch — Récupère la ligne suivante d'un jeu de résultats PDO 
{
?>
<p><?php echo $donnees['id'].' '.$donnees['adresse_mail']; ?></p>

<?php
}

$reponse->closeCursor(); // Termine le traitement de la requête

// On ajoute une entrée dans la table jeux_video
$bdd->exec('INSERT INTO formulaire(nom, sexe, adresse_mail, adresse_ip, date) VALUES(\'Sandy\', \'Madame\', \'s@gmail.fr\',\'72.72.72.72\', \'2019-07-16 08:00:00\')');

?>

<?php
$req = $bdd->prepare('INSERT INTO formulaire(nom, sexe, adresse_mail, adresse_ip, date) VALUES(:nom, :sexe, :adresse_mail, :adresse_ip, :date)');
$req->execute(array('nom' => $_POST['nom'], 'sexe' => $_POST['sexe'], 'adresse_mail' => $_POST['user_mail'], 'adresse_ip' => $adresse_ip, 'date' => $date));
$req->closeCursor();

?>