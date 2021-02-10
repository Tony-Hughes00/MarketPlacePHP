<?php
namespace App\Controller\Api;
use App;
use App\Business;
use App\Controller\Admin\AppAdminController;

class BoutiqueController extends AppApiController {
protected $businessLayer;
    public function __construct() {
        $this->businessLayer = new business\BoutiqueBusiness();
    }
    public function getAll() {

      $boutiques = $this->businessLayer->get('Boutique');

      $this->sendResponse($boutiques);
    }
  }