<?php
class Examen{
    private $id;
    private $descripcion;
    private $n_preguntas;
    private $duracion;
    private $activo;


    public function __get($atributo){
        if(property_exists($this, $atributo)){
            return $this->$atributo;
        }
    }

    public function __set($atributo, $valor){
        if(property_exists($this, $atributo)){
            $this->$atributo = $valor;
        }
    }

    public function __construct($descripcion, $n_preguntas, $duracion, $activo){
        $this->descripcion = $nombre;
        $this->n_preguntas = $n_preguntas;
        $this->duracion = $duracion;
        $this->activo = $activo;
    }
}