<?php
namespace App\Business;
use App;
use Core\Entity;

class UserBusiness {

    public function __construct() {

    }

    /**
     * Function render admin PDF view
     *
     * @return void    
     * 
     * */
    public function get() {

    }
    /**
     * Function render admin PDF view
     *
     * @return void
     */

      /*
      * Function render inscription post submit
      *
      * @return void
      */
     public function post($data) {

         $userExists = $this->loadBy('user', 'email', $userData['email']);
         if (!$userExists) {
             $hash = password_hash($_POST['ins_mdp'], PASSWORD_ARGON2I);

             $userData['mdp'] = $hash;
             // User
             $user = $this->fromArray($userData);
 
             $userData['user_id'] = $user->insert();
             $userData['user'] = $user;

            return $userData;
         }
    }



  }

?>