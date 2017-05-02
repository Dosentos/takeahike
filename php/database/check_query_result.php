<?php

function checkQueryResult($result){
    if(!$result){
        echo '<br>*****************<br>ERROR, NO CONTENT IN QUERY RESULTS<br>*****************<br>';
    return false;
    }

    return true;
}

?>