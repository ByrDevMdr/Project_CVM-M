<?php
session_start();
  $_SESSION ['Name'] = $_POST['N'];
  $_SESSION ['Apellido'] = $_POST['A'];
  $_SESSION ['Username'] = $_POST['Username'];
  echo '
  <script>
  window.history.back();
  </script>
  ';
?>