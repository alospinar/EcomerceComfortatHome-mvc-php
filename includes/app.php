<?php

use Dotenv\Dotenv;
use Model\ActiveRecord;
require __DIR__."/../vendor/autoload.php";
$dotenv= Dotenv::createImmutable(__DIR__);
$dotenv->SafeLoad();
require "funciones.php";
require "database.php";


//conectarnos a la bases de datos
$db=conectarDB();


ActiveRecord::setDB($db);