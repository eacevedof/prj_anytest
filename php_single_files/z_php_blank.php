<?php
function match_all_pieces($sRouterUri,$arRequestURI)
{
    $isMatchedAll = false;
    
    $arRouterUri = explode(WS,$sRouterUri);
    $iNumTrozosRouter = count($arRouterUri);
    
    for($i=0; $i<$iNumTrozosRouter; $i++)
    {
        $sTrozoRouter = $arRouterUri[$i];
        $sTrozoRequest = $arRequestURI[$i];  
        if($sTrozoRouter != "")
        {
            //acceso == acceso_prohibido?? pregmatch
            //echo "router distinto de vacio: $arRouter[$i]<br>";
            $sPatronRouter = WS.$sTrozoRouter.WS;
            $bCoinciden = preg_match($sPatronRouter, $sTrozoRequest);
        }
        //$sTrozoRouter=="" Caza con todo
        else 
        {
            $bCoinciden = ($sTrozoRequest == $sTrozoRouter); 
        }

        if(!$bCoinciden)        
        {
            $cazaTodo = false;
            break;
        }
        //si coinciden evalua el siguiete
    }    
}

