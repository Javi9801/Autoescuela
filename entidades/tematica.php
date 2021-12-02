<?php
class Tematica implements JSONSerializable{
    private $id;
    private $descripcion;

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

    public function __construct($descripcion){
        $this->descripcion = $descripcion;
    }

    public function jsonSerialize(){
        return[
            'id' => $this->id,
            'descripcion' => $this->descripcion
        ];
    }


}