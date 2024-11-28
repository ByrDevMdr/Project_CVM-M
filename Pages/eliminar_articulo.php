<?php
session_start();

if (isset($_POST['productId'])) {
    $productId = $_POST['productId'];

    // Buscar y eliminar el artículo del carrito
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['product']['id'] == $productId) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }
    
}
?>
