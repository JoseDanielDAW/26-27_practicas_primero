<?php

class Persona {

    // Atributos
    private string $_nombre;
    private string $_fecha_nacimiento;
    private string $_domicilio;
    private string $_localidad;
    private EstadoCivil $_estado;

    // Constructor privado
    private function __construct() {

        $this->_nombre = "prueba";
        $this->_fecha_nacimiento = "01/01/2000";
        $this->_domicilio = "carrera 12";
        $this->_localidad = "antequera";
        $this->_estado = EstadoCivil::SOLTERO;

    }

    // Getters y setters
    public function getNombre(): string {
        return $this->_nombre;
    }

    public function setNombre(string $nombre): void {
        $this->_nombre = $nombre;
    }

    public function getFechaNacimiento(): string {
        return $this->_fecha_nacimiento;
    }

    public function setFechaNacimiento(string $fecha): void {
        $this->_fecha_nacimiento = $fecha;
    }

    public function getDomicilio(): string {
        return $this->_domicilio;
    }

    public function setDomicilio(string $domicilio): void {
        $this->_domicilio = $domicilio;
    }

    public function getLocalidad(): string {
        return $this->_localidad;
    }

    public function setLocalidad(string $localidad): void {
        $this->_localidad = $localidad;
    }

    public function getEstado(): EstadoCivil {
        return $this->_estado;
    }

    public function setEstado(EstadoCivil $estado): void {
        $this->_estado = $estado;
    }

    // Constructor estatico
    public static function registrarPersona(string $nombre,string $fecha_nacimiento,string $domicilio,string $localidad,
    EstadoCivil $estado): self {

        $persona = new self();

        $persona->setNombre($nombre);
        $persona->setFechaNacimiento($fecha_nacimiento);
        $persona->setDomicilio($domicilio);
        $persona->setLocalidad($localidad);
        $persona->setEstado($estado);

        return $persona;

    }

    // Metodo toString
    public function toString(): string {

        return $this->_nombre . " es una persona " . $this->_estado->descripcion() . " nacida en " . 
        $this->_fecha_nacimiento . " y que vive en " . $this->_localidad;

    }

}

?>