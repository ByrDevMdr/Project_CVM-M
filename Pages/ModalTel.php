<?php
session_start();
  $_SESSION ['Number'] = $_POST['Number'];
  echo '
  <script>
  window.history.back();
  </script>
  ';
?>