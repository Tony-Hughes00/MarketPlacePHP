<?php

namespace App\Controller;
use App;
class CarteLegend
{

  
    public function __construct() {}

    function affiche() {
      ?>
      <div class="row"> 
        <div class="col-1 carteLegendDiv">
          <div class="carteLegendIndex carteLegendOffert"></div> 
        </div>
        <div class="col-11 carteLegendText"> 
          <span class="">Départ</span> 
        </div>

        <div class="col-1 carteLegendDiv" style="text-align: right;">
          <span class="carteLegendIndex carteLegendDemande"></span> 
        </div>
        <div class="col-11 carteLegendText"> 
          <span class="">Arrivée</span> 
        </div>
        
<!--         <div class="col-1 carteLegendDiv" style="text-align: right;">
          <span class="carteLegendIndex carteLegendDispo"></span> 
        </div>
        <div class="col-11 carteLegendText"> 
          <span class="">disponibilité</span> 
        </div> -->
      </div>
      <?php
    }
    function afficheRelation() {
      ?>
    <div class="row"> 
      <div class="col-6 carteLegendDiv">
        <div class="carteLegendRelation carteLegendDispo"></div> 
      </div>
      <div class="col-6 carteLegendText"> 
        <span class="">Trajet demandé</span> 
      </div>

      <div class="col-6 carteLegendDiv">
        <div class="carteLegendOffert carteLegendRelation"></div> 
      </div>
      <div class="col-6 carteLegendText"> 
        <span class="">Départ correspondant</span> 
      </div>

      <div class="col-6 carteLegendDiv">
        <div class="carteLegendRelation carteLegendDemande"></div> 
      </div>
      <div class="col-6 carteLegendText"> 
        <span class="">Arrivée correspondante</span> 
      </div>
      
    </div>
    <?php
    }
}