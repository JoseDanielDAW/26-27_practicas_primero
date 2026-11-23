<?php

include_once(dirname(__FILE__) . "/../../cabecera.php");
require_once(dirname(__FILE__) . "/../../scripts/clases/Punto.php");

//controlador

//identifico al cliente
$ip = str_replace(".", "_", $_SERVER['REMOTE_ADDR']);

$navegador = "otro";
$agente = strtolower($_SERVER['HTTP_USER_AGENT']);

if (strpos($agente, "chrome") !== false)
{
    $navegador = "chrome";
}
else if (strpos($agente, "firefox") !== false)
{
    $navegador = "firefox";
}
else if (strpos($agente, "edg") !== false)
{
    $navegador = "edge";
}
else if (strpos($agente, "safari") !== false)
{
    $navegador = "safari";
}

//rutas de los ficheros
$nombreFichero = "puntos_" . $ip . "_" . $navegador . ".dat";
$rutaFichero = dirname(__FILE__) . "/../../imagenes/puntos/" . $nombreFichero;

$nombreImagen = "imagen_" . $ip . "_" . $navegador . ".jpg";
$rutaImagen = dirname(__FILE__) . "/../../imagenes/puntos/" . $nombreImagen;

$rutaImagenWeb = "../../imagenes/puntos/" . $nombreImagen;

//array de puntos
$puntos = [];

//mensajes y errores
$errorX = "";
$errorY = "";
$errorColor = "";
$errorGrosor = "";
$mensaje = "";

