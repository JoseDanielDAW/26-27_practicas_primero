<?php

require_once(dirname(__FILE__) . "/../../scripts/clases/Punto.php");

//identifico al cliente
$ip = str_replace(".", "_", $_SERVER['REMOTE_ADDR']);

$navegador = "otro";
$agente = strtolower($_SERVER['HTTP_USER_AGENT']);

if (strpos($agente, "chrome") !== false) {
    $navegador = "chrome";
} else if (strpos($agente, "firefox") !== false) {
    $navegador = "firefox";
} else if (strpos($agente, "edg") !== false) {
    $navegador = "edge";
} else if (strpos($agente, "safari") !== false) {
    $navegador = "safari";
}

//cargo el fichero de puntos
$nombreFichero = "puntos_" . $ip . "_" . $navegador . ".dat";
$rutaFichero = dirname(__FILE__) . "/../../imagenes/puntos/" . $nombreFichero;

$puntos = [];

if (file_exists($rutaFichero)) {
    $lineas = file($rutaFichero, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lineas as $linea) {
        $datos = explode(";", $linea);

        if (count($datos) == 4) {
            $x = filter_var(trim($datos[0]), FILTER_VALIDATE_INT);
            $y = filter_var(trim($datos[1]), FILTER_VALIDATE_INT);
            $color = trim($datos[2]);
            $grosor = filter_var(trim($datos[3]), FILTER_VALIDATE_INT);

            try {
                $punto = new Punto($x, $y, $color, $grosor);
                $puntos[] = $punto;
            } catch (Exception $e) {
                //ignoro los puntos incorrectos
            }
        }
    }
}

//creo la imagen
$imagen = imagecreatetruecolor(501, 501);

$blanco = imagecolorallocate($imagen, 255, 255, 255);
$negro = imagecolorallocate($imagen, 0, 0, 0);

imagefill($imagen, 0, 0, $blanco);

//marco de la imagen
imagerectangle($imagen, 0, 0, 500, 500, $negro);

//dibujo los puntos
foreach ($puntos as $punto) {
    $rgb = Punto::COLORES[$punto->getColor()]['rgb'];

    $color = imagecolorallocate($imagen, $rgb[0], $rgb[1], $rgb[2]);

    $tamano = $punto->getGrosor() * 5;

    imagefilledellipse(
        $imagen,
        $punto->getX(),
        $punto->getY(),
        $tamano,
        $tamano,
        $color
    );
}

//descargo la imagen
header("Content-Type: image/jpeg");
header("Content-Disposition: attachment; filename=imagen_puntos.jpg");

imagejpeg($imagen, null, 90);
