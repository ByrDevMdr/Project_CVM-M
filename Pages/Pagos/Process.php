<?php 
session_start();
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

// Add
require 'vendor/autoload.php';
MercadoPago\SDK::setAccessToken('TEST-6850231550727824-021111-ffade7be47d15157e181586afc037474-1678702290');
$preference = new MercadoPago\Preference();


// $preference -> items =array($item);

// $preference -> save();

// Sustracción por el método post de la forma de pago seleccionada para realizar operaciones.
$Method = $_POST['metodo_pago'];
$Facture = $_POST['facturar'];
$Cant = $_POST['Total'];
$productNamesJSON = $_POST['Prod'];

$productNamesArray = json_decode($productNamesJSON, true);
if($Facture == 'Si'){
    $IVA = $Cant * 0.16;
    $Cant = $IVA + $Cant;
}else if($Facture == 'No'){
    // $Cant = $Cant;
}
$_SESSION['IVA'] = $IVA;
// echo 'Usted pagará: '. $Cant;
// // Verificar si la decodificación fue exitosa
// if ($productNamesArray !== null) {
//     // Mostrar los elementos del arreglo en pantalla
//     echo "Contenido del arreglo recibido:<br>";
//     foreach ($productNamesArray as $product) {
//         echo "Nombre: " . $product['name'] . ", Cantidad: " . $product['price'] . "<br>";
//         // echo $Cant;
//     }
// } else {
//     // Manejar el caso en que la decodificación del JSON falla
//     echo "Error al decodificar el JSON recibido.";
// }


