<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Mot de passe</title>
</head>
<body>
	<form method = "post" action = "secret.php">
		<legend> Votre mot de passe pour perçer mon secret !</legend>
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
		<input type = "hidden" name= "tentative" value="<?php echo $incrementation ; ?>">
	</form>
<?php
if ($incrementation>0)
{
echo $incrementation ." tentative";
}
?>
</body>
</html>