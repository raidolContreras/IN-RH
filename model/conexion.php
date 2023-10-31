<?php 

class Conexion{

  static public function conectar(){

    #PDO("nombre del servidor; nombre de la base de datos", "usuario", "contraseña")

    $link = new PDO("mysql:host=localhost;dbname=u194557050_inconsulting", 
                  "u194557050_ocontreras", 
                  "fjz6GG5l7ly{");

    $link->exec("set names utf8");

    return $link;

  }

}