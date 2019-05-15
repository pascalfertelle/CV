<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Mot de passe</title>
</head>
<body>
	<form method = "post" action = "secret.php">
		<legend> Votre mot de passe</legend>
		<p>password : <input type = "password" name = "password"> </p>
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
		<input type = "hidden" name= "tentative" values="<?php echo $incrementation; ?>">
	</form>
<?php
echo $incrementation ."totohhh";
?>
</body>
</html>