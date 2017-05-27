/*globals $*/

$(document).ready(function() {
    // https://api.jquery.com/jquery.get/
    // Tähän koodia, jolla saa valittujen sijaintifiltterien perusteella oikeat markkerit kartalle.
    var inputValues = {};
    $( ".locationFilter:checkbox:checked" ).each( function( index ) {
        inputValues[ index.$( this ).val() ];
    });
    alert( inputValues );
    //$.get( "generate_marker_xml.php", inputValues );
});