<?php header ("Content-type: image/png");
try
{
$bdd = new PDO('mysql:host=localhost;dbname=id6713792_cv;charset=utf8', 'id6713792_pascal', 'Radio124f'); //On construit une instance de la classe PDO.
}
catch (Exception $e)
{
die('Erreur : ' . $e->getMessage());
}
$req=$bdd->query('SELECT * FROM pret_immobilier');
// On affiche chaque entrée une à une
while ($donnees = $req->fetch())

$req->closeCursor();



$image = imagecreate(200,50);
$orange = imagecolorallocate($image, 255, 128, 0);
imagepng($image);
?>