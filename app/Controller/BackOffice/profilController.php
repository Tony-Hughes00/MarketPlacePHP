<?php

namespace App\Controller\BackOffice;
use App;
use App\Controller\BackOffice\AppBackOfficeController;
use Core\Entity;
use App\Business;

class ProfilController extends AppBackOfficeController {

    public function __construct() {
        parent::__construct();
        $this->businessLayer = new business\ProfileBusiness();

    }
    public function getProfil() {
      $this->renderpage('backoffice.profil');
    }
  }