<?php
function wczytaj($zmienna)
{
           if (!isset($_GET[$zmienna]) || $_GET[$zmienna]=="")
                die( "Blad! brak zmiennej: ".$zmienna ); // nie podano marki w $
           return $_GET[$zmienna];
}

$baza = new  mysqli("localhost", "root", "", "pesele");
if (mysqli_connect_errno())  die( "Blad: ".mysqli_connect_error() );
$baza->set_charset("utf8");
?>