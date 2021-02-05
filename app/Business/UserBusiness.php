<?php

namespace App\Business;
use App;
// use App\Business;
use Core\Entity;
use Core\Business\Business;


class UserBusiness extends Business {

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
    /**
     * Function render admin PDF view
     *
     * @return void
     */
    public function inscription($data) {

      //  $userData['civilite'] = $_POST['ins_civilite'];
      $resBody = (object) array();
      $resBody->testMessage = 'creating user...';
      // $rsBody->reqData = $data->body;
      try {
       $userExists = $this->loadBy('User', 'email', $data['email']);
      }
      catch (Exception $e) {
          $resBody->error;
      }
      // var_dump($userExists);      //  var_dump('creating user....');
       if (!$userExists) {
           $hash = password_hash($data->body->mdp, PASSWORD_ARGON2I);

           $data['mdp'] = $hash;
           $user = $this->create('User', $data);
           $resBody->user = $user;

           $resBody->status = "200";
           $resBody->statusApi = "0";
           $resBody->message = "user created";
       } else {
        $resBody->status = "200";
        $resBody->statusApi = "1";
        $resBody->message = "user already exists";
        $resBody->user = $userExists;
       } 

       return $resBody;

  }
}
