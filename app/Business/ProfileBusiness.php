<?php

namespace App\Business;
use App;
// use App\Business;
use Exception;
use Core\Entity;
use Core\Business\Business;


class ProfileBusiness extends Business {

    public function __construct() {

    }

    /**
     * Function render admin PDF view
     *
     * @return void    
     * 
     * */
    public function getProfil(): object {
      // $user = (object) array();
      $user = $this->load('User', 'id_user', $this->UserId());

      if ($user) {
        $user->boutique = $this->getByCol('Boutique', 'id_vendeur', $user->id_user);
      }
      return $user;
    }
}
