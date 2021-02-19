<?php
namespace App\Controller\Api;
use App;
use App\Business;
use App\Controller\Admin\AppAdminController;

class UserController extends AppApiController {
protected $businessLayer;
    public function __construct() {
        $this->businessLayer = new business\UserBusiness();
    }
     /**
     * Function login redirections
     *
     * @return void
     */
    public function connexion() {
        $data = (object) array();
        $data->body = json_decode($this->getBody());
        // var_dump($data);
  
        $userData['email'] = $data->body->email;
        $userData['user_type'] = "client";
        $userData['mdp'] = $data->body->mdp;

        // $resBody =(object) array();
        $res = $this->getAuth()->login($userData['email'], $userData['mdp']);
        // $res = $user->user;;
        // var_dump($res);
// $resBody = "";
// $this->sendHeaders();
        $this->sendResponse($res);

    }

    /**
     * Function render admin PDF view
     *
     * @return void
     */
    public function logout() {
        $data = (object) array();
        $data->body = json_decode($this->getBody());
  
        $userData['email'] = $data->body->email;
        $userData['user_type'] = "client";
        $userData['mdp'] = $data->body->mdp;

        $resBody =(object) array();
        $resBody->user = $this->getAuth()->login($userData['email'], $userData['mdp']);
        // var_dump($resBody);
// $resBody = "";
// $this->sendHeaders();
        $this->sendResponse($resBody);
    }

    
    /**
     * Function render admin PDF view
     *
     * @return void
     */
    public function inscription() {

        $data = (object) array();
        // var_dump($this->getBody());
        $data->body = json_decode($this->getBody());
        // var_dump($data);
  
        $userData['email'] = $data->body->email;
        $userData['user_type'] = "client";
        $userData['nom'] = $data->body->nom;
        $userData['prenom'] = $data->body->prenom;
        $userData['mdp'] = $data->body->mdp;

        $resBody = $this->businessLayer->inscription($userData);

        $this->sendResponse($resBody);

    }
  }

?>