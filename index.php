<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
include( 'db.php' );
db::dbs();
include ('cookies/cookies_pre.php');
$cokPre = new cookies_pre();
$cokPre->start();


include ('stranka/stranka_pre.php');
$strankaPre = new stranka_pre();
$strankaPre->vstup($_SERVER['QUERY_STRING']);
$strankaPre->vypis();
$strankaPre->paticka(null);

//<script src="prostredi.js"></script>     
//<script src="komunikator.js"></script>     
//</html>
