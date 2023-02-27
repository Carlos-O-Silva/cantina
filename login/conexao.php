<?php

function novaConexao(){
    $dsn = 'mysql:host=localhost;dbname=cantina';
    $nome = 'root';
    $senha = '';

    try
    {
        // cria objeto conexao de classe PDO
        $conexao = new PDO($dsn,$nome,$senha);
        //retorna a conexao
        return $conexao;
    }
    catch(PDOException $e)
    {
        echo 'Erro: ' . $e->getMessage();
    }
}

//novaConexao(); //executa a fç apenas para testar a conexao
//echo "Conexao com o BD realizada com sucesso!1!!!1";
