<?php
require "php/database/database_connection.php";
require "php/database/check_query_result.php";

function parseToXML($htmlStr) {
    $xmlStr=str_replace('<','&lt;',$htmlStr);
    $xmlStr=str_replace('>','&gt;',$xmlStr);
    $xmlStr=str_replace('"','&quot;',$xmlStr);
    $xmlStr=str_replace("'",'&#39;',$xmlStr);
    $xmlStr=str_replace("&",'&amp;',$xmlStr);
    return $xmlStr;
}

function getDestinationAreaData() {
    $mysqli = dbConnect();
    $areaQuery = 'SELECT destination.id, destination.name, destination.location, AsText(destination.center) AS center,
                    AsText(polygon.coordinates) AS coordinates FROM destination
                    INNER JOIN polygon ON polygon.destination_id=destination.id
                    WHERE outer_border=TRUE AND polygon.destination_id=853 LIMIT 5;';
    $destinationAreaResult = mysqli_query($mysqli, $areaQuery);

    if(!checkQueryResult($destinationAreaResult)){
        echo'No query result on areaQuery';
    } else {
        return $destinationAreaResult;
    }
}

function generateMarkerXML() {
    //header("Content-type: text/xml");

    // Start XML file, echo parent node
    echo '<markers>';

    // Iterate through the rows, printing XML nodes for each
    $destinationAreaData = getDestinationAreaData();
    while ( $row = $destinationAreaData->fetch_assoc() ) {
        // Add to XML document node
        echo '<marker ';
        echo 'id="' . $row['id'] . '" ';
        echo 'name="' . parseToXML( $row['name'] ) . '" ';
        echo 'location="' . parseToXML( $row['location'] ) . '" ';
        echo 'center="' . parseToXML( $row['center'] ) . '" ';
        echo '/>';
    }

    // End XML file
    echo '</markers>';
}

generateMarkerXML();

?>