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
            <form action="pedidos.php" method="POST" enctype="multipart/form-data">
                <div class="form-header">
                    
                    <div class="title"><br>
                        <h1 style='margin-left:6.6rem'>Detalhe do Pedido</h1>
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
                                <th class='font-w700'>Produto</th>
                                <th class='d-none d-sm-table-cell font-w700 text-center' style='width: 300px;'>Total</th>
                                <th class='font-w700'>Quantidade</th>
                            </tr>
                        </thead>

                    <?php
include '../../php/conexao.php';
?>

                    <?php

            try {
                $stmt = $db->prepare("SELECT produtos.pro_nome, detalheprodpedido.det_valor, detalheprodpedido.det_quantidade
                FROM detalheprodpedido
                INNER JOIN produtos ON detalheprodpedido.det_produto = produtos.pro_id;");
                if ($stmt->execute()) {
                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                        $pro_nome = $rs->pro_nome;
                        $det_quantidade = $rs->det_quantidade;
                        $det_valor = $rs->det_valor;


                        echo "
                        <tbody>
                        <tr>
                            <td>
                                <span class='font-w600 text-center'>$pro_nome</span>
                            </td>
                            <td class='d-none d-sm-table-cell text-center'>R$ 
                                $det_valor
                            </td>
                            <td>
                                 <span class='font-w600 text-warning text-center'>$det_quantidade</span>
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
<div class="livs" style='margin-left: 2rem'>
<th class='d-none d-sm-table-cell font-w700 text-center' style='width: 300px;'>Subtotal do Pedido: R$18,00</th>
                               
<button class="badge badge-success font-weight-250" style="border: #fa7a33; border-radius:10px; 
         background-color: #fa7a33; height:40px; font-size:12px; padding:7px; margin-left: 400px">Aceitar pedido</button>
         <button class="badge badge-success font-weight-250" style="border: #fa7a33; border-radius:10px; 
         background-color: #fa7a33; height:40px; font-size:12px; padding:7px;">recusar pedido</button>
           
            </div>
                </div>
                <div class="botoes" style= "margin-left: 43rem">
                <div class="continue-button">
                            <button><a href="../index.php" style="color:white">Voltar</a></button>
                        </div></div>
            </div>
        </div></div></div>
        <!-- column -->
</body>

</html>