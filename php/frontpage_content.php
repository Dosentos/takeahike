<?php
/**
 * Created by PhpStorm.
 * User: Dosentti
 * Date: 10.4.2017
 * Time: 16.12
 */
?>

<main>
    <h3>Destinations in Finland</h3>
    <!-- API key Google Maps Javascript API:in: AIzaSyDXvGjS2pVvCg1fac8IjYXnyFob7FUqoMs -->

    <div id="map"></div>
    <script>
        function initMap() {
            var finland = {lat: 64.6479041, lng: 17.1438697};
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 5,
                center: finland
            });

            var markerOne = new google.maps.Marker({
                position: {lat: 63.363, lng: 28.044},
                map: map,
                title: 'Marker 1'
            });

            var markerTwo = new google.maps.Marker({
                position: {lat: 65.363, lng: 26.044},
                map: map,
                title: 'Marker 2'
            });

            var headingOne =
                '<div class="infowindowContent">' +
                    'Nuuksion kansallispuisto' +
                '</div>';

            var infowindowOne = new google.maps.InfoWindow({
                content: headingOne
            });

            var headingTwo = "Oulangan kansallispuisto";

            var infowindowTwo = new google.maps.InfoWindow({
                content: headingTwo
            });

            markerOne.addListener('click', function() {
                infowindowOne.open(map, markerOne);
            });

            markerTwo.addListener('click', function() {
                infowindowTwo.open(map, markerTwo);
            });
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXvGjS2pVvCg1fac8IjYXnyFob7FUqoMs&callback=initMap">
    </script>
</main>

