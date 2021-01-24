<?php
namespace App\Controller\Api;
use App;
use App\Controller\Admin\AppAdminController;

class TestController extends AppAdminController {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Function render admin PDF view
     *
     * @return void
     */
    public function get() {
        // $this->isAdmin();

        $data = "This is a test";

        header("Access-Control-Allow-Credentials: true");
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, authorization");
        header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");

        header('Content-Type: application/json');
        $resBody = (object) array();
        $resBody->status = "200";
        $resBody->message = "valid request";
        $resBody->data = "This is the data";
        echo json_encode($resBody);

    }
    /**
     * Function render admin PDF view
     *
     * @return void
     */
    public function post() {
        // $this->isAdmin();

        $data = "This is a test";

        header("Access-Control-Allow-Credentials: true");
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, authorization");
        header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");

        header('Content-Type: application/json');
        $resBody = (object) array();
        $resBody->status = "200";
        $resBody->message = "valid request";
        $resBody->data = file_get_contents('php://input');
        echo json_encode($resBody);


        // $this->render('admin.parcours.parcoursDetails', compact('data'));

    }
  }

?>