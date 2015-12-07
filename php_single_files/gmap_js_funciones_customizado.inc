<?php

//FUNCIONES DE CREACION DE MAPAS DE GOOGLE (Version 3)
//Más información en : 

//La idea de funcionamiento es la siguiente:
//por un lado hace falta llamar a la funcion de inicialización de cada uno de los objetos (mapas) que queremos poner en la página
//La funcion (initilize_gmaps) se parametriza con las coordenadas (latitud y longitud) y el div contenendor del mapa 
// en el body onload... ejemplo: <body onload='initialize_gmaps(lat,lon,div);'> o bien, si usamos 
// jquery, en la llamada al document.ready
//por otro lado, debemos tener un definido el script de google en alguna parte del documento
//<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
//Si quisiéramos usar el sensor de gps que poseen hoy en día los dispositivos basta con llamar con sensor=true

?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?v=3.4&sensor=false"></script>

<script type="text/javascript">
    var map;
    var infowindowsArray = [];
    var markersArray = [];
    var polylinesArray = [];
    var directionsDisplayArray = [];
    //var directionDisplay;
    var directionsService = new google.maps.DirectionsService();
    var requestGlobal=[];
  
  
    // borra todos los objetos del mapa e inicializa los arrays de datos
    function clearMap(map)
    {
        clearInfoWindows(map);
        clearMarkers(map);
        clearPolylines(map);
        clearDirectionLines(map);
        markersArray = [];
        infowindowsArray = [];
        polylinesArray = [];
        directionsDisplayArray=[];
    }

    // funcion para inicializar el mapa    
    function initialize_gmaps(lat, lon, div, zoom) 
    {
        var myLatlng = new google.maps.LatLng(lat,lon);
        var myOptions = 
        {
            zoom: zoom,
            center: myLatlng,
            scaleControl: true,
            streetViewControl: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            navigationControlOptions: 
            {
                style: google.maps.NavigationControlStyle.ZOOM_PAN
            }
        };
        map = new google.maps.Map(document.getElementById(div),myOptions);
        google.maps.event.addListener
        (   map, 'click', 
            function() 
            {
                clearInfoWindows(map);
            }
        );
    }

    /* Pone un Pushpin	
    Map: El objeto map
    lat y lon: Latitud y longitud del pushpin
    Content: Dato en infowindow
    icon_type: Tipo de icono (por el momento blue o own)
    abierto: si el infowindow debe estar abierto al pintar el pushpin
    dragable: si el puspin es arrastable
    drawable: si debe pintarse el pushpin
    urlicon: icono a pintar
    */
    function placeMarker(map,lat,lon,tit,content,icon_type,abierto,draggable,drawable, urlicon) 
    {
        draggable=(typeof draggable == "undefined") ? false : draggable;
        drawable=(typeof drawable == "undefined") ? true : drawable;

        var point = new google.maps.LatLng(lat,lon);
        var infowindow = new google.maps.InfoWindow({content: content});
        var icon = '';
        if( (icon_type=='blue') || (icon_type=='') )
        {
            if (icon_type=='blue') 
            var icon = 'images/blue-dot.png';
            var shadow = new google.maps.MarkerImage('images/msmarker.shadow.png',
            // The shadow image is larger in the horizontal dimension
            // while the position and offset are the same as for the main image.
            new google.maps.Size(37, 32),
            new google.maps.Point(0,0),
            new google.maps.Point(16, 32));
        }
        shadow="";
        if( icon_type=='own' )
        {
            //var icon = 'pictures/users/' + code + '.png';
            //var icon = 'generateImage.php?color=' + estado_color[estado] + '&text=' + code;
            var icon = urlicon;
        }
        var marker = new google.maps.Marker
        (
            {
                position: point,
                title: tit,
                icon: icon,
                //shadow: shadow,
                draggable: draggable,
                map: map
            }
        );

        infowindowsArray.push(infowindow);
        markersArray.push(marker);
        google.maps.event.addListener
        (
            marker, 
            'click', 
            function() 
            {
                if (infowindowsArray) 
                {
                    for (i in infowindowsArray) 
                    {
                    infowindowsArray[i].close();
                    }
                }
                infowindow.open(map,marker);
            }
        );
        if(abierto=='1')
        infowindow.open(map,marker);

        return marker;
    }//Fin placeMarker
	
    /*
    Pone una lista de lineas
    arraypuntos: array de dos dimensiones de lat, lon
    color: color de la lina
    stroke: grosor de la linea
    */
    function placeLineGroup(map,arraypuntos, color, stroke)
    {
        flightPlanCoordinates=new google.maps.MVCArray();
        for (var i=0;i<arraypuntos.length;i++)
        {
            var myLatLng = new google.maps.LatLng(arraypuntos[i][0],arraypuntos[i][1]);
            flightPlanCoordinates.push(myLatLng);
        }
        //alert("despues");
        var flightPath = new google.maps.Polyline
        (
            {
                path: flightPlanCoordinates,
                strokeColor: color,
                strokeOpacity: 3,
                strokeWeight: stroke,
                clickable: false
            }
        );
        polylinesArray.push(flightPath);
        flightPath.setMap(map);
    }

    /*
    Pone una lista de lineas por optimo google
    arraypuntos: array de dos dimensiones de lat, lon
    color: color de la lina
    stroke: grosor de la linea
    time: tiempo de lanzamiento de la funcion de pintado (limitacion google)
    */
    function placeLineRoadGroup(map,arraypuntos, color, stroke, time)
    {
        var init='';
        var end='';
        var waypoints=[];
        for (var i=0;i<arraypuntos.length;i++) 
        {
            var myLatLng = new google.maps.LatLng(arraypuntos[i][0],arraypuntos[i][1]);
            if (i==0) init=myLatLng;
            else if (i==arraypuntos.length - 1) end=myLatLng;
            else 
            {
                waypoints.push
                (
                    {
                        location:myLatLng,
                        stopover:true
                    }
                );
            }
        }
        var request = 
        {
            origin:init, 
            destination:end,
            travelMode: google.maps.DirectionsTravelMode.DRIVING,
            waypoints: waypoints
        };
        i = requestGlobal.length;
        requestGlobal.push(request);
        setTimeout("resolveGoogleDirection("+i+")", time);
    }

    // Pone el centro en la lat y lon indicada
    function setCenter(map, lat, lon)
    {
        var center=new google.maps.LatLng(lat, lon);
        map.setCenter(center);	
    }
    
    // asigna el zoom pasado por parametro
    function setZoom(map,zoom) 
    {
        map.setZoom(zoom);	
    }

    // pone una linea simple
    function placeLine(map,punto1,punto2,stroke_color,stroke_width,stroke_opacity)
    {
        var flightPlanCoordinates = [punto1,punto2];
        var flightPath = new google.maps.Polyline
        (
            {
                path: flightPlanCoordinates,
                strokeColor: stroke_color,
                strokeOpacity: stroke_opacity,
                strokeWeight: stroke_width,
                clickable: false
            }
        );
        polylinesArray.push(flightPath);
        flightPath.setMap(map);
    }
	
