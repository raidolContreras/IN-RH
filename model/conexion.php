<?php 

class Conexion {
    static public function conectar() {
        $dsn = "mysql:host=193.203.166.24;dbname=u194557050_inconsulting;charset=utf8";
        $username = "u194557050_ocontreras";
        $password = "fjz6GG5l7ly{";

        try {
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_TIMEOUT => 10 // Tiempo de espera de 10 segundos
            ];
            $link = new PDO($dsn, $username, $password, $options);
            return $link;
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}
