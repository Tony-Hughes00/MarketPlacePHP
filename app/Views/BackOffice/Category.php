<?php
?>
<div class="row">
  <div class="col-12 col-md-2 text-right mt-3">
    Category :
  </div>
  <div class="col-12 col-md-10 mt-3">
    <?php        
      $tableCategory = App::getInstance()->getTable('Category');
      $categories = $tableCategory->all();  
    ?>
    <select id="cat_boutique" name="cat_boutique" value="0">
      <option value="aucune">Aucune</option>
      <?php foreach($categories as $cat) {
        echo '<option value="' . $cat->id_category . '"';
        if ($id_cat == $cat->id_category) {
          echo ' selected ';
        } 
        echo '>'; 
        echo $cat->nom_category . '</option>';  
      }         
      ?>
    </select>
  </div>
</div>

