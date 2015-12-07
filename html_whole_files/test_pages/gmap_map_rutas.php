<?php
Tfw::IMPORT("php_classes".DS."helpers","helper_google_maps_3");

//Obtener latitud y longitud con los datos de una dirección.
//El array debe llevar
$arDireccion[] = array
(
    "pais" => "España", //opcional
    "direccion" => "Villaverde a vallecas 50",
    "zona" => "madrid",
    "cp" => ""
);
$arDireccion[] = array
(
    //"pais" => "España", //opcional
    "direccion" => "La granja 8",
    "zona" => "alcobendas",
    "cp" => ""
);

$arDireccion[] = array
(
    "pais" => "España", //opcional
    "direccion" => "Conde de Peñalver 51",
    "zona" => "madrid",
    "cp" => "28006"
);

//bug("antes");
//error_reporting(E_ALL);
//creamos el objeto
//bug(get_included_files());
$oGoogleMap = new HelperGoogleMaps3();
//bug($oGoogleMap,"gmapinc",1); 
$oGoogleMap->set_delay_time(500);

//bug($oGoogleMap,"googlemaps");
//lo configuramos para que no esté acotado.  Es decir que si encuentra la
//dirección 0 fuera de España. p.e Latinoamérica que obtenga los datos.
//$oGoogleMap->dont_narrow();

//La función bug es un var_dump() customizado.
//bug($oGoogleMap->get_latlong_from_address($arDireccion[0]),$arDireccion[0]["direccion"]);
//bug($oGoogleMap->get_latlong_from_address($arDireccion[1]),$arDireccion[1]["direccion"]);
//bug($oGoogleMap->get_latlong_from_address($arDireccion[2]),$arDireccion[2]["direccion"]);
//Esta traza mostraria lo siguiente:

//VARIABLE La granja 8:
//array(2){["latitude"]=>float(40.5475437)["longitude"]=>float(-3.6420912)}

//VARIABLE Conde de Peñalver 51:
//array(2){["latitude"]=>float(40.4363505) ["longitude"]=>float(-3.685144)}





//Los marcadores identifican a los globitos o chinchetas en el mapa.
//El formato de los indices del array a pasar en el constructor debe ser el siguiente:
//title : es equivalente al "tooltiptext" que aparece cuando se pasa el puntero 
//por encima.
//content: el valor que se mostrará en el popup informativo. Se puede incluir html, 
//controles y eventos.
//latitude, longitude: coordenadas de tipo real
//PENDIENTE: Un indice "address" para poder crear un marcador directamente desde
//este dato. De momento no lo hace.
//El orden de los arrays anidados influira en el número que se asigna al marcador.
$arMarcadores[]=array(
    "title"=>"uno ","content"=>"<b>Content 1</b><input type=\"text\" value=\"marcador uno\">",
    "latitude"=>"40.5475437","longitude"=>"-3.6420912"
    );
$arMarcadores[]=array(
    "title"=>"dos ","content"=>"<b>Content 2</b>",
    "latitude"=>"40.4363505","longitude"=>"-3.685144"
    );
$arMarcadores[]=array(
    "title"=>"tres ","content"=>"<b>Content 3</b>",
    "latitude"=>"41.4166909","longitude"=>"-3.7003454"
    );
$oGoogleMap = new HelperGoogleMaps3($arMarcadores);

//Configuramos el zoom
$oGoogleMap->set_zoom(7);
//Dibujamos las lineas entre los marcadores (pines)
//$oGoogleMap->draw_lines();
//Tamaño del mapa
$oGoogleMap->set_size_container(500,500);
$oGoogleMap->set_size_unit('pt');
$oGoogleMap->draw_routes();
$oGoogleMap->set_route_color("black");
$oGoogleMap->set_marker_color("green");
$oGoogleMap->set_route_width(2);
//No se mostrarán numeros en los pines de googlemaps
//$oGoogleMap->set_markers_numbers_off();
//Calcula la distancia entre las chinchetas
$fDistancia = $oGoogleMap->sum_distance();
bug($fDistancia,"DISTANCIA");  //muestra 11.1
//$oGoogleMap->draw_map();

?>

<html>
    <head>
    <title>Goglemaps API 3 Clase PHP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta charset="UTF-8">
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
