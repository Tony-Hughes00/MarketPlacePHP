
<div id="nom"
    style="color: black; font-weight: bold; font-size: 14px; text-shadow: 1px 1px 1px rgb(255, 255, 255); border: 1px solid white; background-color: rgba(255,255,255,0.85); z-index:10;">
</div>
<?php

class Carte {
    private $data = [];
    function __construct($data) {
        $this->data = $data;
    }
   
    function show() {
        $this->openSVG();

        $this->showPolys();

        $this->closeSVG();

        $this->legend();

        $this->selectCommune();
    }
    private function openSVG() {
        echo '<svg id="svgDiv" version="1.1" xmlns:bx="https://boxy-svg.com" xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1000 600" enable-background="new 0 0 1000 600" xml:space="preserve">';
    }
    private function closeSVG() {
        echo '</svg>';
    }
    private function getColorPnm($pnmId) {
        $fill = '#7aaaaa';
        $colorsPnm = [
            "rgba(41,143,228,0.5)", 
            "rgba(102,51,152,0.5)", 
            "rgba(246,140,2,0.5)", 
            "rgba(221,41,136,0.5)"];

        switch ($pnmId) {
            case 40:
                $fill = $colorsPnm[1];
                break;
            case 41:
                $fill = $colorsPnm[2];
                break;
            case 43:
                $fill = $colorsPnm[0];
                break;
            case 46:
                $fill = $colorsPnm[3];
                break;
        }
        // var_dump($pnmId);
        // var_dump($fill);
        return $fill;
    }
    private function getTextColorPnm($pnmId) {
        $fill = '#7aaaaa';

        $colorsPnm = [
            "#298fe4", 
            "#663398", 
            "#f68c02", 
            "#dd2988"];

        switch ($pnmId) {
            case 40:
                $fill = $colorsPnm[1];
                break;
            case 41:
                $fill = $colorsPnm[2];
                break;
            case 43:
                $fill = $colorsPnm[0];
                break;
            case 46:
                $fill = $colorsPnm[3];
                break;
        }
        // var_dump($pnmId);
        // var_dump($fill);
        return $fill;
    }
    private function getSelectedColor() {
        return '#d4ffa8';
    }
    private function showPolys() {
        $fill = '#7aaaaa';
        $fillSelected = $this->getSelectedColor();
        foreach ($this->data['communePoly'] as $key => $commune) {
            echo '<polygon id="' . $key . '" name="' . $commune->nom;
            echo '" class="' . $commune->class;
            if ($commune->pnm == $this->data['pnm']->id_pnm) {
                echo ' selected ';
            }
            echo '" fill="';
            if ($commune->pnm == $this->data['pnm']->id_pnm) {
                echo $fillSelected;
            } else {
                echo $this->getColorPnm($commune->pnm);
                // echo $fill;
            } 
            echo '"';
            echo ' pnm="' . $commune->pnm . '"';
            echo ' commune="' . $commune->commune . '"';

            echo ' stroke="' . $commune->stroke . '" stroke_width="' . $commune->stroke_width . '"';
            echo ' points="' . $commune->points . '"/>';
          }
    }
    public function onLoad() {
        echo "<script>";
        echo "onLoad(" . json_encode($this->data) . ")";
        echo "</script>";
    }
    public function legend() {
        echo '<div>';
        echo '<h5 class="float-left pr-2">Légende</h53>';
        echo '</div>';
        echo '<div class="row" style="font-size:12px;" id="legend">';
        foreach($this->data['pnms'] as $pnm) {
            // var_dump($pnm);
            echo '<div class="col-12 col-md-6">';
            echo '<div class="row">';
            echo '<div class="col-1 p-1">';
            echo '<div class="w-100 h-100" style="background-color:';
            if ($pnm->id_pnm == $this->data['pnm']->id_pnm) {
                echo $this->getSelectedColor();
              } else {
                echo $this->getTextColorPnm($pnm->id_pnm);
            }
            echo ';" >';
            echo '</div>';
            echo '</div>';
            echo '<div class="col-11 text-left">';
            echo $pnm->titre_pnm;
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        echo '</div><br>';
    }
    private function selectCommune() {
        echo '<div id="pnmCommuneListe">';
        echo '</div>';
        echo '<div id="selectCommune" style="visibility:hidden" ';
        echo 'style="color: black; font-weight: bold; font-size: 14px; text-shadow: 1px 1px 1px rgb(255, 255, 255); border: 1px solid white; background-color: rgba(255,255,255,0.85); z-index:10;">';
        echo '<input id="pnmCommunes" name="pnmCommunes" type="hidden" value="">';
        echo '<input id="selectCommuneId" type="hidden" value="0">';
        echo '<input id="selectCommunePnmId" type="hidden" value="' . $this->data["pnm"]->id_pnm . '">';
        echo '<select size="4" id="pnmSelect" onchange="onSelectCommune()">';
            foreach($this->data['pnms'] as $pnm) {
                // var_dump($pnm);
                echo '<option value="' . $pnm->id_pnm . '"';
                if ($this->data["pnm"]->id_pnm == $pnm->id_pnm) {
                    echo ' selected ';
                }
                if ($pnm->id_pnm == $this->data['pnm']->id_pnm) {
                    // echo ' style="color:' . $this->getTextColorPnm($pnm->id_pnm) . ';';
                    // echo $this->getSelectedColor();
                    echo ' style="background-color:' . $this->getSelectedColor($pnm->id_pnm) . ';" '; 
                  } else {
                    // echo ' style="color:' . $this->getTextColorPnm($pnm->id_pnm) . ';';
                    // echo $this->getTextColorPnm($pnm->id_pnm);
                }
                echo ';" ';
                echo '>';
                echo $pnm->titre_pnm;
                echo '</option>';
            }
        echo '</select>';
        // echo '<br><button onclick="closeSelect()">Close</button>';
        echo '</div>';
    }
}

?>

