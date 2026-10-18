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
        <span>Ejercicio 1</span>
    </nav>

<?php

    // Como es corto lo he hecho en la vista directamente
    $var = "cadena";

    $texto = <<<fin
        Esta es una cadena 
    fin;

    $var = <<<'fin'
        Esta es otra cadena 
    fin;

    echo $texto;
    echo "<br>";
    echo $var;
}
