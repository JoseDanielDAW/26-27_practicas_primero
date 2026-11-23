<?php

include_once(dirname(__FILE__) . "/../../cabecera.php");

require_once(dirname(__FILE__) . "/../../scripts/clases/Punto.php");


// CONTROLADOR


inicioCabecera("APLICACION PRIMER TRIMESTRE");

cabecera();

finCabecera();


// VARIABLES

$errores = [
    "x" => "",
    "y" => "",
    "color" => "",
    "grosor" => ""
];

$mensaje = "";


// IDENTIFICAR CLIENTE

$ip = str_replace(".", "_", $_SERVER["REMOTE_ADDR"]);

$agente = strtolower($_SERVER["HTTP_USER_AGENT"]);

$navegador = "otro";

if (strpos($agente, "edg") !== false) {

    $navegador = "edge";

} elseif (strpos($agente, "firefox") !== false) {

    $navegador = "firefox";

} elseif (strpos($agente, "chrome") !== false) {

    $navegador = "chrome";

} elseif (strpos($agente, "safari") !== false) {

    $navegador = "safari";

}


// RUTAS DE LOS FICHEROS

$carpeta = dirname(__FILE__) . "/../../imagenes/puntos/";

if (!is_dir($carpeta)) {

    mkdir($carpeta, 0777, true);
}

$nombreFichero = "puntos_" . $ip . "_" . $navegador . ".dat";
$rutaFichero = $carpeta . $nombreFichero;

$nombreImagen = "imagen_" . $ip . "_" . $navegador . ".jpg";
$rutaImagen = $carpeta . $nombreImagen;

$rutaImagenWeb = "../../imagenes/puntos/" . $nombreImagen;


// ARRAY DE PUNTOS

$puntos = [];


// FUNCIONES PARA TRABAJAR CON LOS FICHEROS

function guardarPuntos($puntos, $rutaFichero)
{

    $fichero = fopen($rutaFichero, "w");

    foreach ($puntos as $punto) {

        $linea = $punto->getX() . " ; ";
        $linea .= $punto->getY() . " ; ";
        $linea .= $punto->getColor() . " ; ";
        $linea .= $punto->getGrosor() . PHP_EOL;

        fwrite($fichero, $linea);
    }

    fclose($fichero);
}


function cargarPuntos($rutaFichero)
{

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

                if ($x !== false && $y !== false && $grosor !== false) {

                    try {

                        $punto = new Punto($x, $y, $color, $grosor);
                        $puntos[] = $punto;

                    } catch (Exception $e) {

                        // No añado los puntos incorrectos

                    }
                }
            }
        }
    }

    return $puntos;
}


// FUNCION PARA CREAR LA IMAGEN

