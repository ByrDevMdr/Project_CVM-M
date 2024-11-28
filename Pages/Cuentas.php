<?php
session_start();
error_reporting(0);
ini_set('display_errors', 0);
$Server = "localhost";
$User = "root";
$Pwd = "";
$BD = "Almacen";
$Conexion = mysqli_connect($Server, $User, $Pwd, $BD);
$Consulta = "Select `Id_Pedido`,`Pedido`,`Estado`,`Avance`,`Fecha`,`Total`,`Resto` from Pedidos where Id_Cliente = {$_SESSION['IdUser']} and Estado = 'Pendiente'";
$Result = mysqli_query($Conexion, $Consulta);
if ($Result->num_rows > 0) {
    $Order = [];
    while ($row = $Result->fetch_assoc()) {
        $Order[] = [
            'id'=> $row['Id_Pedido'],
            'order' => $row['Pedido'],
            'state' => $row['Estado'],
            'advance' => $row['Avance'],
            'date' => $row['Fecha'],
            'total' => $row['Total'],
            'rest' => $row['Resto'],
        ];
    }
    echo '<style>
    #ContentNoOrder{
        display:none;
    }
    </style>';
}else{
    echo '<style>
    #UserList{
        display:none;
    }
    </style>';
}
if(!isset($_SESSION['User'])){
    header("location: Inicio de sesión.php");
    exit();
}
if(isset($_SESSION['User'])){
   echo '<style>
   #ContBtnAbono{
        display:block;
   }
   #ContBtnAdvance{
    display:none;
}  
   </style>'; 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuentas pendientes</title>
    <!-- Enlace para la tipografía -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <!-- Enlace para la hoja de estilos en css -->
    <link rel="stylesheet" href="StyleCuentas.css">
    <!-- Favicon -->
    <link rel="shortcut icon" href="../Img/LogoCarpFavicon.png" type="image/x-icon">
    <!--Iconos de fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    <!-- Modal de confirmación para la actualización de datos del usuario -->
    <div id="Modal" style="display:none;">
    <section id="ModalBack">
        <article id="ModalContent">
            <span id="MessageCorrect">
                Mensaje sobre la operación
            </span>
            <div id="ModalBody">
            <span id="ContentModalBoy">
                <i class="fa-regular fa-circle-check" id="Correct"></i>
                <hr>
                <br>
                <span id="MessageModalBody">
                    El usuario se ha actualizado correctamente!!
                </span>
            </span>
        </div>
        </article>
    </section>
</div>

<table class="head" id="Head">
        <tr>
            <td class="head" id="Logo">
                <img src="../Img/Logo.png" alt="Logo_Carp">
            </td>
            <td class="head" id="ContentTitulo">
                <span id="Titulo">Información de cuentas</span>
            </td>
            <td class="head" id="ContentBtn">
                <button id="Regresar">
                    <i class="fa-solid fa-arrow-left"></i>
                    <a href="../index.php">Volver</a>
                </button>
            </td>
        </tr>
    </table>
    <div id="ContainerBtn">
        <button id="Upload"><i class="fa-solid fa-file-pdf"></i><a href="../UploadPay/UploadPay.php"> Subir comprobante de pago</a></button>
    </div>
<section id="ContentTable">
    <article id="ContentNoOrder">
        <span id="NoOrder">Usted no tiene cuentas pendientes..</span>
    </article>
    <table id="UserList">
        <tr>
            <th class="HeadTable">Id</th>
            <th class="HeadTable">Pedido</th>
            <th class="HeadTable">Estado</th>
            <th class="HeadTable">Avance</th>
            <th class="HeadTable">Fecha</th>
            <th class="HeadTable">Total</th>
            <th class="HeadTable" id="OpcAbono">Opción</th>
            <th class="HeadTable" id="">Resto</th>

        </tr>
        <?php foreach($Order as $order) : ?>
            <tr>
                <td class="ContentDato"><?php echo $order['id']; ?></td>
                <td class="ContentDato"><?php echo $order['order']; ?></td>
                <td class="ContentDato"><?php echo $order['state']; ?></td>
                <td class="ContentDato"><?php echo $order['advance']; ?></td>
                <td class="ContentDato"><?php echo $order['date']; ?></td>
                <td class="ContentDato"><?php echo $order['total']; ?></td>
                <td class="ContentDato" id="ContBtnAbono">

                <?php 
                if($order['state'] == "Pendiente") {
                    echo '<button onclick="openCustomModal(' . $order['id'] . ')" class="BtnOption">Abonar</button>';
                }
                ?>
                    </td>
                <td class="ContentDato"><?php echo $order['rest']; ?></td>
            </tr>

                <!-- Modal para el envío de la cantidad a abonar -->
                <dialog id="ModalSendAbn_<?php echo $order['id']; ?>" class="ModalAbn">
                    <span class="CloseModalAbn" id="CloseModal_<?php echo $order['id']; ?>" onclick="closeCustomModal(<?php echo $order['id']; ?>)">&times;</span>
                    <br>
                    <p id="TitleModalAbn">Abono para el producto - <?php echo $order['id']; ?></p>
                    <form class="ContentForm" action="Abono.php" method="POST" id="FormAbono_<?php echo $order['id']; ?>">
                        <input type="hidden" value="<?php echo $order['id']; ?>" name="IdOrder">
                        <label for="Abono" class="DataRequire">Cantidad a abonar: </label>
                        <input id="Abono" class="DataRequire" type="number" name="ValueAbono" required>
                        <br>
                        <button type="submit" class="BtnOption" id="BtnAbonar"><i class="fa-solid fa-arrow-up-wide-short"></i> Abonar</button>
                    </form>
                </dialog>
        <?php endforeach; ?>
    </table>
    <!-- <form action="Abono.php" method="POST" id="FormAbono">
                                <input type="hidden" value="' . $order['id'] . '" name="IdOrder">
                                <button type="submit" class="BtnOption">Abonar</button>
                            </form> -->
        <!-- Link de jquery para relaizar peticiones de javascript asincronas con AJAX -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
$(document).ready(function() {
    // Obtener todos los formularios que tengan un ID que comienza con "FormEditPr_"
    $('form[id^="FormEditAd_"]').submit(function(event) {
        event.preventDefault(); // Evitar el envío tradicional del formulario

        // Obtener el ID específico del formulario dinámicamente
        var formId = $(this).attr("id");

        // Petición AJAX
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData($(this)[0]),
            contentType: false,
            processData: false,
            success: function(response) {
                // Muestra el modal cuando la respuesta es exitosa
                $("#Modal").show();
                // Cierra el modal después de 2 segundos
                setTimeout(function() {
                    $("#Modal").hide();
                    location.reload(); //Se recarga la página
                }, 1000);
            },
            error: function(error) {
                console.error(error);
            }
        });
    });
});
    // Funciones con parámetros para los modales dinámicos
    function openCustomModal(id) {
        document.getElementById('ModalSendAbn_' + id).showModal();
    }

    function closeCustomModal(id) {
        document.getElementById('ModalSendAbn_' + id).close();
    }

</script>

</body>
</html>