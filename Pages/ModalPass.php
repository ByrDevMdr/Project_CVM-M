<?php
session_start();
$_SESSION['PWD'] = $_POST['Pass'];
$Contraseña_Confirmada = $_POST['PassC'];
$Password = $_POST['Pass'];
$_SESSION['Pass'] = password_hash($Password, PASSWORD_DEFAULT); #Contraseña hasheada.

echo '
  <script>
  window.history.back();
  </script>
  ';
?>