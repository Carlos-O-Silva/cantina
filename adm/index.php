<?php
session_start();
if (!isset($_SESSION['adm_nome'])) {
  header('location: login.php');
}

$logado = $_SESSION['adm_nome'];

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!--=============== FAVICON ===============-->
    <link rel="shortcut icon" href="../public/assets/img/icone.png" type="image/x-icon" />

    <!--=============== REMIX ICONS ===============-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" />

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="css/style_admin.css">

    <title>Home_ADMIN</title>
</head>

<body>
    <!--==================== HEADER ====================-->
    <header class="header" id="header">
    <nav class="nav container">
      <a href="index_admin.php">
        <img src="img/logo.png" alt="" width="190px" height="150px"> 
      </a>

            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="#home" class="nav__link active-link">Home</a>
                    </li>
                    <li class="nav__item">
                        <a href="logout.php" class="nav__link">Sair</a>
                    </li>
                </ul>

                <div class="nav__close" id="nav-close">
                    <i class="ri-close-line"></i>
                </div>
            </div>

            <div class="nav__btns">
                <!-- Theme change button -->
                <!--<i class="ri-moon-line change-theme" id="theme-button"></i> -->

                <div class="nav__toggle" id="nav-toggle">
                    <i class="ri-menu-line"></i>
                </div>
            </div>
        </nav>
        <hr class="line">
    </header>

    <!--==================== STEPS ====================-->
    <section class="steps section container">
        <div class="steps__bg">
        <h2 class="section__title-center steps__title">
                Bem vindo ao Menu
            </h2>

            <div class="steps__container grid">
                <div class="steps__card">
                    <h3 class="steps__card-title">Saldo</h3>
                    <p class="steps__card-description">
                    Adicionar saldo à conta de um usuário
                    </p>
                    <br>
                    <div class="steps__card-icon"> <a href="saldo/saldo.php" class= "link"><i class="ri-money-dollar-circle-line"></i></div></a>
                </div>

                <div class="steps__card">
                    <h3 class="steps__card-title">Pedidos</h3>
                    <p class="steps__card-description">
                    Consultar os pedidos de hoje
                    </p>
                    <br />
                    <div class="steps__card-icon"><a href="pedidos/index.php" class= "link"><i class="ri-bill-line"></i></div></a>
                </div>

               

                <div class="steps__card">
                    <h3 class="steps__card-title">Pedidos</h3>
                    <p class="steps__card-description">
                    Acessar o histórico de pedidos
                    </p>
                    <br />
                    <div class="steps__card-icon"> <a href="historico/index.php" class= "link"><i class="ri-list-check"></i></div></a>
                </div>

               
                <div class="steps__card">
                    <h3 class="steps__card-title">Cadastrar</h3>
                    <p class="steps__card-description">
                    Cadastrar um novo produto
                    </p>
                    <br/>
                    <div class="steps__card-icon"><a href="produto/cadastrarProduto.php" class="link"><i class="ri-add-box-line"></i></div></a>
                </div>
                <div class="steps__card">
                    <h3 class="steps__card-title">Editar/ Desativar</h3>
                    <p class="steps__card-description">
                        Editar ou desativar um produto cadastrado
                    </p>
                    <br />
                    <div class="steps__card-icon"><a href="produto/editarProduto.php" class= "link"><i class="ri-pencil-line"></i></div></a>
                </div>
                 
        </div>
    </section>

    <!--==================== FOOTER ====================-->
    <footer class="footer section">
        <p class="footer__copy">&#169; Todos os direitos reservados à Cantina da Fran.</p>
    </footer>

    <!--=============== SCROLL UP ===============-->
    <a href="#" class="scrollup" id="scroll-up">
    <i class="ri-arrow-up-fill scrollup__icon"></i>
  </a>

  <!--=============== SCROLL REVEAL ===============-->
  <script src="../public/assets/js/scrollreveal.min.js"></script>

  <!--=============== MAIN JS ===============-->
  <script src="../public/assets/js/main.js"></script>
</body>

</html>