<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once("libreria.php");

// Controlador

inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION");
cuerpo(); // Llamo a la vista
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
        <span>Ejercicio 5</span>
    </nav>

<?php

echo "<br>";

// Muestro el resultado de sumar dos números
echo suma(4, 3);

echo "<br>";

// Muestro el resultado de restar dos números
echo resta(5, 4);

echo "<br>";

// Muestro el resultado de multiplicar dos números
echo multiplicacion(5, 5);

echo "<br>";

// Llamo a hacerOperacion indicando que quiero realizar una suma
echo hacerOperacion("suma", 5, 5);
}