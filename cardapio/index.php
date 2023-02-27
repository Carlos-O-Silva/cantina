<?php
session_start();
if (!isset($_SESSION['usu_id'])) {
  header('location: ../login/index.php');
}

?>


<?php

require_once("../elementos/navbar/index.php"); //
include '../php/conexao.php';

?>

<?php

// Select products ordered by the date added
$stmt = $db->prepare("SELECT * FROM produtos  WHERE clas_id = 1 ;");
$stmt2 = $db->prepare("SELECT * FROM produtos  WHERE clas_id = 2 ;");
$stmt3 = $db->prepare("SELECT * FROM produtos  WHERE clas_id = 3 ;");
$stmt4 = $db->prepare("SELECT * FROM produtos  WHERE clas_id = 4 ;");
$stmt5 = $db->prepare("SELECT * FROM produtos  WHERE clas_id = 5 ;");
$stmt6 = $db->prepare("SELECT * FROM produtos  WHERE clas_id = 6 ;");
$stmt7 = $db->prepare("SELECT * FROM produtos  WHERE clas_id = 7 ;");

$stmt->execute();
$stmt2->execute();
$stmt3->execute();
$stmt4->execute();
$stmt5->execute();
$stmt6->execute();
$stmt7->execute();

// $stmt2->execute();
// Fetch the products from the database and return the result as an Array
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
$products2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
$products3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);
$products4 = $stmt4->fetchAll(PDO::FETCH_ASSOC);
$products5 = $stmt5->fetchAll(PDO::FETCH_ASSOC);
$products6 = $stmt6->fetchAll(PDO::FETCH_ASSOC);
$products7 = $stmt7->fetchAll(PDO::FETCH_ASSOC);


// $products2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of products
$total_products  = $db->prepare("SELECT * FROM produtos  WHERE clas_id = 1 AND pro_idSitucaoProduto = 1;");
$total_products2 = $db->prepare("SELECT * FROM produtos  WHERE clas_id = 2 AND pro_idSitucaoProduto = 1;");
$total_products3 = $db->prepare("SELECT * FROM produtos  WHERE clas_id = 3 AND pro_idSitucaoProduto = 1;");
$total_products4 = $db->prepare("SELECT * FROM produtos  WHERE clas_id = 4 AND pro_idSitucaoProduto = 1;");
$total_products5 = $db->prepare("SELECT * FROM produtos  WHERE clas_id = 5 AND pro_idSitucaoProduto = 1;");
$total_products6 = $db->prepare("SELECT * FROM produtos  WHERE clas_id = 6 AND pro_idSitucaoProduto = 1;");
$total_products7 = $db->prepare("SELECT * FROM produtos  WHERE clas_id = 7 AND pro_idSitucaoProduto = 1;");
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
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/scrollreveral.css">
</head>

