<?php
namespace MVC;
class Router {
    
    public $rutaGET = [];
    public $rutaPOST = [];

    public function get($url,$fn){
        $this->rutaGET[$url]=$fn;

    }
    public function post($url,$fn){
        $this->rutaPOST[$url]=$fn;

    }

    public function comprobarRutas(){
        
        session_start();

        $auth= $_SESSION['login']?? null;
        //arreglo de rutas protegidas...
        $rutas_protegidas= ['/admin','/propiedades/crear','/propiedades/actualizar','/propiedades/eliminar','/vendedores/crear','/vendedores/actualizar','/vendedores/eliminar'];

        
        
        $urlActual = strtok($_SERVER['REQUEST_URI'], '?') ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        if($metodo ==='GET'){
            $fn= $this->rutaGET[$urlActual]?? null ;
        }else{
            $fn= $this->rutaPOST[$urlActual]?? null ;
        }

        //proteger las rutas

        if(in_array($urlActual,$rutas_protegidas)&& !$auth){
            header('location: /');
        }

        if($fn){
            // la URL existe y hay una funcion asociada
            call_user_func($fn,$this);
        }else {
            echo 'Pagina no Encontrada';
        }

    }
    // Muestra una vista

    public function render($view,$datos=[]){
        foreach($datos as $key => $value){
            $$key= $value;//$$ significa variable de variable
        }

        $viewName = basename($view);
        if ($viewName === "cuadrosgobelinos") {
            include __DIR__."/views/$view.php";
        } else {
            ob_start();//almacenando en memoria durante un momento...
            include __DIR__. "/views/$view.php";
            $contenido = ob_get_clean();//limpia el buffer
            include __DIR__."/views/layout.php";
        }
    }
}