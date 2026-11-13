<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

// Declaración de variables
$cadena = "Está la niña en casa";
$var = "";

$datos = ["cadena" => $cadena, "var" => $var];

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
        <span>Ejercicio 2</span>
    </nav>

<?php

    // Imprimir la función en la vista
    imprimirCadenas($datos["cadena"]);
}

// Funcion del ejercicio
function imprimirCadenas($cadena)
{
    /*
    // forma no válida muestra la ñ y la a con tilde en interrogación
    for ($i = 0; $i < strlen($cadena); $i++) {
        for ($j = 0; $j < $i; $j++) {
            echo "&nbsp";
        }
        $var = $cadena[$i] . "<br>";
        echo $var;
    }

    echo "<br>";

    // forma no válida muestra la ñ y la a con tilde en interrogación
    for ($i = 0; $i < strlen($cadena); $i++) {
        for ($j = 0; $j < $i; $j++) {
            echo "&nbsp";
        }
        echo substr($cadena, $i, 1) . "<br>";
    }

    echo "<br>";
    */

    // Mostrar la cadena en orden normal con mb_strlen
    for ($i = 0; $i < mb_strlen($cadena, "UTF-8"); $i++) {
        for ($j = 0; $j < $i; $j++) {
            echo "&nbsp";
        }
        echo mb_substr($cadena, $i, 1, "UTF-8") . "<br>";
    }

    echo "<br>";

    // Mostrar la cadena en orden inverso
    for ($i = mb_strlen($cadena, "UTF-8"); $i >= 0; $i--) {
        for ($j = 0; $j < $i; $j++) {
            echo "&nbsp";
        }
        echo mb_substr($cadena, $i, 1, "UTF-8") . "<br>";
    }

    echo "<br>";

    // Separar la cadena usando el carácter "a"
    foreach (explode("a", $cadena) as $parte) {
        echo $parte . "<br>";
    }

    echo "<br>";

    // Localizar "niña" y cambiar el espacio siguiente por "/mujer "
    if (mb_strpos($cadena, "niña", 0, "UTF-8") !== false) {
        $posicion = mb_strpos($cadena, "niña", 0, "UTF-8")
            + mb_strlen("niña", "UTF-8");

        // Comprobar que después de "niña" hay un espacio
        if (mb_substr($cadena, $posicion, 1, "UTF-8") === " ") {
            $cadena = mb_substr($cadena, 0, $posicion, "UTF-8")
                . "/mujer "
                . mb_substr($cadena, $posicion + 1, null, "UTF-8");
        }
    }

    echo $cadena . "<br>";
}
