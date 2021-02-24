<?php
 
 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);
 
 require "Config/Autoload.php";
 require "Config/Config.php";

 use Config\Autoload as Autoload;
 use Config\Router as Router;
 use Config\Request as Request;
     
 Autoload::start();

 header('Cache-Control: no cache'); //Evita el error de cache por reenvío de formulario
 
 session_start();

 Router::Route(new Request());

?>