/********************************** FUNCIONES INTERNAS NO LLAMAR DESDE FUERA DEL SCRIPT *************************/
  
    // funcion interna
    function resolveGoogleDirection(indice) 
    {
        directionsService.route(requestGlobal[indice], manageDirection);
    }

    //funcion interna
    function manageDirection(response, status) 
    {
        var optionsDisplay = 
        {
            hideRouteList: true,
            suppressMarkers: true
        }
        var directionsDisplay = new google.maps.DirectionsRenderer(optionsDisplay);
        directionsDisplayArray.push(directionsDisplay);
        directionsDisplay.setMap(map);
        if (status == google.maps.DirectionsStatus.OK) 
        {
            directionsDisplay.setDirections(response);
        }
        if (status == google.maps.DirectionsStatus.INVALID_REQUEST) 
        {
            alert("Error IVALID_REQUEST");
        }
        if (status == google.maps.DirectionsStatus.NOT_FOUND)
        {
            alert("Error NOT_FOUND");
        }
        if (status == google.maps.DirectionsStatus.UNKNOWN_ERROR) 
        {
            alert("Error UNKNOWN_ERROR");
        }
        if (status == google.maps.DirectionsStatus.ZERO_RESULTS) 
        {
            alert("Error ZERO_RESULTS");
        }
        if (status == google.maps.DirectionsStatus.REQUEST_DENIED) 
        {
            alert("Error REQUEST_DENIED");
        }
    } 

    // borra las inforwindow
    function clearInfoWindows(map)
    {
        if (infowindowsArray) 
        {
            for (i in infowindowsArray) 
            {
                infowindowsArray[i].close();
            }
        }
    }

    // borra todos los markers
    function clearMarkers(map)
    {
        if (markersArray) 
        {
            for (i in markersArray) 
            {
                markersArray[i].setMap(null);
            }
        }
    }

    // borra las lineas poligonales
    function clearPolylines(map)
    {
        if (polylinesArray) 
        {
            for (i in polylinesArray) 
            {
                polylinesArray[i].setMap(null);
            }
        }
    }

    // borra las linas de direccion
    function clearDirectionLines(map) 
    {
        if (directionsDisplayArray) 
        {
            for (i in directionsDisplayArray) 
            {
                directionsDisplayArray[i].setMap(null);
            }
        }
    }

