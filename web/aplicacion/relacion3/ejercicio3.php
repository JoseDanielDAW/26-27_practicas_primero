<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once("libreria.php");

// Controlador

// Dibujo la plantilla de la vista
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
        <span>Ejercicio 3</span>
    </nav>

<?php

// Llamo a la función operaciones indicando el tipo de operación y los números
// En la primera llamada utilizo el tipo de operación 1
echo operaciones(1, 1, 2, 3, 4);

echo "<br>";

// En la segunda llamada utilizo el tipo de operación 4
echo operaciones(4, 1, 2, 3, 4);

}