<?php
class Pret
{
  private $_K;
  private $_mensualite;
  private $_assurance;
  private $_duree;
  private $_FraisDeDossier;

  public function __construct($K, $mensualite, $assurance,$duree,$FraisDeDossier) // Constructeur demandant 4 paramètres
  {
    $this->setMensualite($K);// Initialisation du capital K.
    $this->setMensualite($mensualite); // Initialisation de la mensualité.
    $this->setAssurance($assurance); // Initialisation de l'assurance.
    $this->setDuree($duree); // Initialisation de la durée.
    $this->setFraisDedossier($assurance);//Initialisation des frais de dossier.
  }

  // Mutateur chargé de modifier l'attribut $_K.
  public function setK($K)
  {
    if (!is_int($K)) // S'il ne s'agit pas d'un nombre entier.
    {
      trigger_error('La montant d\'un prêt doit être un nombre entier', E_USER_WARNING);
      return;
    }

if ($force < 0) // On vérifie bien qu'on ne souhaite pas assigner une valeur négative.
    {
      trigger_error('La montant d\'un prêt ne peut être négative', E_USER_WARNING);
      return;
    }
    
    $this->_K = $K;
  }

  // Mutateur chargé de modifier l'attribut $_mensualite.
  public function setMensualite($mensualite)
  {
    if (!is_int($mensualite)) // S'il ne s'agit pas d'un nombre entier.
    {
      trigger_error('La mensualité d\'un prêt doit être un nombre entier', E_USER_WARNING);
      return;
    }

if ($mensualite < 0) // On vérifie bien qu'on ne souhaite pas assigner une valeur négative.
    {
      trigger_error('La mensualité d\'un prêt ne peut être négative', E_USER_WARNING);
      return;
    }

    $this->_mensualite = $mensualité;
  }

 // Mutateur chargé de modifier l'attribut $_assurance.
  public function setAssurance($assurance)
  {
    if (!is_int($assurance)) // S'il ne s'agit pas d'un nombre entier.
    {
      trigger_error('L\'assurance d\'un prêt doit être un nombre entier', E_USER_WARNING);
      return;
    }

if ($force < 0) // On vérifie bien qu'on ne souhaite pas assigner une valeur négative.
    {
      trigger_error('L\'assurance d\'un prêt ne peut être négative', E_USER_WARNING);
      return;
    }

    $this->_assurance = $assurance;
  }

   // Mutateur chargé de modifier l'attribut $_duree.
  public function setDuree($duree)
  {
    if (!is_int($duree)) // S'il ne s'agit pas d'un nombre entier.
    {
      trigger_error('La durée d\'un prêt doit être un nombre entier', E_USER_WARNING);
      return;
    }

if ($force < 0) // On vérifie bien qu'on ne souhaite pas assigner une valeur négative.
    {
      trigger_error('La durée d\'un prêt ne peut être négative', E_USER_WARNING);
      return;
    }

    $this->_duree = 12*$duree;
  }

   // Mutateur chargé de modifier l'attribut $_FraisDeDossier.
  public function setFraisDedossier($FraisDeDossier)
  {
    if (!is_int($FraisDeDossier)) // S'il ne s'agit pas d'un nombre entier.
    {
      trigger_error('Les frais de dossier d\'un prêt doit être un nombre entier', E_USER_WARNING);
      return;
    }


    if ($force < 0) // On vérifie bien qu'on ne souhaite pas assigner une valeur négative.
    {
      trigger_error('Ls frais de dossier d\'un prêt ne peut être négative', E_USER_WARNING);
      return;
    }

    $this->_FraisDeDossier = $FraisDeDossier;
  }


  public function taux()
  {
  	$calcul=10;
  	$n=1;
  	$taux=0.005;
  	$m=$this->_mensualite;
  	$durée=$this->_duree;
  	$a=$this->_assurance;
  	$fd=$this->_FraisDeDossier;
    while ($calcul > 0.00001) 
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
      
      echo $taux1=$taux;

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

      echo $taux2=$taux;

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

      echo $taux3=$taux;
  }
}
$pret1= new Pret(100000,920,30,10,500);
$pret1->taux();

?>