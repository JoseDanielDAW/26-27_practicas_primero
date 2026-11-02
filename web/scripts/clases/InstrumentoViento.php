<?php

abstract class InstrumentoViento extends InstrumentoBase {

    // Atributos
    protected string $_material = "madera";

    // Constructor
    public function __construct(string $material = "madera", int $edad = 15) {

        parent::__construct("instrumento de viento", $edad);

        $this->_material = $material;

    }

    // Metodo afinar
    final public function afinar(): string {

        return "Se ajusta el instrumento de viento";

    }

    // Metodo magico __toString
    public function __toString(): string {

        return parent::__toString() . " Instrumento de material " . $this->_material;

    }

}

?>