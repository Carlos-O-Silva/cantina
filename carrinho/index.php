<?php
session_start();
include '../php/conexao.php';
$page = isset($_GET['page']) && file_exists($_GET['page'] . '.php') ? $_GET['page'] : '../home/index';
include $page . '.php';
?>