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
        <a href="index.php">Relación 2</a>
        <span>&gt;</span>
        <span>Ejercicio 4</span>
    </nav>

<?php

    // He hecho el ejercicio en la vista directamente porque es muy corto

    $numero1 = 17.5;
    $numero2 = 379987.24;

    // Primer valorr (relleno con 0)
    $valor1 = number_format($numero1, 1, ',', '');
    $valor1 = str_pad($valor1, 15, '0', STR_PAD_LEFT);

    // Segundo valor (con espacios)
    $valor2 = number_format($numero2, 2, ',', '.');
    $valor2 = str_pad($valor2, 15, ' ', STR_PAD_LEFT);

    echo "el primer valor -" . $valor1 . "-, el segundo valor -" . $valor2 . "-";
}
