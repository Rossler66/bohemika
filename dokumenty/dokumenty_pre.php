<?php


include_once( "presenter.php" );
class dokumenty_pre extends presenter{

    //put your code here
    private $service;
    private $template;

    function __construct() {
        $this->service = $this->vratObjekt("dokumenty", "dokumenty_ser", "dokumenty_ser");
        $this->template = $this->vratObjekt("dokumenty", "dokumenty_tem", "dokumenty_tem");
    }
    
    
    public function seznam($param){
        $servPar["str"] = $param["str"];
        $templPar["data"] = $this->service->seznam($servPar);
        $templPar["str"] = $param["str"];
        $this->template->pisSeznam($templPar);
        
    }
    
    public function polozka($param){
        $servPar["id"] = $param["id"];
        $temPar["data"] = $this->service->ctiPolozku($servPar);
        $temPar["id"] = $param["id"];
        $temPar["str"] = $param["str"];
        $this->template->pisPolozku($temPar);
    }
    
    public function novpolozka($param){
        $temPar["data"] = $this->service->novPolozka(null);
        $temPar["id"] = $param["id"];
        $temPar["str"] = $param["str"];
        $this->template->pisPolozku($temPar);
    }

    public function uloz($param){
        $dokument = $this->service->uloz($param["form"]["polozka"]);
        
        $vys = array('typ' => 'stranka', 'data' => "./?dokumenty/polozka/str=".$param["str"].",id=".$dokument[0]["dok"]->id);
        $json = json_encode($vys);
        echo '{"token":[';
        echo $json;
        echo "]}";
    }
    

    public function smazpolozka($param){
        $serPar["id"] = $param["id"];
        $this->service->smazpolozka($serPar);
        
        $sezPar["str"] = $param["str"];
        $this->seznam($sezPar);
    }

    public function soubor($param){
        $souborSer = $this->vratObjekt("soubor", "soubor_ser", "soubor_ser");
        $soubor = $souborSer->nahraj($param);

        $soubPar["souborId"] = $soubor["id"];
        $soubPar["id"] = $param["id"];
        $this->service->soubor($soubPar);

        $vys = array('typ' => 'stranka', 'data' => "./?dokumenty/seznam/str=".$param["str"]);
        $json = json_encode($vys);
        echo '{"token":[';
        echo $json;
        echo "]}";
        
    }
}