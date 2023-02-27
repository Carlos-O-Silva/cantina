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
    <link rel="stylesheet" href="../style.css">
    
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

<body style= "background-color: #fa7a33">   
    



<div class="row" style= "padding: 4rem;">
        <div class="col-sm-12" style="display: flex; width: 90%;
                                      height: 79vh;
                                      border-radius: 1rem;
                                      background-color: #FFF;
                                      ">
            <div class="card">
                <div class="card-body">
                    <!-- title -->
                    <div class="d-md-flex align-items-center">
                        <div class= "teste" style="margin: 0 auto">
                            <h4 class="card-title" style= "font-size: 2rem;
    font-weight: 600; text-align:center">Editar ou desativar produtos</h4>
                        </div>
                    </div>

                    <!-- title -->
                </div>
                <div class="table-responsive">
                    <table class="table v-middle">
                        <thead>
                            <tr class="bg-light" style="height: 5rem;">
                                <th class="border-top-0" style="text-align: center; padding:2rem;">Foto</th>
                                <th class="border-top-0" style="text-align: center; padding:2rem;">Nome</th>
                                <th class="border-top-0" style="text-align: center; padding:2rem;">Descrição</th>
                                <th class="border-top-0" style="text-align: center; padding:2rem;">Categoria</th>
                                <th class="border-top-0" style="text-align: center; padding:2rem;">Valor</th>
                             
                                <th class="border-top-0">
                                <form method="POST" action="">    
    <div class="search-div" style="font-size: 15px;">
    <div class="dudu" style="margin: 0 auto;">
    
    <input type="text" style="width:310px;" name="pro_nome"  class="search" placeholder="digite o produto que deseja procurar"
	   value="<?php if(isset($dados['pro_nome'])){ echo $dados['pro_nome']; } ?>">
       <th class="border-top-0">
       <input class="button2 button--flex" style="display: flex; margin-bottom:.7rem;" value="Buscar" type="submit" name="pesqUsuario" id="pesqUsuario" style="background: #fa7a33">
      </div>
   </form>
    </div>


   <?php
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    //var_dump($dados);
    ?>
         <th class="border-top-0"></th>
                                </th></th>
                                
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    
                                <?php
         include '../../php/conexao.php';
         if (!empty($dados['pesqUsuario'])) {            
            $nome = "%" . $dados['pro_nome'] . "%";
            
            $query_usuarios = "SELECT pro_nome, pro_descricao, pro_valor, pro_foto, pro_id, clas_id FROM produtos WHERE pro_nome LIKE :pro_nome ORDER BY pro_nome ASC";
            $result_usuarios = $db->prepare($query_usuarios);
            $result_usuarios->bindParam(':pro_nome', $nome, PDO::PARAM_STR);

            $result_usuarios->execute();
            while ($row_usuario = $result_usuarios->fetch(PDO::FETCH_ASSOC)) {
                extract($row_usuario);

                              
                                           echo "<tr>
                                           <td><img width='100' style=' display:flex; margin: 0 auto;' src='../upload/$pro_foto'></td>
                                           <td style='text-align: center; padding:2.5rem;'>{$pro_nome}</td> 
                                           <td style='text-align: center; padding:2.5rem;'>{$pro_descricao}</td> 
                                           <td style='text-align: center; padding:2.5rem;'>{$clas_id}</td> 
                                           <td style='text-align: center; padding:2.5rem;'>{$pro_valor}</td> 
                                                                 
                                           <td style='padding:2.5rem; text-align: center;'>
                                           <a class='button2 button--flex' href='#' style='width: 65px; margin-left: 50px;' value= 'Buscar' 
                                           type='submit' name='pesqUsuario' id='pesqUsuario' style='background: #fa7a33; display:flex'</a>Editar</td>


                                           <td style=' padding:2.5rem; text-align: center;'>
                                           <a class='button2 button--flex' href='#' style='width:100px' value= 'Buscar' type='submit' 
                                           name='pesqUsuario' id='pesqUsuario' style='background: #fa7a33;'</a>Desativar</td>
                      
                                           </tr>";

                                        }
                                    }    
                                     
                               ?>
                               
<?php
            try {
                $stmt = $db->prepare("SELECT produtos.pro_id, produtos.pro_nome, produtos.pro_descricao, produtos.pro_foto,
                classificacao.clas_descricao, produtos.pro_valor
                FROM produtos
                INNER JOIN classificacao ON produtos.clas_id = classificacao.clas_id;");
                if ($stmt->execute()) {
                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                        $pro_id = $rs->pro_id;
                        $pro_nome = $rs->pro_nome;
                        $pro_descricao = $rs->pro_descricao;
                        $pro_foto = $rs->pro_foto;
                        $clas_descricao = $rs->clas_descricao;
                        $pro_valor = $rs->pro_valor;

                      echo  "<tr> 
                      <td><img width='100' style=' display:flex; margin: 0 auto;' src='../upload/$pro_foto'></td>
                      <td style='text-align: center; padding:2.5rem;'>{$pro_nome}</td> 
                      <td style='text-align: center; padding:2.5rem;'>{$pro_descricao}</td> 
                      <td style='text-align: center; padding:2.5rem;'>{$clas_descricao}</td> 
                      <td style='text-align: center; padding:2.5rem;'>{$pro_valor}</td> 
                      
                      <td style='padding:2.5rem; text-align: center;'>
                      <a class='button2 button--flex' href='#' style='width: 65px; margin-left: 50px;' value= 'Buscar' 
                      type='submit' name='pesqUsuario' id='pesqUsuario' style='background: #fa7a33; display:flex'</a>Editar</td>


                      <td style=' padding:2.5rem; text-align: center;'>
                      <a class='button2 button--flex' href='#' style='width:100px' value= 'Buscar' type='submit' 
                      name='pesqUsuario' id='pesqUsuario' style='background: #fa7a33;'</a>Desativar</td>
                      
                      
                      
                      
                      </tr>";

                    }
                }
            } catch (PDOException $erro) {
                echo "Erro na conexão:" . $erro->getMessage();
            }
        ?> 


                               
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    
<!-- Le Javascript -->
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://bootadmin.org/scripts/vendor/bootstrap.min.js"></script>
<script src="https://bootadmin.org/scripts/vendor/library.min.js"></script>



<script src="https://bootadmin.org/scripts/core/main.js"></script>

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-104952515-1', 'auto');
    ga('send', 'pageview');
</script>

<script>
    /*
Get the opensource admin theme at bootadmin.org
*/
</script>
</body>
</html>
