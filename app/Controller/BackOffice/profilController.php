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
    public function get() {
      $this->Titre('Profil');

      // $this->console_log($this->UserId());

      $user = $this->businessLayer->getProfile();
      // $this->console_log($user);
      // var_dump($user);
      // $test = $_SESSION;
      $this->render('backoffice.profil', compact('user'));
    }
  }