<?php

namespace Core\Business;
use App;
use App\Entity\Entity;
/**
 * Entity class
 * @package Core\Entity
 */
class EntityFactory {

	public function __construct() {
  }
  // public function load($table, $col, $value) {
  //   $entity = null;
  //   switch ($table) {
  //     case 'user':
  //       $entity = new App\Entity\UserEntity();
  //       break;
  //     default:
  //     break;
  //   }
  //   // var_dump($col);
  //   // var_dump($value);
  //   return $entity->loadByCol($col, $value);
  // }
  public function get($table) {
    $entity = null;
    switch ($table) {
      case 'User':
        $entity = new App\Entity\UserEntity();
        break;
        case 'Boutique':
          $entity = new App\Entity\BoutiqueEntity();
          break;
        default:
      break;
    }
    // var_dump($col);
    // var_dump($value);
    return $entity;
  }
}
