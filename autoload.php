<?php
spl_autoload_register(function($className) {
    //var_dump($className);
    $ruta = "src\\".$className.'.php';
    $ruta = str_replace("\\", "/", $ruta);
    require_once $ruta;
} );


