<!DOCTYPE html>
<html>
  <head>
    <title>Google Maps JavaScript API v3 Example: Map Language</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="UTF-8">
    <link href="/apis/maps/documentation/javascript/examples/default.css"
        rel="stylesheet" type="text/css">
    <script type="text/javascript"
        src="http://maps.googleapis.com/maps/api/js?sensor=false&language=ja">
    </script>
    <script type="text/javascript">
      function initialize() {
        var myOptions = {
          zoom: 8,
          center: new google.maps.LatLng(-34.397, 150.644),
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById('map_canvas'),
            myOptions);
      }

      google.maps.event.addDomListener(window, 'load', initialize);
    </script>

  </head>
  <body>
    <div id="map_canvas"></div>
  </body>
</html>