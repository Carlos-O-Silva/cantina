<?php
include '../php/conexao.php';

    if(!isset($_SESSION))
    {
        session_start();
    }
    
$id = $_SESSION['usu_id'];


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cantina da Fran</title>
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">


    <!--css-->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <a href="#" class="scrolltop" id="scroll-top">
        <i class='bx bx-chevrons-up scroll__top__icon'></i>
    </a>

    <header class="header" id="header">
        <nav class="nav_fran bd-container">

            <div class="logo">
                <img src="img/logo.png" style="max-width: 75%; height: auto;">
            </div>

            <div class="nav__menu" id="nav-menu">
                <?php
                $helder = $db->query("SELECT * FROM conta WHERE con_idUsuario = '.$id.';");
                //$stmt = $db->prepare("SELECT * FROM conta WHERE con_idUsuario = 1;");
                foreach ($helder as $key) {
                    echo "      <ul class='nav__list'>
                                <li class='nav__item'><a href='../../../cantina/home/index.php'  class='nav__link' style='font-size: 1.15rem; color: black;'>Home</a></li>
                                <li class='nav__item'><a href='../../../cantina/cardapio/index.php' class='nav__link' style='font-size: 1.15rem;color: black;'>Cardápio</a></li>
                                <li class='nav__item'><a href='../pedidos/index.php' class='nav__link' style='font-size: 1.15rem;color: black;'>Pedidos</a></li>
                                <li class='nav__item'><a href='../carrinho/index.php?page=carrinho' class='nav__link' style='font-size: 1.15rem;color: black;'>Carrinho</a></li>
                               
                                <li class='nav__item'><a href='#carrinho' class='btn'  style='font-size: 1rem;color: white;'>R$ $key[con_saldo]
                                </a></li>
                                
                                <li class='nav__item'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='40' height='40' color='black' fill='currentColor' class='bi bi-person-circle' viewBox='0 0 16 16' class='floatright marginperfil' data-bs-toggle='offcanvas' data-bs-target='#offcanvasRight' aria-controls='offcanvasRight'>
                <path d='M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z' />
                <path fill-rule='evenodd' d='M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z' />
            </svg></button>
            <div class='offcanvas offcanvas-end cor' tabindex='-1' id='offcanvasRight' aria-labelledby='offcanvasRightLabel'>
                <div class='offcanvas-header cor2'>
                </div>


                <div class='offcanvas-body'>


                    <svg xmlns='http://www.w3.org/2000/svg' width='70' height='70' fill='currentColor' class='bi bi-person-circle' viewBox='0 0 16 16' style='margin-left: 150px; margin-bottom: 10px ' class='floatleft marginperfil'>
                        <path d='M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z' />
                        <path fill-rule='evenodd' d='M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z' />
                    </svg>
                    <div class='juca' style='display:flex; margin: 0 auto'>
                        <h5 class='offcanvas-title cor2' id='offcanvasRightLabel' style='display:flex; margin: 0 auto'>Perfil</h5>
                    </div>
                    <hr>

                    <!-- <a class='nav-link active' aria-current='page' href='#'>Home</a> -->

                    <a href='teste.php' class='nav__link
                        ' style='font-size: 1.15rem; color: #fa7a33;'> Adicionar saldo </a> <br> </br>

                    <a href='teste.php' class='nav__link
                        ' style='font-size: 1.15rem; color: #fa7a33;'> Gerenciar conta </a> <br> </br>

                    <a href='../historico/index.php' class='nav__link
                        ' style='font-size: 1.15rem; color: #fa7a33;'> Histórico de pedidos</a> <br> </br>

                        <a href='../../cantina/elementos/navbar/logout.php' class='nav__link
                        ' style='font-size: 1.15rem; color: #fa7a33;'> Sair</a> <br> </br>

      


                </div>
            </div>
                                </li>

                                </ul>";

                    # code...
                }
                // echo $stmt['con_saldo'][0];
                ?>
            </div>

            <div class="nav__toggle">
                <i class='bx bx-menu-alt-right' id="nav-toggle"></i>
            </div>


            


        </nav>
        <hr class="line" style="border: 0;
        margin-top: -.1rem;
    height: 0.3rem;
    background-image: linear-gradient(to right, transparent,var(--first-color), transparent);
    background-image: linear-gradient(to left, transparent,#fa7a33, transparent);">

    </header>
    <!-- END HEADER -->
    <!-- fim NAV -->




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>


</body>

</html>