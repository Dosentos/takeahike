<main>
    <h3>Destinations in Finland</h3>
    <!-- API key Google Maps Javascript API:in: AIzaSyDXvGjS2pVvCg1fac8IjYXnyFob7FUqoMs -->

    <div id="testContainer"></div>
    <div id="map"></div>
    <script>
        /*
        function reqListener () {
            console.log(this.responseText);
        }

        var oReq = new XMLHttpRequest(); //New request object
        oReq.onload = function() {
            //This is where you handle what to do with the response.
            //The actual data is found on this.responseText

            //var withoutQuotes = this.response.replace( /"/g, "");
            //var positionArray = withoutQuotes.split(" ");
            //position = { lat: parseFloat( positionArray[1] ), lng: parseFloat( positionArray[0] ) };

            // Laita position initMap-funktioon.
            // Kokeile koordinaattien tulostamista XAMPP:ssa niin ei tule bad gateway -virheilmoitusta.
        };

        oReq.open("get", "php/destination/destination_functions.php", true);
        //                                                              ^ Don't block the rest of the execution.
        //                                                              Don't wait until the request finishes to
        //                                                              continue.

        oReq.send();

        */
        function initMap() {
            var finland = {lat: 64.6479041, lng: 17.1438697};
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 5,
                center: finland
            });
            var infoWindow = new google.maps.InfoWindow;

            // Laita näiden kahden rivin tilalle AJAX-kutsu
            // https://developers.google.com/maps/documentation/javascript/mysql-to-maps
            var xmlContent = '<?php echo require 'php/destination/generate_marker_xml.php' ?>';
            xmlContent = xmlContent.slice( 0, -1 );

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

                //var text = document.createElement('text');
                //text.textContent = address;
                //infowincontent.appendChild(text);
                var icon = customLabel[type] || {};
                var marker = new google.maps.Marker({
                    map: map,
                    position: center,
                    label: icon.label
                });

                marker.addListener('click', function () {
                    infoWindow.setContent(infowincontent);
                    infoWindow.open(map, marker);
                });
            });

            // Alueiden (tässä Nuuksion (vai oliko Oulangan?) kansallispuiston tapauksessa tietokannasta haetaan vain
            // polygonin uloimmat koordinaatit. Ne pitäisi saada seuraavan Googlen esimerkin paths-kohtaan:
            // (Koko esimerkki: https://developers.google.com/maps/documentation/javascript/shapes#polygons)
            // var bermudaTriangle = new google.maps.Polygon({
            //     paths: [outerCoords, innerCoords],
            //     strokeColor: '#FFC107',
            //     strokeOpacity: 0.8,
            //     strokeWeight: 2,
            //     fillColor: '#FFC107',
            //     fillOpacity: 0.35
            //});
            // Koordinaatit ovat tietokannassa lisäksi väärin päin (ekana lng).

        }
    </script>

    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXvGjS2pVvCg1fac8IjYXnyFob7FUqoMs&callback=initMap">
    </script>
    <h2><a href="?page=destination&destinationid=404">Kohdesivut/Ahmalampi</a></h2>
</main>

