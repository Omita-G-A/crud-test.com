<?php
// Se llama bootstrap porque nos sirve de punto de partida cuando recibimos
// peticiones
// cargar la configuración
require_once 'config/config.php';
// CARGAR LIBRERÍAS una por una a mano
// require_once 'libraries/Core.php';
// require_once 'libraries/Controller.php';
// require_once 'libraries/Database.php';

// método para cargar automáticamente las librerías del core
spl_autoload_register(function $className){
    require_once 'libraries/'.$className.'.php';
}
