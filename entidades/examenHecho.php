<?php
class ExamenHecho{
    private $id;
    private $id_examen;
    private $id_alumno;
    private $fecha;
    private $calificacion;
    private $ejecucion;


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

    public function __construct($id_examen, $id_alumno, $fecha, $calificacion, $ejecucion){
        $this->id_examen = $id_examen;
        $this->id_alumno = $id_alumno;
        $this->fecha = $fecha;
        $this->calificacion = $calificacion;
        $this->ejecucion = $ejecucion;
    }
}