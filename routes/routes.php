<?php

require_once __DIR__ . '/../controller/ContatoController.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200); // Responde com status OK
    exit();
}

$controllerContato = new ContatoController();

$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = explode("/", trim($uri, "/"));

$resource = isset($path[0]) ? $path[0] : null;
$id = isset($path[1]) ? $path[1] : null;


if($resource === 'contatos'){
    
    if($method == 'GET' && !$id){
        $controllerContato->getContatos();
    }elseif($method == 'GET' && $id){
        $id = (int)$id;
        $controllerContato->getContatoById($id);
    }elseif($method == 'POST'){
        $dados = json_decode(file_get_contents("php://input"), true);
        $controllerContato->createContato($dados);
    }elseif($method =='PUT' && $id){
        $dados = json_decode(file_get_contents("php://input"), true);
        $controllerContato->updateContato($dados, $id);
    }elseif($method == 'DELETE' && $id){
        $id = (int)$id;
        $controllerContato->deleteContato($id);
    }else{
        http_response_code(404);
        echo json_encode(["erro" => "Não encontrado."]);
    }    
    
} else {
    http_response_code(404);
    echo json_encode(["erro" => "Rota não encontrada"]);
}
