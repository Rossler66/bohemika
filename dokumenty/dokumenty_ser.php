<?php

include_once( "service.php" );

class dokumenty_ser extends service {

    public function seznam($param) {
        $sezPar["order"] = "dok.nazev";
        if (array_key_exists("order", $param) && $param["order"]) {
            $sezPar["order"] = $param["order"];
        }
        if (array_key_exists("str", $param) && $param["str"]) {
            $sezPar["offset"] = $param["str"];
        }
        
        return $this->nactiSeznam("stranka", "stranka_rep", "web_dokumenty_soubor_rep", $sezPar);
    }
    
    public function ctiPolozku($param) {
        $sezPar["where"] = "dok.id = " . $param["id"];
        return $this->nactiSeznam("stranka", "stranka_rep", "web_dokumenty_soubor_rep", $sezPar);
    }

    public function novPolozka($param) {
        $polozkaRep = $this->vratObjekt("stranka", "stranka_rep", "web_dokumenty_zaz_rep");
        return $polozkaRep->vratEntitu(null);
    }

    public function uloz($param) {
        $polozkaRep = $this->vratObjekt("stranka", "stranka_rep", "web_dokumenty_zaz_rep");
        $polozkaEnt = $polozkaRep->nactiFormular($param);
        $polozkaRep->uloz($polozkaEnt[0]["dok"], "dok");
        return $polozkaEnt;
    }

    public function smazpolozka($param) {
        $asQ = "DELETE FROM web_dokumenty_zaz WHERE id = " . $param["id"];
        db::query($asQ);
    }
    
    public function soubor($param){
        $asQ = "UPDATE web_dokumenty_zaz SET soubor_id = ".$param["souborId"]." WHERE id = ".$param["id"];
        db::query($asQ);
    }

    
}