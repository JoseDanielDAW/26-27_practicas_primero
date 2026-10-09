<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

const FILAS = 5;

function generarArray()
{
    
   $miArray = [];

    for ($i=0;$i<=FILAS;$i++) {
        for($j=0;$j<$i;$j++){
            $miArray[$i][$j] = $i;  
        }
    }

    return $miArray;
}

$usuario = getenv("MYSQL_USER");

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION");
cuerpo();  //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera()
{
?>

<?php


}

//vista
function cuerpo()
{
?>

    <nav class="barra-ubicacion">
        <a href="../../index.php">Inicio</a>
        <span>&gt;</span>
        <a href="index.php">Relación 1</a>
        <span>&gt;</span>
        <span>Ejercicio 4</span>
    </nav>

<?php

    $array = generarArray();

    foreach ($array as $elem) {
        echo "<br>";
        foreach ($elem as $elem2) {
            echo $elem2;
        }
    }
}
