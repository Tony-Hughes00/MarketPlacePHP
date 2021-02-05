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
     * Function render admin PDF view
     *
     * @return void
     */
    public function options() {
        // $this->isAdmin();

        $data = "This is a test";

        // $this->sendHeaders();
        
        $resBody = (object) array();
        $resBody->status = "200";
        $resBody->message = "valid request";
        $resBody->data = "This is the data";
        // echo json_encode($resBody);
        $this->sendResponse($resBody);
    }
/**
     * Function login redirections
     *
     * @return void
     */
    public function connexion() {

        $login = $this->auth->login($_POST['con_email'], $_POST['con_mdp']);

    }

    /**
     * Function render admin PDF view
     *
     * @return void
     */
    public function get() {
        // $this->isAdmin();

        $data = (object) array();
        $data->body = $this->getBody();
        var_dump($data->body);
        $data->testMessage = "This is a test";
        $this->sendResponse($data->body);
    }

    
    /**
     * Function render admin PDF view
     *
     * @return void
     */
    public function inscription() {

        $data = (object) array();
        $data->body = json_decode($this->businessLayer->getBody());
        // var_dump($data);
  
        $userData['email'] = $data->body->email;
        $userData['user_type'] = "client";
        $userData['nom'] = $data->body->nom;
        $userData['prenom'] = $data->body->prenom;

        $resBody = $this->businessLayer->inscription($userData);

        $this->sendResponse($resBody);

    }
  }

?>