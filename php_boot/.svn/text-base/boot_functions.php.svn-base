<?php
function bug($var, $sNombreVariable='var', $isDie=false, $iIndiceEstilo=0 )
{
    $arEstilo[] = "background:#CDE552; padding-left:10px; text-align:left; color:black; font-weight:normal; font-family: \'Courier New\', Courier, monospace !important;";
    
    $sEstilo = $arEstilo[$iIndiceEstilo];
    $sTagPre = "<pre style=\"$sEstilo\" >";
    $sTagFinPre = "</pre>";
    $nombreVariable = $sTagPre . 'VARIABLE <b>'.$sNombreVariable.'</b>:';
    $nombreVariable .= $sTagFinPre;
    echo $nombreVariable;
    echo  "<pre style=\"$sEstilo\" >";
    var_dump($var);
    echo  "</pre>";
    if($isDie) die;   
}

function bugfile($sFilePath, $sNombreVariable="var", $isDie=false)
{
    bug(is_file($sFilePath),$sNombreVariable,$isDie);
}

function bugdir($sDirPath, $sNombreVariable="var", $isDie=false)
{
    bug(is_dir($sDirPath),$sNombreVariable,$isDie);
}

function bugpg()
{
    $arPG = array();
    $arPG["POST"] = $_POST;
    $arPG["GET"] = $_GET;
    bug($arPG,"POST | GET");
}

function bugp()
{
    $arPG = array();
    $arPG["POST"] = $_POST;
    bug($arPG,"POST");
}

function bugg()
{
    $arPG = array();
    $arPG["GET"] = $_GET;
    bug($arPG,"GET");
}

function bugss()
{
    bug($_SESSION,"SESSION");
}

function errorson()
{
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}

function timer_on() 
{
    global $fStartTime;
    list($fMiliSec, $fSec) = explode(" ", microtime());
    $fStartTime = ((float)$fSec + (float)$fMiliSec);
}
 
function timer_off($asDebug=true, $sTitulo="",$isDie=true) 
{
    global $fStartTime;
    list($fMiliSec, $fSec) = explode(" ", microtime());
    $fEndTime = ((float)$fSec + (float)$fMiliSec);
    $fEndTime = $fEndTime-$fStartTime;
    if($asDebug)
        return bug($fEndTime." seg","tiempo ejecución $sTitulo",$isDie);
    else
        return $fEndTime;
}

function bugif()
{
    bug(get_included_files(),"included_files");
}
?>