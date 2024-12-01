<?php

namespace App\Database;

class ConnectionFactory
{

    private static $database = null;

    public static function getConnection()
    {
        if(self::$database === null)
        {
            $env = parse_ini_file($_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . ".env");            
            try {
                $database = new \PDO("mysql:host={$env['DB_HOST']};dbname={$env['DB_NAME']};charset=utf8", 
                    $env["DB_USER"], $env["DB_PASSWORD"]);                
            }
            catch(\PDOException $exception) {
                die($exception->getMessage());
            }
        }
        return $database;
    }

}