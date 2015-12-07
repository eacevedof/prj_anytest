<?php
    function has_regexp($sString)
    {
        $arRegExpChar = array("[","]","+","*","?","(",")","^","{","}","$");
        $arChars = explode("",$sString);
        foreach($arChars as $char)
        {
            if(in_array($char, $arRegExpChar))
            {
                return true;
            }
        }
        return false;
    }

function match_all_pieces($sRouterUri,$arRequestURI)
{
    $isMatchedAll = true;
    
    $arRouterUri = explode(WS,$sRouterUri);
    $iNumTrozosRouter = count($arRouterUri);
    
    for($i=0; $i<$iNumTrozosRouter; $i++)
    {
        $sTrozoRouter = $arRouterUri[$i];
        $sTrozoRequest = $arRequestURI[$i];
        
        //Si no es el último elemento
        if($i!=($iNumTrozosRouter-1))
        {
            $isEqual = ($sTrozoRequest==$sTrozoRouter);
        }
        //Es el último elemento
        else
        {
            if($sTrozoRouter!="" && self::has_regexp($sTrozoRouter))
            {
                $sPatronRouter = WS.$sTrozoRouter.WS;
                $isEqual = preg_match($sPatronRouter, $sTrozoRequest);
            }
            else
            {
                $isEqual = ($sTrozoRequest==$sTrozoRouter);
            }
        }
        
        if(!$isEqual)
        {
            $isMatchedAll = false;
            break;
        }
    }//Fin bucle
    return $isMatchedAll;
}

