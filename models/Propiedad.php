<?php

namespace Model;

class Propiedad extends ActiveRecord{
    protected static $tabla='productos';
    protected static $columnasDB =['id','titulo','precio','precio_Descuento','imagen','descripcion','tipo'];
    public $id;
    public $titulo;
    public $precio;
    public $precio_Descuento;
    public $imagen;
    public $descripcion;
    public $tipo;


    public function __construct($args=[]){
        $this->id=$args['id'] ?? null;
        $this->titulo=$args['titulo'] ??'';
        $this->precio=$args['precio'] ??'';
        $this->precio_Descuento=$args['precio_Descuento'] ??'';
        $this->imagen=$args['imagen'] ??'';
        $this->descripcion=$args['descripcion'] ??'';
        $this->tipo=$args['tipo'] ??'';
    }
    public function validar(){
        if(!$this->titulo){
            self::$errores[] = "Debes añadir un titulo";
        };
        if(!$this->precio){
            self::$errores[] = "El precio es obligatorio";
        };
        if(!$this->precio_Descuento){
            self::$errores[] = "El precio de descuento es obligatorio";
        };
        if(strlen($this->descripcion) < 50){
            self::$errores[] = "La descripcion es obligatoria y debe tener al menos 50 caracteres";
        };
        if(!$this->tipo){
            self::$errores[] = "Debes añadir un tipo";
        };


        if(!$this->imagen){
            self::$errores[] = 'La imagen es Obligatoria ';
        };


        return self::$errores;
    }
}
