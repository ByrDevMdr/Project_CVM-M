<?php
session_start();
$_SESSION['IdOrder'] = $_POST['IdOrder'];
$Amount = $_POST['ValueAbono'];

if(!isset($Amount)){
    header("Location: ../index.php");
}
// Dependencias de la carpeta generada por composer. Add
require 'Pagos/vendor/autoload.php';
// Adición del token de mercado pago. Add
MercadoPago\SDK::setAccessToken('TEST-6850231550727824-021111-ffade7be47d15157e181586afc037474-1678702290');

$preference= new MercadoPago\Preference();
$Productos_MP=array();


    // Add
    $item = new MercadoPago\Item();     
    $item -> id = 001;
    $item -> title = 'Abono CVM-M';
    $item -> quantity = 1;
    $item -> currency_id = 'MXN';
    $item -> unit_price = $Amount;

            // Add
        $preference -> items =array($item);
        $preference -> back_urls = array(
            "success" => "https://cvm-m.com/Pages/CaptureAbn.php?amount=" . $Amount,
            "failure" => "https://cvm-m.com/index.php"
        );
            $preference -> save();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Favicon -->
    <link rel="shortcut icon" href="../Img/LogoCarpFavicon.png" type="image/x-icon">
        <!-- Enlace para la hoja de estilos CSS -->
        <link rel="stylesheet" href="StylePyPr.css">
    <!-- Enlace para la tipografía -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <!-- Enlace para font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Abono de pedido</title>
</head>
<body>
        <!-- Modal que indica que el pedido se realizo correctemente -->
<div id="Modal">
            <section class="ModalBack">
                <article class="ModalContent">
                    <span class="MessageCorrect">
                        Mensaje sobre la operación
                    </span>
                    <div class="ModalBody">
                    <span class="ContentModalBoy">
                        <i class="fa-regular fa-circle-check" id="Correct"></i>
                        <hr>
                        <br>
                        <span class="MessageModalBody">
                            El pago se ha realizado correctamente!!
                        </span>
                    </span>
                </div>
                </article>
            </section>
        </div>
          <!-- Fin del modal -->
<table id="Encabezado">
        <tr>
            <td id="ContentBtnRegresar" class="Containers">
            <i class="fa-solid fa-chevron-left" id="IconRegresar"></i>
            </td>
            <td id="ContentTitle" class="Containers">
                <span id="Title">Ventana de pago</span>
            </td>
            <td id="ContentLogo" class="Containers">
                <img src="../Img/Logo.png" alt="LogoTipo">
            </td>
        </tr>
    </table>
        <div id="MPagos">
        <section id="PayPal-button-container"></section>
        <img src="../Img/MercadoPago.png" alt="MP" id="MercadoPago">
        <div class="CheckOutBtn"></div>
        </div> 
    <!-- SDK para mercadopago -->
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <!-- Enlace para hacer peticiones AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Enlace del SDK de JavaScript para PayPal -->
    <script src="https://www.paypal.com/sdk/js?client-id=AR4Vy7AkiONTWtz3ClaQ7mC8x71q3ctP9r3EhJGpjUg2hVircfFglbvqWNUdw8o49uUkyXANYxvT29Iz&currency=MXN"></script>
    <!-- Incrporación de las funciones que tendrá el botón de PayPal -->
        <script>
        let Regresar = document.getElementById("IconRegresar");
        Regresar.addEventListener("click", function () {
            window.location.href = "Pedidos.php";
            // Eliminar la variable de sesión mediante una petición AJAX
            // $.ajax({
            //     type: "POST",
            //     url: "EliminarCarrito.php",
            //     success: function () {
            //       window.location.href = "Pago.php";
            //     },
            //     error: function (error) {
            //         console.error("Error en la petición AJAX", error);
            //     }
            // });
        });
            paypal.Buttons({
            style:{
                shape: 'pill',
                label: 'pay'
            },
            createOrder: function(data, actions){
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value : <?php echo $Amount;?>
                        }
                    }]
                });
            },
            onApprove: function(data, actions){
                actions.order.capture().then(function (detalles){
                    console.log(detalles);
                    showSuccessModal();
                    // Meter todo lo de abonos en el servidor, terminar la captura del abono y almacenarlo en la BD con todas las funciones y modificaciones.

                    // Mandar los datos por medio de una petición AJAX por detras de todo.
                    let Url = 'CaptureAbn.php';
                    return fetch(Url, {
                        method: 'post',
                        headers: {
                            'content-type': 'application/json'
                        },
                        body: JSON.stringify({
                            detalles: detalles
                        })
                    })
                    location.reload();                 
                });
            },
            onCancel: function(data){
                alert("Pago cancelado");
                console.log(data);
            }
        }).render('#PayPal-button-container');
        function showSuccessModal() {
    var modal = document.getElementById('Modal');
    modal.style.display = 'block';
    // Subir todo al servidor y hacer pruebas 
    // Cierra el modal después de 2 segundos y redirige
    setTimeout(function() {
      modal.style.display = 'none';
      window.location.href = 'Pedidos.php';
    }, 2000);
  }
            // Frontend para el botón de mercado pago. Add
          const mp = new MercadoPago('TEST-c07043af-5683-4b71-a0e4-1951011a5e2d',{
            locale:'es-MX'
        });
        mp.checkout({
            preference: {
                id: '<?php echo $preference ->id; ?>'
            },
            render:{
                container: '.CheckOutBtn',
                label: 'Pagar con Mercado Pago'
            }
        })
        </script>
</body>
</html>