<?php
?>
<div class="row">
  <div class="col-12 col-md-3 text-right mt-3">
    Commune :
  </div>
  <div class="col-12 col-md-4 mt-3 teext-righ">
    <?php        
      $tableCommune = App::getInstance()->getTable('Commune');
      $communes = $tableCommune->all();  
    ?>
    <input type="hidden" id="id_commune" name="id_commune" value=0>
    <input type="hidden" id="code_postal" name="code_postal" value=0>
    <select id="id_communeSel" name="id_communeSel" value="0" onchange="onChangeCommune(this)">
      <option value="aucune">Aucune</option>
      <?php foreach($communes as $com) {
        echo '<option value="' . $com->id_commune . "," . $com->code_postal . '"';
        if ($id_com == $com->id_commune) {
          echo ' selected ';
        } 
        echo '>'; 
        echo $com->nom_commune . '</option>';  
      }         
      ?>
    </select>
  </div>
  <div class="col-12 col-md-5 mt-3 text-left">
    <label id="code_postal_label" name="code_postal_label">Code Postal :</label>
  </div>
</div>
<script>
function onChangeCommune(element) {
  console.log("onChangeCommune", element);
  var opt = element.options[element.selectedIndex];
  console.log('opt', opt);
  vals = opt.value.split(",");
  console.log('opt', vals);
  document.getElementById('id_commune').value = vals[0];
  document.getElementById('code_postal').value = vals[1];
  document.getElementById('code_postal_label').innerHTML = 'Code Postal : ' + vals[1];
}
</script>
