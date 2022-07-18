<?php

include_once( "service.php" );

class menu_ser extends service {


    public function seznam($param) {
        $sezPar["order"] = "menu_kod";
        if (array_key_exists("str", $param) && $param["str"]) {
            $sezPar["offset"] = $param["str"];
        }
        return $this->nactiSeznam("menu", "menu_rep", "web_menu_zaz_rep", $sezPar);
    }

    public function ctiPolozku($param) {
        $sezPar["where"] = "men.id = " . $param["id"];
        return $this->nactiSeznam("menu", "menu_rep", "web_menu_zaz_rep", $sezPar);
    }

    public function novPolozka($param) {
        $polozkaRep = $this->vratObjekt("menu", "menu_rep", "web_menu_zaz_rep");
        return $polozkaRep->vratEntitu(null);
    }

    public function uloz($param) {
        $polozkaRep = $this->vratObjekt("menu", "menu_rep", "web_menu_zaz_rep");
        $polozkaEnt = $polozkaRep->nactiFormular($param);
        $polozkaRep->uloz($polozkaEnt[0]["men"], "men");
        return $polozkaEnt;
    }

    public function smazpolozka($param) {
        $asQ = "DELETE FROM web_menu_zaz WHERE id = " . $param["id"];
        db::query($asQ);
    }
}
