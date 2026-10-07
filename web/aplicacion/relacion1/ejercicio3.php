<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

function arrays () {
    $miArray = [];
    $miArray[1] = 67;
    $miArray[16] = 69;
    $miArray[54] = 88;
    $miArray[] = 34;

    $arrayRelleno = [1,34,"nueva"];

    $miArray["uno"] = "cadena";
    $miArray["dos"] = true;
    $miArray["tres"] = 1.345;   
    $miArray[] = $arrayRelleno;
    
    foreach($miArray as $elem) {
        if (is_array($elem)) {
            foreach ($elem as $dato) {
                echo $dato . "<br>";
            }
        }
        else {
            echo $elem . "\n";
        }
    }
}

$usuario = getenv("MYSQL_USER");

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION");
cuerpo();  //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera()
{
?>

<?php


}

//vista
function cuerpo()
{
?>

    <nav class="barra-ubicacion">
    <a href="../../index.php">Inicio</a>
    <span>&gt;</span>
    <a href="index.php">Relación 1</a>
    <span>&gt;</span>
    <span>Ejercicio 3</span>
    </nav>

<?php

    arrays();
   
}