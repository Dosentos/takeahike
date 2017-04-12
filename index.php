<?php
/**
 * Created by PhpStorm.
 * User: Dosentti
 * Date: 10.4.2017
 * Time: 14.31
 */
require_once('config.php');

include('php/header.php');

if(isset($_GET['page'])){
    $found = false;
    foreach ($content as $page){
        if($_GET['page']=== $page['id']){
            $found = true;
            include($page['include']);
        }
    }
    if (!$found){
        include('php/error/404.php');
    }
}
else {
    include('php/frontpage_content.php');
}
include('php/footer.php');
?>
