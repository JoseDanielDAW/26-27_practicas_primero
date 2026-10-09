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
    <span>Relación 1</span>
    </nav>
    <br>
    Ejercicios de la relación 1:
    <br><br>
    <a href="./ejercicio1.php">Acceso a ejercicio 1</a>
    <br>
    <br>
    <a href="./ejercicio2.php">Acceso a ejercicio 2</a>
    <br>
    <br>
    <a href="./ejercicio3.php">Acceso a ejercicio 3</a>
    <br>
    <br>
    <a href="./ejercicio4.php">Acceso a ejercicio 4</a>
    <br>
    <br>
    <a href="./ejercicio5.php">Acceso a ejercicio 5</a>
    <br>
    <br>
    <a href="./ejercicio6.php">Acceso a ejercicio 6</a>
    <br>
    <br>
    <a href="./ejercicio7.php">Acceso a ejercicio 7</a>
<?php
}
