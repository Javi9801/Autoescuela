<?php

class Respuesta implements JSONSerializable{
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

    public function __construct($enunciado, $id_pregunta){
        $this->enunciado = $enunciado;
        $this->id_pregunta = $id_pregunta;
    }

    public function jsonSerialize(){
        return [
            'id' => $this->id,
            'enunciado' => $this->enunciado,
            'id_pregunta' => $this->id_pregunta
        ];
    }
}


