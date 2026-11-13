<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once("libreria.php");

// Controlador

inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION");
cuerpo(); 
finCuerpo();

// Vista

function cabecera()
{
?>

<?php
}

function cuerpo()
{
?>

    <nav class="barra-ubicacion">
        <a href="../../index.php">Inicio</a>
        <span>&gt;</span>
        <a href="index.php">Relación 3</a>
        <span>&gt;</span>
        <span>Ejercicio 7</span>
    </nav>

<?php

echo "<br>";

// Creo un array con varias palabras de distinta longitud
$vector = array("uno", "grande", "caminos", "a");

// Llamo a la función para ordenar las palabras del array
ordenar($vector);

// Recorro el array y muestro cada palabra en una línea
foreach ($vector as $i) {
    echo $i . "<br>";
}

}