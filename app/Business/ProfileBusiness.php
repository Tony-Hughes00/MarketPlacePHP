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
    public function getProfile() {
      $user = null;
      $user = $this->load('User', 'id_user', $this->UserId());

      return $user;
    }
}
