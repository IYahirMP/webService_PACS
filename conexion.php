<?php

class Conexion extends PDO
{
    private $hostDb = 'localhost';
    private $nombreDb = 'proyecto_daw';
    private $usuarioDb = 'ivan_daw';
    private $passwordDb = '4/YYS2Q.dMsXRtk0';

    public function __construct()
    {
        $cadena = 'mysql:host='
            . $this->hostDb
            . ';dbname='
            . $this->nombreDb
            . ';port=3308'
            . ';charset=utf8';
        try {
            parent::__construct($cadena, $this->usuarioDb, $this->passwordDb, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (PDOException $e) {
            echo 'Error' . $e->getMessage();
            exit;
        }
    }
}
