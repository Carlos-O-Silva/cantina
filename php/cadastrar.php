<?php
session_start();
$usu_nome     = filter_input(INPUT_POST, 'nome',     FILTER_DEFAULT);
$usu_login    = filter_input(INPUT_POST, 'email',    FILTER_DEFAULT);
$usu_telefone = filter_input(INPUT_POST, 'telefone', FILTER_DEFAULT);
$usu_senha    = filter_input(INPUT_POST, 'senha',    FILTER_DEFAULT);


include '../php/conexao.php';


$sth = $db->prepare("INSERT INTO usuario ( usu_nome, usu_login, usu_telefone, usu_senha) VALUES (:nome, :email, :telefone, :senha)");

$sth->bindValue (":nome",     $usu_nome);  
$sth->bindValue (":email",    $usu_login);
$sth->bindValue (":telefone", $usu_telefone);
$sth->bindValue (":senha",    $usu_senha);

$sth->execute();

// Onde o usuario irá apos ser cadastrado
echo "<script>alert('Usuário cadastrado com sucesso!');
        window.location.href = '../login/index.php';
    </script>"

?>