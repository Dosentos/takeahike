<?php
/**
 * Created by PhpStorm.
 * User: Dosentti
 * Date: 10.4.2017
 * Time: 14.38
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Take a hike</title>


    <!--Älkää antanko phpstormin erroreiden hämätä. Nämä luetaan index.php:ssa, joten ne toimii kuten pitää vaikka tää näyttääkin erroria-->
    <!-- Foundation CSS-->
    <link rel="stylesheet" href="css/app.css" />
    <!-- Take a Hike CSS -->
    <link rel="stylesheet" href="scss/main.css" type="text/css" />

    <!-- Open Sans Font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" />
    <!-- Roboto Font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" />

    <!-- Font Awesome ICONS -->
    <script src="https://use.fontawesome.com/c37903bf0f.js"></script>

    <!-- React -->
    <script src="https://unpkg.com/react@15/dist/react.min.js"></script>
    <!-- React-DOM -->
    <script src="https://unpkg.com/react-dom@15/dist/react-dom.min.js"></script>
    <!-- Babel -->
    <script src="https://unpkg.com/babel-standalone@6/babel.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="bower_components/jquery/dist/jquery.js"></script>
    <script src="bower_components/what-input/dist/what-input.js"></script>
    <script src="bower_components/foundation-sites/dist/js/foundation.js"></script>
    <script src="js/app.js"></script>
</head>
<body>
<header>
    <div class="row">
        <div class="small-3 columns">
            <span class="fa fa-bars fa-fw" id="hamburger" onClick="toggleNav();"></span>
        </div>
        <div id="logo" class="small-9 columns">
            <a href="?page=frontpage"><img src="pics/tah_logo.png" alt="Take a Hike logo" /></a>
        </div>
        <!--
        <nav class="small-12 medium-8 x-large columns">
            <?php
        /*
                  foreach ($content as $i => $page){
                      if($page["name"]!="" ){
                          $active = "";
                          if(isset($_GET['page'])  && $_GET['page'] == $page["id"]){
                              $active = "active";
                          }
                          echo "<div class='nav-borders'><a class='$active' href='?page=$page[id]'>$page[name]</a></div>";
                      }
                  }
      */
        ?>
        </nav>
  -->
    </div>
            <?php
            foreach ($content as $i => $page){
                if($page["name"]!="" ){
                    $active = "";
                    if(isset($_GET['page'])  && $_GET['page'] == $page["id"]){
                        $active = "active";
                    }
                    echo "<div class=\"row\"><div class=\"small-12 columns mobile-nav\"><a class='$active' href='?page=$page[id]'>$page[name]</a></div></div>";
                }
            }


            ?>
</header>

