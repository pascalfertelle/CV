<?php
	if (isset($_POST["tentative"]))
	{
	$incre=intval($_POST["tentative"])+1;
	}
	if ($_POST["password"] == "kangourou")
	{

		echo "Mon secret est : Brian is in the kitchen! Vous avez perçé mon secret au bout de " .$incre. " tentative";
		if ($incre>1)
		{
			echo "s!";
		}
		else
		{
			echo "!";
		}

	}
	else
	{ 
		header("location: mdp.php?inc=$incre");
	}
?>