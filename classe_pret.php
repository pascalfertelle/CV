<?php
class Pret
{
  private $_K;
  private $_mensualite;
  private $_assurance;
  private $_duree;
  private $_date;
  private $_FraisDeDossier;
  private $_TAEG;
  private $_ImpactFraisDeDossier;
  private $_ImpacteAssurance;
  private $_taux1;
  private $_tableauAmortissement;

  const N=1;


  public function __construct($K, $mensualite, $assurance,$duree,$date,$FraisDeDossier) // Constructeur demandant 5 paramètres
  {
    $this->setK($K);// Initialisation du capital K.
    $this->setMensualite($mensualite); // Initialisation de la mensualité.
    $this->setAssurance($assurance); // Initialisation de l'assurance.
    $this->setDuree($duree); // Initialisation de la durée.
    $this->setDate($date); // Initialisation de la date.
    $this->setFraisDeDossier($FraisDeDossier);//Initialisation des frais de dossier.
    $this->setTaux();//Initialisation de TAEG, ImpactFraisDeDossier, ImpactAssurance.
    $this->setTableauAmortissement();//Initialisation du tableau d'amortissement du prêt.
  }

  // Mutateur chargé de modifier l'attribut $_K.
  public function setK($K)
  {settype($K, "float");
    if (!is_float($K)) // S'il ne s'agit pas d'un nombre entier.
    {
      trigger_error('La montant d\'un prêt doit être un nombre entier', E_USER_WARNING);
      return;
    }

if ($K < 0) // On vérifie bien qu'on ne souhaite pas assigner une valeur négative.
    {
      trigger_error('La montant d\'un prêt ne peut être négative', E_USER_WARNING);
      return;
    }
    
    $this->_K = $K;
  }

  // Mutateur chargé de modifier l'attribut $_mensualite.
  public function setMensualite($mensualite)
  {settype($mensualite, "integer");
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

    $this->_mensualite = $mensualite;
  }

 // Mutateur chargé de modifier l'attribut $_assurance.
  public function setAssurance($assurance)
  {settype($assurance, "float");
    if (!is_float($assurance)) // S'il ne s'agit pas d'un nombre entier.
    {
      trigger_error('L\'assurance d\'un prêt doit être un nombre entier', E_USER_WARNING);
      return;
    }

if ($assurance < 0) // On vérifie bien qu'on ne souhaite pas assigner une valeur négative.
    {
      trigger_error('L\'assurance d\'un prêt ne peut être négative', E_USER_WARNING);
      return;
    }

    $this->_assurance = $assurance;
  }

   // Mutateur chargé de modifier l'attribut $_duree.
  public function setDuree($duree)
  { settype($duree, "integer");
    if (!is_int($duree)) // S'il ne s'agit pas d'un nombre entier.
    {
      trigger_error('La durée d\'un prêt doit être un nombre entier', E_USER_WARNING);
      return;
    }

if ($duree < 0) // On vérifie bien qu'on ne souhaite pas assigner une valeur négative.
    {
      trigger_error('La durée d\'un prêt ne peut être négative', E_USER_WARNING);
      return;
    }

    $this->_duree = 12*$duree;

  }

    // Mutateur chargé de modifier l'attribut $_date.
  public function setDate($date)
  {$date=date('Y-m-d',strtotime($date));
  	list($annee, $mois, $jour) = explode("-", $date);
    if(!checkdate($mois,$jour,$annee)) // S'il ne s'agit pas d'une date correcte.
    {
      trigger_error('La date n\'est pas valide', E_USER_WARNING);
      return;
    }

    $this->_date= $date;

  }

   // Mutateur chargé de modifier l'attribut $_FraisDeDossier.
  public function setFraisDeDossier($FraisDeDossier)
  {settype($FraisDeDossier, "float");
    if (!is_float($FraisDeDossier)) // S'il ne s'agit pas d'un nombre entier.
    {
      trigger_error('Les frais de dossier d\'un prêt doit être un nombre entier', E_USER_WARNING);
      return;
    }


    if ($FraisDeDossier < 0) // On vérifie bien qu'on ne souhaite pas assigner une valeur négative.
    {
      trigger_error('Ls frais de dossier d\'un prêt ne peut être négative', E_USER_WARNING);
      return;
    }

    $this->_FraisDeDossier = $FraisDeDossier;
  }

// Liste des getters

  public function K()
  {
    return $this->_K;
  }

   public function mensualite()
  {
    return $this->_mensualite;
  }

 public function assurance()
  {
    return $this->_assurance;
  }

 public function duree()
  {
    return $this->_duree;
  }

 public function FraisDeDossier()
  {
    return $this->_FraisDeDossier;
  }

  
  public function TAEG()
  {
    return $this->_TAEG;
  }

  public function ImpactFraisDeDossier()
  {
    return $this->_ImpactFraisDeDossier;
  }
  

  public function ImpactAssurance()
  {
    return $this->_ImpactAssurance;
  }

public function TableauAmortissement()
  {
    return $this->_tableauAmortissement;
  }


  public function setTaux()
  {
  	$calcul=10;
  	$n=self::N;
  	$taux=0.005;
  	$K=$this->_K;
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
      
      $taux1=$taux;
      $this->_taux1=$taux1;

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
      $this->_TAEG = round((((1+$taux3)**12-1)*100),2);
      $this->_ImpactFraisDeDossier = round(((((1+$taux2)**12-1)-((1+$taux1)**12-1))*100),2);
      $this->_ImpactAssurance = round(((((1+$taux3)**12-1)-((1+$taux2)**12-1))*100),2);
  }

  public function setTableauAmortissement()
  {
  	$n=self::N;
    $K=$this->_K;
    $a=$this->_assurance;
    $m=$this->_mensualite;
    $durée=$this->_duree;
    $taux1=$this->_taux1;
    $date=$this->_date;
    $tableauAmortissement=array();
  while ($n <= $durée) 
	{

	$intêrets=$K*$taux1;
	$intêrets=round($intêrets,2);
	$Kremboursé=$m-$intêrets;
	$K=$K-$Kremboursé;
	$date=date('Y-m-d',strtotime('+1 month',strtotime($date)));

  	$tableauAmortissement[$n]= array('interets' => $intêrets, 'Krembourse' => $Kremboursé, 'K' => $K, 'date_de_remboursement' => $date, 'assurance_du_pret'=> $a, 'montant_total_a_rembourser' => ($m+$a));

  	$n=$n+1;
  	}
  	$this->_tableauAmortissement=$tableauAmortissement;
  }
}

/*$pret1= new Pret(100000,900,30,10,'12-06-10',500);
echo 'le TAEG est de '.$pret1->TAEG().'%<br>';
echo 'les frais de dossier ont un impact de '.$pret1->ImpactFraisDeDossier().'% sur le TAEG<br>';
echo 'l\'assurance du prêt a un impact de '.$pret1->ImpactAssurance().'% sur le TAEG';
print_r($pret1->TableauAmortissement());/*