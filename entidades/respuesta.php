<?php

class Respuesta{
    private $id;
    private $enunciado;
    private $id_pregunta;

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

    public function __construct($enunciado, $id_tematica){
        $this->enunciado = $enunciado;
        $this->id_tematica = $id_tematica;
    }
}


