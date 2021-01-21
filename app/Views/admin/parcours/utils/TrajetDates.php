<?php

namespace App\Controller;
use App;
require_once ROOT ."/app/Views/admin/parcours/utils/TrajetDate.php";
use DateTime;
use DatePeriod;
use DateInterval;
use DateTimeZone;
class TrajetDates
{
  protected $date_debut;
  protected $date_fin;
  protected $contrId;
  protected $disabled;

  public function __construct($date_debut, $date_fin, $contrId, $disabled, $classLabel, $classDate = "") {
    $this->date_debut = $date_debut;
    $this->date_fin = $date_fin;
    $this->contrId = $contrId;
    $this->disabled = $disabled;
    $this->classLabel = $classLabel;
    $this->classDate = $classDate;
  }
  /**
  * Function render adress view
  *
  * @return void
  */
  // function affiche() {
    // $html = "";

    // $html = $this->getHtml();

    // echo $html;
  // }
  function getDateString() {
    $str = "";
    $date_debut = new DateTime($this->date_debut);
    $date_fin = new DateTime($this->date_fin);
    if(substr($this->date_debut, 0, 10) == substr($this->date_fin, 0, 10)) {
      $str = $str . '<span class="' . $this->classLabel . '">&nbsp;le&nbsp;</span><span class="' . $this->classDate . '">' . $date_debut->format("d/m/Y") . '</span>';
      $str = $str . '<span class="' . $this->classLabel . '">&nbsp;entre&nbsp;</span><span class="' . $this->classDate . '">' . $date_debut->format("H:i") . '</span>'; 
      $str = $str . '<span class="' . $this->classLabel . '">&nbsp;et&nbsp;</span><span class="' . $this->classDate . '">' . $date_fin->format("H:i") . '</span>'; 
    } else {
      $str = $str . '<span class="' . $this->classLabel . '">entre&nbsp;</span><span class="' . $this->classDate . '">' . $date_debut->format("d/m/Y à H:i") . '</span>'; 
      $str = $str . '<span class="' . $this->classLabel . '">&nbsp;et&nbsp;</span><span class="' . $this->classDate . '">' . $date_fin->format("d/m/Y à H:i") . '</span>'; 
    }
    return $str;
  }
  function getDateStringProfil() {
    $str = "";
    $date_debut = new DateTime($this->date_debut);
    $date_fin = new DateTime($this->date_fin);
    if(substr($this->date_debut, 0, 10) == substr($this->date_fin, 0, 10)) {
      $str = $str . '&nbsp;le&nbsp;' . $date_debut->format("d/m/Y");
      $str = $str . '&nbsp;entre&nbsp;' . $date_debut->format("H:i"); 
      $str = $str . '&nbsp;et&nbsp;' . $date_fin->format("H:i"); 
    } else {
      $str = $str . 'entre le ' . $date_debut->format("d/m/Y à H:i"); 
      $str = $str . '<br>et le ' . $date_fin->format("d/m/Y à H:i"); 
    }
    return $str;
  }
  /**
  * Function render adress view
  *
  * @return void
  */
  function getDates() {

    $date_debut = null;
    $date_fin = null;

    if($this->date_debut) {
      $date_debut = $this->date_debut;
    }
    if($this->date_fin) {
      $date_fin = $this->date_fin;
    }
?>
    <div class="col-12">
      <?php
      $dateObjDebut = new App\Controller\TrajetDate($date_debut, 'TRAJET <span class="text-uppercase">' . $this->contrId . "</span><br><br>Départ entre", $this->contrId . "Debut", $this->disabled);
      $dateObjDebut->affiche();
      ?>
     </div>

     <div class="col-12">
       <?php
      $dateObjFin = new App\Controller\TrajetDate($date_fin, " et ", $this->contrId . "Fin", $this->disabled);
      $dateObjFin->affiche();
      ?>
     </div>
<?php
  }
}
?>