if(!isset($_SESSION['cart'])){
    header("Location:../VistaProductos.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--Cambiar el icono de la página en la pestaña superior de búsqueda-->
    <link rel="shortcut icon" href="../../Img/LogoCarpFavicon.png" type="image/x-icon">
    <!-- SDK para mercadopago -->
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <!-- SDK de javascript para paypal -->
    <script src="https://www.paypal.com/sdk/js?client-id=AR4Vy7AkiONTWtz3ClaQ7mC8x71q3ctP9r3EhJGpjUg2hVircfFglbvqWNUdw8o49uUkyXANYxvT29Iz&currency=MXN"></script>
    <!-- Enlace para la hoja de estilos CSS -->
    <link rel="stylesheet" href="../StyleProcess3.css">
    <!-- Enlace para la tipografía -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <!-- Enlace para font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
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
                <img src="../../Img/Logo.png" alt="LogoTipo">
            </td>
        </tr>
    </table>   
    <section id="Container">
    <div id="ContainerMessageAbono">Usted ha elegido la modalidad de pago: <?php echo $Method;?></div>
    <?php
    $_SESSION['productNames'] = json_decode($productNamesJSON); //JSON que trae el contenido del arreglo del nombre de los productos
    // echo $Method;
    // echo $Cant;
    // foreach ($_SESSION['productNames'] as $product) {
    //     echo $product->name . " (" . $product->quantity . ")"; //Se extrae el sub indice quantity del arreglo original.
    // }
    // echo $_SESSION['Cant'];
    

    // Add
    $item = new MercadoPago\Item();     
    $item -> id = 001;
    $item -> title = 'Productos CVM-M';
    $item -> quantity = 1;
    $item -> currency_id = 'MXN';
    
    // $item -> unit_price = 100.00;
    $ValuePorcent = 0.5 * $Cant;
    $ValueFacture = 0.16 * $Cant;
    // echo 'El porcentaje es : ', $ValuePorcent;
    

        if($Method == 'Abonos'){
            // $Sql='Select Deuda from Clientes where Id_Cliente = ?';
            // Preparar la consulta
            // $stmt = $mysqli->prepare($sql);

            // Vincular el parámetro
            // $stmt->bind_param("i", $_SESSION['IdUser']);

            // Ejecutar la consulta
            // $stmt->execute();

            // Vincular el resultado a una variable
            // $stmt->bind_result($deuda);

            // Obtener el valor
            // $stmt->fetch();

            // Cerrar la consulta
            // $stmt->close();

            // // Ahora, $deuda contiene el valor del campo 'Deuda' para el cliente en sesión
            // echo "La deuda del cliente es: $deuda";
            // $DeudaAct = $deuda + $ValuePorcent;
            // Insertar los datos del pedido en la tabla pedidos con el pago 'Pendiente' y poner en la cuenta del cliente la cantidad total menos lo que abonó si es que realiza el pago.
            // Update Clientes set Deuda = $DeudaAct where Id_Cliente = $_SESSION['IdUser'];
            //Insert into Pedidos values ('',$_SESSION['IdUser'],'Pendiente',$_SESSION['productName'],$ValuePorcent);
            //  echo 'Se ha elegido pagar en abonos'; 
            //  echo $_SESSION['IdUser'];
            $_SESSION['State'] = "Pendiente";
            $PagoTotal = $ValuePorcent;
            $item -> unit_price = $PagoTotal;

        }else if($Method == 'Contado'){
            // Insertar los datos del pedido en la tabla pedidos con el pago 'Liquidado' y no mover la deuda del cliente. 
            //Insert into Pedidos values ('',$_SESSION['IdUser'],'Liquidado',$_SESSION['productName'],$Cant);
            $PagoTotal = $Cant;
            $item -> unit_price = $Cant;
            echo '<style>
             #ContNote{
                display:none;
             }
             </style>';
            $_SESSION['State'] = "Liquidado";
        }
        // Add
        $preference -> items =array($item);
        $preference -> back_urls = array(
            "success" => "https://cvm-m.com/Pages/Pagos/Capture.php?amount=" . $PagoTotal,
            "failure" => "https://cvm-m.com/index.php"
        );
        $preference -> save();
    ?>
        <div id="ContNote">
        <span id="Note">Nota: Para permitirnos empezar a trabajar en el pedido usted deberá de abonar al menos el 50% (<?php echo '$',$ValuePorcent;?>) de la cantidad total del pedido (<?php echo '$',$Cant;?>)</span>

    </div>
    <br>
        <button type="button" id="BtnImp"><i class="fa-solid fa-file-pdf"></i> <a href="Fpdf_Ticket/TiraPago.php">Imprimir comorobante</a></button>
        <div id="MPagos">
            <section id="PayPal-button-container"></section>
                <img src="../../Img/MercadoPago.png" alt="MP" id="MercadoPago">
                <div class="CheckOutBtn"></div>
        </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        let Regresar = document.getElementById("IconRegresar");
        Regresar.addEventListener("click", function () {
            window.location.href = "Pago.php";
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
                color: 'blue',
                shape: 'pill',
                label: 'pay'
            },
            createOrder: function(data, actions){
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value : <?php echo $PagoTotal; ?>

                        }
                    }]
                });
            },
            onApprove: function(data, actions){
                actions.order.capture().then(function (detalles){
                    console.log(detalles);
                    showSuccessModal();
                    let Url = 'Capture.php';
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

  function showSuccessModal() {
    var modal = document.getElementById('Modal');
    modal.style.display = 'block';

    // Cierra el modal después de 2 segundos y redirige
    setTimeout(function() {
      modal.style.display = 'none';
      window.location.href = '../../index.php';
    //   window.location.href = 'Capture.php';
    }, 2000);
  }
</script>

    </script>   
    <!-- Add -->
    <?php
        $_SESSION['Cant'] = $PagoTotal;
        // foreach ($_SESSION['productNames'] as $product) {
        //     echo $product->name . " (" . $product->price . ")---".$product -> quantity; //Se extrae el sub indice quantity del arreglo original.
        // }
        // echo '<br>';
        // echo $_SESSION['Cant'];
    ?>
    <!-- Add -->
</body>
</html>