<?php
session_start();
error_reporting(0);
ini_set('display_errors', 0);
$Server = "localhost";
$User = "root";
$Pwd = "";
$BD = "Almacen";
$Conexion = mysqli_connect($Server, $User, $Pwd, $BD);
$consulta = "Select Id_Cliente, Nombre, Apellido, Nombre_Usuario, Correo, Numero, Deuda From Clientes";
$resultado = mysqli_query($Conexion, $consulta);
if ($resultado->num_rows > 0) {
    $Clients = [];
    while ($row = $resultado->fetch_assoc()) {
        $Clients[] = [
            'id' => $row['Id_Cliente'],
            'name' => $row['Nombre'],
            'surname' => $row['Apellido'],
            'username' => $row['Nombre_Usuario'],
            'mail' => $row['Correo'],
            'number' => $row['Numero'],
            'due' => $row['Deuda'],
        ];
        #echo $Clients['id'];
    }
    echo '<style>
    #ContentNoClient{
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
<style>
#ContentNoclient{
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
    <!-- Link de jquery para relaizar peticiones de javascript asincronas con AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
    <link rel="stylesheet" href="StyleclientList1.css">
</head>
<body>
    <!-- Modal de confirmación para la actualización de datos del usuario -->
    <div id="Modal">
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
    <!-- Fin del modal de confirmación -->
     <table class="head" id="Head">
        <tr>
            <td class="head" id="Logo">
                <img src="../Img/Logo.png" alt="Logo_Carp">
            </td>
            <td class="head" id="ContentTitulo">
                <span id="Titulo">Sesión de trabajador: información de los clientes</span>
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
    <article id="ContentNoclient">
        <span id="NoClient">Aún no hay clientes registrados..</span>
    </article>
    <table id="UserList">
        <tr>
            <th class="HeadTable">Id</th>
            <th class="HeadTable">Nombre</th>
            <th class="HeadTable">Apellido</th>
            <th class="HeadTable">Nombre de usuario</th>
            <th class="HeadTable">Correo</th>
            <th class="HeadTable">Número</th>
            <th class="HeadTable">Deuda</th>
            <th class="HeadTable">Detalles</th>
            <th class="HeadTable">Editar</th>
        </tr>
        <?php foreach($Clients as $Client) : ?>
            <tr>
                <td class="ContentDato"><?php echo $Client['id']; ?></td>
                <td class="ContentDato"><?php echo $Client['name']; ?></td>
                <td class="ContentDato"><?php echo $Client['surname']; ?></td>
                <td class="ContentDato"><?php echo $Client['username']; ?></td>
                <td class="ContentDato"><?php echo $Client['mail']; ?></td>
                <td class="ContentDato"><?php echo $Client['number']; ?></td>
                <td class="ContentDato"><?php echo $Client['due']; ?></td>
                <td class="ContentDato"><button type="button" onclick="ModalDetails('<?php echo $Client['id']; ?>')" id="BtnDetalles">Detalles</button></td>
                <td class="ContentDato"><button type="button" onclick="openCustomModal('<?php echo $Client['id']; ?>')" id="BtnDetalles">Editar</button></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php foreach ($Clients as $client) : ?>
    <!-- Modal dinámico para editar cada cliente -->
    <div class="custom-modal" id="myModal<?php echo $client['id']; ?>">
    <div>
        <div class="modal-overlay" onclick="closeCustomModal('<?php echo $client['id']; ?>')"></div>
    </div>
        <div class="modal-content">
            <div class="ModalHead">
                <span id="CloseModalDn" onclick="closeCustomModal('<?php echo $client['id']; ?>')">&times;</span>
            </div>
            <span class="modal-title">Información del cliente - <?php echo $client['name']; ?></span>
            <hr>
            <form action="EditClient.php" method="POST" id="Form">
            <div class="modal-body">
                <input type="hidden" value="<?php echo $client['id']?>" name="id">
                <label class="TituloArt" style="font-weight: 400;">Nombre: </label><input type="text" value="<?php echo $client['name']; ?>" name="name" class="InputForm">
                <hr>
                <label class="TituloArt" style="font-weight: 400;">Apellido: </label><input type="text" value="<?php echo $client['surname']; ?>" name="surname" class="InputForm">
                <hr style="font-weight: 900; color: black; width: 85%;">
                <label class="CategoriaArt" style="font-weight: 500;">Nombre de usuario: </label><input type="text" value="<?php echo $client['username']; ?>" name="username" class="InputForm">
                <hr style="font-weight: 900; color: black; width: 90%;">
                <label class="CategoriaArt" style="font-weight: 500;">Correo electrónico: </label><input type="text" value="<?php echo $client['mail']; ?>" name="mail" class="InputForm">
                <hr style="font-weight: 900; color: black; width: 90%;">
                <label class="CategoriaArt" style="font-weight: 500;">Número telefónico: </label><input type="text" value="<?php echo $client['number']; ?>" name="number" class="InputForm">
                <hr style="font-weight: 900; color: black; width: 90%;">
                <label class="CategoriaArt" style="font-weight: 500;">Deuda: </label><input type="text" value="<?php echo $client['due']; ?>" name="due" class="InputForm">
            </div>
            <button type="submit" class="BtnFromModal" id="BtnReady"><i class="fa-solid fa-check"></i> Listo</button>
            </form>
            <form action="RemoveClient.php" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres dar de baja a este cliente?');">
                <input type="hidden" value="<?php echo $client['id']?>" name="IdClient">
                <button type="submit" id="DeleteProd" class="BtnFromModal"><i class="fa-solid fa-ban"></i> Borrar</button>
            </form>
            <div class="modal-footer">
                <button type="button" class="BtnFromModal" id="BtnClose" onclick="closeCustomModal('<?php echo $client['id']; ?>')"><i class="fa-solid fa-xmark"></i> Cerrar</button>
            </div>
        </div>
    </div>
    <!--Fin del modal dinámico para editar detalles del producto-->
<?php endforeach; ?>

<?php foreach ($Clients as $client) : ?>
    <!-- Modal dinámico para mostrar detalles para cada cliente -->
    <div class="custom-modal" id="ModalDetails<?php echo $client['id']; ?>">
    <div>
        <div class="modal-overlay" onclick="closeCustomModal('<?php echo $client['id']; ?>')"></div>
    </div>
        <div class="modal-content">
            <div class="ModalHead">
                <span id="CloseModalDn" onclick="CloseModalDetails('<?php echo $client['id']; ?>')">&times;</span>
            </div>
            <span class="modal-title">Información del cliente - <?php echo $client['name']; ?></span>
            <hr>
            <div class="modal-body">
                <label class="TituloArt" style="font-weight: 400;">Nombre: </label><input type="text" disabled value="<?php echo $client['name']; ?>" name="name" class="InputForm">
                <hr>
                <label class="TituloArt" style="font-weight: 400;">Apellido: </label><input type="text" disabled value="<?php echo $client['surname']; ?>" name="surname" class="InputForm">
                <hr style="font-weight: 900; color: black; width: 85%;">
                <label class="CategoriaArt" style="font-weight: 500;">Nombre de usuario: </label><input type="text" disabled value="<?php echo $client['username']; ?>" name="username" class="InputForm">
                <hr style="font-weight: 900; color: black; width: 90%;">
                <label class="CategoriaArt" style="font-weight: 500;">Correo electrónico: </label><input type="text" disabled value="<?php echo $client['mail']; ?>" name="mail" class="InputForm">
                <hr style="font-weight: 900; color: black; width: 90%;">
                <label class="CategoriaArt" style="font-weight: 500;">Número telefónico: </label><input type="text" disabled value="<?php echo $client['number']; ?>" name="number" class="InputForm">
                <hr style="font-weight: 900; color: black; width: 90%;">
                <label class="CategoriaArt" style="font-weight: 500;">Deuda: </label><input type="text" disabled value="<?php echo $client['due']; ?>" name="due" class="InputForm">
            </div>
            <div class="modal-footer">
                <button type="button" class="BtnFromModal" id="BtnClose" onclick="CloseModalDetails('<?php echo $client['id']; ?>')"><i class="fa-solid fa-xmark"></i> Cerrar</button>
            </div>
        </div>
    </div>
    <!--Fin del modal dinámico para mostrar  detalles del producto-->
<?php endforeach; ?>
</section>
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
    function ModalDetails(id) {
        document.getElementById('ModalDetails' + id).style.display = 'block';
    }
    function CloseModalDetails(id) {
        document.getElementById('ModalDetails' + id).style.display = 'none';
    }

    function openCustomModal(id) {
        document.getElementById('myModal' + id).style.display = 'block';
    }

    function closeCustomModal(id) {
        document.getElementById('myModal' + id).style.display = 'none';
    }
    </script>
</body>
</html>
