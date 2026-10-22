<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once("libreria.php");
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
        <a href="index.php">Relación 3</a>
        <span>&gt;</span>
        <span>Ejercicio 6</span>
    </nav>

<?php

    echo llamadaAFuncion(2,2,fn($a,$b)=>$a+$b);
    echo "<br>";
    echo llamadaAFuncion(2,2,fn($a,$b)=>$a-$b);
    echo "<br>";
    echo llamadaAFuncion(2,2,fn($a,$b)=>$a*$b);
    echo "<br>";
    $fn1 = function($a,$b) {
        return $a+$b;
    };
        $fn2 = function($a,$b) {
        return $a-$b;
    };
        $fn3 = function($a,$b) {
        return $a*$b;
    };

    echo llamadaAFuncion(2,2,$fn1);
    echo "<br>";
    echo llamadaAFuncion(2,2,$fn2);
    echo "<br>";
    echo llamadaAFuncion(2,2,$fn3);

}
