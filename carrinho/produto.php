<?php
include '../php/conexao.php';


if (!isset($_SESSION['usu_id'])) {
    header('location:../Login/index.php');
}
?>

<?php


include '../php/conexao.php';

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

$id = $_SESSION['usu_id'];

require_once("../elementos/navbar/index.php");
if (isset($_GET['pro_id'])) {
    $stmt = $db->prepare('SELECT * FROM produtos WHERE pro_id = ?');
    $stmt->execute([$_GET['pro_id']]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$product) {
        exit('Produto inexistente!');
    }
} else {
    exit('Produto inexistente!');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo/logo.png">
    <!-- CSS only -->
   <link href="https://fonts.googleapis.com/css?family=Oswald:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/lanche_styles.css">
    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
    <!-- Título -->
    <title>Cantina da Fran</title>
</head>

<body>
<div class="carlos" style="margin-top: 7rem;">
    <div class="container" style="
    margin-top: 5rem;
    width: 90%;
    height: 70vh;
    display: flex;
    border-radius: 1rem;
    background-color: #FFF;">
<div class="cent" style="margin:0 auto">
        <div class="container" style="margin-top: 5.5rem; margin-left: 4.5rem;">
            <div class="row">
                <div class="col-md-7">
                    <div class="title"><br>
                        <h1 style="color:black"><?= $product['pro_nome'] ?></h1>
                    </div>
                    <hr style="color:black">
                    <h4 style="font-family: Poppins, sans-serif; color: black;"><?= $product['pro_descricao'] ?></h4><br>

                    <h5 style="color:black">R$ <?= $product['pro_valor'] ?></h5><br>
                    <?php if ($product['pro_rrp'] > 0) : ?>
                        <span class="rrp">R$ <?= $product['pro_rrp'] ?></span>
                    <?php endif; ?>

                    <form class="forms" action="index.php?page=carrinho" method="post">
                        <div class="row align-items-center mb-5">
                            <div class="col-auto">
                                <input type="number" name="quantity" class="form-control border" value="1" min="1" max="50" placeholder="Qntd" required>
                                <input type="hidden" name="product_id" class="form-control" value="<?= $product['pro_id'] ?>">
                            </div>
                            <div class="aaa" style="margin: 0 auto; width: 27rem; margin-left:-1rem">
                            <div class="col-auto">
                                <input type="text" name="obs" class="form-control border" placeholder="Observações">
                            </div></div>
                            <div class="aaa" style="margin: 0 auto">
                            <div class="col-auto mt-4" style="width: 15rem">
                                <button type="submit" class="form-control" style="margin-top: .3rem; border-radius: 8px; border: #fa7a33; background-color: #fa7a33; color: #000; font-family: Poppins, sans-serif;" value="Adicionar no Carrinho">Adicionar ao Carrinho</button>

                            </div></div>


                        </div>

                </div>
                <div class="col-md-4 mt-4">
                    <img src="../adm/upload/<?= $product['pro_foto'] ?>" alt="<?= $product['pro_nome'] ?>" style='margin-left: 3rem;width:250px' alt='' class='product__img'>
                </div>
                </form>
            </div>

        </div>
    </div>





    </div>
    </div>

    <!-- Frameworks/Links -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/keen-slider@6.6.10/keen-slider.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="scripts/menu.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</body>

</html>