//funcion para crear la imagen
function crearImagen($puntos, $rutaImagen)
{
    $imagen = imagecreatetruecolor(500, 500);

    $blanco = imagecolorallocate($imagen, 255, 255, 255);
    $negro = imagecolorallocate($imagen, 0, 0, 0);

    //fondo blanco y marco
    imagefill($imagen, 0, 0, $blanco);
    imagerectangle($imagen, 0, 0, 499, 499, $negro);

    //dibujo los puntos
    foreach ($puntos as $punto)
    {
        $datosColor = Punto::COLORES[$punto->getColor()];
        $rgb = $datosColor["rgb"];

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

//funcion para guardar los puntos en el fichero
function guardarPuntos($puntos, $rutaFichero)
{
    $fichero = fopen($rutaFichero, "w");

    foreach ($puntos as $punto)
    {
        $linea = $punto->getX() . " ; ";
        $linea .= $punto->getY() . " ; ";
        $linea .= $punto->getColor() . " ; ";
        $linea .= $punto->getGrosor() . PHP_EOL;

        fwrite($fichero, $linea);
    }

    fclose($fichero);
}

//funcion para cargar los puntos
function cargarPuntos($rutaFichero)
{
    $puntos = [];

    if (file_exists($rutaFichero))
    {
        $lineas = file($rutaFichero, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lineas as $linea)
        {
            $datos = explode(";", $linea);

            if (count($datos) == 4)
            {
                $x = filter_var(trim($datos[0]), FILTER_VALIDATE_INT);
                $y = filter_var(trim($datos[1]), FILTER_VALIDATE_INT);
                $color = trim($datos[2]);
                $grosor = filter_var(trim($datos[3]), FILTER_VALIDATE_INT);

                try
                {
                    $punto = new Punto($x, $y, $color, $grosor);
                    $puntos[] = $punto;
                }
                catch (Exception $e)
                {
                    //ignoro las lineas incorrectas
                }
            }
        }
    }

    return $puntos;
}

//creo los tres puntos iniciales si no existe el fichero
if (!file_exists($rutaFichero))
{
    $puntos[] = new Punto(100, 100, "red", 1);
    $puntos[] = new Punto(250, 250, "blue", 2);
    $puntos[] = new Punto(400, 400, "green", 3);

    guardarPuntos($puntos, $rutaFichero);
    crearImagen($puntos, $rutaImagen);
}
else
{
    $puntos = cargarPuntos($rutaFichero);
}

//procesamiento de formularios
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    $accion = $_POST['accion'] ?? "";

    //añadir un punto
    if ($accion == "guardar")
    {
        $x = filter_var($_POST['x'] ?? "", FILTER_VALIDATE_INT);
        $y = filter_var($_POST['y'] ?? "", FILTER_VALIDATE_INT);

        $color = $_POST['color'] ?? "";
        $grosor = filter_var($_POST['grosor'] ?? "", FILTER_VALIDATE_INT);

        if ($x === false || $x === null || $x < 0 || $x > 500)
        {
            $errorX = "Introduce un número entre 0 y 500";
        }

        if ($y === false || $y === null || $y < 0 || $y > 500)
        {
            $errorY = "Introduce un número entre 0 y 500";
        }

        if (!array_key_exists($color, Punto::COLORES))
        {
            $errorColor = "Selecciona un color";
        }

        if ($grosor === false || $grosor === null || !array_key_exists($grosor, Punto::GROSORES))
        {
            $errorGrosor = "Selecciona un grosor";
        }

        //si no hay errores añado el punto
        if ($errorX == "" && $errorY == "" && $errorColor == "" && $errorGrosor == "")
        {
            try
            {
                $punto = new Punto($x, $y, $color, $grosor);
                $puntos[] = $punto;

                guardarPuntos($puntos, $rutaFichero);
                crearImagen($puntos, $rutaImagen);

                header("Location: index.php");
                exit();
            }
            catch (Exception $e)
            {
                $mensaje = $e->getMessage();
            }
        }
    }

    //borrar un punto
    else if ($accion == "borrar")
    {
        $indice = filter_var($_POST['indice'] ?? "", FILTER_VALIDATE_INT);

        if ($indice !== false && $indice !== null && isset($puntos[$indice]))
        {
            unset($puntos[$indice]);

            $puntos = array_values($puntos);

            guardarPuntos($puntos, $rutaFichero);
            crearImagen($puntos, $rutaImagen);

            header("Location: index.php");
            exit();
        }
    }

    //subir un fichero txt
    else if ($accion == "subir")
    {
        if (isset($_FILES['fichero']) && $_FILES['fichero']['error'] == UPLOAD_ERR_OK)
        {
            $lineas = file($_FILES['fichero']['tmp_name'], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            foreach ($lineas as $linea)
            {
                $datos = explode(";", $linea);

                if (count($datos) == 4)
                {
                    $x = filter_var(trim($datos[0]), FILTER_VALIDATE_INT);
                    $y = filter_var(trim($datos[1]), FILTER_VALIDATE_INT);
                    $color = trim($datos[2]);
                    $grosor = filter_var(trim($datos[3]), FILTER_VALIDATE_INT);

                    //compruebo que los datos sean correctos
                    if ($x !== false && $y !== false && $grosor !== false)
                    {
                        if ($x >= 0 && $x <= 500 && $y >= 0 && $y <= 500)
                        {
                            try
                            {
                                $punto = new Punto($x, $y, $color, $grosor);
                                $puntos[] = $punto;
                            }
                            catch (Exception $e)
                            {
                                //no añado el punto incorrecto
                            }
                        }
                    }
                }
            }

            guardarPuntos($puntos, $rutaFichero);
            crearImagen($puntos, $rutaImagen);

            header("Location: index.php");
            exit();
        }
        else
        {
            $mensaje = "No se ha podido subir el fichero";
        }
    }
}

//si no existe la imagen la creo
if (!file_exists($rutaImagen))
{
    crearImagen($puntos, $rutaImagen);
}

//llamo a la vista
inicioCabecera();
cabecera();
finCabecera();

inicioCuerpo();
cuerpo();
finCuerpo();

//funciones de la vista

function cabecera()
{
    echo "<h1>Relación 7: Ficheros</h1>";
}

function cuerpo()
{
    global $puntos, $errorX, $errorY, $errorColor, $errorGrosor;
    global $mensaje, $rutaImagenWeb;

    //formulario para añadir puntos
    echo "<h2>Añadir punto</h2>";

    echo "<form action='index.php' method='POST'>";

    echo "<label>Coordenada X:</label>";
    echo "<input type='number' name='x' min='0' max='500' value='" . htmlspecialchars($_POST['x'] ?? "") . "'>";
    echo "<span class='error'>" . $errorX . "</span><br>";

    echo "<label>Coordenada Y:</label>";
    echo "<input type='number' name='y' min='0' max='500' value='" . htmlspecialchars($_POST['y'] ?? "") . "'>";
    echo "<span class='error'>" . $errorY . "</span><br>";

    echo "<label>Color:</label>";
    echo "<select name='color'>";

    echo "<option value=''>Selecciona un color</option>";

    foreach (Punto::COLORES as $clave => $color)
    {
        $seleccionado = (($_POST['color'] ?? "") == $clave) ? "selected" : "";

        echo "<option value='" . $clave . "' " . $seleccionado . ">";
        echo $color['nombre'];
        echo "</option>";
    }

    echo "</select>";
    echo "<span class='error'>" . $errorColor . "</span><br>";

    echo "<label>Grosor:</label>";

    foreach (Punto::GROSORES as $clave => $grosor)
    {
        $seleccionado = (($_POST['grosor'] ?? "") == $clave) ? "checked" : "";

        echo "<input type='radio' name='grosor' value='" . $clave . "' " . $seleccionado . ">";
        echo $grosor;
    }

    echo "<span class='error'>" . $errorGrosor . "</span><br>";

    echo "<input type='hidden' name='accion' value='guardar'>";
    echo "<input type='submit' value='Guardar'>";

    echo "</form>";

    echo "<p>" . htmlspecialchars($mensaje) . "</p>";

    //mostrar todos los puntos
    echo "<h2>Puntos guardados</h2>";

    $texto = "";

    foreach ($puntos as $punto)
    {
        $texto .= "X: " . $punto->getX();
        $texto .= " - Y: " . $punto->getY();
        $texto .= " - Color: " . Punto::COLORES[$punto->getColor()]['nombre'];
        $texto .= " - Grosor: " . Punto::GROSORES[$punto->getGrosor()];
        $texto .= "\n";
    }

    echo "<textarea rows='10' cols='60' readonly>";
    echo htmlspecialchars($texto);
    echo "</textarea>";

    //mostrar imagen
    echo "<h2>Imagen de los puntos</h2>";
    echo "<img src='" . $rutaImagenWeb . "?v=" . filemtime(dirname(__FILE__) . "/../../imagenes/puntos/" . basename($rutaImagenWeb)) . "' alt='Imagen de los puntos'>";

    //formulario para borrar puntos
    echo "<h2>Borrar punto</h2>";

    echo "<form action='index.php' method='POST'>";

    echo "<select name='indice'>";

    foreach ($puntos as $indice => $punto)
    {
        echo "<option value='" . $indice . "'>";
        echo "Punto " . ($indice + 1) . " - X: " . $punto->getX() . " Y: " . $punto->getY();
        echo "</option>";
    }

    echo "</select>";

    echo "<input type='hidden' name='accion' value='borrar'>";
    echo "<input type='submit' value='Borrar' " . (count($puntos) == 0 ? "disabled" : "") . ">";

    echo "</form>";

    //descargar imagen
    echo "<h2>Descargar imagen</h2>";
    echo "<a href='imagen.php'>Descargar imagen JPG</a>";

    //formulario para subir puntos
    echo "<h2>Importar puntos desde TXT</h2>";

    echo "<form action='index.php' method='POST' enctype='multipart/form-data'>";

    echo "<input type='file' name='fichero' accept='.txt' required>";
    echo "<input type='hidden' name='accion' value='subir'>";
    echo "<input type='submit' value='Subir fichero'>";

    echo "</form>";
}
?>
