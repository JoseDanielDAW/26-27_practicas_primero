<?php

final class Flauta extends InstrumentoViento implements IFabricable {

    // Constructor privado
    private function __construct(string $material = "madera", int $edad = 15) {

        parent::__construct($material, $edad);

    }

    // Constructor estatico
    public static function CrearDesdeArray(array $datos): self {

        $material = $datos["material"] ?? "madera";
        $edad = $datos["edad"] ?? 15;

        return new self($material, $edad);

    }

    // Metodo sonido
    public function sonido(): string {

        return "La flauta produce un sonido musical";

    }

    // Metodo fabricacion
    public function metodoFabricacion(): string {

        return "Se selecciona la madera, se corta, se perfora y se ensambla la flauta";

    }

    // Metodo reciclado
    public function metodoReciclado(): string {

        return "Se separan los materiales y se reutiliza o recicla la madera";

    }

    // Metodo de clonacion
    public function __clone() {

        $this->registrarClon();

    }

}

?>
