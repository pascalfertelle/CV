<?php
class PretManager
{
  private $_db;


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
  //http://blog.nalis.fr/index.php?post/2011/04/15/PDO%3A-insertion-multiple-en-une-seul-requete.
  {
  	$data=$pret->TableauAmortissement();
    $params=substr(str_repeat("?,", count($data[0])), 0, -1);
    $params=substr(str_repeat("(".$params."),", count($data)), 0, -1);
    $a=array();
    foreach ($params AS $param)
    {
    $a=array_merge($a, array_values($param));
    }

    $querySQL="INSERT INTO pret_immobilier (intérêts, Kremboursé, K, date_de_remboursement, assurance_du_prêt, montant_total_à_rembourser) VALUES ".$params;
    $state = $this->_db->prepare($querySQL);
       
    $state->execute($a);
    return $this->_db->lastInsertId();
       
    }

  public function setDb (PDO $db)
  {
  $this->_db = $db;
  }
}

