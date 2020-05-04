<?php
include "polacz.php";
$pesel = wczytaj("pesel");

$sql = $baza->prepare("INSERT INTO pesele (ID, pesel) VALUES (NULL, ?);");
if ($sql)
{
        $sql->bind_param("s", $pesel);
        $sql->execute();
        $sql->close();
}
else
    die( 'Błąd: '. $baza->error);
$baza->close();
?>