<?php

enum EstadoCivil: int {

    case SOLTERO = 10;
    case CASADO = 20;
    case PAREJA = 30;
    case VIUDO = 40;

    // Devuelve el nombre del caso
    public function descripcion(): string {

        return $this->name;

    }

    // Devuelve el valor
    public function valor(): int {

        return $this->value;

    }

    // Devuelve todos los casos
    public static function casos(): array {

        return self::cases();

    }

}

?>
