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
    <meta charset="UTF-8">
    <title>Take a hike</title>

    <!-- Foundation CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.3.1/css/foundation.min.css" integrity="sha256-itWEYdFWzZPBG78bJOOiQIn06QCgN/F0wMDcC4nOhxY=" crossorigin="anonymous" />
    <!-- Take a Hike CSS -->
    <link rel="stylesheet" href="css/main.css" type="text/css" />

    <!-- Foundation JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.3.1/js/foundation.min.js" integrity="sha256-Nd2xznOkrE9HkrAMi4xWy/hXkQraXioBg9iYsBrcFrs=" crossorigin="anonymous"></script>
    <!-- React -->
    <script src="https://unpkg.com/react@15/dist/react.min.js"></script>
    <!-- React-DOM -->
    <script src="https://unpkg.com/react-dom@15/dist/react-dom.min.js"></script>
    <!-- Babel -->
    <script src="https://unpkg.com/babel-standalone@6/babel.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

</head>
<body>
    <header>
        <h1> This is header</h1>
        <nav>
            <?php
            foreach ($content as $i => $page){
                if($page["name"]!="" ){
                    $active = "";
                    if(isset($_GET['page'])  && $_GET['page'] == $page["id"]){
                        $active = "active";
                    }
                    echo "<a class='$active' href='?page=$page[id]'>$page[name]</a>";
                }
            }
            ?>
        </nav>
    </header>
