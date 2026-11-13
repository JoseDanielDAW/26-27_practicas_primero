<?php

/**
 * Función cuentaVeces()
 * Comprueba el texto recibido, guarda un elemento en el array
 * y cuenta las veces que se llama correctamente a la función.
 */
function cuentaVeces(array &$array, string $string, float $num, float &$num2)
{
    if ($string == "2daw" || $string == "primera") {
        return false;
    }

    $array[$string] = $num;

    static $contador = 0;

    $contador++;

    $num2 = $contador;

    return true;
}

/**
 * Función generarCadenas()
 * Genera una cadena aleatoria con el número de caracteres indicado.
 * Si no se indica un número, utiliza 10 por defecto.
 */
function generarCadenas($num = 10)
{
    if ($num <= 0) {
        return false;
    }

    $caracteres = [
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j','k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't',
        'u', 'v', 'w', 'x', 'y', 'z','A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J','K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T',
        'U', 'V', 'W', 'X', 'Y', 'Z','0', '1', '2', '3', '4', '5', '6', '7', '8', '9'
    ];

    $cadena = '';

    for ($i = 0; $i < $num; $i++) {

        $random = random_int(0, count($caracteres) - 1);

        $cadena .= $caracteres[$random];
    }

    return $cadena;
}

/**
 * Función operaciones()
 * Realiza diferentes operaciones dependiendo del tipo indicado.
 * También permite recibir varios números adicionales.
 */
function operaciones(int $tipoOperacion, float $numero, float $numero2, float ...$numeros3)
{
    if ($tipoOperacion == 1) {
        return $numero + $numero2 + array_sum($numeros3);
    }

    else if ($tipoOperacion == 2) {

        $base = array_shift($numeros3);

        return $numero - $numero2 - array_sum($numeros3);
    }

    else if ($tipoOperacion == 3) {
        return $numero * $numero2 * array_product($numeros3);
    }

    else {

        $pares = 0;
        $impares = 0;
        $operacion = 0;

        foreach ($numeros3 as $i => $elem) {

            if ($i % 2 == 0) {
                $impares += $elem;
            }

            else {
                $pares += $elem;
            }
        }

        $impares = $impares + $numero;
        $pares = $pares + $numero2;

        $operacion = $pares - $impares;

        return $operacion;
    }
}

/**
 * Función devuelve()
 * Recibe tres números, utilizando 2 y 3 como valores por defecto
 * para el segundo y el tercer parámetro.
 */
function devuelve(int $num, int $num2 = 2, int $num3 = 3)
{

    $num = $num + $num2 + $num3;

    return $num * $num2 * $num3;
}

/**
 * Función suma()
 * Devuelve la suma de dos números.
 */
function suma(int $num, int $num2)
{
    return $num + $num2;
}

/**
 * Función resta()
 * Devuelve la resta de dos números.
 */
function resta(int $num, int $num2)
{
    return $num - $num2;
}

/**
 * Función multiplicacion()
 * Devuelve la multiplicación de dos números.
 */
function multiplicacion(int $num, int $num2)
{
    return $num * $num2;
}

/**
 * Función hacerOperacion()
 * Realiza una operación dependiendo del texto recibido.
 */
function hacerOperacion(string $cadena, int $num, int $num2)
{
    if (strcmp($cadena, "suma") == 0) {
        return $num + $num2;
    }

    else if (strcmp($cadena, "resta") == 0) {
        return $num - $num2;
    }

    else if (strcmp($cadena, "multiplicacion") == 0) {
        return $num * $num2;
    }

    else {
        return false;
    }
}

/**
 * Función llamadaAFuncion()
 * Recibe una función como parámetro y la ejecuta con dos números.
 */
function llamadaAFuncion(int $num1, int $num2, callable $callback)
{
    return $callback($num1, $num2);
}

/**
 * Función ordenar()
 * Ordena un array de palabras según su longitud, de mayor a menor.
 */
function ordenar(array &$array)
{
    usort($array, function ($a, $b) {

        $longA = strlen($a);
        $longB = strlen($b);

        return $longB <=> $longA;
    });
}