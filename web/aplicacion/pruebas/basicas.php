<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

$usuario = getenv("MYSQL_USER");

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Pruebas base");
cuerpo();  //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}

//vista
function cuerpo()
{
?>
    <br><br>esto es html
    <?php
        echo "y esto php"
    ?>

<?php
}
