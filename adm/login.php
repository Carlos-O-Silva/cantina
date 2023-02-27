
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>CanZone_ADMIN</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	
</head>
<body class="d-flex
             justify-content-center
             align-items-center
             vh-100">
	 <div class="w-400 p-5 shadow rounded">
	 	<form method="post" 
	 	      action="logar.php">
	 		<div class="d-flex
	 		            justify-content-center
	 		            align-items-center
	 		            flex-column">

	 		<h3 class="display-4 fs-1 
	 		           text-center">
	 			       Cantina</h3>   


	 		</div>

			<br>
			<br>
		  <div class="mb-3">
		    <label class="form-label">
		           Nome de usuário</label>
		    <input type="text" 
		           class="form-control"
		           name="adm_nome">
		  </div>

		  <div class="mb-3">
		    <label class="form-label">
		           Senha</label>
		    <input type="password" 
		           class="form-control"
		           name="adm_senha">
		  </div>
		  
		  <br>
		  <button type="submit" 
		          class="btn btn-primary form-control" style="background-color: #fa7a33; border-color: #fa7a33">
		          LOGIN</button>
		  
		</form>
	 </div>
</body>
</html>
