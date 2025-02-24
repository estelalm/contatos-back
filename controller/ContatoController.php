<?php

require_once __DIR__ . '/../model/DAO/ContatoDao.php';

class ContatoController {

    private $contatoDao;

   public function __construct() {
        $this->contatoDao = new ContatoDao();
    }

    public function getContatos(){
        try{

            $contatos = $this->contatoDao->selectContatos();
            if (empty($contatos)) { 
                echo json_encode(["mensagem" => "Nenhum contato encontrado."]);
                http_response_code(404);
                exit;
            }else{
                echo json_encode($contatos);
                http_response_code(200);
            }

        } catch(Exception $e){
            echo json_encode(["erro" => "Não foi possivel processar a requisição, devido ao um erro na camada de negócio/controle da aplicação. Contate o administrador da API."]);
            http_response_code(500);
        }
    }

    public function getContatoById($id){

        try{

            if(!isset($id) || !filter_var($id, FILTER_VALIDATE_INT)){
                echo json_encode(["erro" => "O ID enviado é inválido."]);
                http_response_code(400);
            }else{
                
                $contato = $this->contatoDao->selectContatoById($id);
                
                if (empty($contato)) { 
                    echo json_encode(["mensagem" => "Nenhum contato encontrado."]);
                    http_response_code(404);
                }else{
                    echo json_encode($contato);
                    http_response_code(200);
                }

            }
        }catch(Exception $e){
            echo json_encode(["erro" => "Não foi possivel processar a requisição, devido ao um erro na camada de negócio/controle da aplicação. Contate o administrador da API."]);
            http_response_code(500);
        }
    }

    public function createContato($dados){

        try{
            if( empty($dados['nome']) || strlen($dados['nome']) > 150 
            || empty($dados['email']) || strlen($dados['email']) > 150 
            || empty($dados['profissao']) || strlen($dados['profissao']) > 100 
            || empty($dados['celular']) || strlen($dados['celular']) !== 11 
            || empty($dados['data_nascimento']) || strlen($dados['data_nascimento']) != 10
            || !isset($dados['enviar_email']) || !isset($dados['enviar_sms']) || !isset($dados['possui_whatsapp'])
            || (!empty($dados['telefone']) && strlen($dados['telefone']) !== 10)){

                echo json_ENCODE(["erro" => "Os dados enviados na requisição são inválidos"]);
                http_response_code(400);
                return false;
            }else{
                
                if($this->contatoDao->insertContato($dados)){
                    echo json_encode(["mensagem" => "Contato criado com sucesso"]);
                    http_response_code(200);
                }else{
                    echo json_encode(["erro" => "Não foi possivel processar a requisição, devido ao um erro no acesso ao banco de dados. Contate o administrador da API"]);
                    http_response_code(500);
                }
            }

    }catch(Exception $e){
            echo json_encode(["erro" => "Não foi possivel processar a requisição, devido ao um erro na camada de negócio/controle da aplicação. Contate o administrador da API."]);
            http_response_code(500);
        }    
    }

    public function updateContato($dados, $id){

        
        try{
            if(!isset($id) || !filter_var($id, FILTER_VALIDATE_INT)){

                echo json_ENCODE(["erro" => "O ID enviado é inválido."]);
                http_response_code(400);

            }elseif(empty($dados['nome']) || strlen($dados['nome']) > 150 
            || empty($dados['email']) || strlen($dados['email']) > 150 
            || empty($dados['profissao']) || strlen($dados['profissao']) > 100 
            || empty($dados['celular']) || strlen($dados['celular']) !== 11 
            || empty($dados['data_nascimento']) || strlen($dados['data_nascimento']) != 10
            || !isset($dados['enviar_email']) || !isset($dados['enviar_sms']) || !isset($dados['possui_whatsapp'])
            || (!empty($dados['telefone']) && strlen($dados['telefone']) !== 10)){

                echo json_ENCODE(["erro" => "Os dados enviados na requisição são inválidos"]);
                http_response_code(400);
                return false;

            }else{

                if($this->contatoDao->updateContato($dados, $id)){
                    echo json_encode(["mensagem" => "Contato atualizado com sucesso"]);
                    http_response_code(200);
                }else{
                    echo json_encode(["erro" => "Não foi possivel processar a requisição, devido ao um erro no acesso ao banco de dados. Contate o administrador da API"]);
                    http_response_code(500);
                }

            }

        }catch(Exception $e){
            echo json_encode(["erro" => "Não foi possivel processar a requisição, devido ao um erro na camada de negócio/controle da aplicação. Contate o administrador da API."]);
            http_response_code(500);
        }
    }

    public function deleteContato($id){

        try{

            if(!isset($id) || !filter_var($id, FILTER_VALIDATE_INT)){
                echo json_encode(["erro" => "O ID enviado é inválido."]);
                http_response_code(400);
            }else{
                if($this->contatoDao->deleteContato($id)){
                    echo json_encode(["mensagem" => "Contato excluído com sucesso"]);
                    http_response_code(200);
                }else{
                    echo json_encode(["erro" => "Não foi possivel processar a requisição, devido ao um erro no acesso ao banco de dados. Contate o administrador da API"]);
                    http_response_code(500);
                }
            }

        }catch(Exception $e){
            echo json_encode(["erro" => "Não foi possivel processar a requisição, devido ao um erro na camada de negócio/controle da aplicação. Contate o administrador da API."]);
            http_response_code(500);
        }
    }

}

