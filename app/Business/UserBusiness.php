<?php

namespace App\Business;
use App;
// use App\Business;
use Exception;
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
    // public function get() {

    // }
    /**
     * Function render admin PDF view
     *
     * @return void
     */

    //   /*
    //   * Function render inscription post submit
    //   *
    //   * @return void
    //   */
    //  public function post($data) {

    //      $userExists = $this->loadBy('user', 'email', $data['email']);
    //      if (!$userExists) {
    //          $hash = password_hash($_POST['ins_mdp'], PASSWORD_ARGON2I);

    //          $userData['mdp'] = $hash;
    //          // User
    //          $user = $this->fromArray('User', $userData);
 
    //          $userData['user_id'] = $user->insert();
    //          $userData['user'] = $user;

    //         return $userData;
    //      }
    // }
    /**
     * Function render admin PDF view
     *
     * @return void
     */
    public function inscription($data): object {
var_dump($data);
      //  $userData['civilite'] = $_POST['ins_civilite'];
      $resBody = (object) array();
      $resBody->testMessage = 'creating user...';
      // $rsBody->reqData = $data->body;
      try {
       $userExists = $this->getByCol('User', 'email', $data['email']);
      }
      catch (Exception $e) {
          $resBody->error = $e;
      }
      // var_dump($data);      //  var_dump('creating user....');
       if (!$userExists) {
           $hash = password_hash($data['ins_mdp'], PASSWORD_ARGON2I);

           $data['mdp'] = $hash;
           var_dump($data);
           $user = $this->create('User', $data);
           $resBody->user = $user;

           $resBody->status = "0";
          //  $resBody->statusApi = "0";
           $resBody->message = "user created";
       } else {
        $resBody->status = "1";
        // $resBody->statusApi = "1";
        $resBody->message = "user already exists";
        $resBody->user = $userExists;
       } 
       return $resBody;
  }
  public function connexion($data) {

    $resBody = (object) array();
    $resBody->testMessage = 'connexion...';

    $resBody->user = $this->auth->login($data['email'], $data['mdp']);
var_dump($resBody);
    if ($resBody->user) {
      $resBody->status = 1;
      $resBody->message = "connexion failed";
    } else {
      $resBody->status = 0;
      $resBody->message = "connexion réussi";
    }
    return $resBody;
  } 
}
