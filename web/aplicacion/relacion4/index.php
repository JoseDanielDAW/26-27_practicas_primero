<?php

include_once(dirname(__FILE__) . "/../../cabecera.php");

// CONTROLADOR

inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();

// EJERCICIO 4 - FLAUTA

$flauta = Flauta::CrearDesdeArray([
    "material" => "madera",
    "edad" => 15
]);

$flautaClon = clone $flauta;

// EJERCICIO 5 - PERSONA

$casos = EstadoCivil::casos();

$estadoAleatorio = $casos[array_rand($casos)];

$persona = Persona::registrarPersona(
    "Daniel",
    "01/01/2000",
    "Carrera 12",
    "Antequera",
    $estadoAleatorio
);

// EJERCICIO 6 - FIBONACCI

$fibonacci = new SerieFibonacci(10);
$generador = SerieFibonacci::fFibonacci(10);

// EJERCICIO 7 - PROPIEDADES DINAMICAS

$objeto = new ClaseMisPropiedades();

$objeto->propPublica = "publica";
$objeto->propiedad1 = 25;
$objeto->propiedad2 = "cadena";


// Array con los datos para la vista

$datos = [
    "flauta" => $flauta,
    "flautaClon" => $flautaClon,
    "persona" => $persona,
    "fibonacci" => $fibonacci,
    "generador" => $generador,
    "objeto" => $objeto
];

inicioCuerpo("2DAW APLICACION");
cuerpo($datos);
finCuerpo();


// VISTA

function cabecera()
{
?>

<?php
}



function cuerpo(array $datos)
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

    echo "<h2>Ejercicio 4 - Flauta</h2>";

    echo "<p>" . $datos["flauta"] . "</p>";
    echo "<p>" . $datos["flauta"]->sonido() . "</p>";
    echo "<p>" . $datos["flauta"]->afinar() . "</p>";
    echo "<p>" . $datos["flauta"]->metodoFabricacion() . "</p>";
    echo "<p>" . $datos["flauta"]->metodoReciclado() . "</p>";

    echo "<h3>Clon de la flauta</h3>";
    echo "<p>" . $datos["flautaClon"] . "</p>";

    echo "<h2>Ejercicio 5 - Persona</h2>";
    echo "<p>" . $datos["persona"]->toString() . "</p>";

    echo "<h2>Ejercicio 6 - Fibonacci</h2>";

    foreach ($datos["fibonacci"] as $valor) {
        echo $valor . " &nbsp;";
    }

    echo "<h3>Generador Fibonacci</h3>";

    foreach ($datos["generador"] as $valor) {
        echo $valor . " &nbsp;";
    }

    echo "<h2>Ejercicio 7 - Propiedades dinámicas</h2>";

    echo "<p>Propiedad 1: " . $datos["objeto"]->propiedad1 . "</p>";
    echo "<p>Propiedad 2: " . $datos["objeto"]->propiedad2 . "</p>";

    echo "<h3>Recorrer objeto</h3>";

    foreach ($datos["objeto"] as $clave => $valor) {

        echo "<p>" . htmlspecialchars($clave) . ": " .
        htmlspecialchars((string)$valor) . "</p>";

    }

}
?>