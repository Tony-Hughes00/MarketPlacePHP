<?php
namespace App\Controller\BackOffice;
use App;
use App\Controller\BackOffice\AppBackOfficeController;
use Core\Entity;

class InsProprietaireController extends AppBackOfficeController {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Function render admin PDF view
     *
     * @return void    
     * 
     * */
    public function get() {
      App::getInstance()->title = 'Inscription' .  App::getInstance()->title;

      $explodeURI = explode('.', $_SERVER['REQUEST_URI']);
      $userType = end($explodeURI);
    //   echo "$this->template";
    //   var_dump($this->template);
    //   var_dump($this->viewPath);
    //   var_dump($_SERVER['PHP_SELF']);

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
     public function post() {
         // App::getInstance()->title = 'Inscription réussie' .  App::getInstance()->title;
         $tableUser = $this->_loadModel('User');
         $tableAdresse = $this->_loadModel('Adresse');
         $tableMembre = $this->_loadModel('Membre');

         $userData['email'] = $_POST['ins_email'];
         $userData['user_type'] = "prop";
         $userData['nom'] = $_POST['ins_nom'];
         $userData['prenom'] = $_POST['ins_prenom'];
         $userData['civilite'] = $_POST['ins_civilite'];

         $userExists = App\Entity\UserEntity::loadFromEmail($userData['email']);
         if (!$userExists) {
             $hash = password_hash($_POST['ins_mdp'], PASSWORD_ARGON2I);

             $userData['mdp'] = $hash;
             // User
             $user = App\Entity\UserEntity::fromArray($userData);
 
             $userData['user_id'] = $user->insert();

            //  $this->render('BackOffice.inscription', compact('userData'));

             header('location: ' . ROUTE . '/', true, 303);
         } else {
          // $this->render('BackOffice.inscription', compact('userData'));
          header('location: ' . ROUTE . '/', true, 303);
         }
    }
        /**
     * Function return data as JSON
     *
     * @return void
     */


  }

?>