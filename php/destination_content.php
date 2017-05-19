<?php
/**
 * Created by PhpStorm.
 * User: Dosentti
 * Date: 11.4.2017
 * Time: 14.41
 */
require('database/database_connection.php');
require('database/check_query_result.php');
$mysqli = dbConnect();
$query = "SELECT destination.id, xml_functions.name, xml_functions.country, polygon.coordinates FROM xml_functions INNER JOIN polygon ON polygon.destination_id = xml_functions.id WHERE polygon.destination_id=". $_GET['destinationid'] .";";
$result = mysqli_query($mysqli, $query);
checkQueryResult($result);

//while ()

?>
<main>
<div id="destination-heading"></div>

<script type="text/babel" src="js/destination_heading.js"></script>
</main>