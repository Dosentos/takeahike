<?php
require 'php/xml_functions/generate_marker_xml.php';
?>

<main>
    <h3>Destinations in Finland</h3>
    <!-- API key Google Maps Javascript API:in: AIzaSyDXvGjS2pVvCg1fac8IjYXnyFob7FUqoMs -->

    <div id="testContainer"></div>
    <div id="map"></div>
    <script>
        function initMap() {
            var finland = {lat: 64.6479041, lng: 17.1438697};
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 5,
                center: finland
            });
            var infoWindow = new google.maps.InfoWindow;

            downloadUrl('xml/markers.xml', function(xmlContent) {
                var xml = xmlContent.responseXML;
                var markers = xml.documentElement.getElementsByTagName('marker');
                Array.prototype.forEach.call(markers, function(markerElem) {
                    var id = markerElem.getAttribute('id');
                    var name = markerElem.getAttribute('name');
                    var location = markerElem.getAttribute('location');

                    var centerWithoutQuotes = markerElem.getAttribute('center').replace( /"/g, "");
                    var coordinateArray = centerWithoutQuotes.split(" ");
                    var lat = parseFloat( coordinateArray[1] );
                    var lng = parseFloat( coordinateArray[0] );
                    var center = new google.maps.LatLng(lat, lng);

                    var infowincontent = document.createElement('div');
                    var strong = document.createElement('strong');
                    strong.textContent = name;
                    infowincontent.appendChild(strong);
                    infowincontent.appendChild(document.createElement('br'));

                    var marker = new google.maps.Marker({
                        map: map,
                        position: center
                    });

                    marker.addListener('click', function () {
                        infoWindow.setContent(infowincontent);
                        infoWindow.open(map, marker);
                    });
                });
            });

            function downloadUrl(url, callback) {
                var request = window.ActiveXObject ?
                    new ActiveXObject('Microsoft.XMLHTTP') :
                    new XMLHttpRequest;

                request.onreadystatechange = function() {
                    if (request.readyState == 4) {
                        request.onreadystatechange = doNothing;
                        callback(request, request.status);
                    }
                };

                request.open('GET', url, true);
                request.send(null);
            }

            function doNothing() {}
        }
    </script>

    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXvGjS2pVvCg1fac8IjYXnyFob7FUqoMs&callback=initMap">
    </script>
    <h2><a href="?page=destination&destinationid=404">Kohdesivut/Ahmalampi</a></h2>
</main>

