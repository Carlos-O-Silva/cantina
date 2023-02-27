<?php
include '../php/conexao.php';


if (!isset($_SESSION['usu_id'])) {
    header('location:../login/index.php');


}
if(isset($_POST['tipo'])) {
    $tipo = $_POST['tipo'];
    //converter de , para .
    $valor = str_replace(",", ".", $_POST['valor']);
    $valor = floatval($valor);

    if($tipo == '0') {
    
    $sql = $db->prepare("UPDATE conta SET con_saldo = con_saldo - :valor WHERE con_idUsuario = :con_idUsuario");
    $sql->bindValue(":valor", $valor);
    $sql->bindValue(":con_idUsuario", $_SESSION['usu_id']);
    $sql->execute();


    if($sql->rowCount()>0){
       
        echo "<script>alert('Pedido efetuado com sucesso!');
           window.location.href='../pedidos/index.php';
          </script>";
        }else{
            //throw new PDOException("Erro: Não foi possível executar a declaração sql");
            echo "Erro: Não foi possível executar a declaração sql";
        }
    }else{
        echo "Erro";
    }            

}




//ob_start();

// If the user clicked the add to cart button on the product page we can check for the form data
if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['product_id']) && is_numeric($_POST['quantity'])) {
    // Set the post variables so we easily identify them, also make sure they are integer
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    // Prepare the SQL statement, we basically are checking if the product exists in our databaser
    $stmt = $db->prepare('SELECT * FROM produtos WHERE pro_id = ?');
    $stmt->execute([$_POST['product_id']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    if ($product && $quantity > 0) {
        // Product exists in database, now we can create/update the session variable for the cart
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            if (array_key_exists($product_id, $_SESSION['cart'])) {
                // Product exists in cart so just update the quanity
                $_SESSION['cart'][$product_id] += $quantity;
            } else {
                // Product is not in cart so add it
                $_SESSION['cart'][$product_id] = $quantity;
            }
        } else {
            // There are no products in cart, this will add the first product to cart
            $_SESSION['cart'] = array($product_id => $quantity);
        }
    }
    // Prevent form resubmission...
    header('location: index.php?page=carrinho');
    exit;
}

// Remove product from cart, check for the URL param "remove", this is the product id, make sure it's a number and check if it's in the cart
if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
    // Remove the product from the shopping cart
    unset($_SESSION['cart'][$_GET['remove']]);
}

// Update product quantities in cart if the user clicks the "Update" button on the shopping cart page
if (isset($_POST['update']) && isset($_SESSION['cart'])) {
    // Loop through the post data so we can update the quantities for every product in cart
    foreach ($_POST as $k => $v) {
        if (strpos($k, 'quantity') !== false && is_numeric($v)) {
            $id = str_replace('quantity-', '', $k);
            $quantity = (int)$v;
            // Always do checks and validation
            if (is_numeric($id) && isset($_SESSION['cart'][$id]) && $quantity > 0) {
                // Update new quantity
                $_SESSION['cart'][$id] = $quantity;
            }
        }
    }
    // Prevent form resubmission...
    header('Location: index.php?page=carrinho');
    exit;

    

}


