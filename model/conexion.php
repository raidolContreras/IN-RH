<?php 

class Conexion{

  static public function conectar(){

    #PDO("nombre del servidor; nombre de la base de datos", "usuario", "contraseña")

    $link = new PDO("mysql:host=localhost;dbname=inrh", 
                  "root", 
                  "");

    $link->exec("set names utf8");

    return $link;

  }

}

require_once($_SERVER['DOCUMENT_ROOT'].'/IN-RH/assets/vendor/autoload.php'); //Cambiar en el servidor /IN-RH/assets/vendor/autoload.php, por /assets/vendor/autoload.php