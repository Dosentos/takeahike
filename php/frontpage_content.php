<main>
    <h3>Destinations in Finland</h3>
    <!-- API key Google Maps Javascript API:in: AIzaSyDXvGjS2pVvCg1fac8IjYXnyFob7FUqoMs -->

    <div id="testContainer"></div>
    <div id="map"></div>
    <script>
        var position;

        function reqListener () {
            console.log(this.responseText);
        }

        var oReq = new XMLHttpRequest(); //New request object
        oReq.onload = function() {
            //This is where you handle what to do with the response.
            //The actual data is found on this.responseText

            //this.response.forEach( function( destination ) {
            //    var containerText = document.getElementById("testContainer");
            //    document.getElementById("testContainer").innerHTML = containerText + destination;
            //});
            var positionArray = this.response.split(" ");
            position = { lat: parseInt( positionArray[1] ), lng: parseInt( positionArray[0] ) };

            //document.getElementById("testContainer").innerHTML = position;
            // Laita position initMap-funktioon.
            // Kokeile koordinaattien tulostamista XAMPP:ssa niin ei tule bad gateway -virheilmoitusta.
        };

        oReq.open("get", "php/destination/destination_functions.php", true);
        //                                                              ^ Don't block the rest of the execution.
        //                                                              Don't wait until the request finishes to
        //                                                              continue.

        oReq.send();

        function initMap() {
            var finland = {lat: 64.6479041, lng: 17.1438697};
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 5,
                center: finland
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

            var marker = new google.maps.Marker({
                // Tietokannasta haetaan alueen keskikoordinaatit. Koordinaatit pitää vielä muuntaa niin, että ne
                // kelpaavat seuraavaan:
                // new google.maps.LatLng(-33.863276, 151.207977)
                position: position,
                map: map,
                title: "Testi"
            });

            var infowindow = new google.maps.InfoWindow({
                content: '<div class="infowindowContent">' +
                'Testi' +
                '</div>'
            });

            marker.addListener('click', function() {
                infowindow.open(map, marker);
            });

            /*
             var position = {lat: 63.363, lng: 28.044};
             var heading =
                 '<div class="infowindowContent">' +
                 'Nuuksion kansallispuisto' +
                 '</div>';
             */
        }
    </script>

    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXvGjS2pVvCg1fac8IjYXnyFob7FUqoMs&callback=initMap">
    </script>
</main>

