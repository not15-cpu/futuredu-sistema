<?php

class Model
{
    protected $db;

    public function __construct()
    {
        try {
            $this->db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST, DB_USER, DB_PASS);
        } catch (PDOException $e) {
            echo "Falha de Conexão: " . $e->getMessage();
        }
    }
}
