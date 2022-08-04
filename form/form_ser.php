<?php
include_once("service.php");

class form_ser extends service
{
    public function ulozForm($param)
    {
        if(!$param["polozky"]){
            return;
        }
        $obsah = "";
        $odd = "";
        foreach ($param["polozky"] as $nazev => $hodnota) {
//            $nazev = str_replace("\\","\\\\".$nazev);
//            $nazev = str_replace("\"","\\\"",$nazev);
//            $hodnota = str_replace("\\","\\\\".$hodnota);
//            $hodnota = str_replace("\"","\\\"",$hodnota);
            $obsah .= $odd."\"".addslashes($nazev)."\":\"".addslashes($hodnota)."\"";
            $odd = ",";
        }
        $formRep = $this->vratObjekt("form", "form_rep", "frm_formular_zaz_rep");
        $formEnt = $formRep->vratEntitu(null);
        $formEnt[0]["frm"]->id = 0;
        $formEnt[0]["frm"]->odeslano = date("Y-m-d H:i");
        $formEnt[0]["frm"]->nazev = "f_".$param["nazev"];
        $formEnt[0]["frm"]->obsah = $obsah;
        $formRep->uloz($formEnt[0]["frm"],"frm");
    }
}