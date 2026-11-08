<?php

/**
 * Valida un numero entero.
 *
 * @param mixed $numero Numero que queremos validar.
 * @return int|false Devuelve el entero o false.
 */
function validaEntero(mixed $numero): int|false {

    $resultado = filter_var($numero, FILTER_VALIDATE_INT);

    if ($resultado !== false) {
        return $resultado;
    }

    return false;

}


/**
 * Valida un numero real.
 *
 * @param mixed $numero Numero que queremos validar.
 * @return float|false Devuelve el real o false.
 */
function validaReal(mixed $numero): float|false {

    $resultado = filter_var($numero, FILTER_VALIDATE_FLOAT);

    if ($resultado !== false) {
        return $resultado;
    }

    return false;

}


/**
 * Valida una fecha con formato dd/mm/aaaa.
 *
 * @param string $fecha Fecha que queremos validar.
 * @return string|false Devuelve la fecha corregida o false.
 */
function validaFecha(string $fecha): string|false {

    $partes = explode("/", $fecha);

    if (count($partes) != 3) {
        return false;
    }

    $dia = (int)$partes[0];
    $mes = (int)$partes[1];
    $anyo = (int)$partes[2];

    if (!checkdate($mes, $dia, $anyo)) {
        return false;
    }

    return sprintf("%02d/%02d/%04d", $dia, $mes, $anyo);

}


/**
 * Valida una hora con formato hh:mm:ss.
 *
 * @param string $hora Hora que queremos validar.
 * @return string|false Devuelve la hora corregida o false.
 */
function validaHora(string $hora): string|false {

    $partes = explode(":", $hora);

    if (count($partes) != 3) {
        return false;
    }

    $horas = (int)$partes[0];
    $minutos = (int)$partes[1];
    $segundos = (int)$partes[2];

    if ($horas < 0 || $horas > 23) {
        return false;
    }

    if ($minutos < 0 || $minutos > 59) {
        return false;
    }

    if ($segundos < 0 || $segundos > 59) {
        return false;
    }

    return sprintf("%02d:%02d:%02d", $horas, $minutos, $segundos);

}


/**
 * Valida un correo electronico.
 *
 * @param string $email Correo que queremos validar.
 * @return string|false Devuelve el correo o false.
 */
function validaEmail(string $email): string|false {

    $resultado = filter_var($email, FILTER_VALIDATE_EMAIL);

    if ($resultado !== false) {
        return $resultado;
    }

    return false;

}


/**
 * Valida una cadena de texto.
 *
 * @param string $cadena Cadena que queremos validar.
 * @param int $maximo Longitud maxima permitida.
 * @return string|false Devuelve la cadena o false.
 */
function validaCadena(string $cadena, int $maximo): string|false {

    $cadena = trim($cadena);

    $cadena = filter_var($cadena, FILTER_UNSAFE_RAW);

    if ($cadena == "") {
        return false;
    }

    if (mb_strlen($cadena) > $maximo) {
        return false;
    }

    return $cadena;

}


/**
 * Valida una cadena mediante una expresion regular.
 *
 * @param string $cadena Cadena que queremos comprobar.
 * @param string $expresion Expresion regular.
 * @return string|false Devuelve la cadena o false.
 */
function validaExpresion(string $cadena, string $expresion): string|false {

    if (preg_match($expresion, $cadena)) {
        return $cadena;
    }

    return false;

}


/**
 * Valida un valor dentro de un rango o conjunto de valores.
 *
 * @param mixed $valor Valor que queremos comprobar.
 * @param array $valores Valores permitidos.
 * @param int $tipo Tipo de comprobacion: 1 valores, 2 claves.
 * @return mixed|false Devuelve el valor o false.
 */
function validaRango(mixed $valor, array $valores, int $tipo = 1): mixed {

    if ($tipo == 1) {

        if (in_array($valor, $valores)) {
            return $valor;
        }

    } elseif ($tipo == 2) {

        if (array_key_exists($valor, $valores)) {
            return $valor;
        }

    }

    return false;

}

?>
