<?php
Tfw::IMPORT("php_classes".DS."helpers","helper_google_maps_3");
function custom_calculate_interval($sInitialTime,$sFinalTime,$isShort=true)
{
    //La hora final se supone siempre es mayor
    $i24hInSeconds = 86400;//segundos en 24 horas
    //HORA INICIAL
    if(strpos($sInitialTime,":")===false) $arTime = crm_time_to_user_time($sInitialTime);
    $arTime = explode(":",$sInitialTime);
    $iInitialSeconds = ($arTime[0] * 3600)+($arTime[1] * 60);
    //comprueba si existen segundos para longitud 6
    if(!empty($arTime[2])) $iInitialSeconds= $iInitialSeconds + $arTime[2];
    
    //HORA FINAL
    if(strpos($sFinalTime,":")===false) $arTime = crm_time_to_user_time($sFinalTime);
    $arTime = crm_time_to_user_time($sFinalTime);
    $arTime = explode(":",$sFinalTime);
    $iFinalSeconds = ($arTime[0] * 3600)+($arTime[1] * 60);
    if(!empty($arTime[2])) $iFinalSeconds = $iFinalSeconds + $arTime[2];
    
    //Si el tiempo final es menor que el inicial se supone que
    //ha acabado un día y ha comenzado otro
    if($iFinalSeconds<$iInitialSeconds)
        $iFinalSeconds = ($i24hInSeconds - $iInitialSeconds)+$iFinalSeconds;
    else
        //Tiempo transcurrido en segundos
        $iFinalSeconds = $iFinalSeconds - $iInitialSeconds; 
    
    $shh = round($iFinalSeconds/3600,0); //Horas
    $smm = round((($iFinalSeconds % 3600)/60),0); //Minutos
    $sss = round((($iFinalSeconds % 3600)%60),0); //Segundos
    $sTime = sprintf("%02d:%02d:%02d", $shh, $smm, $sss);
    if($isShort) $sTime = sprintf("%02d:%02d", $shh, $smm);

    return $sTime;
}

function crm_time_to_user_time($sCrmTime)
{
    $arTime = array();
    $iSize = strlen($sCrmTime);

    $arTime[] = substr($sCrmTime,0,2);//horas
    $arTime[] = substr($sCrmTime,2,2);//minutos
    if($iSize == "6")
        $arTime[] = substr($sCrmTime,4,2);//segundos
    return join(":",$arTime);
}

function get_markers_and_stops($arTrazados,$iNumRuta="")
{
    //bug($arTrazados);
    //Objeto vacio. Necesario para calcular distancia y tiempo
    $oGoogleMap3 = new HelperGoogleMaps3();
    $arMarkers = array();
    $arStops = array();
    $arReturn = array();
    //Pasar de rutas a marcadores:
    if(!empty($arTrazados))
    {
        
        //Datos de la parada inicial. Se usará para calcular tiempo y distancia
        //a las paradas
        $arParadInicial["latitude"] = $arTrazados[0]["Latitud"];
        $arParadInicial["longitude"] = $arTrazados[0]["Longitud"];
        $arParadInicial["hora"] = $arTrazados[0]["Hora"];
    
        $iNumParada = 0;
        
        foreach($arTrazados as $i=>$arTrazado)
        {
            //bug($i);
            $sLatitude = $arTrazado["Latitud"];
            $sLongitud = $arTrazado["Longitud"];
            $isParada = ($arTrazado["Esparada"]=="1");
            //Para las paradas distintas a la inicial
            if($i>0)
            {
                //Si es un punto mayor al inicial y es parada calculo distancia y tiempo
                if($isParada)
                {            
                    $sHora = $arTrazado["Hora"];
                    $iAlumnosSuben = $arTrazado["Alumnos_Suben"];
                    $iAlumnosBajan = $arTrazado["Alumnos_Bajan"];
                    $arStops[]=$i; $iNumParada++;
                    //Datos para calculo de tiempo y distancia desde la parada 0
                    $arDestino = array("latitude"=>$sLatitude,"longitude"=>$sLongitud);
                    //bug($arParadInicial,"parinic"); bug($arDestino,"destino $i");
                    $arDistanciaHora = $oGoogleMap3->get_distance_and_time($arParadInicial, $arDestino);
                    //bug($arDistanciaHora,"distancia hora$i"); //die;
                    $sDistancia = $arDistanciaHora["distance"]["km"];
                    $sTiempo = custom_calculate_interval($arParadInicial["hora"], $sHora); 
                    
                }
                //No es parada
                else
                {
                    $sTitulo = "";
                    $sContenido= "";
                }
            }
            //Parada inicial $i=0 TODOERROR: Siempre se toma la primera parada el primer
            //punto independientemente de que tenga la opcion Esparada=1
            else
            {
                $isParada = true;
                $arStops[]=$i; $iNumParada++;
                $sHora = $arTrazado["Hora"];
                $iAlumnosSuben = $arTrazado["Alumnos_Suben"];
                $iAlumnosBajan = $arTrazado["Alumnos_Bajan"];
                $sDistancia = 0;
                $sTiempo = 0;
            }
            
            //si es parada se crea titulo y contenido
            if($isParada)
            {
                $sTitulo = $arTrazado["Parada"];
                $sContenido = "<b>".$sTitulo."</b><br/>";
                $sContenido .= "<div id=\"divParada_$iNumRuta"."_"."$iNumParada\" style=\"border:1px solid black; text-align:left; padding:4px;\">";
                $sContenido .= "Detalle de la parada: $iNumParada <br/>";
                $sContenido .= "Hora de la parada: $sHora<br/>";
                $sContenido .= "Alumnos que suben: $iAlumnosSuben <br/>";
                $sContenido .= "Alumnos que bajan: $iAlumnosBajan <br/>";
                $sContenido .= "Distancia del trayecto: $sDistancia<br/>";
                $sContenido .= "Tiempo del trayecto: $sTiempo";
                $sContenido .= "</div>";
            }
            $arMarkers[] = array("title"=>$sTitulo,"content"=>$sContenido, "latitude"=>$sLatitude, "longitude"=>$sLongitud);        //$sTitulo = "";
        }//Fin foreach de paradas
    }
    //bug($arMarkers);
    $arReturn["markers"] = $arMarkers;
    $arReturn["stops"] = $arStops;
    //bug($arReturn);
    return $arReturn;
}

