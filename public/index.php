<?php

require_once __DIR__. "/../includes/app.php";

use Controllers\CarritoController;
use Controllers\Logincontroller;
use MVC\Router;
use Controllers\PropiedadController;

use Controllers\PaginaController;



$router = new Router();
//ZONA PRIVADA
$router->get('/admin', [PropiedadController::class,'index']);
$router->get('/propiedades/crear',[PropiedadController::class,'crear']);
$router->post('/propiedades/crear',[PropiedadController::class,'crear']);
$router->get('/propiedades/actualizar',[PropiedadController::class,'actualizar']);
$router->post('/propiedades/actualizar',[PropiedadController::class,'actualizar']);
$router->post('/propiedades/eliminar',[PropiedadController::class,'eliminar']);


//ZONA PUBLICA
$router->get('/',[PaginaController::class,'index']);
$router->get('/nosotros',[PaginaController::class,'nosotros']);
$router->get('/propiedades',[PaginaController::class,'propiedades']);
$router->get('/propiedad',[PaginaController::class,'propiedad']);
$router->get('/contacto',[PaginaController::class,'contacto']);
$router->post('/contacto',[PaginaController::class,'contacto']);
$router->get('/envio',[PaginaController::class,'envio']);
$router->post('/envio',[PaginaController::class,'envio']);

//Login y Autenticacion

$router->get('/login',[Logincontroller::class,'login']);
$router->post('/login',[Logincontroller::class,'login']);
$router->get('/logout',[Logincontroller::class,'logout']);
/* $router->get('/crear',[Logincontroller::class,'crear']);
$router->post('/crear',[Logincontroller::class,'crear']); */

$router->get('/carrito', [CarritoController::class, 'index']);

$router->comprobarRutas();
