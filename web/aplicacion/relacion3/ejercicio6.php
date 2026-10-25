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
        <span>Ejercicio 6</span>
    </nav>

<?php

// Paso una función flecha que suma los dos números
echo llamadaAFuncion(2, 2, fn($a, $b) => $a + $b);

echo "<br>";

// Paso una función flecha que resta los dos números
echo llamadaAFuncion(2, 2, fn($a, $b) => $a - $b);

echo "<br>";

// Paso una función flecha que multiplica los dos números
echo llamadaAFuncion(2, 2, fn($a, $b) => $a * $b);

echo "<br>";

// Creo una función anónima para sumar los dos números
$fn1 = function($a, $b) {
    return $a + $b;
};

// Creo una función anónima para restar los dos números
$fn2 = function($a, $b) {
    return $a - $b;
};

// Creo una función anónima para multiplicar los dos números
$fn3 = function($a, $b) {
    return $a * $b;
};

// Llamo a la función pasando la función de suma como parámetro
echo llamadaAFuncion(2, 2, $fn1);

echo "<br>";

// Llamo a la función pasando la función de resta como parámetro
echo llamadaAFuncion(2, 2, $fn2);

echo "<br>";

// Llamo a la función pasando la función de multiplicación como parámetro
echo llamadaAFuncion(2, 2, $fn3);
}