<?php
class PretManager
{
  private $_db;


  public function __construct($db)
  {
  $this->setDb($db);

  }

  public function add(Pret $pret)

  {
  $req=$this->_db->prepare('INSERT INTO pret_caracteristiques(Kemprunte, frais_de_dossier, duree, mensualite, assurance) VALUES
	 		(:Kemprunte, :frais_de_dossier, :duree,:mensualite, :assurance)');

  $req->execute(array('Kemprunte' => $pret->K(), 'frais_de_dossier' => $pret->FraisDeDossier() , 'duree' => $pret->duree(), 'mensualite'=>$pret->mensualite() , 'assurance'=> $pret->assurance()));
  }

  public function setDb (PDO $db)
  {
  $this->_db = $db;
  }
}