$oBD = CBaseDatos::get_instancia();
$arRevisiones = array("1","","");//396763,,397762,,398658"
$arRuta = array();
//http://www.w3schools.com/html/html_colornames.asp
$arColores = array
(
    "9ACD32",//verde
    "FFA500",//naranja
    "800080",//morado
    "FF0000",//rojo
    "4169E1",//azul claro
    "000080",//azul oscuro
    "C71585",//morado
    "FF00FF",//magenta
    "00FF00",//lima
    "20B2AA",//azul cielo
    "FFD700",//oro
    "DC143C", //crimson
    "8A2BE2",//violeta
);
foreach($arRevisiones as $i=>$idRevision)
{
    $sSQL  = " -- PARADAS
    SELECT DISTINCT 
    --trz.Fecha AS Fecha,
    trz.id_revision_tarifa AS id_revision_tarifa,
    trz.Orden AS Orden,
    trz.id AS id_trazado, trz.Fecha, SUBSTRING(trz.Hora,1,2)+':'+SUBSTRING(trz.Hora,3,2) AS Hora,  
    trz.Alumnos_Suben, trz.Alumnos_Bajan, 
    trz.Esparada, trz.Latitud AS Latitud, trz.Longitud AS Longitud, 
    par.Description AS Parada
    FROM 
    (
        SELECT id, Fecha, Hora, Alumnos_Suben, Alumnos_Bajan, id_parada_ise,
        Esparada, Latitud, Longitud, Orden, id_revision_tarifa 
        FROM prj_trazado
        WHERE id_revision_tarifa = '$idRevision'
        AND Latitud != '0.0' AND Longitud !='0.0'
    ) AS trz
    -- Left porque para CL. no existen paradas ise
    LEFT JOIN prj_parada AS par
    ON trz.id_parada_ise = par.id_parada_ise
    WHERE 1=1
    AND trz.Esparada='1'
    ORDER BY id_revision_tarifa, Orden ASC
    ";
    $arTrazado = $oBD->query($sSQL);
    /*
    $arMarcadores[]=array(
    "title"=>"uno ","content"=>"<b>Content 1</b><input type=\"text\" value=\"marcador uno\">",
    "latitude"=>"40.5475437","longitude"=>"-3.6420912"
    );*/
    //bug($arTrazado);
    $arMarkersAndStops = get_markers_and_stops($arTrazado,$i);
    //bug($arMarkersAndStops); die;
    $arRuta[$idRevision]["dots"] = $arMarkersAndStops["markers"];
    $arRuta[$idRevision]["stops"] = $arMarkersAndStops["stops"];
    $arRuta[$idRevision]["pincolor"] = $arColores[$i];
    $arRuta[$idRevision]["tracecolor"] = $arColores[$i];
    //bug($arRuta);
}
bug($arRuta);
$oGoogleMap = new HelperGoogleMaps3($arRuta);
//$oGoogleMap->draw_lines();
//$oGoogleMap->show_js_array_routes();
?>
<html>
    <head>
    <title>Goglemaps API 3 Clase PHP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta charset="UTF-8">
    
    <script type="text/javascript" src="html_js/js_jquery/js_jquery_v1.7.1.js"></script>
    <script type="text/javascript" src="html_js/js_google/js_google_maps_3.js"></script>
    </head>
<body>
<!--<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=<?php echo TFW_GOOGLEAPIKEY?>&sensor=false">
</script>-->
<?php

$oGoogleMap->draw_map();
?>      
<div id="map_canvas"></div>
</body>
</html>
