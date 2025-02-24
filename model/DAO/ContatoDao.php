<?php

require_once __DIR__ . '/../../config/database.php';

class ContatoDao {

    private $connection;

    public function __construct() {
        $database = new Database();
        $this->connection = $database->getConnection();
    }

    public function selectContatos() {

        $query = "SELECT * FROM tbl_contato";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectContatoById($id){
        $query = "SELECT * FROM tbl_contato WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertContato($dados){
        $query = "INSERT INTO tbl_contato (nome, email, data_nascimento, celular, profissao, telefone, enviar_sms, enviar_email, possui_whatsapp) VALUES 
                  (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connection->prepare($query);

        $enviar_sms = $dados['enviar_sms'] ? 1 : 0;
        $enviar_email = $dados['enviar_email'] ? 1 : 0;
        $possui_whatsapp = $dados['possui_whatsapp'] ? 1 : 0;

        $telefone = !empty($dados['telefone']) ? $dados['telefone'] : null;

        return $stmt->execute([$dados['nome'], $dados['email'], $dados['data_nascimento'], $dados['celular'], $dados['profissao'], $telefone, $enviar_sms, $enviar_email, $possui_whatsapp]);
    }

    public function updateContato($dados, $id){
        $query = "UPDATE tbl_contato SET
                    nome = ?,
                    email = ?,
                    data_nascimento = ?,
                    celular = ?,
                    profissao = ?,
                    telefone = ?,
                    enviar_sms = ?,
                    enviar_email = ?,
                    possui_whatsapp = ?
                    WHERE id = ?";

        $stmt = $this->connection->prepare($query);
        
        $enviar_sms = $dados['enviar_sms'] ? 1 : 0;
        $enviar_email = $dados['enviar_email'] ? 1 : 0;
        $possui_whatsapp = $dados['possui_whatsapp'] ? 1 : 0;

        return $stmt->execute([$dados['nome'], $dados['email'], $dados['data_nascimento'], $dados['celular'], $dados['profissao'], $dados['telefone'], $enviar_sms, $enviar_email, $possui_whatsapp, $id]);
    }

    public function deleteContato($id){
        $query = "DELETE from tbl_contato WHERE id = ?";
        $stmt = $this->connection->prepare($query);

        return $stmt->execute([$id]);
    }

}   