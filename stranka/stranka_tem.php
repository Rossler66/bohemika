<?php

class stranka_tem {

    public function hlavickaZacatek($param) {
        echo '<html>';
        echo '   <head>';
        echo '       <meta charset="utf-8">';
        echo '       <meta name="viewport" content="initial-scale=1, maximum-scale=1">';
        echo '       <link href="bohemika.css" rel="stylesheet" type="text/css">';
        echo '       <link href="bohemikabarvy.css" rel="stylesheet" type="text/css">';
        echo '       <title></title>';
    }

    public function hlavickaKonec($param) {
        echo '   </head>';
        echo '<body>';
    }

    public function zahlavi($param) {
        echo '<div class="zahlavi" id="zahlavi" nazev="Hlavička" idstr="1">';
        echo '  <div class="block logo">';
        echo '      <div class="container">';
        echo '          <div class="pole pole1 poleL">';
        echo '              <a href="?stranka/obsah/typ=T"><img src="./img/logo.svg" class="logo" /></a>';
        echo '              <div class="menu_pas">';
        foreach ($param["menhor"] as $menu) {
            echo '<a href="' . $menu["men"]->odkaz . '">' . $menu["men"]->text . '</a>';
        }
        echo '              </div>';
        echo '          </div>';
        echo '      </div>';
        echo '  </div>';
        echo '  <div class="block menu">';
        echo '      <div class="container">';
        echo '          <div class="pole pole1 poleL">';
        echo '              <div class="menu_pas">';
        foreach ($param["mendol"] as $menu) {
            echo '<a href="' . $menu["men"]->odkaz . '">' . $menu["men"]->text . '</a>';
        }

        echo '              </div>';
        echo '          </div>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }

    public function obsah($param) {
        echo '<div class="' . $param["class"] . '" id="' . $param["obsahId"] . '" nazev="' . $param["nazev"] . '" idstr="' . $param["id"] . '">';
        echo $param["obsah"];
        echo '</div>';
    }

    public function zapati($param) {

        echo '<div class="block block_pata">';
        echo '  <div class="container">';
        echo '      <div class="pole pole3 poleL">';
        echo '          <h3>Nabídka</h3>';
        foreach ($param["nabidka"] as $pol) {
            echo '<a href="' . $pol["men"]->odkaz . '">' . $pol["men"]->text . '</a>';
        }
        echo '<a href="?'.$_SERVER['QUERY_STRING'].',cook=set">Cookies</a>';
        echo '      </div>';
        echo '      <div class="pole pole3 poleL">';
        echo '          <h3>Dokumenty</h3>';
        foreach ($param["dokumenty"] as $pol) {
            $cesta = "./img/" . $pol["sou"]->cesta . "/" . $pol["sou"]->id . "_" . $pol["sou"]->nazev . "." . $pol["sou"]->pripona;
            echo '<a href="' . $cesta . '">' . $pol["dok"]->nazev . '</a>';
        }
        echo '      </div>';
        echo '      <div class="pole pole3 poleL">';
        echo '          <h3>Kontakt</h3>';
        echo '          <a href="#">Volyňských Čechů 837,<br />Žatec 438 01</a>';
        echo '          <a href="#">+420 810 888 900</a>';
        echo '          <a href="#">info@bohemika.eu</a>';
        echo '          <a href="#">FACEBOOK</a>';
        echo '          <a href="#">INSTAGRAM</a>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }

    public function editorBlok($param) {
        echo '<div class="editpanel formular" id="editblock">';
        echo '<h2>Blok</h2>';
        echo '  <div class="barvapole">';
        echo '      <p class="txs_xs nadpis">Pozadí</p>';
        echo '      <div style="background-color:#FFF"; barva="transaprent" onclick="nastavBarvuPozadi(event);">X</div>';
        echo '      <div style="background-color:#FFF"; barva="bila" onclick="nastavBarvuPozadi(event);"></div>';
        echo '      <div style="background-color:#ecebe8"; barva="seda" onclick="nastavBarvuPozadi(event);"></div>';
        echo '      <div style="background-color:#7bc2f5"; barva="bledemodra" onclick="nastavBarvuPozadi(event);"></div>';
        echo '      <div style="background-color:#005897"; barva="tmavomodra" onclick="nastavBarvuPozadi(event);"></div>';
        echo '  </div>';
        echo '  <p class="txs_xs nadpis">Typ pole</p>';
        echo '  <div class="typ">';
        echo '      <p typ="hlava" onclick="nastavTypBloku(event);">Hlava</p>';
        echo '      <p typ="oblasti" onclick="nastavTypBloku(event);">Volby</p>';
        echo '      <p typ="info" onclick="nastavTypBloku(event);">Info</p>';
        echo '      <p typ="standard" onclick="nastavTypBloku(event);">Standard</p>';
        echo '  </div>';
        echo '  <p class="txs_xs nadpis">Posum / smazání</p>';
        echo '  <img src="img/iko_nahoru.svg" onclick="blokNahoru(event);" />';
        echo '  <img src="img/iko_dolu.svg" onclick="blokDolu(event);" />';
        echo '  <img src="img/iko_smaz.svg" onclick="blokSmaz(event);" />';
        echo '  <img src="img/iko_zavrit.svg" onclick="zavriPanel(event);" />';
        echo '</div>';

        echo '<div class="editpanel formular" id="editpole">';
        echo '<h2>Pole</h2>';
        echo '<div class=barvapole>';
        echo '<p class="txs_xs nadpis">Pozadí</p>';
        echo '<div style="background-color:#FFF"; barva="transaprent" onclick="nastavBarvuPozadi(event);">X</div>';
        echo '<div style="background-color:#FFF"; barva="bila" onclick="nastavBarvuPozadi(event);"></div>';
        echo '<div style="background-color:#ecebe8"; barva="seda" onclick="nastavBarvuPozadi(event);"></div>';
        echo '<div style="background-color:#7bc2f5"; barva="bledemodra" onclick="nastavBarvuPozadi(event);"></div>';
        echo '<div style="background-color:#005897"; barva="tmavomodra" onclick="nastavBarvuPozadi(event);"></div>';
        echo '</div>';
        echo '<div class=barvapole>';
        echo '<p class="txs_xs nadpis">Rámeček</p>';
        echo '<div style="background-color:#FFF"; barva="transaprent" onclick="nastavRamecek(event);">X</div>';
        echo '<div style="background-color:#FFF"; barva="bila" onclick="nastavRamecek(event);"></div>';
        echo '<div style="background-color:#ecebe8"; barva="seda" onclick="nastavRamecek(event);"></div>';
        echo '<div style="background-color:#7bc2f5"; barva="bledemodra" onclick="nastavRamecek(event);"></div>';
        echo '<div style="background-color:#005897"; barva="tmavomodra" onclick="nastavRamecek(event);"></div>';
        echo '</div>';
        echo '<div class=barvapole>';
        echo '<p class="txs_xs nadpis">Stín</p>';
        echo '<div style="background-color:#FFF"; hodnota="---" onclick="nastavStin(event);">X</div>';
        echo '<div style="background-color:#333"; hodnota="stin" onclick="nastavStin(event);"></div>';
        echo '</div>';
        echo '<div class=barvapole>';
        echo '<p class="txs_xs nadpis">Zoom</p>';
        echo '<div style="background-color:#FFF"; hodnota="---" onclick="nastavZoom(event);">X</div>';
        echo '<div style="background-color:#FFF"; hodnota="zoom" onclick="nastavZoom(event);">A</div>';
        echo '</div>';
        echo '<p class="txs_xs fc nadpis">Počet polí na šířku / šířka pole</p>';
        echo '<div class="typ">';
        echo '<p typ="pole1" onclick="nastavPocetPole(event);">Počet 1</p>';
        echo '<p typ="pole2" onclick="nastavPocetPole(event);">Počet 2</p>';
        echo '<p typ="pole3" onclick="nastavPocetPole(event);">Počet 3</p>';
        echo '<p typ="pole4" onclick="nastavPocetPole(event);">Počet 4</p>';
        echo '<p typ="poleS" onclick="nastavSirkaPole(event);">Šířka S</p>';
        echo '<p typ="poleM" onclick="nastavSirkaPole(event);">Šířka M</p>';
        echo '<p typ="poleL" onclick="nastavSirkaPole(event);">Šířka L</p>';
        echo '</div>';
        echo '<p class="txs_xs nadpis">Odkaz</p>';
        echo '<img src="img/iko_edit.svg" onclick="nabOdkazy(event);">';
        echo '  <img src="img/iko_zavrit.svg" onclick="odkazSmaz(event);" />';

        echo '<p class="txs_xs nadpis">Posum / smazání</p>';
        echo '<img src="img/iko_nahoru.svg" onclick="blokNahoru(event);">';
        echo '<img src="img/iko_dolu.svg" onclick="blokDolu(event);">';
        echo '<img src="img/iko_smaz.svg" onclick="blokSmaz(event);">';
        echo '  <img src="img/iko_zavrit.svg" onclick="zavriPanel(event);" />';
        echo '</div>';


        echo '<div class="editpanel formular" id="pridejprvek">';
        echo '<h2>Přidat prvek</h2>';
        echo '  <p class="txs_xs nadpis">Typ prvku</p>';
        echo '  <div class="typ">';
        echo '      <p onclick="pridejObrazek(event);">Obrázek</p>';
        echo '      <p onclick="pridejNadpis(event);">Nadpis</p>';
        echo '      <p onclick="pridejText(event);">Text</p>';
        echo '      <p onclick="pridejMapu(event);">Mapa</p>';
        echo '  </div>';
        echo '  <p class="txs_xs nadpis">Posum / smazání</p>';
        echo '  <img src="img/iko_zavrit.svg" onclick="zavriPanel(event);" />';
        echo '</div>';

        echo '<div class="editpanel formular" id="editobrazek">';
        echo '<h2>Obrázek</h2>';
        echo '<p class="txs_xs nadpis">Přetažením nahraj obrázek</p>';
        echo '<div class="upload" jmp="stranka" pre="stranka" fce="obrazek" ondrop="nahrajSoubor(event);"></div>';
        echo '<p class="txs_xs nadpis">Posum / smazání</p>';
        echo '<img src="img/iko_nahoru.svg" onclick="blokNahoru(event);">';
        echo '<img src="img/iko_dolu.svg" onclick="blokDolu(event);">';
        echo '<img src="img/iko_smaz.svg" onclick="blokSmaz(event);">';
        echo '  <img src="img/iko_zavrit.svg" onclick="zavriPanel(event);" />';
        echo '</div>';


        echo '<div class="editpanel formular" id="editnadpis">';
        echo '<h2>Nadpis</h2>';
        echo '  <div class="barvapole">';
        echo '      <p class="txs_xs nadpis">Barva textu</p>';
        echo '      <div style="background-color:#FFF"; barva="transaprent" onclick="nastavBarvuTextu(event);">X</div>';
        echo '      <div style="background-color:#FFF"; barva="bila" onclick="nastavBarvuTextu(event);"></div>';
        echo '      <div style="background-color:#ecebe8"; barva="seda" onclick="nastavBarvuTextu(event);"></div>';
        echo '      <div style="background-color:#7bc2f5"; barva="bledemodra" onclick="nastavBarvuTextu(event);"></div>';
        echo '      <div style="background-color:#005897"; barva="tmavomodra" onclick="nastavBarvuTextu(event);"></div>';
        echo '  </div>';
        echo '  <p class="txs_xs nadpis">Velikost nadpisu</p>';
        echo '  <div class="typ">';
        echo '      <p typ="H1" onclick="nastavTagPrvku(event);">H1</p>';
        echo '      <p typ="H2" onclick="nastavTagPrvku(event);">H2</p>';
        echo '      <p typ="H3" onclick="nastavTagPrvku(event);">H3</p>';
        echo '      <p typ="H4" onclick="nastavTagPrvku(event);">H4</p>';
        echo '      <p typ="H5" onclick="nastavTagPrvku(event);">H5</p>';
        echo '      <p typ="H6" onclick="nastavTagPrvku(event);">H6</p>';
        echo '  </div>';
        echo '  <p class="txs_xs nadpis">zarování textu</p>';
        echo '  <img src="img/iko_textlevo.svg" typ="tal", onclick="nastavZarovnaniTextu(event);" />';
        echo '  <img src="img/iko_textstred.svg" typ="tac", onclick="nastavZarovnaniTextu(event);" />';
        echo '  <img src="img/iko_textpravo.svg" typ="tar", onclick="nastavZarovnaniTextu(event);" />';
        echo '  <p class="txs_xs nadpis">Posum / smazání</p>';
        echo '  <img src="img/iko_nahoru.svg" onclick="blokNahoru(event);" />';
        echo '  <img src="img/iko_dolu.svg" onclick="blokDolu(event);" />';
        echo '  <img src="img/iko_smaz.svg" onclick="blokSmaz(event);" />';
        echo '  <img src="img/iko_zavrit.svg" onclick="zavriPanel(event);" />';
        echo '</div>';

        echo '<div class="editpanel formular" id="edittext">';
        echo '<h2>Text</h2>';
        echo '  <div class="barvapole">';
        echo '      <p class="txs_xs nadpis">Barva textu</p>';
        echo '      <div style="background-color:#FFF"; barva="transaprent" onclick="nastavBarvuTextu(event);">X</div>';
        echo '      <div style="background-color:#FFF"; barva="bila" onclick="nastavBarvuTextu(event);"></div>';
        echo '      <div style="background-color:#ecebe8"; barva="seda" onclick="nastavBarvuTextu(event);"></div>';
        echo '      <div style="background-color:#7bc2f5"; barva="bledemodra" onclick="nastavBarvuTextu(event);"></div>';
        echo '      <div style="background-color:#005897"; barva="tmavomodra" onclick="nastavBarvuTextu(event);"></div>';
        echo '  </div>';
        echo '  <p class="txs_xs nadpis">Zarování textu</p>';
        echo '  <img src="img/iko_textlevo.svg" typ="tal", onclick="nastavZarovnaniTextu(event);" />';
        echo '  <img src="img/iko_textstred.svg" typ="tac", onclick="nastavZarovnaniTextu(event);" />';
        echo '  <img src="img/iko_textpravo.svg" typ="tar", onclick="nastavZarovnaniTextu(event);" />';

        echo '  <p class="txs_xs nadpis">Velikost textu</p>';
        echo '  <div class="barvapole">';
        echo '      <div style="background-color:#FFF"; hodnota="txs_xs" onclick="nastavVelikostTextu(event);">XS</div>';
        echo '      <div style="background-color:#FFF"; hodnota="txs_s" onclick="nastavVelikostTextu(event);">S</div>';
        echo '      <div style="background-color:#FFF"; hodnota="txs_m" onclick="nastavVelikostTextu(event);">M</div>';
        echo '      <div style="background-color:#FFF"; hodnota="txs_l" onclick="nastavVelikostTextu(event);">L</div>';
        echo '      <div style="background-color:#FFF"; hodnota="txs_xl" onclick="nastavVelikostTextu(event);">XL</div>';
        echo '  </div>';

        echo '  <p class="txs_xs nadpis">Posum / smazání</p>';
        echo '  <img src="img/iko_nahoru.svg" onclick="blokNahoru(event);" />';
        echo '  <img src="img/iko_dolu.svg" onclick="blokDolu(event);" />';
        echo '  <img src="img/iko_smaz.svg" onclick="blokSmaz(event);" />';
        echo '  <img src="img/iko_zavrit.svg" onclick="zavriPanel(event);" />';
        echo '</div>';

        echo '<div class="editstranka formular" id="editstranka">';
        echo '  <p class="txs_xs nadpis">Název stránky</p>';
        echo '<input type="text">';
        echo '  <div class="barvapole">';
        echo '  <img src="img/iko_strankaseznam.svg" onclick="strankaSeznam(event);" class="fc"/>';
        echo '  <img src="img/iko_strankapridej.svg" onclick="strankaPridej(event);" />';
        echo '  <img src="img/iko_strankakopy.svg" onclick="strankaKopy(event);" />';
        echo '  <img src="img/iko_strankauloz.svg" onclick="strankaUloz(event);" />';
        echo '</div>';
        echo '</div>';

        echo '<div class="nabidka stin" id="nabidka"></div>';
    }

}