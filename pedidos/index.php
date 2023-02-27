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
$stmt = $db->prepare("SELECT produtos.pro_nome, detalheprodpedido.det_idPedido, produtos.pro_foto, produtos.pro_descricao, produtos.pro_valor
FROM detalheprodpedido
INNER JOIN produtos ON detalheprodpedido.det_produto = produtos.pro_id 
WHERE det_idPedido = 1;");
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


    <nav class="subnav" style="width: 900px; display:flex;">
        <li class='nav_item'><a href="#todos" class='nav__link' style='padding: .1rem 5rem; font-size: 1.15rem; color: black;'>Todos</a></li>
        <li class='nav_item'><a href="#pendentes" class='nav__link' style='padding: .1rem 2rem; font-size: 1.15rem; color: black;'>Pendentes</a></li>
        <li class='nav_item'><a href="#aceitos" class='nav__link' style='padding: .1rem 5rem; font-size: 1.15rem; color: black;'>Aceitos</a></li>
        <li class='nav_item'><a href="#prontos" class='nav__link' style='padding: .1rem 2rem; font-size: 1.15rem; color: black;'>Prontos</a></li>
        <li class='nav_item'><a href="#concluidos" class='nav__link' style='padding: .1rem 2rem; font-size: 1.15rem; color: black;'>Concluidos</a></li>
        <li class='nav_item'><a href="#cancelados" class='nav__link' style='padding: .1rem 5rem; font-size: 1.15rem; color: black;'>Cancelados</a></li>
    </nav><br>



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
                            
                        
                                <td style= 'text-align: center'>
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
    </table> <hr style="color: #fa7a33">
                    </div>


                    <a name='pendentes'></a>
                    
                    <div class='pendentes'>
                                <h2 class='section__title-center' style='color: black;'>
                                    Pendentes
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
                    WHERE id_situacaoPedido = 1;");
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
                            <img src='img/carregando.png' style= 'margin-right:3.5rem' width='100' border-radius='8' class='product__img'>
                            </td>

                        
                                <td>
                                    <span class='font-w600 text-center' style='color: gray'>$sit_descricao</span>
                                </td>
                
                                <td class='d-none d-sm-table-cell text-center'>R$ 
                                    $valor_pedido
                                </td>

                                <td><button class='badge badge-success font-weight-100' style='border: #fa7a33; border-radius:10px; 
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
    </table> <hr style="color: #fa7a33">
                    </div>


            
                    <a name='aceitos'></a>
                     
                    <div class='aceitos'>
                                <h2 class='section__title-center' style='color: black;'>
                                    Aceitos
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
                        WHERE id_situacaoPedido = 2; ");
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
                            <img src='img/aceitar.png' width='100' border-radius='8' style= 'margin-right:-3rem' class='product__img'>
                            </td>
                        
                                <td style= 'text-align: center'>
                                    <span class='font-w600 text-center'  style='color: gray'>$sit_descricao</span>
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
    </table> <hr style="color: #fa7a33">
                    </div>


                    
                    <a name='prontos'></a>
                    
                    <div class='prontos'>
                                <h2 class='section__title-center' style='color: black;'>
                                    Prontos para a retirada
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
                        WHERE id_situacaoPedido = 3;");
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
                            <img src='img/andando.png' width='100' border-radius='8' class='product__img'>
                            </td>

                        
                                <td style= 'text-align: center'>
                                    <span class='font-w600 text-center' style='color: gray'>$sit_descricao</span>
                                </td>
                                
                                <td class='d-none d-sm-table-cell text-center'>R$ 
                                    $valor_pedido
                                </td>

                                <td><button class='badge badge-success font-weight-100' style='border: #fa7a33; border-radius:10px; 
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
    </table> <hr style="color: #fa7a33">
                    </div>


                    <a name='concluidos'></a>
                
                    
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
                            <img src='img/lista.png' width='100' border-radius='8' style='margin-left: -4rem' class='product__img'>
                            </td>

                                
                        
                                <td style= 'text-align: center'>
                                    <span class='font-w600 text-center' style='color: gray;'>$sit_descricao</span>
                                </td>
                                
                                <td class='d-none d-sm-table-cell text-center'>R$ 
                                    $valor_pedido
                                </td>

                                <td><button class='badge badge-success font-weight-100' style='border: #fa7a33; border-radius:10px; 
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
    </table> <hr style="color: #fa7a33">
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
                            <img src='img/cancel.png' width='100' border-radius='8' style= 'margin-right:-3.5rem' class='product__img'>
                            </td>
                        
                                <td style= 'text-align: center'>
                                    <span class='font-w600 text-center' style='color: gray'>$sit_descricao</span>
                                </td>
                                
                                <td class='d-none d-sm-table-cell text-center'>R$ 
                                    $valor_pedido
                                </td>
                                <td><button class='badge badge-success font-weight-100' style='border: #fa7a33; border-radius:10px; 
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
    </table><hr style="color: #fa7a33">
                    </div>





    </div>
</body>

</html>