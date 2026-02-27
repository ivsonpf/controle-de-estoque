<?php 

$sevidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "estoque";

try {
    $conexao = new PDO("
    mysql:host=$servidor;
    dbname=$banco;
    charset=utf8",
    $usuario, 
    $senha);

} catch (\Throwable $erro) {
    # code...
}

?>