<?php
	if ($_POST["password"] = "kangourou")
	{
		echo "Mon secret est : Brian is in the kitchen!";
		echo $_POST["password"];
	}
	else
	{ 
		header("location: mdp.php");
	}
?>