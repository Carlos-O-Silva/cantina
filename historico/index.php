

<?php

require_once("../elementos/navbar/index.php"); //
include '../php/conexao.php';

if (!isset($_SESSION['usu_id'])) {
    header('location:../login/index.php');


}



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
    <link rel="stylesheet" href="css/style_nav.css">
    <link rel="stylesheet" href="css/cadastro.css">
    <link rel="stylesheet" href="css/style_cardap.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" />
</head>

<body style="background-color: white">

<!--<ul class='nav__list'>-->


    <nav class="subnav" style="width: 900px; display:flex;">
        <li class='nav_item'><a href="#todos" class='nav__link' style='padding: .1rem 10rem; font-size: 1.15rem; color: black;'>Todos</a></li>
        <li class='nav_item'><a href="#concluidos" class='nav__link' style='padding: .1rem 6rem; font-size: 1.15rem; color: black;'>Concluidos</a></li>
        <li class='nav_item'><a href="#cancelados" class='nav__link' style='padding: .1rem 10rem; font-size: 1.15rem; color: black;'>Cancelados</a></li>
    </nav>



                <a name='todos'></a>

            <div class='todos'>
                <h2 class='section__title-center' style='color: black;'>
                    Todos
                </h2>
            </div>

            <div class="card-body" style='width: 1200px; height: auto; margin: 0 auto; margin-top: 1rem;'>


            <table class='table table-hover table-borderless table-vcenter font-size-sm'>
            <thead>
            <tr class='text-uppercase'>
                <th class='font-w700'>Pedido</th>
                <th class='font-w700'></th>
                <th class='d-none d-sm-table-cell font-w700'></th>
                <th class='font-w700'></th>
                <th class='d-none d-sm-table-cell font-w700 text-center' style='width: 100px;'></th>
                <th class='font-w700 text-center' style='width: 30px;'></th>
            </tr>
            </thead>

            <?php
            include '../php/conexao.php';
            ?>


            <?php

            try {
            $stmt = $db->prepare("SELECT pedidos.id_pedido, pedidos.id_usuario, pedidos.valor_pedido, 
            pedidos.data_pedido, situacaopedido.sit_descricao, pedidos.motivoCanelamento, pedidos.ped_hora
            FROM pedidos
            INNER JOIN situacaopedido ON pedidos.id_situacaoPedido = situacaopedido.sit_id; ");
            if ($stmt->execute()) {
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
            $id_pedido = $rs->id_pedido;
            $id_usuario = $rs->id_usuario;
            $valor_pedido = $rs->valor_pedido;
            $data_pedido = $rs->data_pedido;
            $sit_descricao = $rs->sit_descricao;
            $motivoCanelamento = $rs->motivoCanelamento;
            $ped_hora = $rs->ped_hora;


            echo "
            <tbody>
            <tr>

            <td>
                    <span class='font-w600 text-center'>$id_pedido</span>
                </td>

            <td>
            <img src='img/prato.png' width='100' border-radius='8' class='product__img'>
            </td>
                


                <td>
                    <span class='font-w600 text-center' style='color: gray;'>$sit_descricao</span>
                </td>

                <td class='d-none d-sm-table-cell text-center'>R$ 
                    $valor_pedido
                </td>

                <td>
                <button class='badge badge-success font-weight-100' style='border: #fa7a33; border-radius:10px; 
                background-color: #fa7a33; height:40px; font-size:12px; padding:7px;'><a href='detalhe.php' style='color:white'>Detalhes do pedido</a></button>
                </td>
            </tr>
            </tbody>
            ";
            }

            }
            } catch (PDOException $erro) {
            echo "Erro na conexão:" . $erro->getMessage();
            }
            ?> 
            </table> 
            </div>


  
                    <div class='concluidos'>
                                <h2 class='section__title-center' style='color: black;'>
                                    Concluidos
                                </h2>
                            </div>

                    <div class="card-body" style='width: 1200px; height: auto; margin: 0 auto; margin-top: 1rem;'>
                
                
                <table class='table table-hover table-borderless table-vcenter font-size-sm'>
                    <thead>
                        <tr class='text-uppercase'>
                            <th class='font-w700'>Pedido</th>
                            <th class='font-w700'></th>
                            <th class='d-none d-sm-table-cell font-w700'></th>
                            <th class='font-w700'></th>
                            <th class='d-none d-sm-table-cell font-w700 text-center' style='width: 100px;'></th>
                            <th class='font-w700 text-center' style='width: 30px;' href='../index.php'></th>
                        </tr>
                    </thead>


                    <?php

                    try {
                        $stmt = $db->prepare("SELECT pedidos.id_pedido, pedidos.id_usuario, pedidos.valor_pedido, 
                        pedidos.data_pedido, situacaopedido.sit_descricao, pedidos.motivoCanelamento, pedidos.ped_hora
                        FROM pedidos
                        INNER JOIN situacaopedido ON pedidos.id_situacaoPedido = situacaopedido.sit_id
                        WHERE id_situacaoPedido = 4; ");
                        if ($stmt->execute()) {
                            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                $id_pedido = $rs->id_pedido;
                                $id_usuario = $rs->id_usuario;
                                $valor_pedido = $rs->valor_pedido;
                                $data_pedido = $rs->data_pedido;
                                $sit_descricao = $rs->sit_descricao;
                                $motivoCanelamento = $rs->motivoCanelamento;
                                $ped_hora = $rs->ped_hora;

                                
                            echo "
                            <tbody>
                            <tr>
                                <td>
                                    <span class='font-w600 text-center'>$id_pedido</span>
                                </td>

                            <td>
                            <img src='img/lista.png' width='100' border-radius='8' class='product__img'>
                            </td>

                                

                                <td class='d-none d-sm-table-cell'>
                                    <span class='font-size-sm text-muted text-center'>$ped_hora</span>
                                </td>
                        
                                <td>
                                    <span class='font-w600 text-center' style='color: gray'>$sit_descricao</span>
                                </td>
                                
                                <td class='d-none d-sm-table-cell text-center'>R$ 
                                    $valor_pedido
                                </td>

                                <td>
                                <button class='badge badge-success font-weight-100' style='border: #fa7a33; border-radius:10px; 
                background-color: #fa7a33; height:40px; font-size:12px; padding:7px;'><a href='detalhe.php' style='color:white'>Detalhes do pedido</a></button>
                </td>
                                
                                
                            </tr>
                            </tbody>
                            ";
                        }
                    }
                } catch (PDOException $erro) {
                    echo "Erro na conexão:" . $erro->getMessage();
                }
                ?> 
    </table> 
                    </div>


                    <a name='cancelados'></a>

                    <div class='cancelados'>
                                <h2 class='section__title-center' style='color: black;'>
                                    Cancelados
                                </h2>
                            </div>
                    

                    <div class="card-body" style='width: 1200px; height: auto; margin: 0 auto; margin-top: 1rem;'>
                
                
                <table class='table table-hover table-borderless table-vcenter font-size-sm'>
                    <thead>
                        <tr class='text-uppercase'>
                        <th class='font-w700'>Pedido</th>
                        <th class='font-w700'></th>
                            <th class='d-none d-sm-table-cell font-w700'></th>
                            <th class='font-w700'></th>
                            <th class='d-none d-sm-table-cell font-w700 text-center' style='width: 100px;'></th>
                            <th class='font-w700 text-center' style='width: 30px;' href='../index.php'></th>
                        </tr>
                    </thead>


                    <?php

                    try {
                        $stmt = $db->prepare("SELECT pedidos.id_pedido, pedidos.id_usuario, pedidos.valor_pedido, 
                        pedidos.data_pedido, situacaopedido.sit_descricao, pedidos.motivoCanelamento, pedidos.ped_hora
                        FROM pedidos
                        INNER JOIN situacaopedido ON pedidos.id_situacaoPedido = situacaopedido.sit_id
                        WHERE id_situacaoPedido = 5; ");
                        if ($stmt->execute()) {
                            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                $id_pedido = $rs->id_pedido;
                                $id_usuario = $rs->id_usuario;
                                $valor_pedido = $rs->valor_pedido;
                                $data_pedido = $rs->data_pedido;
                                $sit_descricao = $rs->sit_descricao;
                                $motivoCanelamento = $rs->motivoCanelamento;
                                $ped_hora = $rs->ped_hora;

                                
                            echo "
                            <tbody>
                            <tr>
                            
                                <td>
                                    <span class='font-w600 text-center'>$id_pedido</span>
                                </td>

                            <td>
                            <img src='img/cancel.png' width='100' border-radius='8' class='product__img'>
                            </td>

                                

                                <td class='d-none d-sm-table-cell'>
                                    <span class='font-size-sm text-muted text-center'>$ped_hora</span>
                                </td>
                        
                                <td>
                                    <span class='font-w600 text-center' style='color: gray'>$sit_descricao</span>
                                </td>
                                
                                <td class='d-none d-sm-table-cell text-center'>R$ 
                                    $valor_pedido
                                </td>

                                <button class='badge badge-success font-weight-100' style='border: #fa7a33; border-radius:10px; 
                                background-color: #fa7a33; height:40px; font-size:12px; padding:7px;'><a href='detalhe.php' style='color:white'>Detalhes do pedido</a></button>
                                </td>
                                
                                
                                
                            </tr>
                            </tbody>
                            ";
                        }
                    }
                    
                } catch (PDOException $erro) {
                    echo "Erro na conexão:" . $erro->getMessage();
                }
                ?> 
    </table> 
                    </div>





    </div>
</body>

</html>