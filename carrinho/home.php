<?php
include '../php/conexao.php';


if (!isset($_SESSION['usu_id'])) {
    header('location:../Login/index.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <!--css-->
  <link rel="stylesheet" href="../home/css/style.css">
</head>

<body>


  <header class="header" id="header">



    <nav class="nav_fran bd-container">

      <div class="logo">
        <img src="img/logo.png">
      </div>

      <div class="nav__menu" id="nav-menu"
      
      >

        <ul class="nav__list">
      
          <li class="nav__item"><a href="../../../cantina/home/index.php" class="nav__link" style="font-size: 1.15rem; color: black;">Home</a></li>
          <li class="nav__item"><a href="../../../cantina/cardapio/index.php" class="nav__link" style="font-size: 1.15rem;color: black;">Cardápio</a></li>
          <li class="nav__item"><a href="#pedidos" class="nav__link" style="font-size: 1.15rem;color: black;">Pedidos</a></li>
          <li class="nav__item"><a href="#carrinho" class="btn">
              <img src="img/icons/carrinho.png" style="width:25px; height:25px;">
            </a></li>
        </ul>
      </div>

      <div class="nav__toggle">
        <i class='bx bx-menu-alt-right' id="nav-toggle"></i>
      </div>



    </nav>

  </header>
  <!-- END HEADER -->
  <!-- fim NAV -->


  <div class="banner">
        <img class="d-block w-100" src="../../cantina/home/img/bunga bunga.png" alt="First slide">
      </div>



</body>

</html>