<?php
$sTrozoRequest = "acceso_prohibido";
$sTrozoRouter = "acceso";

$sTrozoRequest = "0805";
$sTrozoRouter = "[0-9]{3,4}";
//http://www.elcodigo.net/cgi-bin/DBread.cgi?tabla=scripts&campo=0&clave=89


//preg_match("/[\d]{4}/", $_valor)
$sPatronRouter = WS.$sTrozoRouter.WS;

bug($sTrozoRequest,"string a comprobar");
bug($sPatronRouter,"patron a cumplir");
//$bCoinciden = preg_match_all($sPatronRouter, $sTrozoRequest, $arCoincidencias);
$bCoinciden = preg_match($sPatronRouter, $sTrozoRequest, $arCoincidencias);
//$bCoinciden = preg_split($sPatronRouter, $sTrozoRequest);
bug($bCoinciden,"coincide?");bug($arCoincidencias,"array coincidencias");
?>