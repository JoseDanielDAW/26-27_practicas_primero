<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

function controladorArray()
{
    $vector = array("primera" => 12.56, 24 => true, 67 => 23.76);

    return $vector;
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
        <span>Ejercicio 6</span>
    </nav>

<?php
    echo "<br>";

    $vector = controladorArray();

    foreach ($vector as $i => $elem) {
        echo " Índice: " . $i . " Valor: " . $elem . "<br>";
    }

    echo "<br>";

    $keys = array_keys($vector);
    $valor = array_values($vector);

    for ($i = 0; $i < count($vector); $i++) {
        echo " Índice: " . $keys[$i] . " Valor: " . $valor[$i] . "<br>";
    }
}
