<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once("libreria.php");
//controlador

// Variables
$vector = array();
$numero = 0;
cuentaVeces($vector, "1osición", 7, $numero);
cuentaVeces($vector, "otra", 2, $numero);

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION");
cuerpo($vector,$numero);  //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera()
{
?>

<?php


}

//vista
function cuerpo(array $vector,int $numero)
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

echo "<br>";

// Recorrer el array y mostrar datos
    foreach ($vector as $i => $elem) {
        echo  "Índice: ". $i . " Elemento: ". $elem . "<br>";
    }

// Mostrar el número de veces que se llama a la función
    echo "Número de veces que se llama a la función: ".$numero;
}
