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

        $resBody = (object) array();
        $resBody->status = "200";
        $resBody->message = "valid request";
        $resBody->data = "This is the data";
        
        $this->httpRespond($resBody);

    }
    /**
     * Function render admin PDF view
     *
     * @return void
     */
    public function post() {

      $resBody = (object) array();
      $resBody->status = "200";
      $resBody->message = "valid request";
      $resBody->data = file_get_contents('php://input');

      $this->httpRespond($resBody);
    }
        /**
     * Function return data as JSON
     *
     * @return void
     */


  }

?>