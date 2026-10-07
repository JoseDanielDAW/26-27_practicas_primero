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
    
   return $miArray;
}

function arraysArray() {

    $miArray = array(
        1 => 67,
        16 => 69,
        54 => 88,
        34,
        "uno" => "cadena",
        "dos" => true,
        "tres" => 1.345,
        "ultima" => [1,34,"nueva"]
    );

    return $miArray;
}

function arraysCorchetes() {

    $miArray = [
        1 => 67,
        16 => 69,
        54 => 88,
        34,
        "uno" => "cadena",
        "dos" => true,
        "tres" => 1.345,
        "ultima" => [1,34,"nueva"]
    ];

    return $miArray;
}

function mostrarArray () {
     
    $cadena = "";
    $miArray = arrays();
    $miArrayArrays = arraysArray();
    $miArrayCorchetes = arraysCorchetes();
    
    foreach ($miArray as $elem) {
        if (is_array($elem))
           foreach ($elem as $dato) {
            $cadena .= $dato . "<br>";
        }

        else
            $cadena .= $elem . "<br>";
    }

    $cadena .= "<br>";

     foreach ($miArrayArrays as $elem) {
        if (is_array($elem))
           foreach ($elem as $dato) {
            $cadena .= $dato . "<br>";
        }

        else
            $cadena .= $elem . "<br>";
    }

    $cadena .= "<br>";

     foreach ($miArrayCorchetes as $elem) {
        if (is_array($elem))
           foreach ($elem as $dato) {
            $cadena .= $dato . "<br>";
        }

        else
            $cadena .= $elem . "<br>";
    }

    return $cadena;
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

    echo "<br>";
    echo mostrarArray();
   
}