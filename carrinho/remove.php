<?php
session_start();
unset($_SESSION["cart"]);
header("LOCATION:index.php?page=home");
?>