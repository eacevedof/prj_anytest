<?php
//bug(TFW_GOOGLEAPIKEY); die;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
  <head>
    <title>Google Maps JavaScript API v3 Example: Map Simple</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta charset="UTF-8">
    <style type="text/css">
      html, body, #map_canvas {
        margin: 0;
        padding: 0;
        height: 100%;
      }
    </style>
    <script type="text/javascript"
      src="http://maps.googleapis.com/maps/api/js?key=<?php echo TFW_GOOGLEAPIKEY?>&sensor=false">
    </script>
<!--
    <script type="text/javascript"
        src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
-->
    <script type="text/javascript">
      var map;
      function initialize() {
        var myOptions = {
          zoom: 8,
          center: new google.maps.LatLng(-34.397, 150.644),
          mapTypeId: google.maps.MapTypeId.ROADMAP //SATELITE, HYBRID, TERRAIN
        };
        map = new google.maps.Map(document.getElementById('map_canvas'),
            myOptions);
      }

      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </head>
  <body>
    <div id="map_canvas"></div>
  </body>
</html>
