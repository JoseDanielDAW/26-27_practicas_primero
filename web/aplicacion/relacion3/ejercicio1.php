<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once("libreria.php");

// Controlador

// Creo un array vacío y una variable para guardar el número de llamadas
$vector = array();
$numero = 0;

// Llamo a la función para añadir elementos al array
cuentaVeces($vector, "1osición", 7, $numero);
cuentaVeces($vector, "otra", 2, $numero);

inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION");
cuerpo($vector, $numero); // Llamo a la vista y le paso los datos
finCuerpo();

// Vista

function cabecera()
{
?>

<?php
}

// Función que muestra el contenido de la página
function cuerpo(array $vector, int $numero)
{
?>

    <nav class="barra-ubicacion">
        <a href="../../index.php">Inicio</a>
        <span>&gt;</span>
        <a href="index.php">Relación 3</a>
        <span>&gt;</span>
        <span>Ejercicio 1</span>
    </nav>

<?php

// Dejo un salto de línea para separar el contenido
echo "<br>";

// Recorro el array para mostrar el índice y el elemento que contiene
foreach ($vector as $i => $elem) {
    echo "Índice: " . $i . " Elemento: " . $elem . "<br>";
}

// Muestro cuántas veces se ha llamado correctamente a la función
echo "Número de veces que se llama a la función: " . $numero;
}