<?php
session_start();

if (!isset($_SESSION['adm_nome'])) {
    header('location: ../login.php');
  }

?>

<!DOCTYPE html>
<html lang="en"> 
<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        
           Fran
        
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

    <script type="text/javascript">
        var host = "bootadmin.org";
        if ((host == window.location.host) && (window.location.protocol != "https:"))
            window.location.protocol = "https";
    </script>

    <!-- Le Meta Data -->
    <meta content="Bootadmin" property="og:site_name">
    <meta content="Bootadmin" property="og:title">
    <meta content="website" property="og:type">
    <meta content="Bootadmin is an open source bootstrap admin panel." property="og:description">
    <meta name="keywords" content="bootstrap, admin, theme, panel, administration, material">
    
    
    <meta content="/images/logo.png" property="og:image">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@iamshipon1988">
    <meta name="twitter:creator" content="@iamshipon1988">
    
    <meta name="twitter:title" content="Bootadmin">
    
    
    <meta name="twitter:description" content="An opensource bootstrap admin panel.">
    

    <!-- Le App Banner Data -->
    <meta name="apple-itunes-app" content="app-id=1245521413">
    <!--<meta name="apple-itunes-app" content="app-id=1245521413, affiliate-data=myAffiliateData, app-argument=myURL">-->

    <!-- Le Mobile Specific Metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Le CSS
    ================================================== -->
    <link rel="stylesheet" href="https://bootadmin.org/style/vendor/library.min.css">
    <link rel="stylesheet" href="https://bootadmin.org/style/vendor/jqueryui-flat/jquery-ui.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../css/cadastro.css">
    
    <link rel="stylesheet" href="https://bootadmin.org/style/core/style.min.css">

    <!-- Le IE Conditionals
    ================================================== -->
    <!--[if lt IE 9]>
	    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le Javascript Pre-loads
    ================================================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Le Page Specific Codes
    ================================================== -->
    

	<!-- Le Favicons
	================================================== -->
    <link rel="apple-touch-icon" sizes="76x76" href="/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="/images/favicon/site.webmanifest">
    <link rel="mask-icon" href="/images/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="/images/favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="msapplication-config" content="/images/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
</head>

<body style="background-color: #fa803e;">
    <div class="container">
        <div class="form">
            <form action="detalhe.php" method="POST" enctype="multipart/form-data">
                <div class="form-header">
                    
                    <div class="title"><br>
                        <h1 style='margin-left:6.6rem'>Pedidos de hoje</h1>
                    </div>

                </div>

<div class="row">
        <!-- column -->
        <div class="teste">
            <div class="card card-hover" style='border:white; width: 1000px'>
                <div class="card-body">
                
                    <table class='table table-striped table-hover table-borderless table-vcenter font-size-sm'>
                        <thead>
                            <tr class='text-uppercase'>
                                <th class='font-w700'>Pedido</th>
                                <th class='d-none d-sm-table-cell font-w700'>Hora</th>
                                <th class='font-w700'>Status</th>
                                <th class='d-none d-sm-table-cell font-w700 text-center' style='width: 100px;'>Valor</th>
                                <th class='font-w700 text-center' style='width: 30px;' href='../index.php'></th>
                            </tr>
                        </thead>

                    <?php
include '../../php/conexao.php';
?>

                    <?php

            try {
                $stmt = $db->prepare("SELECT pedidos.id_pedido, pedidos.id_usuario, pedidos.valor_pedido, 
                pedidos.data_pedido, situacaopedido.sit_descricao, pedidos.motivoCanelamento, pedidos.ped_hora
                FROM pedidos
                INNER JOIN situacaopedido ON pedidos.id_situacaoPedido = situacaopedido.sit_id ORDER BY pedidos.id_pedido; ");
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
                            <td class='d-none d-sm-table-cell'>
                                <span class='font-size-sm text-muted text-center'>$ped_hora</span>
                            </td>
                            <td>
                                <span class='font-w600 text-warning text-center'>$sit_descricao</span>
                            </td>
                            <td class='d-none d-sm-table-cell text-center'>R$ 
                                $valor_pedido
                            </td>
                            <td>
                              <button class='badge badge-success font-weight-100' href='teste.php' style= 'border: #fa7a33; border-radius:10px; background-color: #fa7a33'>Detalhes do Pedido</button>
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

                <div class="botoes" style= "margin-left: 43rem">
                <div class="continue-button">
                            <button><a href="../index.php">Voltar</a></button>
                        </div></div>
            </div>
        </div></div></div>
        <!-- column -->
</body>

</html>