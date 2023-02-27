<?php
session_start();
if (!isset($_SESSION['usu_id'])) {
  header('location:../login/index.php');
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <!--css-->
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

<?php

require_once("../elementos/navbar/index.php");

?>
  <!-- END HEADER -->
  <!-- fim NAV -->


  <div class="banner">
        <img class="d-block w-100" src="../../cantina/home/img/homer.png" alt="First slide">
      </div>

    <!--==================== FOOTER ====================-->
    <footer class="footer section">
        <p class="footer__copy">&#169; Todos os direitos reservados à Cantina da Fran.</p>
    </footer>


</body>

</html>