<body>

    <nav class="subnav" style="width: 700px;">
        <a href="#lanches" style="width: 100px;"> <img src="img/icons/burguer.png" style="width:35px; height:35px;"></a>
        <a href="#bebidas" style="width: 100px;"> <img src="img/icons/refri.png" style="width:35px; height:35px;"></a>
        <a href="#salgados" style="width: 100px;"> <img src="img/icons/croissant.png" style="width:35px; height:35px;"></a>
        <a href="#sorvetes" style="width: 100px;"> <img src="img/icons/icecream.png" style="width:35px; height:35px;"></a>
        <a href="#doces" style="width: 100px;"> <img src="img/icons/cookies.png" style="width:35px; height:35px;"></a>
        <a href="#diversos" style="width: 100px;"> <img src="img/icons/candies.png" style="width:35px; height:35px;"></a>
        <a href="#acai" style="width: 100px;"> <img src="img/icons/acai.png" style="width:45px; height:45px;"></a>
    </nav>
    <!--<div class="container">
        <form action="" method="GET">
            <input type="text" name="" size="50" id="filter" placeholder="Insira o que deseja pesquisar" onkeyup="searchProduct()" style="margin-left: 265px">
            <button style="width:100px;">Buscar</button>
        </form>
    </div>-->



    <!--==================== PRODUTOS ====================-->
    <a name="lanches"></a>
    <section class="product section container" id="products">

        <div class="lanches">
            <h2 class="section__title-center" style="color: #fa7a33;font-size:35px">
                Lanches
            </h2>
            <hr style="color: #fa7a33;">
        </div>

        <div class="product__container grid" style="background-color: white; grid-template-columns: repeat(4, 185px);" id="card-lists">


            <!--  ==================================== CARD LANCHES ============================================================= -->

            <?php foreach ($products as $product) : ?>

                <article class='product__card' style='border: 1px solid #fa7a33; 
                border-radius: 18px;
                max-height: 400px;
                width: 250px;'>
                    <br>
                    <img src="../adm/upload/<?= $product['pro_foto'] ?>" width="140" border-radius="8" alt="<?= $product['pro_nome'] ?>" alt='' class='product__img'>
                    </a>
                    <hr style='color: white;'>
                    <h3 class='product__title' style='text-align:center; font-size:1.2rem; margin-bottom: 1rem'>
                        <?= $product['pro_nome'] ?></h3>
                    <h3 class='product__desc' style='text-align:center; font-size:.800rem;' ;>
                        <?= $product['pro_descricao'] ?></h3>
                    <span class='product__price' style='text-align:center; color: #fa7a33;'>R$
                        <?= number_format($product['pro_valor'],2,",","."); ?></span>
                    <hr style='color: white;'>

                    <?php if ($product['pro_rrp'] > 0) : ?>
                        <span class="rrp">R$ <?= $product['pro_rrp'] ?></span>
                    <?php endif; ?>

                    <button class='product__button' style='background-color: #fa7a33;'>
                        <a href="../carrinho/index.php?page=produto&pro_id=<?= $product['pro_id'] ?>">
                            <i class='ri-shopping-bag-line' style="color: white"></i>
                        </a>
                    </button>
                </article>

            <?php endforeach; ?>

        </div>

    </section>

    </div>
    <!--  ==================================== CARD BEBIDAS ============================================================= -->
    <a name="bebidas"></a>

    <section class="product section container" id="products">
        <h2 class="section__title-center" style="color: #fa7a33;font-size:35px">
            Bebidas
        </h2>
        <hr style="color: #fa7a33;">

        <div class="product__container grid" style="background-color: white; grid-template-columns: repeat(4, 185px);">

            <?php foreach ($products2 as $product) : ?>

                <article class='product__card' style='border: 1px solid #fa7a33; 
    border-radius: 18px;
    max-height: 400px;
    width: 250px;'>
                    <br>
                    <img src="../adm/upload/<?= $product['pro_foto'] ?>" width="140" border-radius="8" alt="<?= $product['pro_nome'] ?>" alt='' class='product__img'>
                    </a>
                    <hr style='color: white;'>
                    <h3 class='product__title' style='text-align:center; font-size:1.2rem; margin-bottom: 1rem'>
                        <?= $product['pro_nome'] ?></h3>
                    <h3 class='product__desc' style='text-align:center; font-size:.800rem;' ;>
                        <?= $product['pro_descricao'] ?></h3>
                    <span class='product__price' style='text-align:center; color: #fa7a33;'>R$
                    <?= number_format($product['pro_valor'],2,",","."); ?></span>
                    <hr style='color: white;'>

                    <?php if ($product['pro_rrp'] > 0) : ?>
                        <span class="rrp">R$ <?= $product['pro_rrp'] ?></span>
                    <?php endif; ?>

                    <button class='product__button' style='background-color: #fa7a33;'>
                        <a href="../carrinho/index.php?page=produto&pro_id=<?= $product['pro_id'] ?>">
                            <i class='ri-shopping-bag-line' style="color: white"></i>
                        </a>
                    </button>

                </article>

            <?php endforeach; ?>




        </div>

    </section>

    </section>
    <a name="salgados"></a>

    <section class="product section container" id="products">
        <h2 class="section__title-center" style="color: #fa7a33; font-size:35px">
            Salgados
        </h2>
        <hr style="color: #fa7a33;">

        <div class="product__container grid" style="background-color: white; grid-template-columns: repeat(4, 185px);">
            <?php foreach ($products5 as $product) : ?>

                <article class='product__card' style='border: 1px solid #fa7a33; 
