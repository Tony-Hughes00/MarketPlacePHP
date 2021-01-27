<?php

namespace App\Controller\BackOffice;
use App;
use App\Controller\BackOffice\AppBackOfficeController;
use Core\Entity;

class ProfilController extends AppBackOfficeController {

    public function __construct() {
        parent::__construct();
    }
    public function get() {
      $this->Titre('Profil');

      $this->console_log($this->UserId());

      $user = null;
      $user = $this->load('user', 'id_user', $this->UserId());
      $this->console_log($user);
      // var_dump($user);
      // $test = $_SESSION;
      $this->render('backoffice.profil', compact('user'));
    }
  }