<?php

namespace App\Controller\BackOffice;
use App;
use App\Controller\BackOffice\AppBackOfficeController;
use Core\Entity;

class ProfilController extends AppBackofficeController {

    public function __construct() {
        parent::__construct();
    }
    public function get() {
      $this->Titre('Profil');

      $test = $_SESSION;
      $this->render('backoffice.profil', compact('test'));
    }
  }