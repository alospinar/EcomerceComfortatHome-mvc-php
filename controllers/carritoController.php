<?php

namespace Controllers;

use MVC\Router;

class CarritoController {
    public static function index(Router $router) {
        $router->render('paginas/carrito', [
            'titulo' => 'Carrito de Compras'
        ]);
    }
}
