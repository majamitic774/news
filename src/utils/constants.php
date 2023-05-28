<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(dirname(__FILE__))));
define('SRC', dirname(dirname(__FILE__)));
define('CORE', SRC . DS . 'Core');
define('VIEWS', SRC . DS . '..' . DS . 'public' . DS . 'views' . DS);
define('VENDOR', SRC . DS . '..' . DS . 'vendor' . DS);

require_once VENDOR . 'vlucas/phpdotenv/src/Dotenv.php';
require_once VENDOR . 'autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(ROOT);
$dotenv->load();

$serverIPaddress = $_ENV['SERVER_IP_ADDRESS'];

define('BASE_URL', "http://$serverIPaddress:8005/");
define('STORAGE', ROOT . DS . 'public' . DS . 'storage' . DS);
