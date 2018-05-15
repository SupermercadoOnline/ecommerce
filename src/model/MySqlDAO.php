<?php


class MySqlDAO
{

    private static $instance;

    public static function getInstance(){

        if(empty(self::$instance)){
            self::$instance = new mysqli('mysql', 'root', '', 'supermercado_online');
            self::$instance->set_charset('utf8');
        }

        return self::$instance;

    }

}