<?php
function bug($var, $sNombreVariable="var", $isDie=false )
{
    if(IS_DEBUG_ALLOWED)
    {    
        if(is_string($var))
        {
            $isSQL = false;
            $arSQLWords = array("select","from","inner join","insert into","update","delete");
            $sTmpVar = strtolower($var);
            foreach($arSQLWords as $sWord)
                //var_dump("word:$sWord, string:$sTmpVar",strpos($sWord,$sTmpVar));
                if(strpos($sTmpVar,$sWord)!==false){$isSQL=true; break;}

            //var_dump($isSQL);
            if($isSQL)
            {
                if(!strpos($var,"\nFROM"));
                    $var = str_replace("FROM","\nFROM",$var);
                if(!strpos($var,"\nINNER"));
                    $var = str_replace("INNER","\nINNER",$var);
                if(!strpos($var,"\nLEFT"));
                    $var = str_replace("LEFT","\nLEFT",$var);
                if(!strpos($var,"\nRIGHT"));
                    $var = str_replace("RIGHT","\nRIGHT",$var);
                if(!strpos($var,"\nWHERE"));
                    $var = str_replace("WHERE","\nWHERE",$var);
                if(!strpos($var,"\nAND"));
                    $var = str_replace("AND","\nAND",$var);
                if(!strpos($var,"\nORDER BY"));
                    $var = str_replace("ORDER BY","\nORDER BY",$var);
            }
        }
        $sTagPre = "<pre style=\"background:#CDE552; padding:0px; color:black; font-size:12px;\">\n";
        $sTagFinPre = "</pre>";
        $nombreVariable = $sTagPre ."VARIABLE <b>$sNombreVariable</b>:";
        $nombreVariable .= $sTagFinPre;
        echo $nombreVariable;
        echo  "<pre style=\" background:#E2EDA8; font-size:12px; padding-left:10px; text-align:left; color:black; font-weight:normal; font-family: \'Courier New\', Courier, monospace !important;\">\n";
        var_dump($var);
        echo  "</pre>";

        if($isDie)die;  
    }
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