<?php
namespace App\Controller\Api;
use App;
use App\Business\UserBusiness;
use App\Controller\Admin\AppAdminController;

class InsUserController extends AppAdminController {
protected $businessLayer;
    public function __construct() {
        $businessLayer = new App\Business\UserBusiness();
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
     * Function render admin PDF view
     *
     * @return void
     */
    public function get() {
        // $this->isAdmin();

        $data = (object) array();
        $data->body = $this->getBody();
        $data->testMessage = "This is a test";
        // header("Access-Control-Allow-Credentials: true");
        // header("Access-Control-Allow-Origin: *");
        // header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, authorization");
        // header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");

        // header('Content-Type: application/json');
        // $resBody = (object) array();
        // $resBody->status = "200";
        // $resBody->message = "valid request";
        // $resBody->data = "This is the data";
        // // echo "we're here";
        // echo json_encode($resBody);
        $this->sendResponse($data);
    }
    /**
     * Function render admin PDF view
     *
     * @return void
     */
    public function post() {
        // $this->isAdmin();         
        
        // $body = $this->getBody();
		header("Access-Control-Allow-Credentials: true");
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, authorization");
		header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");

        header('Content-Type: text');

        $data = (object) array();
        $data->body = json_decode($this->getBody());
        // var_dump($data);

        $userData['email'] = $data->body->email;
         $userData['user_type'] = "client";
         $userData['nom'] = $data->body->nom;
         $userData['prenom'] = $data->body->prenom;
        //  $userData['civilite'] = $_POST['ins_civilite'];
        $resBody = (object) array();
        $resBody->testMessage = 'creating user...';
        // $rsBody->reqData = $data->body;
        try {
         $userExists = $this->loadBy('User', 'email', $userData['email']);
        }
        catch (Exception $e) {
            $resBody->error;
        }
        //  var_dump('creating user....');
         if (!$userExists) {
             $hash = password_hash($data->body->mdp, PASSWORD_ARGON2I);

             $userData['mdp'] = $hash;
             // User
            //  var_dump($userData);
             $user = $this->create('User', $userData);
            //  var_dump($user);
            //  $responseBody['user'] = $user;
 
            //  $userData['user_id'] = $user->insert();  
         }      
        // $this->sendResponse($userData);
        // $data = "This is a test";
        // $resBody = (object) array();
		$resBody->status = "200";
        $resBody->message = "valid request";
        $resBody->user = $user;
        // $resBody->data = $userExists;
        // $this->sendResponse($responseBody);
        // echo "{message: This is a user test}";
        $this->sendResponse($resBody);

    }
  }

?>