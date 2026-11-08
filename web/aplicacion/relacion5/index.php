<?php

include_once(dirname(__FILE__) . "/../../cabecera.php");

// CONTROLADOR

inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();


// Variables

$errores = [];
$resultados = [];


// Comprobar si se ha enviado el formulario

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // NOMBRE

    $nombre = trim($_POST["nombre"] ?? "");

    if ($nombre == "") {

        $errores[] = "El nombre es obligatorio";

    } elseif (mb_strlen($nombre) > 25) {

        $errores[] = "El nombre no puede superar los 25 caracteres";

    } elseif (mb_strtoupper(mb_substr($nombre, 0, 1)) == "H") {

        $errores[] = "El nombre no puede comenzar por H";

    } else {

        $nombre = mb_strtoupper($nombre);
        $resultados["nombre"] = $nombre;

    }


    // CONTRASEÑA

    $contrasena = $_POST["contrasena"] ?? "";

    $expresion = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[$_\-;<>\@])[A-Za-z0-9$_\-;<>\@]{8,15}$/';

    if (!preg_match($expresion, $contrasena)) {

        $errores[] = "La contraseña debe tener entre 8 y 15 caracteres, mayuscula, minuscula, numero y un caracter especial permitido";

    } else {

        $resultados["contrasena"] = "Correcta";

    }


    // FECHA DE NACIMIENTO

    $fechaNacimiento = trim($_POST["fecha_nacimiento"] ?? "");

    $partesNacimiento = explode("/", $fechaNacimiento);

    if (count($partesNacimiento) == 3) {

        $dia = (int)$partesNacimiento[0];
        $mes = (int)$partesNacimiento[1];
        $anyo = (int)$partesNacimiento[2];

        if (checkdate($mes, $dia, $anyo)) {

            $fechaNacimiento = sprintf("%02d/%02d/%04d", $dia, $mes, $anyo);
            $resultados["fecha_nacimiento"] = $fechaNacimiento;

        } else {

            $errores[] = "La fecha de nacimiento no es valida";

        }

    } else {

        $errores[] = "El formato de nacimiento debe ser dd/mm/aaaa";

    }


    // FECHA DEL CARNET

    $fechaCarnet = trim($_POST["fecha_carnet"] ?? "");

    $partesCarnet = explode("/", $fechaCarnet);

    if (count($partesCarnet) == 3) {

        $dia = (int)$partesCarnet[0];
        $mes = (int)$partesCarnet[1];
        $anyo = (int)$partesCarnet[2];

        if (checkdate($mes, $dia, $anyo)) {

            $fechaCarnet = sprintf("%02d/%02d/%04d", $dia, $mes, $anyo);

            if (isset($resultados["fecha_nacimiento"])) {

                $nacimiento = DateTime::createFromFormat("d/m/Y", $fechaNacimiento);
                $carnet = DateTime::createFromFormat("d/m/Y", $fechaCarnet);

                $fechaMinima = clone $nacimiento;
                $fechaMinima->modify("+18 years");

                if ($carnet >= $fechaMinima) {

                    $resultados["fecha_carnet"] = $fechaCarnet;

                } else {

                    $errores[] = "El carnet debe obtenerse al cumplir los 18 años";

                }

            } else {

                $errores[] = "No se puede comprobar el carnet sin una fecha de nacimiento valida";

            }

        } else {

            $errores[] = "La fecha del carnet no es valida";

        }

    } else {

        $errores[] = "El formato del carnet debe ser dd/mm/aaaa";

    }


    // HORA

    $hora = trim($_POST["hora"] ?? "");

    $partesHora = explode(":", $hora);

    if (count($partesHora) == 3) {

        $horas = (int)$partesHora[0];
        $minutos = (int)$partesHora[1];
        $segundos = (int)$partesHora[2];

        if ($horas >= 0 && $horas <= 23 &&
            $minutos >= 0 && $minutos <= 59 &&
            $segundos >= 0 && $segundos <= 59) {

            $hora = sprintf("%02d:%02d:%02d", $horas, $minutos, $segundos);
            $resultados["hora"] = $hora;

        } else {

            $errores[] = "La hora no es valida";

        }

    } else {

        $errores[] = "La hora debe tener formato hh:mm:ss";

    }


    // ESTADO CIVIL

    $estado = $_POST["estado"] ?? "";

    if (filter_var($estado, FILTER_VALIDATE_INT) === false ||
        !in_array((int)$estado, [1, 2, 3, 4])) {

        $errores[] = "Debes seleccionar un estado civil valido";

    } else {

        $estados = [
            1 => "Soltero",
            2 => "Casado",
            3 => "Pareja",
            4 => "Viudo"
        ];

        $resultados["estado"] = $estados[(int)$estado];

    }


    // ESTUDIOS

    $estudios = $_POST["estudios"] ?? [];

    $opcionesEstudios = [
        0 => "Sin estudios",
        1 => "Primaria",
        2 => "Secundaria",
        3 => "Bachillerato",
        4 => "Formacion profesional",
        5 => "Universidad"
    ];

    if (!is_array($estudios) || count($estudios) == 0) {

        $errores[] = "Debes seleccionar al menos un estudio";

    } else {

        $estudios = array_map("strval", $estudios);

        if (in_array("6", $estudios)) {

            $errores[] = "La opcion 6 no es valida";

        } elseif (in_array("0", $estudios) && count($estudios) > 1) {

            $errores[] = "Sin estudios no se puede seleccionar junto a otras opciones";

        } else {

            $estudiosCorrectos = [];

            foreach ($estudios as $estudio) {

                if (filter_var($estudio, FILTER_VALIDATE_INT) !== false &&
                    array_key_exists((int)$estudio, $opcionesEstudios)) {

                    $estudiosCorrectos[] = $opcionesEstudios[(int)$estudio];

                } else {

                    $errores[] = "Hay una opcion de estudios no valida";

                }

            }

            if (count($estudiosCorrectos) == count($estudios)) {

                $resultados["estudios"] = $estudiosCorrectos;

            }

        }

    }


    // NUMERO DE HERMANOS

    $hermanos = $_POST["hermanos"] ?? "0";

    $hermanos = filter_var($hermanos, FILTER_VALIDATE_INT);

    if ($hermanos === false || $hermanos < 0 || $hermanos > 20) {

        $errores[] = "El numero de hermanos debe estar entre 0 y 20";

    } else {

        $resultados["hermanos"] = $hermanos;

    }


    // SUELDO

    $sueldo = $_POST["sueldo"] ?? "1100";

    $sueldo = filter_var($sueldo, FILTER_VALIDATE_FLOAT);

    if ($sueldo === false || $sueldo < 1000 || $sueldo > 150000) {

        $errores[] = "El sueldo debe estar entre 1000 y 150000 euros";

    } else {

        $resultados["sueldo"] = $sueldo;

    }

}


