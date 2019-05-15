<?php
	if (isset($_POST["incrementation"]))
	{
	$incre=$_POST["incrementation"]+1;
	}
	if ($_POST["password"] == "kangourou")
	{

		echo "Mon secret est : Brian is in the kitchen! Vous avez perçé mon secret" ;
		echo $_POST["incrementation"];

	}
	else
	{ 
		header("location: mdp.php?inc=$incre");
	}
?>