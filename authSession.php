<?php
session_start();
if(empty($_SESSION['auth'])||($_SESSION['auth']!=true)){
  header("Location: ../index.php?op=acessoNegado");
  die();
  }
?>