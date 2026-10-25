<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once("libreria.php");

// Controlador

// Guardo el número que voy a utilizar para generar la cadena
$numero = 5;

inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION");
cuerpo($numero); 
finCuerpo();

// Vista

// Función para mostrar la cabecera de la página
function cabecera()
{
?>

<?php
}

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

// Genero una cadena aleatoria con la longitud que he indicado
echo generarCadenas($numero);

echo "<br>";

// Genero otra cadena aleatoria utilizando la longitud por defecto, que es 10
echo generarCadenas();
}