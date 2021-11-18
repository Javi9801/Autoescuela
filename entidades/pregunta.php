<?php

class Pregunta{
    private $id;
    private $enunciado;
    private $imagen;
    private $id_tematica;

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

    public function __construct($enunciado, $imagen, $id_tematica){
        $this->enunciado = $enunciado;
        $this->imagen = $imagen;
        $this->id_tematica = $id_tematica;
    }
}


