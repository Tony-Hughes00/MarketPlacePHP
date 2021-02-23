<?php
namespace App\Controller\BackOffice;
use App;
use App\Controller\BackOffice\AppBackOfficeController;
use Core\Entity;
use App\Business;

class UserController extends AppBackOfficeController {
  // protected $businessLayer;

    public function __construct() {
        parent::__construct();
        $this->businessLayer = new business\UserBusiness();

    }

    /**
     * Function render admin PDF view
     *
     * @return void    
     * 
     * */
    public function get() {
    //   App::getInstance()->title = 'Inscription' .  App::getInstance()->title;
      $this->Titre('Inscription');

      $explodeURI = explode('.', $_SERVER['REQUEST_URI']);
      $userType = end($explodeURI);

      $this->render('BackOffice.inscription', compact('userType'));
    }
    /**
     * Function render admin PDF view
     *
     * @return void
     */

      /*
      * Function render inscription post submit
      *
      * @return void
      */
     public function inscription() {
        //  App::getInstance()->title = 'Inscription réussie' .  App::getInstance()->title;
        $this->Titre('Inscription réussie');
var_dump($_REQUEST);
         $userData['email'] = $_POST['ins_email'];
         $userData['user_type'] = "prop";
         $userData['nom'] = $_POST['ins_nom'];
         $userData['prenom'] = $_POST['ins_prenom'];
         $userData['civilite'] = $_POST['ins_civilite'];
         $userData['ins_mdp'] = $_POST['ins_mdp'];

         $resBody = $this->businessLayer->inscription($userData);
         if ($resBody->user) {
             header('location: ' . ROUTE . '/', true, 303);
         } else {
          // $this->render('BackOffice.inscription', compact('userData'));
          header('location: ' . ROUTE . '/', true, 303);
         }
    }
    /*
    * Function login redirections
    *
    * @return void
    */
   public function connexion() {
  // var_dump($data);

    $userData['email'] = $_POST['con_email'];
    $userData['user_type'] = "prop";
    $userData['mdp'] = $_POST['con_mdp'];

    $resBody = (object) array();
    $resBody = $this->auth->login($userData['email'], $userData['mdp']);
// var_dump($resBody);
    if ($resBody->status == 0) {
      header('location: ' . ROUTE . 'boutique', true, 303);
    } else {
      // header('location: ' . ROUTE, true, 303);
      // header('location: ' . ROUTE . 'boutique', true, 303);
      $this->render('backoffice.noConnexion');
    }
   }

    /**
     * Function logout and redirect to home page
     * 
     * @return void
     */
    public function logout() {
      if (isset($_COOKIE['rememberMe'])) {
          unset($_COOKIE['rememberMe']);
          unset($_COOKIE['rememberMeToken']);

          setcookie('rememberMe', null, time() - 3600);
          setcookie('rememberMeToken', null, time() - 3600);

          $tableCookie = $this->_loadModel('Cookie');
          $token = $tableCookie->selectCookieTokenByEmail($_SESSION['marketplace']['email']);

          if ($token) {
              $tableCookie->deleteCookieToken($_SESSION['marketplace']['email']);
          }
      }

      unset($_SESSION['marketplace']);

      header('location: ' . ROUTE, true, 303);
  }

  }

?>