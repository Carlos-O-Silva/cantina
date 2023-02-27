<?php
session_start();

$usuarios_site = [
   [
      "id" => 1,
      "email" => "fran@gmail.com",
      "senha" => "123",
      "perfil" => 2
   ]
];

//variavel inicia com false
$usuario_autenticado = false;

//variavel vai armazenar o id do usuário
$usuario_id = null;
//vai armazenar o perfil do usuário
$usuario_perfil = null;

foreach($usuarios_site as $usuario)
{
    if ( ($usuario['email'] == $_POST['email']) && ($usuario['senha'] == $_POST['senha']))
    {
        $usuario_autenticado = true;
        $usuario_id = $usario['id']; //armazena id do usuário
        $usuario_perfil = $usuario['perfil']; //armazena perfil do usuário
    }

}
//se variável usuario_autenticado igual a true
if($usuario_autenticado)
    {
        echo 'Usuario Autenticado';
        $_SESSION['autenticado'] = 'sim';
        $_SESSION['id'] = $usuario_id;
        $_SESSION['perfil'] = $usuario_perfil;
        //redirecionamento para home.php
        header('Location:home.php');

    }
else{
    $_SESSION['autenticado'] = 'nao';
    //redirecionamento para a página index, passa por parametro login=erro
    header('Location:index.php?login=erro');
}





?>