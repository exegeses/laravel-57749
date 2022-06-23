<?php

class Conexion
{
    private static $link;

    private function __construct()
    {} // impedimos instanciar la clase

    static function conectar()
    {
        // si no hay una conexion
        if( !isset( self::$link ) ){
            //creamos la conexion
            self::$link = new PDO(
                'mysql:host=localhost;dbname=agencia',
                'root',
                'root'
            );
        }

        return self::$link;
    }

}