function crearImagen($puntos, $rutaImagen)
{

    $imagen = imagecreatetruecolor(501, 501);

    $blanco = imagecolorallocate($imagen, 255, 255, 255);
    $negro = imagecolorallocate($imagen, 0, 0, 0);

    imagefill($imagen, 0, 0, $blanco);

    // MARCO

    imagerectangle($imagen, 0, 0, 500, 500, $negro);

    // DIBUJAR PUNTOS

    foreach ($puntos as $punto) {

        $rgb = Punto::COLORES[$punto->getColor()]["rgb"];

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

    imagejpeg($imagen, $rutaImagen, 90);

    imagedestroy($imagen);
}


// CARGAR PUNTOS DEL FICHERO

if (!file_exists($rutaFichero)) {

    // TRES PUNTOS INICIALES

    $puntos[] = new Punto(100, 100, "red", 1);
    $puntos[] = new Punto(250, 250, "blue", 2);
    $puntos[] = new Punto(400, 400, "green", 3);

    guardarPuntos($puntos, $rutaFichero);

    crearImagen($puntos, $rutaImagen);

} else {

    $puntos = cargarPuntos($rutaFichero);

}


// COMPROBAR SI SE HA ENVIADO EL FORMULARIO

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $accion = $_POST["accion"] ?? "";


    // GUARDAR PUNTO

    if ($accion == "guardar") {

        // COORDENADA X

        $x = filter_var($_POST["x"] ?? "", FILTER_VALIDATE_INT);

        if ($x === false || $x === null || $x < 0 || $x > 500) {

            $errores["x"] = "La coordenada X debe estar entre 0 y 500";
        }


        // COORDENADA Y

        $y = filter_var($_POST["y"] ?? "", FILTER_VALIDATE_INT);

        if ($y === false || $y === null || $y < 0 || $y > 500) {

            $errores["y"] = "La coordenada Y debe estar entre 0 y 500";
        }


        // COLOR

        $color = $_POST["color"] ?? "";

        if (!is_string($color) || !array_key_exists($color, Punto::COLORES)) {

            $errores["color"] = "Debes seleccionar un color valido";
        }


        // GROSOR

        $grosor = filter_var($_POST["grosor"] ?? "", FILTER_VALIDATE_INT);

        if (
            $grosor === false || $grosor === null ||
            !array_key_exists($grosor, Punto::GROSORES)
        ) {

            $errores["grosor"] = "Debes seleccionar un grosor valido";
        }


        // SI NO HAY ERRORES AÑADO EL PUNTO

        if (
            $errores["x"] == "" &&
            $errores["y"] == "" &&
            $errores["color"] == "" &&
            $errores["grosor"] == ""
        ) {

            try {

                $punto = new Punto($x, $y, $color, $grosor);

                $puntos[] = $punto;

                guardarPuntos($puntos, $rutaFichero);

                crearImagen($puntos, $rutaImagen);

                header("Location: index.php");
                exit();

            } catch (Exception $e) {

                $mensaje = $e->getMessage();

            }
        }
    }


    // BORRAR PUNTO

    elseif ($accion == "borrar") {

        $indice = filter_var($_POST["indice"] ?? "", FILTER_VALIDATE_INT);

        if (
            $indice !== false && $indice !== null &&
            isset($puntos[$indice])
        ) {

            unset($puntos[$indice]);

            $puntos = array_values($puntos);

            guardarPuntos($puntos, $rutaFichero);

            crearImagen($puntos, $rutaImagen);

            header("Location: index.php");
            exit();

        }
    }


    // SUBIR FICHERO TXT

    elseif ($accion == "subir") {

        if (
            isset($_FILES["fichero"]) &&
            $_FILES["fichero"]["error"] == UPLOAD_ERR_OK
        ) {

            $lineas = file(
                $_FILES["fichero"]["tmp_name"],
                FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES
            );

            foreach ($lineas as $linea) {

                $datosLinea = explode(";", $linea);

                if (count($datosLinea) == 4) {

                    $x = filter_var(trim($datosLinea[0]), FILTER_VALIDATE_INT);
                    $y = filter_var(trim($datosLinea[1]), FILTER_VALIDATE_INT);
                    $color = trim($datosLinea[2]);
                    $grosor = filter_var(trim($datosLinea[3]), FILTER_VALIDATE_INT);

                    if ($x !== false && $y !== false && $grosor !== false) {

                        if (
                            $x >= 0 && $x <= 500 &&
                            $y >= 0 && $y <= 500
                        ) {

                            try {

                                $punto = new Punto($x, $y, $color, $grosor);

                                $puntos[] = $punto;

                            } catch (Exception $e) {

                                // No añado los puntos incorrectos

                            }
                        }
                    }
                }
            }

            guardarPuntos($puntos, $rutaFichero);

            crearImagen($puntos, $rutaImagen);

            header("Location: index.php");
            exit();

        } else {

            $mensaje = "No se ha podido subir el fichero";

        }
    }
}


// COMPROBAR SI EXISTE LA IMAGEN

if (!file_exists($rutaImagen)) {

    crearImagen($puntos, $rutaImagen);

}


// DATOS PARA LA VISTA

