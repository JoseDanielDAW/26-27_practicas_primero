<?php

class ClaseMisPropiedades implements IteratorAggregate {

    // Atributos
    private array $_propiedades = [];

    public mixed $propPublica = null;
    private mixed $_propPrivada = 25;

    // Metodo magico __set
    public function __set(string $nombre, mixed $valor) {

        if ($nombre == "_propPrivada" || $nombre == "_propiedades") {

            throw new LogicException("No se puede modificar esta propiedad");

        }

        $this->_propiedades[$nombre] = $valor;

    }

    // Metodo magico __get
    public function __get(string $nombre) {

        if (array_key_exists($nombre, $this->_propiedades)) {

            return $this->_propiedades[$nombre];

        }

        throw new LogicException("La propiedad no existe");

    }

    // Metodo magico __isset
    public function __isset(string $nombre): bool {

        return array_key_exists($nombre, $this->_propiedades);

    }

    // Metodo magico __unset
    public function __unset(string $nombre) {

        unset($this->_propiedades[$nombre]);

    }

    // Metodo para recorrer el objeto
    public function getIterator(): Traversable {

        $propiedades = [];

        // Añadir propiedades dinamicas
        foreach ($this->_propiedades as $clave => $valor) {

            $propiedades["oi_" . $clave] = $valor;

        }

        // Añadir propiedades normales al final
        $propiedades["oi_propPublica"] = $this->propPublica;
        $propiedades["oi__propPrivada"] = $this->_propPrivada;

        return new ArrayIterator($propiedades);

    }

}

?>
