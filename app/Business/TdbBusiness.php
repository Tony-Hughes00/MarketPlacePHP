<?php

namespace App\Business;
use App;
// use App\Business;
use Exception;
use Core\Entity;
use Core\Business\Business;


class TdbBusiness extends Business {

    public function __construct() {

    }

    /**
     * Function render admin PDF view
     *
     * @return void    
     * 
     * */
    public function getTdb() {

      $boutique = $this->load('Boutique', 'id_vendeur', $this->UserId());
var_dump($boutique);
      return $boutique;
    }
}
