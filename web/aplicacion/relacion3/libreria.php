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

$random = random_int(1,count($caracteres));


return true;
}

function operaciones() {}

function devuelve() {}

function hacerOperacion() {}

function llamadaAFuncion() {}

function ordenar() {}
