<?php

namespace App\Controller\BackOffice;
use App;
use App\Controller\BackOffice\AppBackOfficeController;
use Core\Entity;
use App\Business;

class ProfilController extends AppBackOfficeController {
  protected $businessLayer;

    public function __construct() {
        parent::__construct();
        $this->businessLayer = new business\ProfileBusiness();

    }
    public function getProfil() {
      $this->Titre('Profil');

      $user = $this->businessLayer->getProfil();
      // var_dump($user);
      $this->render('backoffice.profil', compact('user'));
    }
  }