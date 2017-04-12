<?php
/**
 * Created by PhpStorm.
 * User: Dosentti
 * Date: 10.4.2017
 * Time: 14.32
 */

$content = [
    ["privilege"=>0, "name"=>"Front page", "id"=>"frontpage", "include"=>"php/frontpage_content.php"],
    ["privilege"=>0, "name"=>"Inspire", "id"=>"inspire", "include"=>"php/inspire_content.php"],
    ["privilege"=>0, "name"=>"About Hiking", "id"=>"hiking", "include"=>"php/hiking_content.php"],
    ["privilege"=>0, "name"=>"Info", "id"=>"about", "include"=>"php/info_content.php"],
    ["privilege"=>0, "name"=>"", "id"=>"destination", "include"=>"php/destination_content.php"],
    ["privilege"=>1, "name"=>"My Page", "id"=>"mypage", "include"=>"php/mypage_content.php"],
    ["privilege"=>2, "name"=>"", "id"=>"admin", "include"=>"php/admin_content.php"]
];
/*
Privilege määrittelee kuka näkee sivun:
    0 = Kuka tahansa
    1 = Kirjautuneet
    2 = Admin

Name on sivun nimi.
    Jos sivu on olemassa, mutta sitä vastaavaa linkkiä ei tule navigaatioon, sen nimeksi tulee "".
    Tällöin sivu ohitetaan navigaatiota kootessa.

ID on GET parametri, joka tulee osoiteriville ja käytetään myös index.php -tiedostossa sivun valintaan.
Include on includattava osa, jota tarvitaan index.php-tiedostossa
*/

//Tällä funktiolla tarkastetaan käyttäjän syötteet.
//Metodi palauttaa true, mikäli syöte on ok. Muussa tapauksessa false.
//TOIMINTA TÄYTYY TESTATA!!!!
function checkInput($data){
    //Poistaa ylimääräiset välilyönnit
    $corrData = trim($data);
    //Poistaa kenoviivat
    $corrData = stripcslashes($data);
    //Poistaa html
    $corrData = htmlspecialchars($data);
    if($corrData === $data){
        return true;
    }
    else{return false;}
}