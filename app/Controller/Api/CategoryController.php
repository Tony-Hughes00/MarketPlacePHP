<?php
namespace App\Controller\Api;
use App;
use App\Business;
use App\Controller\Admin\AppAdminController;

class CategoryController extends AppApiController {
protected $businessLayer;
    public function __construct() {
        $this->businessLayer = new business\CategoryBusiness();
    }

    public function getAll() {

      $categories = $this->businessLayer->getAll();

      $this->sendResponse($categories);
    }
  }