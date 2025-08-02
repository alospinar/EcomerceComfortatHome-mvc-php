<?php

namespace Model;

use Intervention\Image\Colors\Hsv\Channels\Value;

class ActiveRecord {
    //base de datos
    protected static $db; 
    protected static $columnasDB =[];
    protected static $tabla = '';

    //Errores
    protected static $errores=[];
    



        //definir la conexion a la BD
    public static function setDB($database){
        self::$db=$database;
    }


    public function guardar(){
        if(!is_null($this->id)){
            //actualizar
            $this->actualizar();
        }else {
            //crear un nuveo registro
            $this->crear();
        }
    }   
    public function crear(){

        //sanitizar los datos 
        $atributos= $this->sanitizarAtributos();
        

        // Insertar en la base de datos
        $query ="INSERT INTO " . static::$tabla. " (";
        $query .=join(', ',array_keys($atributos));
        $query .=" ) VALUES (' "; 
        $query .=join("', '",array_values($atributos));
        $query .=" ') ";
        $resultado = self::$db->query($query);
        //mensaje de exito
        if($resultado){
            //redireccionar al usuario.
            
            header("Location: /admin?resultado=1");
        }

    }

    public function actualizar() {
        //sanitizar los datos 
        $atributos= $this->sanitizarAtributos();  
        $valores= [];
        foreach($atributos as $key => $value){
            $valores[]="{$key}='{$value}'";
        }  
        $query = " UPDATE " . static::$tabla. " SET ";
        $query .=  join(', ', $valores);
        $query .= "WHERE id = '". self::$db->escape_string($this->id)."' ";
        $query.= "LIMIT 1"; 

        $resultado= self::$db->query($query);
        if($resultado){
            //redireccionar al usuario.
            header("Location: /admin?resultado=2");
        }
        
    }
    //Eliminar un registro
    public function eliminar() {

        $query= " DELETE FROM " . static::$tabla. " WHERE id = ". self::$db->escape_string($this->id)." LIMIT 1";
        $resultado= self::$db->query($query);
        if($resultado){
            $this->borrarImagen();
            header('location: /admin?resultado=3');
        }
    }

    //identificar y unir los atributos de la BD
    public function atributos(){
        $atributos=[];
        foreach(static::$columnasDB as $columna){
            if($columna==='id')continue;
                $atributos[$columna]= $this->$columna;
        }
        return $atributos;
    }
        
    public function sanitizarAtributos(){
        $atributos=$this->atributos();
        $sanitizado=[];
        foreach($atributos as $key=>$value){
            $sanitizado[$key]= self::$db->escape_string($value);
        }
        return $sanitizado;
    }
    //validacion
    public static function getErrores(){
        return static::$errores;
    }

    public function validar(){
        static::$errores=[];
        return static::$errores;
    }

    public function setImagen($imagen){
        // Elimina la imagen previa
        if(!is_null($this->id)){
            $this->borrarImagen();
        }
        //asignar al atributo de imagen el nombre de la imagen
        if($imagen){
            $this->imagen=$imagen;
        }
    }
    //elimnar el archivo 
    public function borrarImagen(){
        $existeArchivo= file_exists(CARPETA_IMAGENES.$this->imagen);
        if($existeArchivo){
            unlink(CARPETA_IMAGENES.$this->imagen);
        }
    }
    //lista todas las registros
    public static function all(){
        $query= "SELECT * FROM ".static::$tabla;
        $resultado=self::consultarSQL($query);
        return $resultado;
    }
    //obtener determinado numero de registros.

    public static function get($cantidad){
        $query= "SELECT * FROM ".static::$tabla." LIMIT ".$cantidad;
        $resultado=self::consultarSQL($query);
        return $resultado;
    }

    // Busca una propiedad por su id

    public static function find($id) {
        //obtener los datos de la propiedad que vamos a actulizar
        $query = "SELECT * FROM " . static::$tabla. " WHERE id = $id";//no hay problema porque vamos a utilizar una nueva variable con esta consulta
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    public static function consultarSQL($query){
        //consultar la base de datos
        $resultado=self::$db->query($query);
        //iterar los resultados
        $array=[];
        while($registro=$resultado->fetch_assoc()){
            $array[]= static::crearObjeto($registro);
        }

        // liberar la memoria 
        $resultado->free();

        //retornar los resultados
        return $array;
    }

    protected static function crearObjeto($registro){
        $objeto = new static;
        foreach($registro as $key=>$value){
            if(property_exists($objeto,$key)){
                $objeto->$key= $value;
            }
        }

        return $objeto;   
    }

    //sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args=[]){
        foreach($args as $key => $value){
            if(property_exists($this,$key) && !is_null($value)){
                $this->$key = $value;
            }
        }
        
    }
}