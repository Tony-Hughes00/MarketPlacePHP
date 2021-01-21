<?php

namespace App\Controller;
use App;
use DateTime;
use DatePeriod;
use DateInterval;
use DateTimeZone;

class TrajetDate
{
  protected $date;
  protected $label;
  protected $contrId;
  protected $disabled;

  public function __construct($date, $label, $contrId, $disabled) {
    if($date) {
      $this->date = $date;
    } else {
      $timeZone = new DateTimeZone('Europe/Paris');
      $this->date = null;

      // $this->date = (new DateTime(null, $timeZone))->format('Y-m-d H:i:s');
    }
    $this->label = $label;
    $this->contrId = $contrId;
    $this->disabled = $disabled;
    $this->classLabel = "parcoursLabel";

  }
    /**
  * Function render adress view
  *
  * @return void
  */
  function afficheDateValidation() {
    ?>
    <input type="hidden" value="TrajetDate::afficheDateValidation()">
    <div class="d-none d-sm-block" style="text-align:left; padding-left:30px;">
      <label for="Date<?=$this->contrId?>" class="<?= $this->classLabel ?>">
        <strong><?= $this->label?>&nbsp;</strong>
      </label>
      <input type="date" 
            id="Date<?=$this->contrId?>" name="Date<?=$this->contrId?>" 
            onchange="onClickValDateTime(this)" 
        <?php         
        if($this->disabled) {
            echo   'disabled';
        } ?>
            value="<?= 
                  Date(substr($this->date, 0, 10)); 
                  ?>"> 
      <input type="time"
             id="Time<?=$this->contrId?>" name="Time<?=$this->contrId?>"
             onchange="onClickValDateTime(this)" 
      <?php
        if($this->disabled) {
          echo  'disabled';
        }?>
             value="<?= 
          Date(substr($this->date, 11, 5))?>">
    </div>
    <div class="col-12 d-sm-none" style="text-align:left">
      <label for="<?=$this->contrId?>Date" 
            class="<?= $this->classLabel ?>"><strong><?= $this->label?>&nbsp;</strong></label>
    </div>
    <div class="col-12 d-sm-none" style="text-align:left">
      <input type="date" 
             id="<?=$this->contrId?>Date" name="<?=$this->contrId?>Date" 
      <?php         
        if($this->disabled) {
          echo   'disabled';
        } ?>
             value="<?= 
                  Date(substr($this->date, 0, 10)); 
                  ?>"> 
      <label for="hdepart"><strong>&nbsp;</strong></label>
      <input type="time"
             id="<?=$this->contrId?>Time" name="<?=$this->contrId?>Time"
      <?php
        if($this->disabled) {
          echo  'disabled';
        }?>
             value="<?=
             Date(substr($this->date, 11, 5))?>">
    </div>
    <?php
  }
  /**
  * Function render adress view
  *
  * @return void
  */
  function affiche() {
?>
    <input type="hidden" value="TrajetDate::affiche()">
    <div class="row" style="text-align:center; ">
    <div class="col-12" style="text-align:center; padding:20px;">
      <label for="<?=$this->contrId?>Date" class="<?= $this->classLabel ?>"><strong><?= $this->label?>&nbsp;</strong></label>
    </div>
     <div class="col-12 col-sm-12" style="text-align:center"> 
     <!-- <strong>&nbsp;entre test&nbsp;</strong> -->

     <!-- <div class="col-12 col-sm-12" style="text-align:left">  -->
      <input type="date" 
             id="<?=$this->contrId?>Date" name="<?=$this->contrId?>Date" 
             onchange="enableParcoursEnregButton()"
    <?php         
    if($this->disabled) {
            echo   'disabled';
    } ?>
             value="<?php
            if ($this->date == null) {
              echo null;
            } else {
              echo Date(substr($this->date, 0, 10)); 
            }
            ?>"> 
    <!-- </div> -->
    <strong>&nbsp;à&nbsp;</strong>
    <!-- <div class="col-12 col-sm-4" style="text-align:left"> -->
      <label for="hdepart"><strong>&nbsp;</strong></label>
        <input type="time"
           id="<?=$this->contrId?>Time" name="<?=$this->contrId?>Time"
           onchange="enableParcoursEnregButton()"
    <?php
    if($this->disabled) {
             echo  'disabled';
    }?>
               value="<?php 
            if ($this->date == null) {
              echo '00:00';
            } else {
              echo Date(substr($this->date, 11, 5)); 
            }
    ?>">
    </div>

    </div>
<?php
  }
    /**
  * Function render adress view
  *
  * @return void
  */
  function afficheDispo() {
    ?>
        <input type="hidden" value="TrajetDate::afficheDispo()">
        <div class="row">
    
        <!-- <div class="col-12" style="text-align:left">
          <label for="< ?=$this->contrId?>Date" class="< ?= $this->classLabel?>"><strong>< ?= $this->label?>&nbsp;</strong></label>
        </div> -->
    
        <div class="col-12 col-sm-4" style="text-align:left">
          <label for="hdepart"><strong>&nbsp;</strong></label>
            <input type="time"
               id="<?=$this->contrId?>Time" name="<?=$this->contrId?>Time"
               onchange="onChangeDispo(this)"
        <?php
        if($this->disabled) {
                 echo  'disabled';
        }?>
                   value="<?php 
                if ($this->date == null) {
                  echo '0';
                } else {
                  echo Date(substr($this->date, 0, 10)); 
                }
        ?>">
        </div>
    
        </div>
    <?php
      }
  /**
  * Function render adress view
  *
  * @return void
  */
  function afficheVal() {
    ?>
    <input type="hidden" value="TrajetDate::afficheVal()">
        <div class="row">
    
        <div class="col-12" style="text-align:left">
          <label for="duDepart" class="<?= $this->classLabel ?>"><strong><?= $this->label?>&nbsp;</strong></label>
        </div>
    
        <div class="col-12 col-sm-8" style="text-align:left">
          <input type="date" 
                 id="<?=$this->contrId?>Date" name="<?=$this->contrId?>Date" 
                 onchange="enableParcoursConfirmButton()"
        <?php         
        if($this->disabled) {
                echo   'disabled';
        } ?>
                 value="
                 <?= 
                Date(substr($this->date, 0, 10)); 
                ?>
        "> 
        </div>
    
        <div class="col-12 col-sm-4" style="text-align:left">
          <label for="hdepart"><strong>&nbsp;</strong></label>
            <input type="time"
               id="<?=$this->contrId?>Time" name="<?=$this->contrId?>Time"
               onchange="enableParcoursConfirmButton()"
        <?php
        if($this->disabled) {
                 echo  'disabled';
        }?>
                   value=" 
        <?=Date(substr($this->date, 11, 5))?> 
        ">
        </div>
    
        </div>
    <?php
      }
      // Convert a date or timestamp into French.
function dateToFrench($date, $format) 
{
    $english_days = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
    $french_days = array('lun', 'mar', 'mer', 'jeu', 'ven', 'sam', 'dim');
    $english_months = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
    $french_months = array('Janv', 'Févr', 'Mars', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sept', 'Oct', 'Nov', 'Déc');
    return str_replace($english_months, $french_months, str_replace($english_days, $french_days, date($format, strtotime($date) ) ) );
}
  function afficheFull() {
    // setlocale(LC_TIME, 'fr_FR');
    $date = new DateTime($this->date, new DateTimeZone('Europe/Paris'));
    $date = $date->format("D, d M Y");
    echo $this->dateToFrench($date, "D, d M Y");
  }
}
?>