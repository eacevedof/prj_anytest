/**
 * @author Eduardo Acevedo Farje.
 * @link www.eduardoaf.com
 * @version 1.1.3
 * @name Javascript class for GoogleMaps3  
 * @uses google_maps_3.php, jquery v1.7+
 * @date 16-07-2012
 */
var bug = function(value,title)
{
    if(window.console != undefined)
    {    
        if(title!=null) console.debug(title);
        console.debug(value);
    }
};

var gmaps3 =
{
    config : 
    {
        //Mapa
        sMapType : 'roadmap',
        fLatitude : 40.41694, //Coord de centrado
        fLongitude : -3.70361, //Puerta del sol (Madrid).
        iZoom : 6,
        //Rutas
        arRoutes : [], //[ [["sTitle, sContent, fLatitude, fLongitude"],[paradas],["color_pines"],["color_trazado"]],  ]
        useMarkersNumbers : true,
        sMarkerColor: 'red', //TODO modificar este script y el codigo php para que esta sea por defecto
        //Lineas de distancia
        drawLines : false,
        //Lienzo
        sIdDivContainer : 'map_canvas', //Div contenedor
        iWidth : 800,
        iHeight: 600,
        sUnitWH : 'px',
        //Rutas:
        drawMarkers : true,//todo nuevo
        //drawRoutes : false, TODO nuevo
        drawTraces : true,
        sRouteMode: 'driving', // DRIVING, WALKING BICYCLING, 
        //sRouteColor: 'red', //TODO modificar este script y el codigo php para que esta sea por defecto
        fRouteAlpha : 0.6,  // de 0.0 a 1.0
        iRouteWidth : 4
    },
    
    get_route_points: function(iRouteIndex)
    {
        var arRoutes = gmaps3.config.arRoutes;
        var arRoute = arRoutes[iRouteIndex];
        //Marcadores del trazado de la ruta i
        var arPoints = arRoute[0];//0 es el array de marcadorers
        return arPoints;
    },
    
    //stops. Paradas
    get_route_markers: function(iRouteIndex)
    {
        var arRoute = gmaps3.config.arRoutes[iRouteIndex];
        var arPoints = arRoute[0];
        var arStopsIndexes = arRoute[1];//1 array de indices de paradas (marcadores)
        var arMarkers = [];
        for(var i=0; i<arPoints.length; i++)
        {
            for(var j=0; j<arStopsIndexes.length; j++)
            {
                if(i==arStopsIndexes[j])
                    arMarkers.push(arPoints[i]);
            }
        }
        return arMarkers;
    },
    
    //Devuelve todas las paradas de todas las rutas. Necesario para ajustar el zoom
    get_all_routes_markers: function()
    {
        var arAllMarkers = [];//for()a.concat(b,d);
        var arTemp = [];
        for(var i=0; i<gmaps3.config.arRoutes.length;i++)
        {
            arTemp = gmaps3.get_route_markers(i);
            arAllMarkers = arAllMarkers.concat(arTemp);
        }
        return arAllMarkers;
    },
    
    get_route_pin_color: function(iRouteIndex)
    {
        var arRoutes = gmaps3.config.arRoutes;
        var arRoute = arRoutes[iRouteIndex];
        var sPinColor = arRoute[2];//2 es el color de los pines
        return sPinColor;
    },
    
    get_route_trace_color: function(iRouteIndex)
    {
        var arRoutes = gmaps3.config.arRoutes;
        var arRoute = arRoutes[iRouteIndex];
        var sTraceColor = arRoute[3];//3 es el color del trazado
        return sTraceColor;        
    },
    
    get_total_traces : function()
    {
        var iTotal = 0;
        for(var i=0; i<gmaps3.config.arRoutes.length; i++)
            //El número total de trazados es igual al total de puntos - 1
            iTotal += (gmaps3.config.arRoutes[i][0].length - 1);
        return iTotal;
    },
    
    //arMarkers: [sTitle, sContent, fLatitude, fLongitude],..[]
    draw_markers : function(arMarkers, sMarkerColor)
    {
        var arTmpMarker;
        var oLatLng;
        var sTitle;
        var sContent;
        var iMarkerNumber;
        var iCoordZ; //Posibles problemas con esta coordenada
        
        var sMarkerColor = sMarkerColor || gmaps3.config.sMarkerColor;
        
        for(var i = 0; i<arMarkers.length; i++) 
        {
            arTmpMarker = arMarkers[i];
            sTitle = arTmpMarker[0];
            sContent = arTmpMarker[1];
            //Si la latitud y longitud es 0
            if(arTmpMarker[2]!=0 && arTmpMarker[3]!=0)
            {
                oLatLng = new google.maps.LatLng(arTmpMarker[2], arTmpMarker[3]);
                iMarkerNumber = i+1;
                //iCoordZ = (i+1)*10;
                iCoordZ = i+1;
                gmaps3.draw_marker(sTitle, sContent, oLatLng, iMarkerNumber, iCoordZ,
                sMarkerColor);
            }
        }
    },
    
    //https://developers.google.com/maps/documentation/javascript/overlays#Markers
    draw_marker : function(sTitle, sContent, oLatLng, iNumber, iCoordZ, sMarkerColor)
    {
        sMarkerColor = gmaps3.clean_color_param(sMarkerColor);
        var oStyleIcon = new StyledIcon(StyledIconTypes.MARKER,{color:sMarkerColor,text:iCoordZ.toString()});
     	var oStyleMarker = new StyledMarker
        (
            {styleIcon:oStyleIcon, 
                position:oLatLng, 
                map: gmaps3.oMap,
                title: sTitle}
        );
    
        //bug(oStyleMarker,"oStyleMarker");
        if(sContent!=null && jQuery.trim(sContent)!='')
        {
            var on_click = function()
            {
                if(gmaps3.oInfoWindow) gmaps3.oInfoWindow.close();
                gmaps3.oInfoWindow = new google.maps.InfoWindow({content: sContent});
                //gmaps3.oInfoWindow.setContent(sContent);
                gmaps3.oInfoWindow.open(gmaps3.oMap,oStyleMarker);
            }
            google.maps.event.addListener(oStyleMarker,'click',on_click);
        }
        //bug(oMarker,"oMarker");
    },
    
    //Pinta lineas rectas entre puntos
    draw_lines : function(arLatLong,sLineColor)
    {
        var arObjectsLl = [];
        var fLat = 0;
        var fLong = 0;
        var arTmpLatLong = [];
        var oTmpLatLng = null;
        for(var i = 0; i < arLatLong.length; i++) 
        {
            arTmpLatLong = arLatLong[i];
            fLat = arTmpLatLong[0];
            fLong = arTmpLatLong[1];
            
            oTmpLatLng = new google.maps.LatLng(fLat, fLong);
            arObjectsLl.push(oTmpLatLng);
        }
        //bug(arObjectsLl,"arObjectsLi");
        var oPolyLine = new google.maps.Polyline
        (
            {
                path: arObjectsLl,
                strokeColor: gmaps3.clean_color_param(sLineColor),
                strokeOpacity: 1.0,
                strokeWeight: 2
            }
        );
        //bug(oPolyLine,"polyline");
        oPolyLine.setMap(gmaps3.oMap);
    },
    
    is_all_traces_received: function()
    {
        //Si el número de trazados recibidos es igual al total de puntos -1 
        //quiere decir que se han dibujado todas
        return (gmaps3.iTracesRendered == gmaps3.iTracesToBeRendered);
    },
    
    draw_trace: function(arLatLong,sTraceColor)
    {
        var oTempOrigin, oTempDestination;
        for(var i=0; i<(arLatLong.length-1); i++)
        {
            oTempOrigin = arLatLong[i];
            oTempDestination = arLatLong[i+1];
            gmaps3.add_trace(oTempOrigin, oTempDestination, sTraceColor);
        }
    },
    
    clean_color_param : function(sColor)
    {
        var hxColor = sColor.replace("#","");
        hxColor = "#"+hxColor;
        return hxColor;
    },
    
    //Añade el trazado entre dos puntos al mapa
    add_trace : function(oLlOrigin, oLlDestination, sTraceColor)
    {
        bug(sTraceColor,"trace color en add_trace");
        var sContent = sContent || '';
        var oDirRenderOption = 
        {
            map: gmaps3.oMap,
            //panel: directionsPanel,
            suppressInfoWindows: true,
            suppressMarkers: true,
            polylineOptions: 
            { 
                strokeColor: gmaps3.clean_color_param(sTraceColor), 
                thickness: 100, 
                strokeOpacity: gmaps3.config.fRouteAlpha,
                strokeWeight: gmaps3.config.iRouteWidth
            }
        };
        bug(oDirRenderOption,"o dir render");
        var oDirectionsRenderer = new google.maps.DirectionsRenderer(oDirRenderOption);
        var oDirectionsService = new google.maps.DirectionsService();
        //Javascript allows us to access the constant
        // using square brackets and a string value as its
        // "property."
        var oDirectionsTravelMode = google.maps.DirectionsTravelMode[gmaps3.get_route_mode()];
        var oRequest = 
        { 
            origin: oLlOrigin, 
            destination: oLlDestination,
            travelMode : oDirectionsTravelMode
        };
        var on_response = function(oResponse, sStatus)
        {
            gmaps3.iTracesRendered++;
            if(sStatus == google.maps.DirectionsStatus.OK)
            {
                oDirectionsRenderer.setDirections(oResponse);
                //Actualizo las rutas dibujadas
                //bug(gmaps3.iTracesRendered,"trazos pintadas de "+gmaps3.iTracesToBeRendered+" interval "+gmaps3.iRouteInterval);
            }
            else
            { 
                bug(google.maps.DirectionsStatus,"error en peticion ");
            }
        };
        //bug(oRequest,"peticion de trazado enviado");
        oDirectionsService.route(oRequest, on_response);
        oDirectionsRenderer.setMap(gmaps3.oMap);
    },
    
    //DRIVING, WALKING BICYCLING, 
    get_route_mode : function(sType)
    {
        var sType = sType || gmaps3.config.sRouteMode;
        sType = sType.toUpperCase();
        return sType;        
    },
    
    get_maptype : function(sType)
    {
        var oMapTypeId = null;
        var sType = sType || gmaps3.config.sMapType;
        sType = sType.toLowerCase();
        if(sType=="roadmap")
        {
            oMapTypeId = google.maps.MapTypeId.ROADMAP;
        }
        else if(sType=="satelite")
        {
            oMapTypeId = google.maps.MapTypeId.SATELITE;
        }
        else if(sType=="hybrid")
        {
            oMapTypeId = google.maps.MapTypeId.HYBRID;
        }
        else //if(sType="terrain")
        {
            oMapTypeId = google.maps.MapTypeId.TERRAIN;
        }
        return oMapTypeId;
    },
    
    //Extrae la latitud de los marcadores ya sea como objetos de google
    //o un array de arrays
    extract_latlng_from_points : function(arPoints, asGoogleObj)
    {
        var arPoints = arPoints || [];//todo || gmaps3.config.arMarkers;
        var arLatLong = [];
        var arTemp = [];
        var fLatitude = 0;
        var fLongitude = 0;
        //Los marcadores es un array de arrays cuyas filas llevan como 
        //
        for(var i=0; i<arPoints.length; i++)
        {
            arTemp = arPoints[i];
            fLatitude = arTemp[2];
            fLongitude = arTemp[3];
            if(asGoogleObj==null) arTemp = [fLatitude,fLongitude];
            else arTemp = new google.maps.LatLng(fLatitude,fLongitude);
            arLatLong.push(arTemp);
        }
        return arLatLong;
    },
    
    //Comprueba si se ha de pintar trazados y si se han añadido todos
    //los trazados al mapa.
    fit_in_screen : function()
    {
        var doFit = false;
        //Si se están dibujando trazdos se comprueba en cada llamada que se 
        //hayan recibido todas desde el servidor mediante ajax.
        if(gmaps3.config.drawTraces && gmaps3.is_all_traces_received())
        {
            clearInterval(gmaps3.iRouteInterval);
            doFit = true;
        }
        else if(!gmaps3.config.drawTraces)
            doFit = true;
        //else ; // drawTraces && !all_routes_received
        
        if(doFit)
        {
            //Objetos de tipo maps.LatLng TODO ERROR. HAY QUE RECUPERAR TODOS LOS PUNTOS 
            //DE TODAS LAS RUTAS
            var arAllMarkers = gmaps3.get_all_routes_markers();
            //bug(arAllMarkers,"todos los marcadores");
            var arLlObjects = gmaps3.extract_latlng_from_points(arAllMarkers,true);
            //bug(arLlObjects,"llobjects");
            //Recuperamos los limites que se están visualizando
            var oLlBound = new google.maps.LatLngBounds();
            //Recorremos cada punto y lo pasamos por el metodo extend
            for(var i = 0; i < arLlObjects.length; i++) 
                oLlBound.extend(arLlObjects[i]);
            //Fit these bounds to the map
            gmaps3.oMap.fitBounds(oLlBound);            
        }

    },
    
    //=======================================================================
    oMap : null, //El objeto mapa
    //La ventana única
    oInfoWindow : null, 
    //El número de trazados que se han añadido al mapa
    iTracesRendered : 0, 
    //El número total de trazados que se van a dibujar. Se toman en cuenta todas las rutas.
    iTracesToBeRendered : 0,
    
    //Acumulador. Guarda lo devuelto por route interval
    iRouteInterval : 0,
    
    //Antes la llamaba initialize. Le he cambiado el nombre para demostrar
    //que no necesariamente tiene que ser asi.
    load_map: function()
    {
        //Cuento los trazados a dibujar
        gmaps3.iTracesToBeRendered = gmaps3.get_total_traces();
        //bug(gmaps3.iTracesToBeRendered,"traces to be rendered");
        //el div donde se dibujara el mapa
        var eDivContainer = document.getElementById(gmaps3.config.sIdDivContainer);
        //objeto jquery del div contenedor. Es distinto del anterior ya que no puedo
        //utilizar este mismo dentro del constructor "Map". este objeto me sirve para configurar
        //sus estilos
        var oDivCanvas = jQuery(eDivContainer);
        
        //Array auxiliar donde se almacenará la latitud y longitud de los marcadores
        //de una ruta
        var arTmpLatLong = [];
        
        if(gmaps3.config.sUnitWH=='px')
        {
            oDivCanvas.width(gmaps3.config.iWidth);
            oDivCanvas.height(gmaps3.config.iHeight);
        }
        else
        {
            var sCanvasSize = gmaps3.config.iWidth + gmaps3.config.sUnitWH;
            oDivCanvas.width(sCanvasSize);
            sCanvasSize = gmaps3.config.iHeight + gmaps3.config.sUnitWH;
            oDivCanvas.height(sCanvasSize);
        }
        oDivCanvas.css("margin", "0");
        oDivCanvas.css("padding", "0");
        
        //La zona a visualizar. Es un objeto latitud longitud el cual se utilizará para centrar el mapa.
        var oLlCenter = new google.maps.LatLng(gmaps3.config.fLatitude, gmaps3.config.fLongitude);
        
        //====================
        //  EL OBJETO MAPA
        //====================
        var oConfig = 
        {
            center: oLlCenter,
            zoom: gmaps3.config.iZoom,
            mapTypeId : gmaps3.get_maptype()
        };
        
        gmaps3.oMap = new google.maps.Map(eDivContainer, oConfig);
        //=====================
        // FIN CREACION OBJETO MAPA
        //=====================
  
        var arPoints = [];var sRouteColor="red";var sMarkerColor="red";
        //gmaps3.config.drawTraces = false;
        for(var i=0; i<gmaps3.config.arRoutes.length; i++)
        {
            //Todos los puntos que conforman la ruta
            sMarkerColor = gmaps3.config.arRoutes[i][2];
            sRouteColor = gmaps3.config.arRoutes[i][3];
            //bug(sMarkerColor,"color marcador de ruta "+i+" "+sMarkerColor+" color trazado "+sRouteColor);
            arPoints = gmaps3.config.arRoutes[i][0];
            //bug(arPoints,"puntos_ruta_"+i);
            //Array de latitudes y longitudes para dibujar trazado
            if(gmaps3.config.drawTraces)
            {
                //crea un array de objetos latitud longitud
                arTmpLatLong = gmaps3.extract_latlng_from_points(arPoints,true);
                //llamada ajax
                gmaps3.draw_trace(arTmpLatLong,sRouteColor);       
            } 
            //bug(gmaps3.config.drawLines,"drawline?");
            if(gmaps3.config.drawLines)
            {
                arTmpLatLong = gmaps3.extract_latlng_from_points(arPoints);
                //bug(arTmpLatLong,"latlong");
                gmaps3.draw_lines(arTmpLatLong,sRouteColor);
            }
            
            if(gmaps3.config.drawMarkers)
            {
                //Solo se pinta los marcadores. Las paradas
                var arMarkers = gmaps3.get_route_markers(i);
                //bug(arMarkers,"paradas");
                //bug(sMarkerColor,"marker color");
                gmaps3.draw_markers(arMarkers,sMarkerColor);
            }
  
        } 
            
        //Si no se ha pintado trazados se ajusta el zoom inmediatamente
        if(!gmaps3.config.drawTraces) 
            gmaps3.fit_in_screen();
        else
        //Cada segundo ejecuta la funcion fit_in_screen. Esta, comprueba que 
        //se hayan añadido todos los trazados al mapa para ajustar el zoom
        gmaps3.iRouteInterval = setInterval("gmaps3.fit_in_screen()",1000);       
    }//Fin load_map
};
