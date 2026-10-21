<?php

/**
 * Funcion cuentaVeces()
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

function generarCadenas($num=10) {

if ($num <= 0) {
  return false;
}

$caracteres = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j','k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't','u', 'v', 'w', 'x', 'y', 'z',
'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J','K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T','U', 'V', 'W', 'X', 'Y', 'Z',
'0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

$cadena = '';

for ($i = 0;$i<$num;$i++) {
$random = random_int(0,count($caracteres)-1);
$cadena .= $caracteres[$random];
}

return $cadena;
}

function operaciones(int $tipoOperacion,float $numero,float $numero2,float ...$numeros3) {

  if ($tipoOperacion == 1) {
    return $numero + $numero2 + (array_sum($numeros3));
  }

  else if ($tipoOperacion == 2) {
    $base = array_shift($numeros3);
    return $numero - $numero2 - array_sum($numeros3);
  }

  else if($tipoOperacion == 3) {
    return $numero * $numero2 * array_product($numeros3);
  }

  else {
    $pares = 0;
    $impares = 0;
    $operacion = 0;

    foreach ($numeros3 as $i => $elem) {
      if ($i%2==0) {
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

function devuelve(int $num,int $num2 = 2,int $num3 = 3) {
  $num = $num + $num2 + $num3;
  return $num * $num2 * $num3;
}

function suma() {}

function resta() {}

function multiplicacion() {}

function hacerOperacion() {}

function llamadaAFuncion() {}

function ordenar() {}
