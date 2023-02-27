<?php
include '../php/conexao.php';
?>
<html>

<head>
    <meta charset="UTF-8">

    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>

<body>

    <div class="container">

        <div class="content first-content">


            <div class="first-column">
                <div class = "logo">
                <img src="img/logo.png">             
                </div>
                
                <button id="signin" class="btn btn-primary">Entrar</button>
            </div>


            <div class="second-column">
                <h2 class="title title-second">Criar nova conta</h2>
                
                <form action="../php/cadastrar.php", form class="form" method="post">
               
                    <!--FORMULÁRIO-->

                    <label class="label-input" for="">
                        <i class="far fa-user icon-modify"></i>
                        <input type="text"  class="input" placeholder="Nome" name="nome" required/>
                    </label>

                    <label class="label-input" for="">
                        <i class="far fa-envelope icon-modify"></i>
                        <input type="text" class="input" placeholder="E-mail" name="email" required/>
                    </label>

                    <label class="label-input" for="">
                        <i class="fas fa-lock icon-modify"></i>
                        <input type="text" class="input" placeholder="Telefone" name="telefone" required/>
                        
                    </label>

                    <label class="label-input" for="">
                        <i class="fas fa-lock icon-modify"></i>
                        <input type="password" class="input" placeholder="Senha" name="senha" required/>
                    </label>

                    

                    <button class ="btn btn-second">Criar</button>

                </form>
            </div>
            <!--segunda coluna-->
        </div>


        <div class="content second-content">
            <div class="first-column">
                <div class = "logo">
                <img src="img/logo.png">             
                </div>
                <button id="signup" class="btn btn-primary">Criar conta</button>
            </div>




            <div class="second-column">
                <h2 class="title title-second">Entrar na conta</h2>

                <form action="../php/login.php", form class="form" method="post">

                    <label class="label-input" for="">
                        <i class="far fa-envelope icon-modify"></i>
                        <input type="email" placeholder="E-mail" name="email" required>
                    </label>

                    <label class="label-input" for="">
                        <i class="fas fa-lock icon-modify"></i>
                        <input type="password" placeholder="Senha" name="senha" required>
                    </label>

                    <a class="password" href="#">esqueceu a senha?</a> <!-- redefinir senha aaa -->
                    <button class="btn btn-second">Entrar</button>
                </form>
            </div><!-- second column -->
        </div><!-- second-content -->
    </div>
    <script src="js/app.js"></script>
</body>

</html>