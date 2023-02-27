<?php
session_start();
$usu_login = filter_input(INPUT_POST, 'email', FILTER_DEFAULT);
$usu_senha = filter_input(INPUT_POST, 'senha', FILTER_DEFAULT);

include '../php/conexao.php';

$sth = $db->prepare("SELECT * FROM usuario WHERE usu_login = :email AND usu_senha = :senha");

$sth->bindValue(":email", $usu_login);
$sth->bindValue (":senha", $usu_senha);
$sth->execute();

$num = $sth->rowCount();
$rs = $sth->fetch(PDO::FETCH_OBJ);

if ($num > 0) {
    $_SESSION['email'] = $rs->usu_login;
    $_SESSION['senha'] = $rs->usu_senha;
    $_SESSION['usu_id'] = $rs->usu_id;

    header("LOCATION: ../home/index.php");

} else {
    ?>
    <script>alert("Login ou senha errados!");
        window.location.href = "../login/index.php";
    </script>
    <?php

}

