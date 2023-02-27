<?php
session_start();
// if (!isset($_SESSION['usu_username'])) {
//   header('location:../public/login.php');
// }

// $logado = $_SESSION['usu_username'];
// $id = $_SESSION['usu_id'];


$pro_nome =      filter_input(INPUT_POST, 'pro_nome',      FILTER_DEFAULT);
$pro_descricao = filter_input(INPUT_POST, 'pro_descricao', FILTER_DEFAULT);
$pro_valor =     filter_input(INPUT_POST, 'pro_valor',     FILTER_DEFAULT);
$clas_id =       filter_input(INPUT_POST, 'clas_id',       FILTER_DEFAULT);


$pro_foto = $_FILES['pro_foto']['name'];
$caminho_imagem = "../adm/upload/";
move_uploaded_file($_FILES['pro_foto']['tmp_name'], $caminho_imagem.$_FILES['pro_foto']['name']);



include 'conexao.php';


$sth = $db->prepare("INSERT INTO produtos ( pro_nome, pro_descricao, pro_valor, clas_id, pro_foto) VALUES (:pro_nome, :pro_descricao, :pro_valor, :clas_id, :pro_foto)");
    
$sth->bindValue (":pro_nome",       $pro_nome);       
$sth->bindValue (":pro_descricao",  $pro_descricao);
$sth->bindValue (":pro_valor",      $pro_valor);
$sth->bindValue (":clas_id",        $clas_id);
$sth->bindValue (":pro_foto",       $pro_foto);

$sth->execute();
   
echo " 
<script>alert('Produto cadastrado com sucesso!');
window.location.href = '../adm/index.php';
 </script>";

?>