// DATOS PARA LA VISTA

$datos = [
    "errores" => $errores,
    "resultados" => $resultados
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
?>

<?php

    echo "<nav class='barra-ubicacion'>";
    echo "<a href='../../index.php'>Inicio</a>";
    echo "<span>&gt;</span>";
    echo "<a href='index.php'>Relación 5</a>";
    echo "<span>&gt;</span>";
    echo "<span>Introducción de información</span>";
    echo "</nav>";


    echo "<h2>Relación 5 - Introducción de información</h2>";


    // MOSTRAR ERRORES

    if (count($datos["errores"]) > 0) {

        echo "<h3>Errores encontrados</h3>";

        foreach ($datos["errores"] as $error) {

            echo "<p class='error'>" . htmlspecialchars($error) . "</p>";

        }

    }


    // MOSTRAR RESULTADOS

    if (count($datos["resultados"]) > 0) {

        echo "<h3>Datos recibidos correctamente</h3>";

        foreach ($datos["resultados"] as $clave => $valor) {

            echo "<p><strong>" . htmlspecialchars($clave) . ":</strong> ";

            if (is_array($valor)) {

                echo implode(", ", $valor);

            } else {

                echo htmlspecialchars((string)$valor);

            }

            echo "</p>";

        }

    }


    // FORMULARIO

    echo "<h3>Formulario</h3>";

    echo "<form method='POST' action='index.php'>";


    // NOMBRE

    echo "<p>Nombre:</p>";
    echo "<input type='text' name='nombre' maxlength='25'>";


    // CONTRASEÑA

    echo "<p>Contraseña:</p>";
    echo "<input type='password' name='contrasena'>";


    // FECHA DE NACIMIENTO

    echo "<p>Fecha de nacimiento (dd/mm/aaaa):</p>";
    echo "<input type='text' name='fecha_nacimiento'>";


    // FECHA DEL CARNET

    echo "<p>Fecha del carnet (dd/mm/aaaa):</p>";
    echo "<input type='text' name='fecha_carnet'>";


    // HORA

    echo "<p>Hora (hh:mm:ss):</p>";
    echo "<input type='text' name='hora'>";


    // ESTADO CIVIL

    echo "<p>Estado civil:</p>";

    echo "<input type='radio' name='estado' value='1'> Soltero<br>";
    echo "<input type='radio' name='estado' value='2'> Casado<br>";
    echo "<input type='radio' name='estado' value='3'> Pareja<br>";
    echo "<input type='radio' name='estado' value='4'> Viudo<br>";
    echo "<input type='radio' name='estado' value='5'> Opcion no valida<br>";


    // ESTUDIOS

    echo "<p>Estudios:</p>";

    echo "<input type='checkbox' name='estudios[]' value='0'> Sin estudios<br>";
    echo "<input type='checkbox' name='estudios[]' value='1'> Primaria<br>";
    echo "<input type='checkbox' name='estudios[]' value='2'> Secundaria<br>";
    echo "<input type='checkbox' name='estudios[]' value='3'> Bachillerato<br>";
    echo "<input type='checkbox' name='estudios[]' value='4'> Formacion profesional<br>";
    echo "<input type='checkbox' name='estudios[]' value='5'> Universidad<br>";
    echo "<input type='checkbox' name='estudios[]' value='6'> Opcion no valida<br>";


    // HERMANOS

    echo "<p>Numero de hermanos:</p>";
    echo "<input type='number' name='hermanos' min='0' max='20' value='0'>";


    // SUELDO

    echo "<p>Sueldo:</p>";
    echo "<input type='number' name='sueldo' min='1000' max='150000' step='0.01' value='1100'>";


    echo "<br><br>";
    echo "<input type='submit' value='Enviar'>";

    echo "</form>";

}

?>
