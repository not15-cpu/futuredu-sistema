<?php

// No PHP, a função define() é usada para criar constantes, ou seja, valores que não podem ser alterados durante a execução do script. Ela permite que você associe um nome a um valor fixo que será acessível globalmente.
define("URL_BASE", "http://localhost/sistema-escola/public/");
define("APP_URL", 'http://localhost/futuredu/public/');
//Configurações do Banco de Dados
define('DB_HOST', 'br61-cp.valueserver.com.br');
define('DB_NAME', 'alve6465_giovani_n');
define('DB_USER', 'alve6465_frontdev');
define('DB_PASS', 'Tipi03@123');


define('EMAIL_HOST', 'smtp.hostinger.com.br');
define('EMAIL_PORT', '465');
define('EMAIL_USER', 'verification@conexusnet.org');
define('EMAIL_PASS', 'sadboy9823231299A#');


//Sistemas de carregamento automatico de class
spl_autoload_register(function ($class) {

    if (file_exists('../app/controllers/' . $class . '.php')) {
                           //'../app/controllers/HomeController.php'
        require_once '../app/controllers/' . $class . '.php';
    }

    if(file_exists('../app/models/'. $class . '.php')){
        require_once '../app/models/'. $class . '.php';
    }

    if(file_exists('../routes/'. $class . '.php')){
        require_once '../routes/'. $class . '.php';
    }

});
