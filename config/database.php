<?php

class Database {

    private $host = 'localhost';
    private $db = 'contatos_db';
    private $port = 3306;
    private $user = '';
    private $pass = '';
    
    public function getConnection(){
        try {
            $pdo = new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->db;charset=utf8", $this->user, $this->pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;
        } catch(PDOException $e) {
            echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
            exit;
        }   
    }
}
