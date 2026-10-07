<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

//controlador

const NUMLANZAMIENTOS = 1000;

function lanzamientoDado() {

    $min = 1;
    $max = 6;
    $arrayLanzamientos = [];

    for ($i=0;$i<=6;$i++) {
        $arrayLanzamientos[$i] = mt_rand($min,$max);
    }

    return $arrayLanzamientos;

}

function contarLanzamientos($parametro) {
  
    $datosLanzamientos = [0,0,0,0,0,0];
    $i = 0;

    while ($i<$parametro) {
        $numRandom = mt_rand()%6+1;

        if($numRandom == 1) {
        $datosLanzamientos[0]++;
        }

        else if($numRandom == 2) {
        $datosLanzamientos[1]++;
        }

        else if($numRandom == 3) {
        $datosLanzamientos[2]++;
        }

        else if($numRandom == 4) {
        $datosLanzamientos[3]++;
        }

        else if($numRandom == 5) {
        $datosLanzamientos[4]++;
        }

        else if($numRandom == 6) {
        $datosLanzamientos[5]++;
        }

        $i++;
    }

    return $datosLanzamientos;

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
    <span> > </span>
    <a href="index.php">Relación 1</a>
    <span> > </span>
    <span>Ejercicio 2</span>
    </nav>

<?php
    echo "<br>";

    $arrayLanzamientos = lanzamientoDado();

    echo "Lanzamiento 1 del dado: $arrayLanzamientos[0]";
    echo "<br>";
    echo "Lanzamiento 2 del dado: $arrayLanzamientos[1]";
    echo "<br>";
    echo "Lanzamiento 3 del dado: $arrayLanzamientos[2]";
    echo "<br>";
    echo "Lanzamiento 4 del dado: $arrayLanzamientos[3]";
    echo "<br>";
    echo "Lanzamiento 5 del dado: $arrayLanzamientos[4]";
    echo "<br>";
    echo "Lanzamiento 6 del dado: $arrayLanzamientos[5]";
    echo "<br>";    

    $datosLanzamientos = contarLanzamientos(NUMLANZAMIENTOS);

    echo "<br>";
    echo "Se ha lanzado el dado ".NUMLANZAMIENTOS." veces";
    echo "<br>";

    echo "El 1 ha salido ".$datosLanzamientos[0]." veces con un porcentaje de ".$datosLanzamientos[0]/10 ."%";
    echo "<br>";
    echo "El 2 ha salido ".$datosLanzamientos[1]." veces con un porcentaje de ".$datosLanzamientos[1]/10 ."%";
    echo "<br>";
    echo "El 3 ha salido ".$datosLanzamientos[2]." veces con un porcentaje de ".$datosLanzamientos[2]/10 ."%";
    echo "<br>";
    echo "El 4 ha salido ".$datosLanzamientos[3]." veces con un porcentaje de ".$datosLanzamientos[3]/10 ."%";
    echo "<br>";
    echo "El 5 ha salido ".$datosLanzamientos[4]." veces con un porcentaje de ".$datosLanzamientos[4]/10 ."%";
    echo "<br>";
    echo "El 6 ha salido ".$datosLanzamientos[5]." veces con un porcentaje de ".$datosLanzamientos[5]/10 ."%";

}
