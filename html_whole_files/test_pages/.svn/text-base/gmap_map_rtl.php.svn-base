<?php
$apikey = "";
?>
<!DOCTYPE html>
<html dir="rtl">
  <head>
    <title>Maps API Example: Right-to-Left Text</title>
    <meta charset="UTF-8">
    <link href="/apis/maps/documentation/javascript/examples/default.css"
        rel="stylesheet" type="text/css">
    <script type="text/javascript"
        src="http://maps.googleapis.com/maps/api/js?sensor=false&language=ar">
    </script>
    <script  type="text/javascript">
      function initialize() {
        var myOptions = {
          scaleControl: true,
          center: new google.maps.LatLng(30.064742, 31.249509),
          zoom: 10,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        var map = new google.maps.Map(document.getElementById('map_canvas'),
            myOptions);

        var marker = new google.maps.Marker({
          map: map,
          position: map.getCenter()
        });
        var infowindow = new google.maps.InfoWindow();
        infowindow.setContent('<b>القاهرة</b>');
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map, marker);
        });
      }

      google.maps.event.addDomListener(window, 'load', initialize);
    </script>

  </head>
  <body>
    <p>القاهرة Egypt</p>
    <div id="map_canvas" style="height: 600px;"></div>
  </body>
</html>