<?php
require "php/database/database_connection.php";
require "php/database/check_query_result.php";

//$locationFilterValues = $_GET[]

function parseToXML($htmlStr) {
    $xmlStr=str_replace('<','&lt;',$htmlStr);
    $xmlStr=str_replace('>','&gt;',$xmlStr);
    $xmlStr=str_replace('"','&quot;',$xmlStr);
    $xmlStr=str_replace("'",'&#39;',$xmlStr);
    $xmlStr=str_replace("&",'&amp;',$xmlStr);
    return $xmlStr;
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

function getDestinationAreaData() {
    $mysqli = dbConnect();
    /*$areaQuery = 'SELECT destination.id, destination.name, destination.location, AsText(destination.center) AS center,
                    AsText(polygon.coordinates) AS coordinates FROM destination
                    INNER JOIN polygon ON polygon.destination_id=destination.id
                    WHERE outer_border=TRUE AND polygon.destination_id=853 LIMIT 5;';*/
    $areaQuery = 'SELECT destination.id, destination.name, AsText(destination.center) AS center
                  FROM destination;';
    $destinationAreaResult = mysqli_query($mysqli, $areaQuery);

    if(!checkQueryResult($destinationAreaResult)){
        echo'No query result on areaQuery';
    } else {
        return $destinationAreaResult;
    }
}

function generateMarkerXML() {
    if( file_exists( 'xml/markers.xml' ) ) {
        unlink( 'xml/markers.xml' );
    }

    // Start XML file, write parent node to file
    $xmlFile = fopen("xml/markers.xml", "a") or die("Unable to open file!");
    fwrite( $xmlFile, '<?xml version="1.0" encoding="UTF-8" standalone="no" ?>' . "\n" );
    fwrite( $xmlFile, '<markers>' . "\n" );

    // Iterate through the rows, writing XML nodes for each
    $destinationAreaData = getDestinationAreaData();
    while ( $row = $destinationAreaData->fetch_assoc() ) {
        // Add to XML document node
        fwrite( $xmlFile, "\t" . '<marker ' );
        fwrite( $xmlFile, 'id="' . $row['id'] . '" ' );
        fwrite( $xmlFile, 'name="' . utf8_encode( parseToXML( $row['name'] ) ) . '" ' );
        fwrite( $xmlFile, 'center="' . parseToXML( removeChars( $row['center'] ) ) . '" ' );
        fwrite( $xmlFile, '/>' . "\n" );
    }

    // End XML file
    fwrite( $xmlFile, '</markers>' );
    fclose( $xmlFile );
}

generateMarkerXML();

?>