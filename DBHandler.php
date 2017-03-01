<?php

class Db
{
    private static $instance = NULL;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    private static $user = 'root';
    private static $password = 'root';
    private static $db = 'restaurant_calendar';
    private static $host = 'localhost';
    private static $port = 3306;

    /*
    getConnectoin
    */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = mysqli_connect(self::$host, self::$user, self::$password, self::$db);
            // if (mysqli_connect_errno()) {
            //     printf("Connect failed:%s\n",mysqli_connect_error());
            //     exit();
            // }
        }
        return self::$instance;
    }

   }
