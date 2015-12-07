<?
$base_url = "http://maps.googleapis.com/maps/api/geocode/xml";//v3
//tiene un limite de peticiones al día

if($pais=="") $pais="España";

$address="";

if($recordset->result($result,"Address")!="") $address.=$recordset->result($result,"Address");

if($recordset->result($result,"Population")!="") $address.=", ".$recordset->result($result,"Population");

if($recordset->result($result,"Description")!="") $address.=", ".$recordset->result($result,"Description");

if($recordset->result($result,"CP")!="") $address.=", ".$recordset->result($result,"CP");

if($pais!="") $address.=", ".$pais; //Opcional

 

$request_url=$base_url."?address=".str_replace(" ","+",urlencode(utf8_encode($address)))."&sensor=false";

$xml=simplexml_load_file($request_url) or die("url not loading");

$status=$xml->status;

if(strcmp($status, "OK") == 0)
{
    ##Successful geocode
    $geocode_pending = false;
    $lat = $xml->result->geometry->location->lat;//v3
    $lng = $xml->result->geometry->location->lng;//v3
    $ok=0;

    if($lat < 45.18786629495072 && $lat > 24.654534254781115 && $lng > -19.80908203125 && $lng < 4.3828125) 
    {
        $ok=1;//Acota direcciones en España y Canarias, revisarlo
    }
    $delay += 250;
}
else
{
    // failure to geocode
    $geocode_pending = false;
    echo "Address " . $address . " failed to geocoded. ";
    echo "Received status " . $status . "\n";
}

usleep($delay);

