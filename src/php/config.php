<?php
// Conexão com o database

$usuario = 'root';
$senha = '';
$database = 'loginecadastro';
$host = 'localhost';

$mysqli = new mysqli($host, $usuario, $senha, $database);

if($mysqli->error) {
    die("Falha ao conectar ao banco de dados: " . $mysqli->error);
}
?>