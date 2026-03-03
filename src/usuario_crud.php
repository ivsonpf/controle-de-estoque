<?php 

function buscarUsuario(PDO $conexao)
{
   
$sql = "SELECT id, nome, email FROM usuarios ORDER BY nome ";
$consulta = $conexao-> prepare($sql);
$consulta->execute();
return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

?>