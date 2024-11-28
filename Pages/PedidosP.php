<?php
session_start();
error_reporting(0);
ini_set('display_errors', 0);
$Server = "localhost";
$User = "root";
$Pwd = "";
$BD = "Almacen";
$Conexion = mysqli_connect($Server, $User, $Pwd, $BD);
$Consulta = "Select 
                Pedidos.Id_Pedido,
                Pedidos.Id_Cliente,
                Pedidos.Pedido,
                Pedidos.Estado,
                Pedidos.Avance,
                Pedidos.Fecha,
                Pedidos.Total,
                Pedidos.Resto,
                Clientes.Nombre AS Nombre
            FROM Pedidos 
            JOIN Clientes ON Pedidos.Id_Cliente = Clientes.Id_Cliente";
$Result = mysqli_query($Conexion, $Consulta);
if ($Result->num_rows > 0) {
    $Order = [];
    while ($row = $Result->fetch_assoc()) {
        $Order[] = [
            'id'=> $row['Id_Pedido'],
            'idC'=> $row['Id_Cliente'],
            'order' => $row['Pedido'],
            'state' => $row['Estado'],
            'advance' => $row['Avance'],
            'date' => $row['Fecha'],
            'total' => $row['Total'],
            'rest' => $row['Resto'],
            'clientName' => $row['Nombre'],
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
if(!isset($_SESSION['UserP'])){
    header("location: Sesión trabajador.php");
    exit();
}
// if(isset($_SESSION['User'])){
//    echo '<style>
//    #ContBtnAbono{
//         display:block;
//    }
//    #ContBtnAdvance{
//     display:none;
// }  
//    </style>'; 
// }
if(isset($_SESSION['UserP'])){
    echo '<style>
    #ContBtnAbono{
        display:none;
    }
    #ContBtnAdvance{
        display:block;
    }   
    </style>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<style>
#ContentNoAbono{
    background: rgba(255, 218, 149, 0.253);
    padding: .7em;
    border-radius: 10px 10px;
    margin: 10px;
    font-family: 'Roboto', sans-serif;
    text-align: center;
    font-size: 20px;
    }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos pendientes</title>
    <!-- Enlace para la hoja de estilos en css -->
    <link rel="stylesheet" href="StyleFPC.css">
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
                    El avance del pedido se ha actualizado correctamente!!
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
                <span id="Titulo">Sesión de trabajador: Información de pedidos</span>
            </td>
            <td class="head" id="ContentBtn">
                <button id="Regresar">
                    <i class="fa-solid fa-arrow-left"></i>
                    <a href="PanelT.php">Volver</a>
                </button>
            </td>
        </tr>
    </table>
<section id="ContentTable">
<article id="ContentNoOrder">
        <span id="NoAbono">Aún no tiene pedidos..</span>
    </article>
    <table id="UserList">
        <tr>
            <th class="HeadTable">Id pedido</th>
            <th class="HeadTable">Cliente</th>
            <th class="HeadTable">Pedido</th>
            <th class="HeadTable">Estado de pago</th>
            <th class="HeadTable">Avance</th>
            <th class="HeadTable">Fecha</th>
            <th class="HeadTable">Total</th>            
            <th class="HeadTable">Deuda</th>
            <th class="HeadTable">Opción</th>
        </tr>
        <?php foreach($Order as $order) : ?>
            <tr>
                <td class="ContentDato"><?php echo $order['id']; ?></td>
                <!--<td class="ContentDato"><?php #echo $order['clientName'], " (",$order['idC'],")"; ?></td>-->
                <td class="ContentDato"><?php echo $order['clientName']; ?></td>
                <td class="ContentDato"><?php echo $order['order']; ?></td>
                <td class="ContentDato"><?php echo $order['state']; ?></td>
                <td class="ContentDato"><?php echo $order['advance']; ?></td>
                <td class="ContentDato"><?php echo $order['date']; ?></td>
                <td class="ContentDato"><?php echo $order['total']; ?></td>
                <td class="ContentDato"><?php echo $order['rest']; ?></td>
                <td class="ContentDato" id="ContBtnAdvance">
                <button type="button" onclick="openCustomModal('<?php echo $order['id']; ?>')" class="BtnOption" id="BtnAvance">Editar avance</button>
            </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php foreach($Order as $order) : ?>
    <div class="custom-modal" id="myModal<?php echo $order['id']; ?>">
        <div>
            <div class="modal-overlay" onclick="closeCustomModal('<?php echo $order['id']; ?>')"></div>
        </div>
        <div class="modal-content">

            <div class="ModalHead">
                 <span id="CloseModalDn" onclick="closeCustomModal('<?php echo $order['id']; ?>')">&times;</span>
            </div>
                <span class="modal-title">Información del Pedido - <?php echo $order['id']; ?></span>
                <hr>
                <form action="EditAdvance.php" method="POST" id="FormEditAd_<?php echo $order['id']; ?>">
                    <span class="modal-title-body">Edite el avance del pedido: </span>
                    <input type="hidden" name="IdOrder" value="<?php echo $order['id']; ?>">
                    <select name="Advance" id="OptionAdvance">
                        <option value="En proceso" class="OptionAdvance">Avance</option>
                        <option value="En proceso">En proceso</option>
                        <option value="Medio">Medio</option>
                        <option value="Terminado">Terminado</option>
                    </select>
                        <br>
                    <button type="submit" class="BtnFromModal" id="BtnReady"><i class="fa-solid fa-check"></i> Listo</button>
                    <button type="button" class="BtnFromModal" id="BtnClose" onclick="closeCustomModal('<?php echo $order['id']; ?>')"><i class="fa-solid fa-xmark"></i> Cerrar</button>

                </form>
            </div>
    </div>
    <?php endforeach; ?>
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
        document.getElementById('myModal' + id).style.display = 'block';
    }

    function closeCustomModal(id) {
        document.getElementById('myModal' + id).style.display = 'none';
    }
</script>

</body>
</html>