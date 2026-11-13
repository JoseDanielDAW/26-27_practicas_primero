<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

// Declaración de variables

// Crear una cadena de varias líneas
$cadena = <<<'TEXTO'
<html>
<p>
123
45
correo@gmail.com
josedaniel@gmail.com
</p>
<div>
5346
</div>
TEXTO;

    // Expresiones regulares
    $etiqueta = '/<[^>]+>/';
    $numero = '/[0-9]+/';
    $email = '/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/';

    $datos = ["cadena"=>$cadena,"etiqueta"=>$etiqueta,"numero"=>$numero,"email"=>$email];

$usuario = getenv("MYSQL_USER");

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION");
cuerpo($datos);  //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera()
{
?>

<?php


}

//vista
function cuerpo($datos)
{
?>

    <nav class="barra-ubicacion">
        <a href="../../index.php">Inicio</a>
        <span>&gt;</span>
        <a href="index.php">Relación 2</a>
        <span>&gt;</span>
        <span>Ejercicio 5</span>
    </nav>

<?php

    // Imprimir funcion en la vista
    buscarExpR($datos);
}

function buscarExpR($datos) {

    // Buscar etiquetas HTML
    echo "Etiquetas HTML:<br>";

    if (preg_match($datos["etiqueta"], $datos["cadena"], $coincidencia, PREG_OFFSET_CAPTURE)) {
        echo "Elemento encontrado: " . $coincidencia[0][0] . "<br>";
        echo "Posición: " . $coincidencia[0][1] . "<br>";
    }

    echo "<br>";

    // Buscar números
    echo "Números:<br>";

    if (preg_match($datos["numero"], $datos["cadena"], $coincidencia, PREG_OFFSET_CAPTURE)) {
        echo "Elemento encontrado: " . $coincidencia[0][0] . "<br>";
        echo "Posición: " . $coincidencia[0][1] . "<br>";
    }

    echo "<br>";

    // Buscar direcciones de correo electrónico
    echo "Correos electrónicos:<br>";

    if (preg_match($datos["email"], $datos["cadena"], $coincidencia, PREG_OFFSET_CAPTURE)) {
        echo "Elemento encontrado: " . $coincidencia[0][0] . "<br>";
        echo "Posición: " . $coincidencia[0][1] . "<br>";
    }
}