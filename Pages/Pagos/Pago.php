<?php
session_start();
$Server = "localhost";
$User = "root";
$Pwd = "";
$BD = "Almacen";
$Conexion = mysqli_connect($Server, $User, $Pwd, $BD);
// Dependencias de la carpeta generada por composer. Add
require 'vendor/autoload.php';
// Adición del token de mercado pago. Add
MercadoPago\SDK::setAccessToken('TEST-6850231550727824-021111-ffade7be47d15157e181586afc037474-1678702290');

$preference= new MercadoPago\Preference();
$Productos_MP=array(); // Add

if (isset($_POST['clear_cart'])) {
    unset($_SESSION['cart']);
    unset($_SESSION['cart_count']);
}
// Función que calculara el total del carrito. 
function calculateCartTotal()
{
    $total = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['quantity'] * $item['product']['price'];
        }
    }
    return $total;
}
// Bloques de comprocación y a asu vez restricción.
if(!isset($_SESSION['User'])){
    header("Location:../Inicio de sesion.php");
    exit();
}
else if(!isset($_SESSION['cart'])){
    header("Location: ../VistaProductos.php");
    exit();
}
// include   'VistaProductos.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago de pedido</title>
    <!--Favicon-->
    <link rel="shortcut icon" href="../../Img/LogoCarpFavicon.png" type="image/x-icon">
    <!-- Enlace para la tipografía -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <!-- Enlace para la hoja de estilos -->
    <link rel="stylesheet" href="../StylePago.css">
    <!-- Enlace para font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <table id="Encabezado">
        <tr>
            <td id="ContentBtnRegresar" class="Containers">
            <i class="fa-solid fa-chevron-left" id="IconRegresar"></i>
            </td>
            <td id="ContentTitle" class="Containers">
                <span id="Title">Elija el modo de pago</span>
            </td>
            <td id="ContentLogo" class="Containers">
                <img src="../../Img/Logo.png" alt="LogoTipo">
            </td>
        </tr>
    </table>        
    <?php
    $productNames = array(); //Inicialización del arreglo para almacenar el nombre de los productos.
    //Se recorre el carrito y se agregan los nombres con cantidades al arreglo que se declara dentro del bucle foreach.
    foreach ($_SESSION['cart'] as $item) {
        $productName = $item['product']['name'];
        $productPrice = $item['product']['price'];
        $productQuantity = $item['quantity'];
        $productNames[] = array('name' => $productName, 'quantity' => $productQuantity, 'price' => $productPrice);
    }
    $productNamesJSON = json_encode($productNames); //Se convierte el arreglo a una cadena JSON
?>
    <section id="PanelMain">
        <article id="Método">  
        <form action="Process.php" method="POST">
            <label for="metodo_pago" id="MethodSelect">Seleccione el método de pago:</label>
            <input id="InputContado" type="radio" name="metodo_pago" value="Contado" checked> <label for="InputContado">Contado</label>
            <input id="InputAbono" type="radio" name="metodo_pago" value="Abonos"> <label for="InputAbono">Abonos</label>
            <br>
            <br>
            <label for="facturar">¿Desea facturar?</label>
            <select id="facturar" name="facturar">
                <option value="Si">Sí</option>
                <option value="No" selected>No</option>
            </select>
            <input type="hidden" name="Total" value="<?php echo calculateCartTotal(); ?>">
            <input type="hidden" name="Prod" value="<?php echo htmlspecialchars($productNamesJSON); ?>"> 
            <br>
            <button type="submit" id="BtnPay"><i class="fa-solid fa-money-bill"></i> Realizar pago</button>
        </form>        
        <div id="ContNota">
            <span id="Nota">Nota: si elije el modo de pago 'Abonos' tendrá que realizar un deposito de al menos el 50% de la cantidad total del pedido. Esto para asegurar su pedido.</span>
        </div>
        </article>

        <ul id="Detalles">
            <span id="Details">Detalles de compra</span>
            <hr>
                            <?php if (isset($_SESSION['cart'])) : ?>
                                <?php foreach ($_SESSION['cart'] as $item) : ?>
                                    <li class="BodyModalCart">
                                        <?php echo $item['product']['name']; ?> -
                                        Cantidad: 
                                        <button type="button" class="BtnLess" data-product-id="<?php echo $item['product']['id']; ?>">-</button>
                                        <?php echo $item['quantity']; $_SESSION['Cantidad'] = $item['quantity']; ?>
                                        <button type="button" class="BtnMore" data-product-id="<?php echo $item['product']['id']; ?>">+</button>
                                        -
                                        Subtotal: $<?php echo $item['quantity'] * $item['product']['price']; ?>
                                        <button type="button" class="BtnRemove" data-product-id="<?php echo $item['product']['id']; ?>">Eliminar</button>
                                    </li>
                                <?php endforeach; ?>

                                <li class="BodyModalCart">Total del Carrito: $<?php echo calculateCartTotal(); ?></li>
                                <form aclass="BodyModalCart"ction="VistaProductos.php" method="post">
                                    <button type="submit" name="clear_cart" id="ClearCart"><i class="fa-regular fa-trash-can"></i> Regresar y eliminar todo </button>
                                </form>
                            <?php else : ?>
                                <li class="BodyModalCart">El carrito está vacío</li>
                            <?php endif; ?>
        </ul>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    let Regresar = document.getElementById("IconRegresar");
    Regresar.addEventListener("click",function(){
        window.location.href="../VistaProductos.php";
    });
     $(document).ready(function() {
        $(".BtnLess").on("click", function() {
            var productId = $(this).data("product-id");
            updateQuantity(productId, -1);
        });

        $(".BtnMore").on("click", function() {
            var productId = $(this).data("product-id");
            updateQuantity(productId, 1);
        });

        $(".BtnRemove").on("click", function() {
            var productId = $(this).data("product-id");
            removeItem(productId);
        });

function updateQuantity(productId, change) {
    // Obtener la cantidad actual del producto en el carrito
    var currentQuantity = parseInt($("#quantity_" + productId).text());

    // Calcular la nueva cantidad sumando el cambio
    var newQuantity = currentQuantity + change;

    // Verificar si la nueva cantidad excede el límite máximo (10)
    if (newQuantity > 10) {
        alert("La cantidad máxima permitida es 10.");
        return; // Salir de la función sin realizar la solicitud AJAX
    }

    // Realizar una solicitud AJAX para actualizar la cantidad del artículo en el carrito
    $.ajax({
        type: "POST",
        url: "../actualizar_cantidad.php",
        data: { productId: productId, change: change },
        success: function(response) {
            location.reload();       // La función reload actualiza la interfaz después de recibir la respuesta
        },
        error: function(error) {
            console.error("Error en la solicitud AJAX", error);
        }
    });
}


        function removeItem(productId) {
            // Realizar una solicitud AJAX para eliminar el artículo del carrito
            $.ajax({
                type: "POST",
                url: "../eliminar_articulo.php", 
                data: { productId: productId },
                success: function(response) {
                    location.reload();
                },
                error: function(error) {
                    console.error("Error en la solicitud AJAX", error);
                }
            });
        }
    });
</script>

</body>
</html>