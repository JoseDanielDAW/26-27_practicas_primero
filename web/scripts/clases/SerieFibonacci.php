<?php

class SerieFibonacci implements Iterator {

    // Atributos
    private int $_limite;
    private int $_claveActual = 0;

    // Constructor
    public function __construct(int $limite) {

        $this->_limite = $limite;

    }

    // Devuelve el valor actual
    public function current(): int {

        $a = 0;
        $b = 1;

        for ($i = 0; $i < $this->_claveActual; $i++) {

            $auxiliar = $a + $b;
            $a = $b;
            $b = $auxiliar;

        }

        return $a;

    }

    // Devuelve la clave actual
    public function key(): int {

        return $this->_claveActual;

    }

    // Avanza al siguiente elemento
    public function next(): void {

        $this->_claveActual++;

    }

    // Reinicia el iterador
    public function rewind(): void {

        $this->_claveActual = 0;

    }

    // Comprueba si quedan elementos
    public function valid(): bool {

        return $this->_claveActual <= $this->_limite;

    }

    // Metodo estatico con generador
    public static function fFibonacci(int $ultimo): Generator {

        $a = 0;
        $b = 1;

        for ($i = 0; $i <= $ultimo; $i++) {

            yield $a;

            $auxiliar = $a + $b;
            $a = $b;
            $b = $auxiliar;

        }

    }

}

?>
