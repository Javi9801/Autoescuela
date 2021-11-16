<?php
class Usuario{
    private $id;
    private $email;
    private $nombre;
    private $apellidos;
    private $password;
    private $fecha_nacimiento;
    private $rol;
    private $foto;
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

    public function __construct($id, $email, $nombre, $apellidos, $password, $fecha_nacimiento, $rol, $foto, $activo){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->correo = $correo;
        $this->password = $password;
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->rol = $rol;
        $this->foto = $foto;
        $this->activo = $activo;
    }
}
