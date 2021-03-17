<?php
namespace Cores;
use PDO;

class Db{
    private static ?object $_instance = null;
    private PDO $_pdo;
    public function __construct()
    {
        try{
            $this->_pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASSWORD);
            $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch (\PDOException $e){
            die($e->getMessage());
        }
    }

    public static function getInstance(): object{
        if(!isset(self::$_instance)){
            self::$_instance = new Db();
        }
        return self::$_instance;
    }
}