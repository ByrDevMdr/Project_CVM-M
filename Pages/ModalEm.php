<?php
session_start();
  $_SESSION ['Email'] = $_POST['Email'];
  echo '
  <script>
  window.history.back();
  </script>
  ';
?>