$datos = [

    "puntos" => $puntos,
    "errores" => $errores,
    "mensaje" => $mensaje,
    "rutaImagen" => $rutaImagenWeb,
    "valores" => $_POST

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

    echo "<nav class='barra-ubicacion'>";

    echo "<a href='../../index.php'>Inicio</a>";
    echo "<span>&gt;</span>";
    echo "<a href='index.php'>Relación 7</a>";
    echo "<span>&gt;</span>";
    echo "<span>Ficheros</span>";

    echo "</nav>";


    echo "<h2>Relación 7 - Ficheros</h2>";


    // VARIABLES

    $puntos = $datos["puntos"];
    $errores = $datos["errores"];
    $valores = $datos["valores"];


    // FORMULARIO PARA AÑADIR PUNTOS

    echo "<h3>Añadir punto</h3>";

    echo "<form method='POST' action='index.php'>";


    // COORDENADA X

    echo "<p>Coordenada X:</p>";

    echo "<input type='number' name='x' min='0' max='500' value='" .
        htmlspecialchars($valores["x"] ?? "") . "'>";

    if ($errores["x"] != "") {

        echo "<span class='error'>" . htmlspecialchars($errores["x"]) . "</span>";

    }


    // COORDENADA Y

    echo "<p>Coordenada Y:</p>";

    echo "<input type='number' name='y' min='0' max='500' value='" .
        htmlspecialchars($valores["y"] ?? "") . "'>";

    if ($errores["y"] != "") {

        echo "<span class='error'>" . htmlspecialchars($errores["y"]) . "</span>";

    }


    // COLOR

    echo "<p>Color:</p>";

    echo "<select name='color'>";

    echo "<option value=''>Selecciona un color</option>";

    foreach (Punto::COLORES as $clave => $color) {

        $seleccionado = (($valores["color"] ?? "") == $clave) ? "selected" : "";

        echo "<option value='" . $clave . "' " . $seleccionado . ">";

        echo $color["nombre"];

        echo "</option>";
    }

    echo "</select>";

    if ($errores["color"] != "") {

        echo "<span class='error'>" . htmlspecialchars($errores["color"]) . "</span>";

    }


    // GROSOR

    echo "<p>Grosor:</p>";

    foreach (Punto::GROSORES as $clave => $grosor) {

        $seleccionado = (($valores["grosor"] ?? "") == $clave) ? "checked" : "";

        echo "<input type='radio' name='grosor' value='" . $clave . "' " .
            $seleccionado . ">";

        echo $grosor . "<br>";
    }

    if ($errores["grosor"] != "") {

        echo "<span class='error'>" . htmlspecialchars($errores["grosor"]) . "</span>";

    }


    echo "<br><br>";

    echo "<input type='hidden' name='accion' value='guardar'>";

    echo "<input type='submit' value='Guardar'>";

    echo "</form>";


    // MENSAJE

    if ($datos["mensaje"] != "") {

        echo "<p class='error'>" . htmlspecialchars($datos["mensaje"]) . "</p>";

    }


    // MOSTRAR TODOS LOS PUNTOS

    echo "<h3>Puntos guardados</h3>";

    $texto = "";

    foreach ($puntos as $punto) {

        $texto .= "X: " . $punto->getX();

        $texto .= " - Y: " . $punto->getY();

        $texto .= " - Color: " .
            Punto::COLORES[$punto->getColor()]["nombre"];

        $texto .= " - Grosor: " .
            Punto::GROSORES[$punto->getGrosor()];

        $texto .= "\n";
    }

    echo "<textarea rows='10' cols='60' readonly>";

    echo htmlspecialchars($texto);

    echo "</textarea>";


    // MOSTRAR IMAGEN

    echo "<h3>Imagen de los puntos</h3>";

    echo "<img src='" . htmlspecialchars($datos["rutaImagen"]) .
        "?v=" . (file_exists(dirname(__FILE__) . "/../../imagenes/puntos/" .
            basename($datos["rutaImagen"])) ?
            filemtime(dirname(__FILE__) . "/../../imagenes/puntos/" .
                basename($datos["rutaImagen"])) : time()) .
        "' alt='Imagen de los puntos'>";


    // FORMULARIO PARA BORRAR PUNTOS

    echo "<h3>Borrar punto</h3>";

    echo "<form method='POST' action='index.php'>";

    echo "<select name='indice'>";

    foreach ($puntos as $indice => $punto) {

        echo "<option value='" . $indice . "'>";

        echo "Punto " . ($indice + 1);

        echo " - X: " . $punto->getX();

        echo " - Y: " . $punto->getY();

        echo "</option>";
    }

    echo "</select>";

    echo "<input type='hidden' name='accion' value='borrar'>";

    echo "<input type='submit' value='Borrar' " .
        (count($puntos) == 0 ? "disabled" : "") . ">";

    echo "</form>";


    // DESCARGAR IMAGEN

    echo "<h3>Descargar imagen</h3>";

    echo "<a href='imagen.php'>Descargar imagen JPG</a>";


    // SUBIR FICHERO TXT

    echo "<h3>Importar puntos desde TXT</h3>";

    echo "<form method='POST' action='index.php' enctype='multipart/form-data'>";

    echo "<input type='file' name='fichero' accept='.txt' required>";

    echo "<input type='hidden' name='accion' value='subir'>";

    echo "<input type='submit' value='Subir fichero'>";

    echo "</form>";

}

?>
