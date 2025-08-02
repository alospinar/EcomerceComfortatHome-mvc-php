<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager ;


class PropiedadController{
    public static function index(Router $router){
        
        $propiedades = Propiedad::all();

        
        //muestra mensaje condicional
        $resultado = $_GET['resultado']?? null;



        $router->render('propiedades/admin',[
            'propiedades'=>$propiedades,
            'resultado'=>$resultado,
            
        ]);

    }

    public static function crear(Router $router){
        $propiedad=  new Propiedad;
        
        //Arreglo con mensajes de errores
        $errores = Propiedad::getErrores();

        if($_SERVER['REQUEST_METHOD']==='POST'){

            $propiedad= new Propiedad($_POST['propiedad']);

            //Generar un nombre unico
            $nombreImagen = md5(uniqid(rand(),true)).".jpg";
            if($_FILES['propiedad']['tmp_name']['imagen']){
                $manager= new ImageManager(Driver::class);
                $imagen = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])
                 ->resize(800, 600, function ($constraint) {
                     $constraint->aspectRatio(); // mantiene la relación de aspecto
                     $constraint->upsize();      // evita que se agrande si es más pequeña
                 });
                $propiedad->setImagen($nombreImagen);
            }
            $errores= $propiedad->validar();
            
            //Revisar que el array de errores este vacio
            if(empty($errores)){

        
                /* SUBIDA DE ARCHIVOS */

                if(!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                };
                //le tengo que dar permiso a la carpeta imagenes
                chmod(CARPETA_IMAGENES, 0777);
                //guardar la imagen en el servidor
                $imagen->save(CARPETA_IMAGENES . $nombreImagen);
                
                $propiedad->guardar();
                    

            }
            
        }
        $router->render('propiedades/crear',[
            'propiedad'=>$propiedad,
            
            'errores'=>$errores
        ]);
    }

    public static function actualizar(Router $router){
        $id= validarORedireccionar('/admin'); 
       
        $propiedad= Propiedad::find($id);

        

        $errores = Propiedad::getErrores();
        //metodo post actualizar
        //Ejucutar el codigo despues de que el usuario envia el formulario
        if($_SERVER['REQUEST_METHOD']==='POST'){

            //asignar los atributos
            $args=$_POST['propiedad'];
            $propiedad->sincronizar($args);
            //validacion
            $errores = $propiedad->validar();

            // subida del archivos

            //genera un nombre unico 
            $nombreImagen = md5(uniqid(rand(),true)).".jpg";
            if($_FILES['propiedad']['tmp_name']['imagen']){
                $manager= new ImageManager(Driver::class);
                $imagen = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])
                 ->resize(800, 600, function ($constraint) {
                     $constraint->aspectRatio(); // mantiene la relación de aspecto
                     $constraint->upsize();      // evita que se agrande si es más pequeña
                 });
                $propiedad->setImagen($nombreImagen);
            }
            //Revisar que el array de errores este vacio
            if(empty($errores)){
                if($_FILES['propiedad']['tmp_name']['imagen']){
                    //alacenar la imagen
                    chmod(CARPETA_IMAGENES, 0777);
                    $imagen->save(CARPETA_IMAGENES . $nombreImagen);
                // Insertar en la base de datos\
                }
                $propiedad->guardar();
            }
            
        }
        
        $router->render('propiedades/actualizar',[
            'propiedad'=> $propiedad,
            'errores'=>$errores,
            
        ]);
    }

    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD']==='POST'){
            
            //validar ID
            $id= $_POST['id'];
            $id= filter_var($id,FILTER_VALIDATE_INT);

            if($id){
                $tipo=$_POST['tipo'];
                if(validarTipoContenido($tipo)){
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();

                }
            }
        }
    }
    
}