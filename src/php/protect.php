<?php
// Verifica a sessão, caso usuário esteja logado, poderá acessar a página, caso não, deverá voltar a página de login

if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION['id'])) {
    die("Você não pode acessar essa página sem estar logado!<p><a href=\"../index.php\">Entrar</a></p>");
}
?>