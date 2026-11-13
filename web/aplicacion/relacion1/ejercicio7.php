<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

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
        <span>Ejercicio 7</span>
    </nav>

<?php

echo "<br>";
echo date("d/m/Y", time());
echo "<br>";
echo date("l d, F Y, z", time());
echo "<br>";
echo date("H:i:s", time());

echo "<br><br>";

$fechaActual = new DateTime();
echo $fechaActual->format("d/m/Y");
echo "<br>";
echo $fechaActual->format("l d, F Y, z");
echo "<br>";
echo $fechaActual->format("H:i:s");

echo "<br><br>";

$fechaFija = new DateTime("2024-03-29 12:45:00");
echo $fechaFija->format("d/m/Y");
echo "<br>";
echo $fechaFija->format("l d, F Y, z");
echo "<br>";
echo $fechaFija->format("H:i:s");

echo "<br><br>";

$fechaModificada = new DateTime();
$fechaModificada->modify("-12 days -4 hours");
echo $fechaModificada->format("d/m/Y");
echo "<br>";
echo $fechaModificada->format("l d, F Y, z");
echo "<br>";
echo $fechaModificada->format("H:i:s");

}
