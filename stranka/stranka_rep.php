<?php
include_once( 'repository.php' );

class web_stranka_zaz_rep extends repository {

    public function __construct() {
        include_once 'stranka/stranka_ent.php';
        $this->definice = array(
            "str" =>
            array(
                "tabulka" => "web_stranka_zaz",
                "entita" => "web_stranka_zaz_ent",
                "alias" => "str",
            ),
        );
    }

}


class web_provozovna_zaz_rep extends repository {

    public function __construct() {
        include_once 'stranka/stranka_ent.php';
        $this->definice = array(
            "pro" =>
            array(
                "tabulka" => "web_provozovna_zaz",
                "entita" => "web_provozovna_zaz_ent",
                "alias" => "pro",
            ),
        );
    }

}

class web_provozovna_kraj_rep extends repository {

    public function __construct() {
        include_once 'stranka/stranka_ent.php';
        $this->definice = array(
            "pro" =>
            array(
                "tabulka" => "web_provozovna_zaz",
                "entita" => "web_provozovna_zaz_ent",
                "alias" => "pro",
            ),
            "kra" =>
            array(
                "tabulka" => "kat_kraje_kat",
                "entita" => "kat_kraje_kat_ent",
                "alias" => "kra",
                "join" => "pro.kraj_id = kra.id",
            ),
        );
    }

}


class kat_kraje_kat_rep extends repository {

    public function __construct() {
        include_once 'stranka/stranka_ent.php';
        $this->definice = array(
            "kra" =>
            array(
                "tabulka" => "kat_kraje_kat",
                "entita" => "kat_kraje_kat_ent",
                "alias" => "kra",
            ),
        );
    }

}

class web_dokumenty_naz_rep extends repository {

    public function __construct() {
        include_once 'stranka/stranka_ent.php';
        $this->definice = array(
            "naz" =>
                array(
                    "tabulka" => "web_dokumenty_kat",
                    "entita" => "web_dokumenty_kat_ent",
                    "alias" => "naz",
                ),
        );
    }

}


class web_dokumenty_zaz_rep extends repository {

    public function __construct() {
        include_once 'stranka/stranka_ent.php';
        $this->definice = array(
            "dok" =>
            array(
                "tabulka" => "web_dokumenty_zaz",
                "entita" => "web_dokumenty_zaz_ent",
                "alias" => "dok",
            ),
            "naz" =>
                array(
                    "tabulka" => "web_dokumenty_kat",
                    "entita" => "web_dokumenty_kat_ent",
                    "alias" => "naz",
                    "join" => "dok.nazev_id = naz.id",
                ),
        );
    }

}

class web_dokumenty_soubor_rep extends repository {

    public function __construct() {
        include_once 'stranka/stranka_ent.php';
        include_once 'soubor/soubor_ent.php';
        $this->definice = array(
            "dok" =>
            array(
                "tabulka" => "web_dokumenty_zaz",
                "entita" => "web_dokumenty_zaz_ent",
                "alias" => "dok",
            ),
            "naz" =>
                array(
                    "tabulka" => "web_dokumenty_kat",
                    "entita" => "web_dokumenty_kat_ent",
                    "alias" => "naz",
                    "join" => "dok.nazev_id = naz.id",
                ),
            "sou" =>
            array(
                "tabulka" => "web_soubory_kat",
                "entita" => "web_soubory_kat_ent",
                "alias" => "sou",
                "join" => "dok.soubor_id = sou.id",
            ),
        );
    }

}

class web_spoluprace_rep extends repository {

    public function __construct() {
        include_once 'stranka/stranka_ent.php';
        $this->definice = array(
            "spo" =>
                array(
                    "tabulka" => "web_spoluprace_zaz",
                    "entita" => "web_spoluprace_zaz_ent",
                    "alias" => "spo",
                ),
            "pro" =>
                array(
                    "tabulka" => "web_provozovna_zaz",
                    "entita" => "web_provozovna_zaz_ent",
                    "alias" => "pro",
                    "join" => "spo.provozovna_id = pro.id",
                ),
        );
    }

}

