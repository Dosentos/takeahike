<?php

function dbConnect(){
    if(!isset($mysqli)){
        $config = parse_ini_file_quotes_safe("../../db.ini");
        $mysqli = new mysqli($config['addr'], $config['user'], $config['pass'], $config['db']);
    }

    if ($mysqli->connect_error) {
        die( "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
    }

    return $mysqli;
}

// Tällä funktiolla luetaan .ini tiedostojen sisältö
function parse_ini_file_quotes_safe($f)
{
    $r=null;
    $sec=null;
    $f=@file($f);
    for ($i=0;$i<@count($f);$i++)
    {
        $newsec=0;
        $w=@trim($f[$i]);
        if ($w)
        {
            if ((!$r) or ($sec))
            {
                if ((@substr($w,0,1)=="[") and (@substr($w,-1,1))=="]") {$sec=@substr($w,1,@strlen($w)-2);$newsec=1;}
            }
            if (!$newsec)
            {
                $w=@explode("=",$w);$k=@trim($w[0]);unset($w[0]); $v=@trim(@implode("=",$w));
                if ((@substr($v,0,1)=="\"") and (@substr($v,-1,1)=="\"")) {$v=@substr($v,1,@strlen($v)-2);}
                if ($sec) {$r[$sec][$k]=$v;} else {$r[$k]=$v;}
            }
        }
    }
    return $r;
}

?>