<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

function controladorArray()
{
    $vector = array();
    $vector[1] = "esto es una cadena";
    $vector["posi1"] = 25.67;
    $vector[] = false;
    $vector["ultima"] = array(2, 5, 96);
    $vector[56] = 23;

    return $vector;
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
        <span>Ejercicio 5</span>
    </nav>

<?php

    $vector = controladorArray();

    foreach ($vector as $i => $elem) {
        echo "<br> Posición: $i Valor: ";
        if (is_array($elem)) {
            foreach ($elem as $elem2) {
                $elem2;
            }
        } else if (is_integer($elem)) {
            echo "Entero con valor: " . $elem . " ,en binario: " . decbin($elem);
        } else if (is_float($elem)) {
            echo "Real: " . $elem . " al cuadrado: " . pow($elem, 2);
        } else if (is_string($elem)) {
            echo "-" . $elem . "-";
        } else if (is_bool($elem)) {
            echo $elem . " y su opuesto: " . !($elem);
        }
    }
}