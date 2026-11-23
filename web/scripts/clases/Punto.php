<?php

class Punto
{
    //constantes
    public const COLORES = [
        "black" => ["nombre" => "negro", "rgb" => [0, 0, 0]],
        "red" => ["nombre" => "rojo", "rgb" => [255, 0, 0]],
        "blue" => ["nombre" => "azul", "rgb" => [0, 0, 255]],
        "green" => ["nombre" => "verde", "rgb" => [0, 128, 0]],
        "yellow" => ["nombre" => "amarillo", "rgb" => [255, 255, 0]]
    ];

    public const GROSORES = [
        1 => "fino",
        2 => "medio",
        3 => "grueso"
    ];

    //propiedades
    private int $x;
    private int $y;
    private string $color;
    private int $grosor;

    //constructor
    public function __construct($x, $y, $color, $grosor)
    {
        if (!$this->setX($x))
        {
            throw new Exception("Coordenada X incorrecta");
        }

        if (!$this->setY($y))
        {
            throw new Exception("Coordenada Y incorrecta");
        }

        if (!$this->setColor($color))
        {
            throw new Exception("Color incorrecto");
        }

        if (!$this->setGrosor($grosor))
        {
            throw new Exception("Grosor incorrecto");
        }
    }

    //setters
    public function setX($x): bool
    {
        if (is_int($x) && $x >= 0 && $x <= 20000)
        {
            $this->x = $x;
            return true;
        }

        return false;
    }

    public function setY($y): bool
    {
        if (is_int($y) && $y >= 0 && $y <= 20000)
        {
            $this->y = $y;
            return true;
        }

        return false;
    }

    public function setColor($color): bool
    {
        if (is_string($color) && array_key_exists($color, self::COLORES))
        {
            $this->color = $color;
            return true;
        }

        return false;
    }

    public function setGrosor($grosor): bool
    {
        if (is_int($grosor) && array_key_exists($grosor, self::GROSORES))
        {
            $this->grosor = $grosor;
            return true;
        }

        return false;
    }

    //getters
    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function getGrosor(): int
    {
        return $this->grosor;
    }
}
