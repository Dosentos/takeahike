<main>
    <h3>Destinations in Finland</h3>
    <!-- API key Google Maps Javascript API:in: AIzaSyDXvGjS2pVvCg1fac8IjYXnyFob7FUqoMs -->

    <div id="testContainer"></div>
    <div id="map"></div>
    <script>
        var position = {lat: 64.6479041, lng: 17.1438697};
        var xmlContent = '<?php echo require 'php/destination/generate_marker_xml.php' ?>';
        alert( xmlContent.slice( 0, -1 ) );

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
    <!--
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXvGjS2pVvCg1fac8IjYXnyFob7FUqoMs&callback=initMap">
    </script>
    <h2><a href="?page=destination&destinationid=404">Kohdesivut/Ahmalampi</a></h2>
    -->
</main>

