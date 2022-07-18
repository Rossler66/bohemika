<?php

include_once( "template.php" );

class dokumenty_tem extends template {

    public function pisSeznam($param) {
        echo '<div class="block  block_standard">';
        echo '<div class="container">';
        echo '<div class="pole pole1 poleL">';
        echo '<div class="volbysez">';

        echo '<a href="./?dokumenty/novpolozka/id=0,str=' . $param["str"] . '"><img src="./img/iko_plus.svg" /></a>';
        if ($param["str"] > 0) {
            echo '<a href="./?dokumenty/seznam/str=' . ($param["str"] - 1) . '"><img src="./img/iko_doleva.svg" /></a>';
        }
        echo '<a href="./?dokumenty/seznam/str=' . ($param["str"] + 1) . '"><img src="./img/iko_doprava.svg" /></a>';
        echo '</div>';
        echo '<table class="seznam">';
        echo '<tr><th class="tal">Název</th><th class="tar">Volby</th></tr>';
        foreach ($param["data"] as $rad) {
            $cesta = "./img/".$rad["sou"]->cesta."/".$rad["sou"]->id."_".$rad["sou"]->nazev.".".$rad["sou"]->pripona;
            echo '<tr><td>' . $rad["dok"]->nazev . '</td>';
            echo '<td><div class="volbysez">';
            echo '<a href="?dokumenty/polozka/id=' . $rad["dok"]->id . ',str=' . $param["str"] . '" class="iko"><img src="./img/iko_edit.svg"></a>';
            echo '<a href="'.$cesta.'" target="_blank" class="iko"><img src="./img/iko_dokument.svg"></a>';
            echo '<a href="?dokumenty/smazpolozka/id=' . $rad["dok"]->id . ',str=' . $param["str"] . '" class="iko"><img src="./img/iko_smaz.svg"></a>';
            echo '</div></td></tr>';
        }
        echo '</table>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    public function pisPolozku($param) {
        echo '<div class="block  block_standard">';
        echo '  <div class="container" ondragover="nastavDrag(event);">';
        echo '      <div class="pole pole3 poleL bcg_svetlabarva stin formular">';
        echo '          <h2 class="col_tmavabarva">Dokument<a href="?dokumenty/seznam/str=' . $param["str"] . '"><img src="./img/iko_zavrit.svg" ></a></h2>';
        echo '          <form name="polozka" >';
        echo '              <div class="nav">Název dokumentu</div>';
        echo '              <input type="text" name="dok_nazev" value="' . $param["data"][0]["dok"]->nazev . '" />';
        if($param["data"][0]["dok"]->id > 0){
            echo '<div class="upload" jmp="dokumenty" pre="dokumenty" fce="soubor" par="str='.$param["str"].',id='.$param["data"][0]["dok"]->id.'" ondrop="nahrajSoubor(event);"></div>';
        }
        echo '              <input type="hidden" name="dok_id" value="' . $param["data"][0]["dok"]->id . '" />';
        echo '              <div class="tlacpas">';
        echo '                  <input type="button" class="tlacitko" value="Uložit" jmp="dokumenty" pre="dokumenty" fce="uloz" par="id=' . $param["id"] . ',str=' . $param["str"] . '" form="polozka" onclick="posli(event)" />';
        echo '              </div>';
        echo '          </form>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }

    
}

