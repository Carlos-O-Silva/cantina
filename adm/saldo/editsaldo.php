

<?php
session_start();
if (!isset($_SESSION['adm_nome'])) {
  header('location: ../login.php');
}

?>


<?php
    // Bloco if que recupera as informações no formulário, etapa utilizada pelo Update
    // Verifica se foi enviando dados via GET
    if ($_GET) {
        $id = (isset($_GET["cod"]) && $_GET["cod"] != null) ? $_GET["cod"] : "";
        //echo "<script>alert('".$id."');</script>";
        include '../../php/conexao.php';
        try {
            $stmt = $db->prepare("SELECT * FROM usuario WHERE Usu_id = ?");
            $stmt->bindParam(1, $id);
            if ($stmt->execute()) {
                $rs = $stmt->fetch(PDO::FETCH_OBJ);
                $id = $rs->usu_id;
                $email = $rs->usu_login;   
                //echo "<script>alert('".$marca."');</script>";
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            echo "Erro: ".$erro->getMessage();
        }
    }
?>
<?php
    if ($_GET) {
        $id = (isset($_GET["cod"]) && $_GET["cod"] != null) ? $_GET["cod"] : "";
        //echo "<script>alert('".$id."');</script>";
        include '../../php/conexao.php';
        try {
            $stmt = $db->prepare("SELECT conta.con_saldo FROM conta INNER JOIN usuario ON conta.con_idUsuario=?");  
        
           
    
            $stmt->bindParam(1, $id);
            if ($stmt->execute()) {
                $rs = $stmt->fetch(PDO::FETCH_OBJ);
                $saldo = $rs->con_saldo;  

                

                //echo "<script>alert('".$marca."');</script>";
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            echo "Erro: ".$erro->getMessage();
        }
    }

    


if(isset($_POST['tipo'])) {
	$tipo = $_POST['tipo'];
	//converter de , para .
	$valor = str_replace(",", ".", $_POST['valor']);
	$valor = floatval($valor);

	if($tipo == '0') {
		// Depósito
		$sql = $db->prepare("UPDATE conta SET con_saldo = con_saldo + :valor ");
		$sql->bindValue(":valor", $valor);

		$sql->execute();

	} else {
		// Saque
		$sql = $db->prepare("UPDATE conta SET con_saldo = con_saldo - :valor");
		$sql->bindValue(":valor", $valor);
	
		$sql->execute();
	}

    if($sql->rowCount()>0){
       
        echo "<script>alert('ALTERAÇÃO FEITA COM SUCESSO');
           window.location.href='../saldo/saldo.php';
          </script>";
        }else{
            //throw new PDOException("Erro: Não foi possível executar a declaração sql");
            echo "Erro: Não foi possível executar a declaração sql";
        }
    }        



?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>FRAN ADMIN</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="saldo.css">
</head>
<body class="d-flex
             justify-content-center
             align-items-center
             vh-100">
	 <div class="pow">
	 	<form method="post">
	 		<div class="d-flex
	 		            justify-content-center

	 		            align-items-center
	 		            flex-column">

	 		<h3 class="display-4 fs-1 
	 		           text-center">
	 			       Adicionar Saldo</h3>   


	 		</div>

			<br>
			<br>
		  <div class="mb-3">
		    <label class="form-label" >
		           Login do usuário</label>
		    <input type="" class="form-control" name="adm_nome" value = '<?php echo "{$email}";?>'disabled>
		  </div>

		  <div class="mb-3">
		    <label class="form-label">
		           Credito atual do usuário</label>
                   <input type="" class="form-control" name="valor" value = '<?php echo "{$saldo}";?>'disabled> 
		  </div>
          
		Tipo de transação<br/>
		<select name="tipo" class="form-control">
			<option value="0">Depósito</option>
			<option value="1">Retirada</option>
		</select><br/><br/>
        <!--pattern="[0-9.,]{1,}" para aceitar numeros . e , -->
		Valor:<br/>
		<input type="text" class="form-control" name="valor" pattern="[0-9.,]{1,}" required/><br/><br/>
      

        <button type="submit" 
		          class="btn btn-primary form-control" style="background-color: #fa7a33; border-color:#fa7a33">
		          ALTERAR SALDO</button>

	</form>
	 </div>
</body>
</html>
