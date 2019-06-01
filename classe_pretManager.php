<?php
class PretManager
{
  private $_db;

  const N=1;


  public function __construct($db)
  {
  $this->setDb($db);

  }

  public function addCaracteristique(Pret $pret)

  {
  $req=$this->_db->prepare('INSERT INTO pret_caracteristiques(Kemprunte, frais_de_dossier, duree, mensualite, assurance) VALUES
	 		(:Kemprunte, :frais_de_dossier, :duree,:mensualite, :assurance)');

  $req->execute(array('Kemprunte' => $pret->K(), 'frais_de_dossier' => $pret->FraisDeDossier() , 'duree' => $pret->duree(), 'mensualite'=>$pret->mensualite() , 'assurance'=> $pret->assurance()));
  }

  public function addTableauAmortissement(Pret $pret)
  {
  	$n=self::N;
  	while ($n<= $pret->duree())
  	{
  	$req = $bdd->prepare('INSERT INTO pret_immobilier(intérêts, Kremboursé, K, date_de_remboursement, assurance_du_prêt, montant_total_à_rembourser) VALUES(:interets, :Krembourse, :K, :date_de_remboursement, :assurance_du_pret, :montant_total_a_rembourser)');
	 $req->execute(array('interets' => $intêrets, 'Krembourse' => $Kremboursé, 'K' => $K, 'date_de_remboursement' => $date, 'assurance_du_pret'=> $_POST["assurance"], 'montant_total_a_rembourser' => ($m+$a)));
  	}
  }

  public function setDb (PDO $db)
  {
  $this->_db = $db;
  }
}

