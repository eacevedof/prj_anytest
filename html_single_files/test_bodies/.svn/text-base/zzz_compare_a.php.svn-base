<!DOCTYPE html>
<html>
    <head>
    <title>ANY TEST</title>
    <meta charset="UTF-8">
    <script type="text/javascript" 
            src="http://maps.googleapis.com/maps/api/js?sensor=false&language=sp"></script>
    <script type="text/javascript">
    function initialize()
    {
        var oOpciones = {
          scaleControl: true,
          center: new google.maps.LatLng(30.064742, 31.249509),
          zoom: 10,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var eDivMapa = document.getElementById('divThemap');
        var oMapa = new google.maps.Map(eDivMapa, oOpciones);
        //console.debug(oMapa);
         var marker = new google.maps.Marker({
          map: oMapa,
          position: oMapa.getCenter()
        });
        console.debug(marker);
    }
    google.maps.event.addDomListener(window, 'load', initialize);
    </script>    </head>
<body>

<div id="divContenido">
    <div id="divThemap" style="width: 100%; height: 100%">oo</div>
</div>
</body>
</html>
