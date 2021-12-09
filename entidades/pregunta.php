<?php
require_once("tematica.php");
require_once("respuesta.php");

class Pregunta implements JSONSerializable{
    private $id;
    private $enunciado;
    private $imagen;
    private $tematica;
    private $respuestas;

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

    public function __construct($enunciado, $imagen, $tematica){
        $this->enunciado = $enunciado;
        $this->imagen = $imagen;
        $this->tematica = $tematica;
    }

    public function jsonSerialize(){
        return[
            'id' => $this->id,
            'enunciado' => $this->enunciado,
            'imagen' =>  $this->imagen,
            'tematica' =>  $this->tematica,
            'respuestas' =>  $this->respuestas
        ];
    }
}


