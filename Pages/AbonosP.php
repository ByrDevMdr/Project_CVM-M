<?php
session_start();
error_reporting(0);
ini_set('display_errors', 0);
$Server = "localhost";
$User = "root";
$Pwd = "";
$BD = "Almacen";
$Conexion = mysqli_connect($Server, $User, $Pwd, $BD);
$consulta = "Select Abonos.*, Clientes.Nombre AS NombreCliente, Clientes.Apellido as ApellidoCliente, Pedidos.Estado AS EstadoPedido from Abonos join Clientes on  Abonos.Id_Cliente = Clientes.Id_Cliente join Pedidos ON Abonos.Id_Pedido = Pedidos.Id_Pedido";
#Con consultas y un JOIN, se puede unir una tabla con otra teniendo un valor como referencia (Las llaves foraneas).
$resultado = mysqli_query($Conexion, $consulta);

if ($resultado->num_rows > 0) {
    $Abono = [];

    while ($row = $resultado->fetch_assoc()) {
        $Abono[] = [
            'id' => $row['Id_Abono'],
            'idC' => $row['Id_Cliente'],
            'orderId' => $row['Id_Pedido'],
            'date' => $row['Fecha'],
            'amount' => $row['Cantidad'],
            'clientName' => $row['NombreCliente'],
            'clientSurname' => $row['ApellidoCliente'],
            'orderState' => $row['EstadoPedido'],
        ];
    }
    echo '<style>
    #ContentNoAbono{
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
    header("location: Sesión trabajador.html");
    exit();
}
if($_SESSION['Rol']!="Administrador"){
    header("location:PanelT.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <style>#ContentNoAbono{
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
    <title>Información de usuarios</title>
    <!-- Enlaces para la tipogrfía -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Capriola&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300&display=swap" rel="stylesheet">
    <!-- Favicon -->
    <link rel="shortcut icon" href="../Img/LogoCarpFavicon.png" type="image/x-icon">
    <!--Iconos de fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Enlace para la hoja de estilos en css -->
    <link rel="stylesheet" href="StyleAbP1.css">
</head>
<body>
    <!-- Modal de confirmación para la actualización de datos del usuario -->
    <!-- <div id="Modal">
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
    </section> -->
</div>
    <!-- Fin del modal de confirmación -->
     <table class="head" id="Head">
        <tr>
            <td class="head" id="Logo">
                <img src="../Img/Logo.png" alt="Logo_Carp">
            </td>
            <td class="head" id="ContentTitulo">
                <span id="Titulo">Sesión de trabajador: información de los abonos</span>
            </td>
            <td class="head" id="ContentBtn">
                <button id="Regresar">
                    <i class="fa-solid fa-arrow-left"></i>
                    <a href="PanelT.php">Volver</a>
                </button>
            </td>
        </tr>
    </table>
    <button id="ImpTable"><i class="fa-solid fa-file-pdf"></i> <a href="Fpdf_Abonos/Reporte_Abn.php" target="__blank">Imprimir tabla de abonos</a></button>
    <section id="ContentTable">
    <article id="ContentNoAbono">
        <span id="NoAbono">Aún no tiene abonos previos..</span>
    </article>
    <table id="UserList">
        <tr>
            <th class="HeadTable">Número del abono</th>
            <th class="HeadTable">Cliente</th>
            <th class="HeadTable">Detalles del pedido</th>
            <th class="HeadTable">Fecha del abono</th>
            <th class="HeadTable">Detalles del abono</th>
        </tr>
<?php foreach($Abono as $IntAbono): ?>
        <div class="custom-modal" id="Order<?php echo $IntAbono['orderId']; ?>">
    <div>
        <div class="modal-overlay" onclick="closeCustomModalOrder('<?php echo $IntAbono['orderId']; ?>')"></div>
    </div>
    <div class="modal-content">
        <div class="ModalHead">
            <span id="CloseModalDn" onclick="closeCustomModalOrder('<?php echo $IntAbono['orderId']; ?>')">&times;</span>
        </div>
        <span class="modal-title">Información del abono al pedido: </span>
        <hr>
        <div class="modal-body">

                <?php 
                    $pedidoId = $IntAbono['orderId'];
                    $consultaDetallesPedido = "SELECT * FROM Pedidos WHERE Id_Pedido = $pedidoId";
                    $resultadoDetallesPedido = mysqli_query($Conexion, $consultaDetallesPedido);
                    $detallesPedido = mysqli_fetch_assoc($resultadoDetallesPedido);
                ?>
                <div class="pedido-info">
                    <label class="CategoriaArt" style="font-weight: 500;">ID del Pedido:</label>
                    <span class="InputForm"><?php echo $detallesPedido['Id_Pedido']; ?></span><br>
                    <hr>
                    <label class="CategoriaArt" style="font-weight: 500;">Pedido:</label>
                    <span class="InputForm"><?php echo $detallesPedido['Pedido']; ?></span><br>
                    <hr>
                    <label class="CategoriaArt" style="font-weight: 500;">Estado:</label>
                    <span class="InputForm"><?php echo $detallesPedido['Estado']; ?></span><br>
                    <br>
                    <label class="CategoriaArt" style="font-weight: 500;">Avance:</label>
                    <span class="InputForm"><?php echo $detallesPedido['Avance']; ?></span><br>
                    <br>
                    <label class="CategoriaArt" style="font-weight: 500;">Total:</label>
                    <span class="InputForm"><?php echo $detallesPedido['Total']; ?></span><br>
                    <br>
                    <label class="CategoriaArt" style="font-weight: 500;">Fecha:</label>
                    <span class="InputForm"><?php echo $detallesPedido['Fecha']; ?></span><br>
                </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="BtnFromModal" id="BtnClose" onclick="closeCustomModalOrder('<?php echo $IntAbono['orderId']; ?>')">
    <i class="fa-solid fa-xmark"></i> Cerrar
</button>

</div>

    </div>
</div>
            <?php endforeach; ?>
<!-- Add -->




        <?php foreach($Abono as $abono) : ?>
    <tr>
        <td class="ContentDato"><?php echo $abono['id']; ?></td>
        <td class="ContentDato"><?php echo $abono['clientName'], " ",$abono['clientsurname'],""; ?></td>
        <td class="ContentDato">
<!-- Add -->

    <button type="button" onclick="openCustomModalOrder('<?php echo $abono['orderId']; ?>')" id="BtnDetalles">
        Mostrar Detalles
    </button>

<!-- Add -->

    </td>
        <td class="ContentDato"><?php echo $abono['date']; ?></td>
        <td class="ContentDato"><button type="button" onclick="openCustomModal('<?php echo $abono['id']; ?>')" id="BtnDetalles">Mostrar Detalles</button></td>
    </tr>
<?php endforeach; ?>

    </table>
    <?php foreach ($Abono as $abono) : ?>
    <!-- Modal dinámico para cada cliente -->
    <div class="custom-modal" id="myModal<?php echo $abono['id']; ?>">
    <div>
        <div class="modal-overlay" onclick="closeCustomModal('<?php echo $abono['id']; ?>')"></div>
    </div>
        <div class="modal-content">
            <div class="ModalHead">
                <span id="CloseModalDn" onclick="closeCustomModal('<?php echo $abono['id']; ?>')">&times;</span>
            </div>
            <span class="modal-title">Información del abono - <?php echo $abono['id']; ?></span>
            <hr>
            <!-- <form action="EditClient.php" method="POST" id="Form"> -->
            <div class="modal-body">
                <input type="hidden" value="<?php echo $abono['id']?>" name="id">
                <label class="TituloArt" style="font-weight: 400;">Nombre del pedido: </label><span class="InputForm"><?php echo $abono['clientName']; ?></span>
                <hr>
                <label class="TituloArt" style="font-weight: 400;">Id del pedido: </label><span class="InputForm"><?php echo $abono['orderId']; ?></span>
                <hr style="font-weight: 900; color: black; width: 85%;">
                <label class="CategoriaArt" style="font-weight: 500;">Fecha </label><span class="InputForm"><?php echo $abono['date']; ?></span>  
                <hr style="font-weight: 900; color: black; width: 90%;">
                <label class="CategoriaArt" style="font-weight: 500;">Cantidad: </label><span class="InputForm"><?php echo $abono['amount'], " (",$abono['orderState'],")"; ?></span>  
                <hr style="font-weight: 900; color: black; width: 90%;">
            </div>
            <!-- </form> -->
            <div class="modal-footer">
                <button type="button" class="BtnFromModal" id="BtnClose" onclick="closeCustomModal('<?php echo $abono['id']; ?>')"><i class="fa-solid fa-xmark"></i> Cerrar</button>
            </div>
        </div>
    </div>
    <!--Fin del modal dinámico para detalles del producto-->
<?php endforeach; ?>
</section>
    <!-- Link de jquery para relaizar peticiones de javascript asincronas con AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $("#Form").submit(function(event) {
            event.preventDefault(); // Evitar el envío tradicional del formulario

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
    // Funciones para los modales dinámicos
    function openCustomModal(id) {
        document.getElementById('myModal' + id).style.display = 'block';
    }

    function closeCustomModal(id) {
        document.getElementById('myModal' + id).style.display = 'none';
    }
    
        function openCustomModalOrder(abonoId) {
    // Obtener el modal correspondiente al ID del abono
    var modal = document.getElementById("Order" + abonoId);

    // Mostrar el modal cambiando su estilo de display a "block"
    modal.style.display = "block";
}


// // Función para cerrar el modal
function closeCustomModalOrder(abonoId) {
    // Obtener el modal correspondiente al ID del abono
    var modal = document.getElementById("Order" + abonoId);

    // Ocultar el modal cambiando su estilo de display a "none"
    modal.style.display = "none";
}
    </script>
</body>
</html>
