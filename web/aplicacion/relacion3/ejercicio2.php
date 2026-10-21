<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once("libreria.php");
//controlador
// Variables
$numero = 5;

$usuario = getenv("MYSQL_USER");

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION");
cuerpo($numero);  //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera()
{
?>

<?php


}

//vista
function cuerpo(int $numero)
{
?>

    <nav class="barra-ubicacion">
        <a href="../../index.php">Inicio</a>
        <span>&gt;</span>
        <a href="index.php">Relación 3</a>
        <span>&gt;</span>
        <span>Ejercicio 2</span>
    </nav>

<?php

// Generar cadena aleatoria con variable $numero
echo generarCadenas($numero);

echo "<br>";

// Generar cadena aleatoria por defecto(10)
echo generarCadenas();
}
