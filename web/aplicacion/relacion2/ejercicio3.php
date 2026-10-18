<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
// Declaración de variables
$caracteres = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j','k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't','u', 'v', 'w', 'x', 'y', 'z',
'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J','K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T','U', 'V', 'W', 'X', 'Y', 'Z',
'0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

$cadena = "";

$usuario = getenv("MYSQL_USER");

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION");
cuerpo($caracteres,$cadena);  //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera()
{
?>

<?php


}

//vista
function cuerpo($caracteres,$cadena)
{
?>

    <nav class="barra-ubicacion">
    <a href="../../index.php">Inicio</a>
    <span>&gt;</span>
    <a href="index.php">Relación 2</a>
    <span>&gt;</span>
    <span>Ejercicio 3</span>
    </nav>

<?php
   
    // Imprimir las funciónes en la vista
    cadenaAleatoria($caracteres,$cadena);
    echo "<br>";
    cadenaAleatoriaASCII($cadena);
}

// Función de cadena de 20 caracteres aleatorios a partir de array
function cadenaAleatoria($caracteres,$cadena) {

    for ($i=0;$i<20;$i++) {
        $j = mt_rand(0,count($caracteres)- 1);
        $cadena .= $caracteres[$j];
    }

    echo $cadena;
}

// Función de cadena de 20 caracteres aleatorios a partir del código ASCII
function cadenaAleatoriaASCII($cadena) {

    for ($i = 0; $i < 20; $i++) {
        $codigo = mt_rand(48, 122);

        // Eliminar los caracteres que no sean letras o números
        while (!(($codigo >= 48 && $codigo <= 57) || ($codigo >= 65 && $codigo <= 90) ||($codigo >= 97 && $codigo <= 122))) {
            $codigo = mt_rand(48, 122);
        }

        $cadena .= chr($codigo);
    }

    echo $cadena;
}