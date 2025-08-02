<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginaController{
    public static function index(Router $router){
        
        $propiedades= Propiedad::get(9);
        $inicio = true;

        $router->render('paginas/index',[
            'propiedades'=>$propiedades,
            'inicio'=> $inicio
        ]);
    }
    public static function nosotros(Router $router){

        $router->render('paginas/nosotros');
    }
    public static function propiedades(Router $router){
        
        $propiedades= Propiedad::all();
        
        $router->render('paginas/propiedades',[
            'propiedades'=>$propiedades

        ]);
    }
    public static function propiedad(Router $router){

        $id=validarORedireccionar('/propiedades');

        //buscar la propiedad por su id
        $propiedad= Propiedad::find($id);

        $router->render('paginas/propiedad',[
            'propiedad'=>$propiedad
        ]);
    }

    public static function contacto(router $router){
        $mensaje = null;
        
        if($_SERVER['REQUEST_METHOD']==='POST'){
            /* debuguear($_POST); */
            $respuestas = $_POST['contacto'];

            //crear una instancia de PHPmailer
            $mail = new PHPMailer();

            //configurar SMTP
            $mail->isSMTP();
            $mail->Host = $_ENV['EMAIL_HOST'];
            $mail->SMTPAuth = true;
            $mail->Port = $_ENV['EMAIL_PORT'];
            $mail->Username = $_ENV['EMAIL_USER'];
            $mail->Password = $_ENV['EMAIL_PASS'];
            $mail->SMTPSecure='tls';

            //configurar el contenido del mail

            $mail-> setFrom('PedidosHome@comforth.shop');
            $mail->addAddress('PedidosHome@comforth.shop');
            $mail->Subject='Tiene un nuevo mensaje ';

            //habilitar HTML

            $mail->isHTML(true);
            $mail->CharSet='UTF-8';

            //define el contenido
            $contenido='<html> ';
            $contenido .= '<p> Tiene un nuevo Mensaje</p>';
            $contenido .= '<p> nombre: '. $respuestas['nombre'] .' </p>';


            //enviar de forma condicional  algunhos campos de email o telefono
            if($respuestas['contacto']==='telefono'){
                $contenido.= '<p>Eligio ser contactado por Telefono: </p>';
                $contenido .= '<p> Telefono: '. $respuestas['telefono'] .' </p>';
                $contenido .= '<p> Fecha de contacto: '. $respuestas['fecha'] .' </p>';
                $contenido .= '<p> Hora: '. $respuestas['hora'] .' </p>';
            } else {
                //es email, entonces agregamos el campo de email
                $contenido.= '<p>Eligio ser contactado por email: </p>';
                $contenido .= '<p> email: '. $respuestas['email'] .' </p>';
            }

            
            $contenido .= '<p> mensaje: '. $respuestas['mensaje'] .' </p>';
            $contenido .= '<p> Nombre del producto : '. $respuestas['producto'] .' </p>';
/*             $contenido .= '<p> Prefiere ser contactado por: '. $respuestas['contacto'] .' </p>'; */
            
            $contenido.= '</html>';

            $mail->Body =$contenido;
            $mail->AltBody =' ESTO ES TEXTO alternativo sin HTML';


            //enviar el email

            if($mail->send()){
                $mensaje= 'mensaje enviado correctamente';
            } else{
                $mensaje= 'el mensaje no se pudo enviar...';
            }
        }
        
        $router->render('/paginas/contacto',[
            'mensaje'=>$mensaje
        ]);
    }
    public static function envio(router $router){
        $mensaje = null;
        if($_SERVER['REQUEST_METHOD']==='POST'){
            /* debuguear($_POST); */
            $respuestas = $_POST['contacto'];

            //crear una instancia de PHPmailer
            $mail = new PHPMailer();

            //configurar SMTP
            $mail->isSMTP();
            $mail->Host = $_ENV['EMAIL_HOST'];
            $mail->SMTPAuth = true;
            $mail->Port = $_ENV['EMAIL_PORT'];
            $mail->Username = $_ENV['EMAIL_USER'];
            $mail->Password = $_ENV['EMAIL_PASS'];
            $mail->SMTPSecure='tls';
            //este codigo se utiliza para hacer pruebas con brevo, ya que es localhost , luego se quita cuando se suba a la pagina
            /* $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            ); */

            //configurar el contenido del mail
            $numero_aleatorio = mt_rand(100000, 999999);
            $mail-> setFrom('PedidosHome@comforth.shop');
            $mail->addAddress('PedidosHome@comforth.shop');
            $mail->Subject='Tiene un nuevo pedido #'.$numero_aleatorio;

            //habilitar HTML

            $mail->isHTML(true);
            $mail->CharSet='UTF-8';

            //define el contenido
            $contenido='<html> ';
            $contenido .= '<p> Tiene un nuevo Pedido #'.$numero_aleatorio.'</p>';
            $contenido .= '<p> nombre del Cliente: '. $respuestas['nombre'] .' </p>';


            //enviar de forma condicional  algunhos campos de email o telefono
            
            $contenido .= '<p> documento C.C.: '. $respuestas['cedula'] .' </p>';
            $contenido .= '<p> número de celular: '. $respuestas['celular'] .' </p>';
            $contenido .= '<p> Destino del envió :'. $respuestas['ciudad'] .', Departamento:'.$respuestas['departamento'].' </p>';
            $contenido .= '<p> Dirección detallada : '. $respuestas['direccion'] .' </p>';
            

            if (!empty($respuestas['productos'])) {
                $productos = json_decode($respuestas['productos'], true);
                if (is_array($productos)) {
                    $contenido .= "<h3>Productos del carrito:</h3><ul>";
                    foreach ($productos as $producto) {
                        $contenido .= "<li>";
                        $contenido .= "Nombre: " . htmlspecialchars($producto['nombre']) . "<br>";
                        $contenido .= "Cantidad: " . intval($producto['cantidad']) . "<br>";
                        $contenido .= "Precio: $" . number_format($producto['precio'], 0, ',', '.') . " COP <br>";
                        $contenido .= "</li>";
                        }
                    $contenido .= "</ul>";
                }
                $contenido.= 'Total: $ '.htmlspecialchars($respuestas['total_final'])." COP <br>";
                $contenido.= 'Descuento Aplicado: $ '.htmlspecialchars($respuestas['descuento_aplicado'])." COP <br>";
                $contenido.= '</html>';

                $mail->Body =$contenido;
                $mail->AltBody =' ESTO ES TEXTO alternativo sin HTML';
                if($mail->send()){
                    $mensaje= 'mensaje enviado correctamente';

                } else{
                    $mensaje= 'el mensaje no se pudo enviar...';
                }
            } else{
                $mensaje= 'el mensaje no se pudo enviar...';
            }
            //enviar el email

            
            
        }
        
        $router->render('/paginas/envio',[
            'mensaje'=>$mensaje
        ]);
        
    }
}