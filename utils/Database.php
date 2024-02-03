<?php
namespace Utils;
class Database {
    private static $instance = null;
    private $conn;

    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $name = 'couvoiturage';

    private function __construct()
    {
        $this->conn = new \mysqli($this->host, $this->user, $this->pass, $this->name);
    }

    public static function getInstance()
    {
        if(!self::$instance)
        {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    public function query($sql)
    {
        return $this->conn->query($sql);
    }
}