// Ejemplo de procesamiento y llamada a las funciones desde JSON
/**
function procesaJSONMapa(xml) 
{

    limpiaMapa();
    var centrolat=xml.center.lat;
    var centrolon=xml.center.lon;
    var zoom=xml.center.zoom;
    setCenter(map,centrolat, centrolon);
    setZoom(map,zoom);
    // empezamos a procesar puntos
    if (xml.markers!=null) 
    {
        for (var i=0;i<xml.markers.length;i++) 
        {
            var lat=xml.markers[i].lat;
            var lon=xml.markers[i].long;
            var texto=xml.markers[i].texto;
            var pintable=xml.markers[i].pintable;
            var dragable=xml.markers[i].dragable;
            var urlicon=xml.markers[i].urlicon;
            //placeMarker(map,lat,lon,tit,content,icon_type,code,estado,abierto,draggable,drawable, urlicon) 
            placeMarker(map,lat,lon,texto,texto,"own","",dragable,pintable, urlicon); 
        }
    }
    // Pintamos las lineas
    if (xml.RutasLineas!=null) 
    {
        for (var i=0;i<xml.RutasLineas.length;i++) 
        {
            var color=xml.RutasLineas[i].color;
            var grosor=xml.RutasLineas[i].grosor;
            if (xml.RutasLineas[i].puntos!=null) 
            {
                var array_puntos_lineas=new Array();
                for (var j=0;j<xml.RutasLineas[i].puntos.length;j++) 
                {
                    var lat=xml.RutasLineas[i].puntos[j].lat;
                    var lon=xml.RutasLineas[i].puntos[j].long;
                    array_puntos_lineas[j]=new Array(lat, lon);
                }
                placeLineGroup(map,array_puntos_lineas, color, grosor);
            }
        }
    }
    // Pintamos las lineas carretera
    time=0;
    if (xml.RutasLineasCarretera!=null) 
    {
        for (var i=0;i<xml.RutasLineasCarretera.length;i++) 
        {
            var color=xml.RutasLineasCarretera[i].color;
            var grosor=xml.RutasLineasCarretera[i].grosor;
            if (xml.RutasLineasCarretera[i].puntos!=null) 
            {
                // TODO: partir lineas en grupos de 10
                var array_puntos_lineas=new Array();
                for (var j=0;j<xml.RutasLineasCarretera[i].puntos.length;j++) 
                {
                    var lat=xml.RutasLineasCarretera[i].puntos[j].lat;
                    var lon=xml.RutasLineasCarretera[i].puntos[j].long;
                    array_puntos_lineas[j]=new Array(lat, lon);
                }
                placeLineRoadGroup(map,array_puntos_lineas, color, grosor, time);
                time+=100;
            }
        }
    }

}/**/

</script>