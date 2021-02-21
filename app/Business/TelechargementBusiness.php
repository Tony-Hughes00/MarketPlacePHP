<?php

namespace App\Business;
use App;
// use App\Business;
use Exception;
use Core\Entity;
use Core\Business\Business;


class TelechargementBusiness extends Business {

  public function upload($id_boutique, $files) {

    if (isset($files['boutiqueImage']) && $files['boutiqueImage']['error'] == 0) {
      $filename = $files['boutiqueImage']['name'];
      $filepath = $files['boutiqueImage']['tmp_name'];

      $isImage = explode("/", mime_content_type($filepath))[0] == "image";

      $imageFolder = ROOT . '/' . RACINE . 'boutique/' . $id_boutique . '/image/';
      if ($isImage) {
        if (!file_exists($imageFolder)) {
          mkdir($imageFolder, 0777, true);
      }
        $repoPath = $imageFolder . $filename;
        if (file_exists($repoPath)) {
          unlink($repoPath);
         }
         move_uploaded_file($filepath, $repoPath);
        }
    }

  }
}