// Send the user to the place order page if they click the Place Order button, also the cart should not be empty
if (isset($_POST['placeorder']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    header('Location: index.php?page=');
    exit;
}

// Check the session variable for products in cart
$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;
// If there are products in cart
if ($products_in_cart) {
    // There are products in the cart so we need to select those products from the database
    // Products in cart array to question mark string array, we need the SQL statement to include IN (?,?,?,...etc)
    $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $stmt = $db->prepare('SELECT * FROM produtos WHERE pro_id IN (' . $array_to_question_marks . ')');
    // We only need the array keys, not the values, the keys are the id's of the products
    $stmt->execute(array_keys($products_in_cart));
    // Fetch the products from the database and return the result as an Array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Calculate the subtotal
    foreach ($products as $product) {
        $subtotal += (float)$product['pro_valor'] * (int)$products_in_cart[$product['pro_id']];
        $_SESSION['cart']['subtotal'] = $subtotal;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo/logo.png">
    <link href="https://fonts.googleapis.com/css?family=Oswald:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style_nav.css">
    
    <!-- <link rel="stylesheet" href="css/carrinho_styles.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

    <!-- Título -->
    <title>Cantina da Fran</title>
</head>


<body style="background-color: white;">
    <div class="container" style="
    margin-top: 7rem;
    width: 90%;
    height: 75vh;
    /* display: flex;*/
    /*box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.212);*/
    border-radius: 1rem;
    background-color: #FFF;">


        <br><br>
        <div class="main">

            <body style="background-color: white;">
                <div class="container" >
                <form method="POST">

                        <div class="title"style='margin:0 auto; display:flex'>
                            <h1 style='margin: 0 auto'>Seu Carrinho</h1>
                        </div><br>

                </div>

                <div class="row">
                    <!-- column -->
                    <div class="teste">
                        <div class="card card-hover" style='border:white; width: 1000px;  border-radius: 8px; margin: 0 auto'>
                            <div class="card-body">

                                <table class='table table-vcenter'>
                                    <thead>
                                        <tr class='text-uppercase'>
                                            
                                            <th scope='col' class='font-w700' style="font-size:23px" style='width: 170px; color:white'>Produto</th>
                                            <th scope='col' class='font-w700' style="font-size:23px" style='width: 200px;'></th>
                                            <th scope='col' class='font-w700' style="font-size:23px" style='width: 200px;'>Valor</th>
                                            <th scope='col' class='font-w700' style="font-size:23px" style='width: 200px;'>Quantidade</th>
                                            <th scope='col' class='font-w700 text-center' style='width: 30px;' href='../index.php'></th>
                                        </tr>
                                    </thead>

                                    <?php
                                    include '../php/conexao.php';
                                    ?>



                                    <tbody>
                                        <?php if (empty($products)) : ?>
                                            <tr>
                                                <th scope="col" style="text-align:center;">Seu carrinho está vazio!</th>
                                            </tr>
                                        <?php else :

                                                foreach ($products as $product) : ?>
                                                <tr>
                                                    
                                                <td>
                                                <img src="../adm/upload/<?= $product['pro_foto'] ?>" width="90" border-radius="8" class='product__img' style="margin-left:2px">
                    </a>
                                                        <br>
                                                    </td>
                                                    <td>
                                                        <a style="font-size:20px"><?= $product['pro_nome'] ?></a>
                                                        <br>
                                                    </td>
                                                    <td class="price"><a style="font-size:20px">R$ <?= $product['pro_valor'] ?></a></td>

                                                    <!-- QUANTIDADE TOTAL DOS PROTUDOS NO CARRINHO -->

                                                    <td>
                                                    <input type="" style="width:90px; margin-left:2rem; border: transparent; text-align: center;" name="quantity-<?= $product['pro_id'] ?>" value="<?= $products_in_cart[$product['pro_id']] ?>" min="1" max="<?= $produto['pro_qtd'] ?>" placeholder="Quantidade" disabled>
                                                </td>
                                                    <td>


                                                    <!-- QUANTIDADE TOTAL DOS PROTUDOS NO CARRINHO -->


                                                    <a class="btn btn-danger col-auto remove" style='background: red;' role="button" href="index.php?page=carrinho&remove=<?= $product['pro_id'] ?>">
                                                            <ion-icon class="fs-5 mt-1" name="trash"></ion-icon>
                                                        </a>
                                                        
                                                    </td>
                                                </tr>
                                            <?php

                                   


                                        endforeach; 
                                            endif;
                                             ?>
                                    </tbody>
                                </table>


                                <!-- VALOR TOTAL DOS PROTUDOS NO CARRINHO -->


                                <input type="hidden" value = '<?php echo "{$subtotal}";?>' name="valor" pattern="[0-9.,]{1,}" /><br/><br/> 

                                <!-- VALOR TOTAL DOS PROTUDOS NO CARRINHO -->
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="d-grid ml-6 d-md-flex mb-5">
                            <div class="botoes" style='margin-left: 44.5rem; margin-top: -4rem'>
                       
                                <div class="continue-button">
                                <form method="POST">
            <select name="tipo" style="margin-right:12rem">
                <option value="0"></option>
            </select>
            <br>
            <br>
            <br>
            <br>
            
                                                <tr>
                    <div class="row g-2" style="width: 100rem">                          
                        <div class="continue-button" style="margin-left: 50rem">
                            <button style="margin-left:47rem;  margin-top: 4rem"><a href="../cardapio/index.php" style="color: white;">Voltar</a></button>
                        </div>
                    </div>
                    
                                                </tr>
                </div><div class="pfvdacerto" style="margin-bottom: 3rem; margin-top: 3rem;">
            <a style='margin-top: 3rem; font-size: 25px;position:relative; color:black; margin-left: -50rem'>Total: R$<?= number_format($subtotal,2,",","."); ?></a>
            </div>
            </div>
            
        </div>
        <input type="hidden" value = '<?php echo "{$subtotal}";?>' name="valor" pattern="[0-9.,]{1,}" /><br/><br/> 
                          
        <button style="
        height:50px;
    background-color: #fa7a33;
    padding: 0.62rem;
    border-radius: 10px;
    width:45rem;
    margin-left:11rem;
    margin-top: -1.5rem">
    <input type="submit" style="
    background-color: #fa7a33; border: none; color: white" value="Finalizar Compra!"/></button>
    
        </form>
                                  
                                    </button>
                                </div>  </div>

                                    </div>
                        </div>


                                 
                                </div>
                        </form>
                    </div>
                </div>
        </div>

        <?php
require_once("../elementos/navbar/index.php"); //

?>

    <!-- Frameworks/Links -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/keen-slider@6.6.10/keen-slider.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="scripts/menu.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>



</html>