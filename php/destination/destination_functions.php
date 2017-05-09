<?php

require '../database/database_connection.php';
require '../database/check_query_result.php';
require 'destination.php';

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

//Tällä funktiolla poistetaan turhat merkit stringin alusta ja lopusta
function removeChars($coordString) {
    $resultString = '';
    if(strpos($coordString, 'POLYGON')!== false){
        $resultString = substr($coordString, 0, -2);
        $resultString = substr($resultString, 9);
    }
    else if(strpos($coordString, 'LINESTRING')!== false){
        $resultString = substr($coordString, 0, -1);
        $resultString = substr($resultString, 11);
    }
    else if(strpos($coordString, 'POINT')!== false){
        $resultString = substr($coordString, 0, -1);
        $resultString = substr($resultString, 6);
    }

    if($coordString === $resultString){
        return 'ERROR: There was no POLYGON OR LINESTRING OR POINT in the string at removeChars function';
    }
    return $resultString;
}

function convertCoordinates($coordString) {
    return $coordString;
}

function buildDestinations($destinationAreaResult) {
    /*
    $destinationArray = [];

    while( $destinationArea = $destinationAreaResult->fetch_assoc() ) {
        $destinationArray[] = new Destination( $destinationArea['name'],
                                                $destinationArea['center'],
                                                $destinationArea['coordinates'],
                                                $destinationArea['location'] );
    }
    return $destinationArray;
    */
    $destinationArray = [];
    $destinationsArray = [];
    $i = 0;
    while( $destinationArea = $destinationAreaResult->fetch_assoc() ) {
        $destinationArray += [ 0 => $destinationArea['name'] ];
        $destinationArray += [ 1 => removeChars( $destinationArea['center'] ) ];
        $destinationArray += [ 2 => removeChars( $destinationArea['coordinates'] ) ];
        $destinationArray += [ 3 => $destinationArea['location'] ];

        $destinationsArray += [ $i => $destinationArray ];
        $destinationArray = [];
        $i++;
    }
    return $destinationsArray;
}

$destinationsArray = buildDestinations( getDestinationAreaData() ) ;
//echo $destinationsArray;
echo json_encode( $destinationsArray[0][1] ); //echoaa keskipisteen
//echo json_encode(42);

?>