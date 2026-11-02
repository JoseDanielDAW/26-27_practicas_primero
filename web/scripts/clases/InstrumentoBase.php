<?php

abstract class InstrumentoBase {

    // Atributos
    private string $_descripcion;
    protected int $_edad = 10;

    protected static int $_totalInstrumentos = 0;
    private int $_instancia;

    // Constructor
    public function __construct(string $descripcion, int $edad = 10) {

        $this->_descripcion = $descripcion;
        $this->_edad = $edad;

        $this->_instancia = self::$_totalInstrumentos + 1;
        self::$_totalInstrumentos++;

    }

    // Getter y setter de descripcion
    public function getDescripcion(): string {
        return $this->_descripcion;
    }

    public function setDescripcion(string $descripcion): void {
        $this->_descripcion = $descripcion;
    }

    // Getter de edad
    public function getEdad(): int {
        return $this->_edad;
    }

    // Metodos abstractos
    abstract public function sonido(): string;

    abstract public function afinar(): string;

    // Metodo envejecer
    public function envejecer(): void {
        $this->_edad++;
    }

    // Metodo magico __toString
    public function __toString(): string {

        return "instrumento con descripción " . $this->_descripcion . ", instancia " . $this->_instancia .
        " de un total de " . self::$_totalInstrumentos .". Tiene " . $this->_edad . " años. La clase es " . get_class($this);

    }

    // Deshabilitar sobrecarga dinamica
    public function __get(string $nombre) {
        throw new LogicException("Acceso no permitido");
    }

    public function __set(string $nombre, mixed $valor) {
        throw new LogicException("Modificacion no permitida");
    }

    public function __isset(string $nombre) {
        throw new LogicException("Acceso no permitido");
    }

    public function __unset(string $nombre) {
        throw new LogicException("Acceso no permitido");
    }

    // Registrar una nueva instancia al clonar
    protected function registrarClon(): void {

        $this->_edad = 0;
        $this->_instancia = ++self::$_totalInstrumentos;

    }

}

?>
