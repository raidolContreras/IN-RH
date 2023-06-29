<?php 

class Conexion{

  static public function conectar(){

    #PDO("nombre del servidor; nombre de la base de datos", "usuario", "contraseña")

    $link = new PDO("mysql:host=localhost;dbname=inconsulting", 
                  "ocontreras", 
                  "fjz6GG5l7ly{");

    $link->exec("set names utf8");

    return $link;

  }

}
require_once ("autoload.php");