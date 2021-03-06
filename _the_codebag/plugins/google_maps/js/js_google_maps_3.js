/**
 * @author Eduardo Acevedo Farje.
 * @link www.eduardoaf.com
 * @version 1.0.9
 * @name Javascript class for GoogleMaps3  
 * @uses google_maps_3.php, jquery v1.7+
 * @date 17-06-2012
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
        //Marcadores
        arMarkers : [],
        sMarkerColor : 'green',
        useMarkersNumbers : true,
        //Lineas de distancia
        drawLines : false,
        //Lienzo
        sIdDivContainer : 'map_canvas', //Div contenedor
        iWidth : 800,
        iHeight: 600,
        sUnitWH : 'px',
        //Rutas:
        drawRoutes : true,
        sRouteMode: 'driving', // DRIVING, WALKING BICYCLING, 
        sRouteColor: 'green',
        fRouteAlpha : 0.5,  // de 0.0 a 1.0
        iRouteWidth : 3
    },
    
    //arMarkers: [sTitle, sContent, fLatitude, fLongitude],..[]
    draw_markers : function(arMarkers)
    {
        var arTmpMarker;
        var oLatLng;
        var sTitle;
        var sContent;
        var iMarkerNumber;
        var iCoordZ;
        
        for(var i = 0; i < arMarkers.length; i++) 
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
                //bug(oLatLng,"oLatLng");
                //iIconNumber = arTmpLocation[5];
                gmaps3.draw_marker(sTitle, sContent, oLatLng, iMarkerNumber, iCoordZ);
            }
        }
    },
    
    //https://developers.google.com/maps/documentation/javascript/overlays#Markers
    draw_marker : function(sTitle, sContent, oLatLng, iNumber, iCoordZ, 
    oMiImage,oMiShadow,oMiIcon,oShape)
    {
        //Url con configuración de color en marcador
        var sIconUrl = 'http://gmaps-samples.googlecode.com/svn/trunk/markers/'+gmaps3.config.sMarkerColor+'/marker';
        var sEndIconUrl = '.png';
        var oInfoWindow = null;
       
        var oMarker = new google.maps.Marker
        (
            {
                map: gmaps3.oMap,
                title: sTitle,
                position: oLatLng,
                zIndex: iCoordZ,
                image: oMiImage, //oMarkerImage
                shadow: oMiShadow, //oMarkerImage
                icon: oMiIcon, //oMarkerImage
                shape: oShape // coord: [1, 1, 1, 20, 18, 20, 18 , 1], type: 'poly'
            }
        );
        if(oMiIcon==null && iNumber!='' && gmaps3.config.useMarkersNumbers)
            oMarker.icon = sIconUrl + iCoordZ + sEndIconUrl;
        
        if(sContent!=null && jQuery.trim(sContent)!='')
        {
            oInfoWindow = new google.maps.InfoWindow
            (
                {content: sContent}
            );
            
            var on_click = function()
            {
                oInfoWindow.open(gmaps3.oMap,oMarker);
            }
            google.maps.event.addListener(oMarker,'click',on_click);
        }
        //bug(oMarker,"oMarker");
    },
    
    draw_lines : function(arLatLong)
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
                strokeColor: "#FF0000",
                strokeOpacity: 1.0,
                strokeWeight: 2
            }
        );

        oPolyLine.setMap(gmaps3.oMap);
    },
    
    is_all_routes_received: function()
    {
        //Si el número de rutas recibidas son iguales al total de puntos -1 
        //quiere decir que se han dibujado todas
        return (gmaps3.iRoutesRendered == (gmaps3.config.arMarkers.length-1));
    },
    
    draw_routes: function(arLatLong)
    {
        var oTempOrigin, oTempDestination;
        for(var i=0; i<(arLatLong.length-1); i++)
        {
            oTempOrigin = arLatLong[i];
            oTempDestination = arLatLong[i+1];
            gmaps3.add_route(oTempOrigin, oTempDestination);
        }
    },
    
    add_route : function(oLlOrigin, oLlDestination)
    {
        var sContent = sContent || '';
        var oDirRenderOption = 
        {
            map: gmaps3.oMap,
            //panel: directionsPanel,
            suppressInfoWindows: true,
            suppressMarkers: true,
            polylineOptions: 
                { 
                    strokeColor: gmaps3.config.sRouteColor, 
                    thickness: 100, 
                    strokeOpacity: gmaps3.config.fRouteAlpha,
                    strokeWeight: gmaps3.config.iRouteWidth
                }
        };
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
            if(sStatus == google.maps.DirectionsStatus.OK)
            {
                oDirectionsRenderer.setDirections(oResponse);
                //Actualizo las rutas dibujadas
                gmaps3.iRoutesRendered++;
                //bug(gmaps3.iRoutesRendered,"rutas pintadas");
            }
            else
            { 
                //bug(google.maps.DirectionsStatus,"status de ruta");
            }
        };
        
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
    extract_latlong_from_markers : function(arMarkers, asGoogleObj)
    {
        var arMarkers = arMarkers || gmaps3.config.arMarkers;
        var arLatLong = [];
        var arTemp = [];
        var fLatitude = 0;
        var fLongitude = 0;
        //Los marcadores es un array de arrays cuyas filas llevan como 
        //
        for(var i=0; i<arMarkers.length; i++)
        {
            arTemp = arMarkers[i];
            fLatitude = arTemp[2];
            fLongitude = arTemp[3];
            if(asGoogleObj==null) arTemp = [fLatitude,fLongitude];
            else arTemp = new google.maps.LatLng(fLatitude,fLongitude);
            arLatLong.push(arTemp);
        }
        return arLatLong;
    },
    
    //
    fit_in_screen : function()
    {
        var doFit = false;
        //Si se están dibujando rutas se comprueba en cada llamada que se 
        //hayan recibido todas desde el servidor mediante ajax.
        if(gmaps3.config.drawRoutes && gmaps3.is_all_routes_received())
        {
            clearInterval(gmaps3.iRouteInterval);
            doFit = true;
        }
        else if(!gmaps3.config.drawRoutes)
            doFit = true;
        //else ; // drawRoutes && !all_routes_received
        
        if(doFit)
        {
            //Objetos de tipo maps.LatLng
            var arLlObjects = gmaps3.extract_latlong_from_markers(null,true);
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
    
    //Las rutas pintadas por ajax
    iRoutesRendered : 0, 
    
    iRouteInterval : 0,
    
    //Antes la llamaba initialize. Le he cambiado el nombre para demostrar
    //que no necesariamente tiene que ser asi.
    load_map: function()
    {
        //el div donde se dibujara el mapa
        var eDivContainer = document.getElementById(gmaps3.config.sIdDivContainer);
        //objeto jquery del div contenedor. Es distinto del anterior ya que no puedo
        //utilizar este mismo dentro del constructor "Map". este objeto me sirve para configurar
        //sus estilos
        var oDivCanvas = jQuery(eDivContainer);
        
        var arLatLong = [];
        
        if(gmaps3.config.sUnitWH=='px')
        {
            oDivCanvas.width(gmaps3.config.iWidth);
            oDivCanvas.height(gmaps3.config.iHeight);
        }
        else
        {
            var sSize = gmaps3.config.iWidth + gmaps3.config.sUnitWH;
            //bug(sSize);
            oDivCanvas.width(sSize);
            sSize = gmaps3.config.iHeight + gmaps3.config.sUnitWH;
            oDivCanvas.height(sSize);
            
        }
        oDivCanvas.css("margin", "0");
        oDivCanvas.css("padding", "0");
        
        //La zona a visualizar. Es un objeto latitud longitud el cual se utilizará para centrar el mapa.
        var oLlCenter = new google.maps.LatLng(gmaps3.config.fLatitude, gmaps3.config.fLongitude);
        
        var oConfig = 
        {
            center: oLlCenter,
            zoom: gmaps3.config.iZoom,
            mapTypeId : gmaps3.get_maptype()
        };
        
        gmaps3.oMap = new google.maps.Map(eDivContainer, oConfig);
        
        if(gmaps3.config.drawRoutes==true)
        {
            arLatLong = gmaps3.extract_latlong_from_markers(gmaps3.config.arMarkers,true);
            //Ejecuta llamadas ajax por cada ruta
            gmaps3.draw_routes(arLatLong);
        }   
        
        if(gmaps3.config.drawLines==true)
        {
            arLatLong = gmaps3.extract_latlong_from_markers(gmaps3.config.arMarkers);
            //bug(arLatLong,"arLatLong");
            gmaps3.draw_lines(arLatLong);
        }

        gmaps3.draw_markers(gmaps3.config.arMarkers);
        //Reajusta la visualizacion de los marcadores sino se pintan rutas.
        //ya que si hay que hacer esto no tiene efecto
        if(!gmaps3.config.drawRoutes)
            gmaps3.fit_in_screen();
        else
            //Cada segundo ejecuta la funcion fit_in_screen. Comprueba que 
            //se hayan recibido todas las rutas para ajustar el mapa
            gmaps3.iRouteInterval = setInterval("gmaps3.fit_in_screen()",1000);
    }
};