border-radius: 18px;
max-height: 400px;
width: 250px;'>
                    <br>
                    <img src="../adm/upload/<?= $product['pro_foto'] ?>" width="140" border-radius="8" alt="<?= $product['pro_nome'] ?>" alt='' class='product__img'>
                    </a>
                    <hr style='color: white;'>
                    <h3 class='product__title' style='text-align:center; font-size:1.2rem; margin-bottom: 1rem'>
                        <?= $product['pro_nome'] ?></h3>
                    <h3 class='product__desc' style='text-align:center; font-size:.800rem;' ;>
                        <?= $product['pro_descricao'] ?></h3>
                    <span class='product__price' style='text-align:center; color: #fa7a33;'>R$
                    <?= number_format($product['pro_valor'],2,",","."); ?></span>
                    <hr style='color: white;'>

                    <?php if ($product['pro_rrp'] > 0) : ?>
                        <span class="rrp">R$ <?= $product['pro_rrp'] ?></span>
                    <?php endif; ?>

                    <button class='product__button' style='background-color: #fa7a33;'>
                        <a href="../carrinho/index.php?page=produto&pro_id=<?= $product['pro_id'] ?>">
                            <i class='ri-shopping-bag-line' style="color: white"></i>
                        </a>
                    </button>

                </article>

            <?php endforeach; ?>



        </div>

    </section>
    <!--  ==================================== CARD SORVETES ============================================================= -->
    <a name="sorvetes"></a>
    <section class="product section container" id="products">
        <h2 class="section__title-center" style="color: #fa7a33; font-size:35px">
            Sorvetes
        </h2>
        <hr style="color: #fa7a33;">

        <div class="product__container grid" style="background-color: white; grid-template-columns: repeat(4, 185px);">


            <?php foreach ($products3 as $product) : ?>

                <article class='product__card' style='border: 1px solid #fa7a33; 
border-radius: 18px;
max-height: 400px;
width: 250px;'>
                    <br>
                    <img src="../adm/upload/<?= $product['pro_foto'] ?>" width="140" border-radius="8" alt="<?= $product['pro_nome'] ?>" alt='' class='product__img'>
                    </a>
                    <hr style='color: white;'>
                    <h3 class='product__title' style='text-align:center; font-size:1.2rem; margin-bottom: 1rem'>
                        <?= $product['pro_nome'] ?></h3>
                    <h3 class='product__desc' style='text-align:center; font-size:.800rem;' ;>
                        <?= $product['pro_descricao'] ?></h3>
                    <span class='product__price' style='text-align:center; color: #fa7a33;'>R$
                    <?= number_format($product['pro_valor'],2,",","."); ?></span>
                    <hr style='color: white;'>

                    <?php if ($product['pro_rrp'] > 0) : ?>
                        <span class="rrp">R$ <?= $product['pro_rrp'] ?></span>
                    <?php endif; ?>

                    <button class='product__button' style='background-color: #fa7a33;'>
                        <a href="../carrinho/index.php?page=produto&pro_id=<?= $product['pro_id'] ?>">
                            <i class='ri-shopping-bag-line' style="color: white"></i>
                        </a>
                    </button>

                </article>

            <?php endforeach; ?>


        </div>
        <!--  ==================================== CARD DOCES  ============================================================= -->
    </section>
    <a name="doces"></a>

    <section class="product section container" id="products">
        <h2 class="section__title-center" style="color: #fa7a33; font-size:35px">
            Doces
        </h2>
        <hr style="color: #fa7a33;">

        <div class="product__container grid" style="background-color: white; grid-template-columns: repeat(4, 185px);">
            <?php foreach ($products4 as $product) : ?>

                <article class='product__card' style='border: 1px solid #fa7a33; 
