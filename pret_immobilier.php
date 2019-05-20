<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="style.css" type="text/css" />
<title>Simulateur de pret immobilier</title>
</head>
<body class="<?php echo $_GET['sexe'];?>">
<h1 id="titre">Bienvenue sur mon simulateur de prêt immobilier</h1>
<div class="flexbox2">	
	<div>
		<form method="post">
		<fieldset class="flexbox3">
			<legend>votre prêt immobilier</legend>
			<p>Date de début du prêt : <input type = "date" name = "date" value = "<?php echo date('Y-m-d'); ?>"> </p>
			<p>Capital emprunté : <input type = "number" name = "capital_emprunté" value="<?php if (isset($_POST['capital_emprunté'])){echo $_POST['capital_emprunté'];} ?>"> </p>
			<p>Frais de dossier : <input type = "number" name = "frais_de_dossier" value="<?php if (isset($_POST['frais_de_dossier'])){echo $_POST['frais_de_dossier'];} ?>"> </p>
			<p>Durée du prêt en années : <input type = "number" name = "durée" value="<?php if (isset($_POST['durée'])){echo $_POST['durée'];} ?>"> </p>
			<p>Mensualité hors assurance : <input type = "number" name = "mensualité" step="any" value="<?php if (isset($_POST['mensualité'])){echo $_POST['mensualité'];} ?>"> </p>
			<p>Assurance du prêt par mois: <input type = "number" name = "assurance"  step="any" value="<?php if (isset($_POST['assurance'])){echo $_POST['assurance'];}?>"></p>
			<input type = "submit" value = "Envoyer">
		</fieldset>
		</form>
		<a href="index.php">Revenir au CV </a>
	</div>

		<?php
		if (isset ($_POST["date"]) && isset ($_POST["capital_emprunté"]) && isset ($_POST["frais_de_dossier"]) && isset ($_POST["durée"]) && isset ($_POST["mensualité"]) && isset ($_POST["assurance"]))
		{   
			try
		    {
			$bdd = new PDO('mysql:host=localhost;dbname=id6713792_cv;charset=utf8', 'id6713792_pascal', 'Radio124f'); //On construit une instance de la classe PDO.
		    }
		    catch (Exception $e)
		    {
		    die('Erreur : ' . $e->getMessage());
		    }
		    $req=$bdd->prepare('TRUNCATE TABLE pret_immobilier');
	 		$req->execute(array());
			$req->closeCursor();

			echo '<div class="flexbox4">';
			$K = $_POST["capital_emprunté"];
			$fd=$_POST["frais_de_dossier"];
			$a=$_POST["assurance"];
			$durée = $_POST["durée"];
			$durée = 12*$durée;
			$m = $_POST["mensualité"];
			$taux=0.005;
			$n=1;
			$calcul=10;
			$date = $_POST["date"];
			$today= new DateTime();
			$date1= new DateTime ($_POST["date"]);

			while ($calcul>0.00001) 
				{
					$calcul=0;
					$taux = $taux - 0.0000001;
					while ($n<=$durée)
					{
						$calcul=$calcul + ($m/(1+$taux)**$n);
						$n=$n+1;
					}
					$calcul=$K-$calcul;
					$n=1;
				}


			while ($calcul<-0.00001) 
				{
					$calcul=0;
					$taux = $taux + 0.00000001;
					while ($n<=$durée)
					{
						$calcul=$calcul + (($m)/(1+$taux)**$n);
						$n=$n+1;
					}
					$calcul=$K-$calcul;
					$n=1;
				}
			
			$taux1=$taux;

			$calcul=-1;

			while ($calcul<-0.00001) 
				{
					$calcul=0;
					$taux = $taux + 0.00000001;
					while ($n<=$durée)
					{
						$calcul=$calcul + (($m)/(1+$taux)**$n);
						$n=$n+1;
					}
					$calcul=$K-$fd-$calcul;
					$n=1;
				}

			$taux2=$taux;

			$calcul=-1;

			while ($calcul<-0.00001) 
				{
					$calcul=0;
					$taux = $taux + 0.00000001;
					while ($n<=$durée)
					{
						$calcul=$calcul + (($m+$a)/(1+$taux)**$n);
						$n=$n+1;
					}
					$calcul=$K-$fd-$calcul;
					$n=1;
				}

			$taux3=$taux;

			if ($date<$today)
				{
				$interval=date_diff($date1,$today);
				$interval= (($interval->format('%y') * 12) + $interval->format('%m'));
				settype($interval, "integer");
				}

			echo 
			'<div id="scrollbar"><table class="élément">
			<caption>Tableau d\'amortissement</caption>
			<tr>
			<th>Mensualité</th>
			<th>intêrets</th>
			<th>Capital remboursé</th>
			<th>Capital restant dû</th>
			<th>date de remboursement</th>';
			if ($_POST["assurance"]!==0)
			{echo '<th>Assurance du prêt</th>';}
			echo '<th>Montant total à rembourser</th></tr>';
			while ($n<=$durée) 
			{

				$intêrets=$K*$taux1;
				$intêrets=round($intêrets,2);
				$Kremboursé=$m-$intêrets;
				$K=$K-$Kremboursé;
				$date=date('Y-m-d',strtotime('+1 month',strtotime($date)));
				echo '<tr';

					if ($n<=$interval)
					{
					echo ' class="green"';
					}
					else
					{
					echo ' class="red"';
					}

						echo '>
					  <td'; if($n==$interval+1) {echo ' class="échéance"';} else {echo ' class="autre"';} echo'>'.$n.'</td>
					  <td'; if($n==$interval+1) {echo ' class="échéance"';} else {echo ' class="autre"';} echo'>'.$intêrets.'</td>
					  <td'; if($n==$interval+1) {echo ' class="échéance"';} else {echo ' class="autre"';} echo'>'.$Kremboursé.'</td>
					  <td'; if($n==$interval+1) {echo ' class="échéance"';} else {echo ' class="autre"';} echo'>'.$K.'</td>
					  <td'; if($n==$interval+1) {echo ' class="échéance"';} else {echo ' class="autre"';} echo'>'.$date.'</td>';
					  if ($_POST["assurance"]!==0)
					  {echo '<td'; if($n==$interval+1) {echo ' class="échéance"';}  else {echo ' class="autre"';} echo'>'.$_POST["assurance"].'</td>';}
					  echo '<td'; if($n==$interval+1) {echo ' class="échéance"';} else {echo ' class="autre"';} echo'>'.($m+$a).'</td>';
					  if($n==$interval+1) {echo'<td class="échéance"> prochaine échéance</td>';} echo '</tr>';

				try
		        {
			    $bdd = new PDO('mysql:host=localhost;dbname=id6713792_cv;charset=utf8', 'id6713792_pascal', 'Radio124f'); //On construit une instance de la classe PDO.
		        }
		        catch (Exception $e)
		        {
		        die('Erreur : ' . $e->getMessage());
		    	}
		        $req = $bdd->prepare('INSERT INTO pret_immobilier(intérêts, Kremboursé, K, date_de_remboursement, assurance_du_prêt, montant_total_à_rembourser) VALUES(:interets, :Krembourse, :K, :date_de_remboursement, :assurance_du_pret, :montant_total_a_rembourser)');
	 			$req->execute(array('interets' => $intêrets, 'Krembourse' => $Kremboursé, 'K' => $K, 'date_de_remboursement' => $date, 'assurance_du_pret'=> $_POST["assurance"], 'montant_total_a_rembourser' => ($m+$a)));
				$req->closeCursor();
					  
					  
				$n=$n+1;
			}
		echo '</table></div>
		<div>
		<h1 class="TAEG"> Le TAEG est de '.round((((1+$taux3)**12-1)*100),2).'%</h1>
		<h2 class="TAEG"> L\'impact des frais de dossier sur le TAEG est de '.round(((((1+$taux2)**12-1)-((1+$taux1)**12-1))*100),2).'%</h2>
		<h2 class="TAEG">L\'impact de l\'assurance du prêt sur le TAEG est de '.round(((((1+$taux3)**12-1)-((1+$taux2)**12-1))*100),2).'%</h2>
		</div>
		</div>';
		}
	?>
</div>
</body>
</html>