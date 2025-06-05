<?php

namespace Source\Core;

use \PDO;
use \PDOException;

class Connect
{
    private const HOST = '127.0.0.1';
    private const NAME = 'indiehub';      
    private const USER = 'root';
    private const PASS = '123';
              

    public static function getInstance(): PDO
    {
        try {
            $dsn = "mysql:host=" . self::HOST . ";dbname=" . self::NAME;
            $options = [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ];
            return new PDO($dsn, self::USER, self::PASS, $options);
        } catch (PDOException $e) {
          
            die("Não foi possível conectar ao banco de dados. Verifique as credenciais em Connect.php.");
        }
    }
}
