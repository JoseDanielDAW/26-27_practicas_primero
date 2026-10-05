<?php
include_once(dirname(__FILE__) . "/cabecera.php");
//controlador

$usuario=getenv("MYSQL_USER");

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
    <span>Inicio</span>
    </nav>
    <br><br>
    Relaciones de ejercicios
    <br><br>
    <a href="./aplicacion/relacion1/index.php">Acceso a relación 1</a>


<?php
}