border-radius: 18px;
max-height: 400px;
width: 250px;'>
                    <br>
                    <img src="../adm/upload/<?= $product['pro_foto'] ?>" width="140" border-radius="8" alt="<?= $product['pro_nome'] ?>" alt='' class='product__img'>
                    </a>
                    <hr style='color: white;'>
                    <h3 class='product__title' style='text-align:center; font-size:1.2rem; margin-bottom: 1rem'>
                        <?= $product['pro_nome'] ?></h3>
                    <h3 class='product__desc' style='text-align:center; font-size:.800rem;' ;>
                        <?= $product['pro_descricao'] ?></h3>
                    <span class='product__price' style='text-align:center; color: #fa7a33;'>R$
                    <?= number_format($product['pro_valor'],2,",","."); ?></span>
                    <hr style='color: white;'>

                    <?php if ($product['pro_rrp'] > 0) : ?>
                        <span class="rrp">R$ <?= $product['pro_rrp'] ?></span>
                    <?php endif; ?>

                    <button class='product__button' style='background-color: #fa7a33;'>
                        <a href="../carrinho/index.php?page=produto&pro_id=<?= $product['pro_id'] ?>">
                            <i class='ri-shopping-bag-line' style="color: white"></i>
                        </a>
                    </button>

                </article>

            <?php endforeach; ?>



        </div>

    </section>
    <!--  ==================================== CARD SALGADOS ============================================================= -->

    <!--  ==================================== CARD SALGADOS ============================================================= -->
    </section>
    <a name="diversos"></a>

    <section class="product section container" id="products">
        <h2 class="section__title-center" style="color: #fa7a33;font-size:35px">
            Diversos
        </h2>
        <hr style="color: #fa7a33;">

        <div class="product__container grid" style="background-color: white; grid-template-columns: repeat(4, 185px);">
            <?php foreach ($products6 as $product) : ?>

                <article class='product__card' style='border: 1px solid #fa7a33; 
border-radius: 18px;
max-height: 400px;
width: 250px;'>
                    <br>
                    <img src="../adm/upload/<?= $product['pro_foto'] ?>" width="140" border-radius="8" alt="<?= $product['pro_nome'] ?>" alt='' class='product__img'>
                    </a>
                    <hr style='color: white;'>
                    <h3 class='product__title' style='text-align:center; font-size:1.2rem; margin-bottom: 1rem'>
                        <?= $product['pro_nome'] ?></h3>
                    <h3 class='product__desc' style='text-align:center; font-size:.800rem;' ;>
                        <?= $product['pro_descricao'] ?></h3>
                    <span class='product__price' style='text-align:center; color: #fa7a33;'>R$
                    <?= number_format($product['pro_valor'],2,",","."); ?></span>
                    <hr style='color: white;'>

                    <?php if ($product['pro_rrp'] > 0) : ?>
                        <span class="rrp">R$ <?= $product['pro_rrp'] ?></span>
                    <?php endif; ?>

                    <button class='product__button' style='background-color: #fa7a33;'>
                        <a href="../carrinho/index.php?page=produto&pro_id=<?= $product['pro_id'] ?>">
                            <i class='ri-shopping-bag-line' style="color: white"></i>
                        </a>
                    </button>

                </article>

            <?php endforeach; ?>



        </div>

    </section>
    <!--  ==================================== CARD SALGADOS ============================================================= -->
    </section>
    <a name="acai"></a>

    <section class="product section container" id="products">
        <h2 class="section__title-center" style="color: #fa7a33; font-size:35px">
            Açaí
        </h2>
        <hr style="color: #fa7a33;">

        <div class="product__container grid" style="background-color: white; grid-template-columns: repeat(4, 185px);">
            <?php foreach ($products7 as $product) : ?>

                <article class='product__card' style='border: 1px solid #fa7a33; 
border-radius: 18px;
max-height: 400px;
width: 250px;'>
                    <br>
                    <img src="../adm/upload/<?= $product['pro_foto'] ?>" width="140" border-radius="8" alt="<?= $product['pro_nome'] ?>" alt='' class='product__img'>
                    </a>
                    <hr style='color: white;'>
                    <h3 class='product__title' style='text-align:center; font-size:1.2rem; margin-bottom: 1rem'>
                        <?= $product['pro_nome'] ?></h3>
                    <h3 class='product__desc' style='text-align:center; font-size:.800rem;' ;>
                        <?= $product['pro_descricao'] ?></h3>
                    <span class='product__price' style='text-align:center; color: #fa7a33;'>R$
                    <?= number_format($product['pro_valor'],2,",","."); ?></span>
                    <hr style='color: white;'>

                    <?php if ($product['pro_rrp'] > 0) : ?>
                        <span class="rrp">R$ <?= $product['pro_rrp'] ?></span>
                    <?php endif; ?>

                    <button class='product__button' style='background-color: #fa7a33;'>
                        <a href="../carrinho/index.php?page=produto&pro_id=<?= $product['pro_id'] ?>">
                            <i class='ri-shopping-bag-line' style="color: white"></i>
                        </a>
                    </button>

                </article>

            <?php endforeach; ?>



        </div>

    </section>


    </div>
    <!--=============== SEARCH WITH JS ===============-->
    <script src="../cardapio/js/search.js"></script>
</body>

</html>