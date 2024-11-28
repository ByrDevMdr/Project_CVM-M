<?php
session_start();
if (!isset($_POST['Terms'])) {
    $_SESSION['Term'] = "No";
} else {
    $_SESSION['Term'] = "Si";
}
echo $_SESSION['Term'];
?>
