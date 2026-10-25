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

// Función para mostrar la cabecera de la página
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
        <span>Ejercicio 4</span>
    </nav>

<?php

echo "<br>";

// Llamo a la función pasando los tres números
echo devuelve(5, 4, 3);

echo "<br>";

// Llamo a la función pasando solamente el primer número
// Los otros dos utilizan sus valores por defecto
echo devuelve(5);

echo "<br>";

// Paso el primer y el segundo número
// El tercer número utiliza su valor por defecto
echo devuelve(5, 4);

echo "<br>";

// Paso el primer y el tercer número
// El segundo número recibe el valor 3
echo devuelve(5, 3);
}