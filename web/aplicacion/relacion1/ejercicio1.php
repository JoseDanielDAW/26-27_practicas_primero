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
    <span>Ejercicio 1</span>
    </nav>

<?php
    echo "<br>";
    $numero = 5.6;
    echo "Numero sin redondear: $numero";
    echo "<br>";
    echo "Número redondeado: ".round($numero);
    echo "<br>";
    echo "Redondeo a la baja: ".floor($numero);
    echo "<br>";
    echo "Potencia de 2 del número: ".pow($numero,2);
    echo "<br>";
    echo "Raíz cuadrada del número: ".sqrt($numero);
    echo "<br>";
    echo "<br>";
    $numero = 123;
    echo "Nuevo número: $numero";
    echo "<br>";
    echo "Hexadecimal: ".dechex($numero);
    echo "<br>";
    echo "Base 4 a 8: ".base_convert($numero, 4, 8);
    echo "<br>";
    echo "<br>";

    $binario = 0b1010;
    $octal = 012;
    $hexadecimal = 0xA;

    echo "Binario en decimal: " . $binario;
    echo "<br>";
    echo "Binario: " . decbin($binario);
    echo "<br><br>";

    echo "Octal en decimal: " . $octal;
    echo "<br>";
    echo "Octal: " . decoct($octal);
    echo "<br><br>";

    echo "Hexadecimal en decimal: " . $hexadecimal;
    echo "<br>";
    echo "Hexadecimal: " . dechex($hexadecimal);
}
