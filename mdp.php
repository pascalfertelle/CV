<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Mot de passe</title>
</head>
<body>
	<form method = "post" action = "secret.php" enctype="multipart/form-data">
		<legend> Votre mot de passe pour perçer mon secret !</legend>
		<p>password : <input type = "password" name = "password"> </p>
		<p>fichier à transmettre : <input type="file" name="monfichier"> </p>
		<input type = "submit" value = "Envoyer le mot de passe">
		<?php
		if (isset ($_GET["inc"]))
		{
		$incrementation=$_GET["inc"];
		}
		else
		{
		$incrementation = 0;
		}
		?>
		<input type = "hidden" name= "tentative" value="<?php echo $incrementation ; ?>">
	</form>
<?php
if ($incrementation>0)
{
echo $incrementation ." tentative";
	if ($incrementation>1)
	{
		echo "s sans succès!";
	}
	else
	{
		echo " sans succès!";
	}
}
?>
</body>
</html>