
<?php

include '../php/conexao.php';

if (!isset($_SESSION['usu_id'])) {
    header('location:../Login/index.php');

}

    include '../php/conexao.php';
    
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
    }
    
    }
    
    ?>
    
    <?php
    
    $products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
    $subtotal = 0.00;
    
    if ($products_in_cart) {
    
        $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
        $stmt = $db->prepare('SELECT * FROM produtos WHERE pro_id IN (' . $array_to_question_marks . ')');
        // Precisamos apenas das chaves do array, não dos valores, as chaves são os id's dos produtos
        $stmt->execute(array_keys($products_in_cart));       
        // Busca os produtos do banco de dados e retorna o resultado como um Array
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Calcular valor do pedido
        foreach ($products as $product) {
            $subtotal += (float)$product['pro_valor'] * (int)$products_in_cart[$product['pro_id']];
            $_SESSION['cart']['subtotal'] = $subtotal;
        }
    }
    
        
    
    
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Finalizacao Pedido</title>
    </head>
    <body>
        <form method="POST">
            <select name="tipo">
                <option value="0">Valor do Pedido</option>
            </select>
            <!--pattern="[0-9.,]{1,}" para aceitar numeros . e , -->		         
                                                <tr>
                    <div class="row g-2">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                            <a>Valor da Compra</a>
                            <a>R$ <?= $subtotal ?></a>                                
                                </a></li>
                        </div>
                    </div>
                                                </tr>
                </div>
            </div>
        </div>
        <input type="hidden" value = '<?php echo "{$subtotal}";?>' name="valor" pattern="[0-9.,]{1,}" /><br/><br/> 
            <input type="submit" value="Finalizar Compra!" />
    
        </form>
    </body>
    </html>
    