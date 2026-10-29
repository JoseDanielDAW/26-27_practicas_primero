<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();

inicioCuerpo("2DAW APLICACION");
cuerpo(); // Llamo a la vista y le paso los datos
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
        <a href="index.php">Relación 4</a>
        <span>&gt;</span>
        <span>Ejercicios:</span>
    </nav>

<?php

    


}