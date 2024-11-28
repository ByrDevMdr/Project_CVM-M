<?php
session_start();
  $_SESSION ['Dirección'] = $_POST['Dirección'];
  echo '
  <script>
  window.history.back();
  </script>
  ';
?>