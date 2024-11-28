<?php
session_start();

if (isset($_POST['productId']) && isset($_POST['change'])) {
    $productId = $_POST['productId'];
    $change = intval($_POST['change']);

    foreach ($_SESSION['cart'] as &$item) {
        if ($item['product']['id'] == $productId) {
            $item['quantity'] += $change;
            break;
        }
        if(!isset($item)){
            unset($_SESSION['cart']);
        }
    }
}
?>
