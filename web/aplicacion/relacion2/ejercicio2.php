<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

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
        <a href="index.php">Relación 2</a>
        <span>&gt;</span>
        <span>Ejercicio 2</span>
    </nav>

<?php

    $cadena = "Está la niña en casa";
    $var = "";

    // forma no válida muestra la ñ y la a con tilde en interrogación
    for ($i = 0; $i < strlen($cadena); $i++) {
        for ($j = 0; $j < $i; $j++) {
            echo "&nbsp";
        }
        $var = $cadena[$i] . "<br>";
        echo $var;
    }

    echo "<br>";

    // forma no válida muestra la ñ y la a con tilde en interrogación
    for ($i = 0; $i < strlen($cadena); $i++) {
        for ($j = 0; $j < $i; $j++) {
            echo "&nbsp";
        }
        echo substr($cadena, $i, 1) . "<br>";
    }

    echo "<br>";

    for ($i = 0; $i < strlen($cadena); $i++) {
        for ($j = 0; $j < $i; $j++) {
            echo "&nbsp";
        }
        echo mb_substr($cadena, $i, 1,"UTF-8") . "<br>";
    }
}
