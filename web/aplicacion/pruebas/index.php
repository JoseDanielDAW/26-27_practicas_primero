<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

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
{}

//vista
function cuerpo()
{
?>
    <br><br>
    Elemento de pruebas
    <br><br>
    <a href="basicas.php">Funcionamiento basico</a>   
    <a href="pasopar.php">Paso parametros</a>
     <a href="./proyecto1/Ej1.php">Ejercicio 1</a>      
<?php
}
