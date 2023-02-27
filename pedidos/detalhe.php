<?php
session_start();
if (!isset($_SESSION['usu_id'])) {
    header('location:../login/index.php');

}

?>


<?php

require_once("../elementos/navbar/index.php"); //
include '../php/conexao.php';



// Select products ordered by the date added
$stmt = $db->prepare("SELECT produtos.pro_nome, detalheprodpedido.det_idPedido, produtos.pro_foto, produtos.pro_descricao, produtos.pro_valor, detalheprodpedido.det_idPedido
FROM detalheprodpedido
INNER JOIN produtos ON detalheprodpedido.det_produto = produtos.pro_id 
WHERE det_idPedido = 21;");
$stmt2 = $db->prepare("SELECT * FROM produtos  WHERE clas_id = 2 ;");

$stmt->execute();
$stmt2->execute();

// $stmt2->execute();
// Fetch the products from the database and return the result as an Array
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
$products2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);


// $products2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of products
$total_products  = $db->prepare("SELECT produtos.pro_nome, detalheprodpedido.det_idPedido, produtos.pro_foto, produtos.pro_descricao, produtos.pro_valor
FROM detalheprodpedido
INNER JOIN produtos ON detalheprodpedido.det_produto = produtos.pro_id 
WHERE det_idPedido = 1;");
$total_products2 = $db->prepare("SELECT * FROM produtos  WHERE clas_id = 2 AND pro_idSitucaoProduto = 1;");
// $total_products2 = $pdo->query('SELECT * FROM bebidas')->rowCount();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cardápio</title>
    <!--css-->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style_nav.css">
    <link rel="stylesheet" href="css/cadastro.css">
    <link rel="stylesheet" href="css/style_cardap.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" />
</head>

<body style="background-color: white">

<!--<ul class='nav__list'>-->


                   

                            <a name='todos'></a>

                            <div class='todos'>
                                <h2 class='section__title-center' style='color: black; margin-top: 8rem; font-size: 2rem;'>
                                    Pedido Nº21
                                </h2>
                            </div>
                    

        <div class="product__container grid" style="padding: .2rem .2rem; margin-right: 68rem; background-color: white; grid-template-columns: repeat(1, 185px);" id="card-lists">

        
            <!--  ==================================== CARD LANCHES ============================================================= -->

            <?php foreach ($products as $product) : ?>
            

                <article class='product__card' style='border: 1px solid #000000;
                display: flex;
                padding: 3rem 3rem; 
                border-radius: 18px;
                max-height: 450px;
                width: 80rem;'>
                    <br>
                    <img class="image" src="../adm/upload/<?= $product['pro_foto'] ?>" width="140" border-radius="8" alt="<?= $product['pro_nome'] ?>" alt='' class='product__img'>
                    </a>
                    <hr style='color: white;'>
                    <h3 class='product__title' style='text-align:center; font-size:1.2rem; margin-bottom: 1rem'>
                        <?= $product['pro_nome'] ?></h3>
                    <h3 class='product__desc' style='text-align:center; font-size: 1rem;' ;>
                        <?= $product['pro_descricao'] ?></h3>
                    <span class='product__price' style='text-align:center; color: #fa7a33;'>R$
                        <?= $product['pro_valor'] ?></span>
                    <hr style='color: white;'>
                        
                            <h3 class='product__desc' style="align: center; font-size: 1rem; color: #fa7a33">1 Unidade(s)</h1>
                     
                </article>

            <?php endforeach; ?>

        </div>
        <h3 class='product__desc' style="margin-left: 65rem; font-size: 2rem; color: #fa7a33">Total: R$18,00</h1>
                     

    </section>

    </div>

    </section>

    </div>
</body>

</html>