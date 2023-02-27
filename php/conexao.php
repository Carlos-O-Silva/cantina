<?php


try
{
    $db = new PDO("mysql:dbname=cantina;charset=utf8;host=localhost","root","");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		switch($e->getCode()){
			case "1049":
			echo "Banco de dados não existe";
			break;

			case "1044":
			echo "Usuário incorreto";
			break;
			
			case "1045":
			echo "Senha incorreta";
			break;
		}
	}


?>