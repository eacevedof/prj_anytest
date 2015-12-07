<?php
/*route -p add 74.125.230.166 MASK 255.255.255.255 192.168.40.5

maps.googleapis.com
route -p add 209.85.169.95 MASK 255.255.255.255 192.168.40.5

map.google.com
route -p add 74.125.230.169 MASK 255.255.255.255 192.168.40.5  
 */

function curl($sUrl)
{
    //Inicia una nueva sesión y devuelve el manipulador curl para el uso de las funciones:
    //curl_setopt(), curl_exec(), y curl_close(). 
    $oCurlInit = curl_init();
    $sUrl = "http://www.yahoo.es";
    //Configura una opción para una transferencia cURL
    //CURLOPT_URL 	Dirección URL a capturar. 
    curl_setopt($oCurlInit, CURLOPT_URL, $sUrl);
    //CURLOPT_RETURNTRANSFER TRUE para devolver el resultado de la transferencia 
    //como string del valor de curl_exec() en lugar de mostrarlo directamente. 
    curl_setopt($oCurlInit, CURLOPT_RETURNTRANSFER, 1);
    
    //curl_setopt($oCurlInit, CURLOPT_PROXY, "192.168.40.4");
    //curl_setopt($oCurlInit, CURLOPT_HTTPPROXYTUNNEL, 1);
    //var_dump(curl_getinfo($oCurlInit, CURLINFO_HTTP_CODE));

    // Capturar la URL y la pasa al 
    $oCurlExec = curl_exec($oCurlInit);
    if($oCurlExec===false)
    {
        echo "error en curl_exec: ".curl_error($oCurlInit); 
        curl_close($oCurlInit); 
        die();
    }
    //Esta función cierra una sesión CURL y libera todos sus recursos. El recurso CURL, ch, también es eliminado. 
    curl_close ($oCurlInit);    
    return $oCurlExec;
}

$sGmapUrlPeticion = "http://maps.googleapis.com/maps/api/geocode/xml";//v3
//tiene un limite de peticiones al día

$arDireccion = array
(
    "Country" => "España", //opcional
    "Population" => "Carretera de villaverde a vallecas 46",
    "Description" => "Villaverde bajo",
    "CP" => "28021"
);

$sDireccion = join(", ",$arDireccion);
$sGmapUrlFinal = $sGmapUrlPeticion."?address=".str_replace(" ","+",urlencode(utf8_encode($sDireccion)))."&sensor=false";
//$sGmapUrlFinal = "http://maps.google.com/maps/api/geocode/xml?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&sensor=false";
//$sStringRecibido = curl($sGmapUrlFinal);
//$oXml = simplexml_load_string($sStringRecibido);
//allow_url_include = On 
$oXml = simplexml_load_file($sGmapUrlFinal) or die("url not loading");
$sXmlStatus = $oXml->status;

//bug($oXml);

if(strcmp($sXmlStatus, "OK") == 0)
{
    ##Successful geocode
    $geocode_pending = false;
    $fLatitud = $oXml->result->geometry->location->lat;//v3
    $fLongitud = $oXml->result->geometry->location->lng;//v3
    $ok=0;
    
    bug($fLatitud); bug($fLongitud);
    if($fLatitud < 45.18786629495072 && $fLatitud > 24.654534254781115 && $fLongitud > -19.80908203125 && $fLongitud < 4.3828125) 
    {
        $ok=1;//Acota direcciones en España y Canarias, revisarlo
    }
    $delay = 250;
}
else
{
    // failure to geocode
    $geocode_pending = false;
    echo "Address " . $sDireccion . " failed to geocoded. ";
    echo "Received status " . $sXmlStatus . "\n";
}

usleep($delay);

/*
 * ERRORES: 
 *   
 */
?>