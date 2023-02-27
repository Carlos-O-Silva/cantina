<?php
session_start();
if (!isset($_SESSION['adm_nome'])) {
  header('location: ../login.php');
}

?>


<?php
include '../../php/conexao.php';
?>

 <!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../public/assets/img/icone.png" type="image/x-icon" />

    <link rel="stylesheet" href="../css/cadastro.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Cadastrar Produto</title>
</head>

<body style="background-color: #fa803e;">
    <div class="container">
        <div class="form">
            <form action="../../php/cadastrarproduto.php" method="POST" enctype="multipart/form-data">
                <div class="form-header">
                    
                    <div class="title"><br>
                        <h1>Cadastrar Produto</h1>
                    </div>

                </div>

                <div class="input-group">

                    <div class="input-box" style="width: 60%;">
                        <label for="nome">Nome do Produto</label>
                        <input id="nome" type="text" name="pro_nome" placeholder="Digite o nome do produto" >

                        <div class='input-box' style='width: 100%'>
                                <label for='modelo'>Categoria</label>                                 
                                    <select name="clas_id">
                                        <option value="clas_id" selected = selected>Selecione a categoria</option>
                                        <?php
                                        $sth = $db->prepare('SELECT *FROM classificacao');
                                        $sth->execute();
                                        foreach ($sth as $res) :
                                        extract($res);
                                        ?>
                                        <!-- <option value="">  </option> -->
                                        <option value="<?= $clas_id ?>"> <?= $clas_descricao ?> </option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>
                            </div>

                            <div class="input-box" style="width: 100%;">
                        <label for="descricao">Descrição</label>
                        <input id="descricao" type="text" name="pro_descricao" placeholder="Descreva o produto">
                    </div>

                    </div>

                    <div class="input-box" style="width: 30%;">
                        <label for="preco">Valor do Produto</label>
                        <input id="preco" type="number" name="pro_valor" placeholder="Digite o preço"   min="0"><br><hr><br>

                        <div class="input-box">
                        <img id="img" style="width: 165px; margin-left: 50px;" />
                    </div>
                        
                        </div>

                        



                    <div class="input-box">
                        <label for="foto"> 
                            <span class="material-icons">
                                add_a_photo
                            </span>&nbsp;
                            Escolha a foto</label>
                        <input id="foto" name="pro_foto" type="file"  >
                        <img id="img" style="width: 120px" />
                    </div>

                    <div class="botoes">

                        <div class="continue-button">
                            <button><a href="../index.php">Voltar</a></button>
                        </div>

                        <div class="continue-button">
                            <button><a>Cadastrar</a> </button>
                        </div>

                    </div>
                </div>

                

            </form>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js">
</script>




<script>
    $(function(){
        $('#foto').change(function(){
            const file = $(this)[0].files[0]
            const fileReader = new FileReader()
            fileReader.onloadend = function(){
           $('#img').attr('src', fileReader.result)
                

            }
            fileReader.readAsDataURL(file)
        })

    })
</script>

