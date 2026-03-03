<?php 
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "estoque";

try {
    $conexao = new PDO("mysql:host=$servidor; dbname=$banco; charset=utf8", $usuario, $senha);

    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //echo "Conexão com bancos de dados etabelecida com sucesso!";

} catch (\Throwable $erro) {
    die("Erro ao conectar com o banco de dados: " . $erro->getMessage());
}

?>
