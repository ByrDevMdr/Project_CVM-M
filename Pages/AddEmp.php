<?php
session_start();
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta trabajador</title>
        <!-- Link de jquery para relaizar peticiones de javascript asincronas con AJAX -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Enlaces para la tipografía -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300&display=swap" rel="stylesheet">
    <!--Enlace para la hoja de estilos-->
    <link rel="stylesheet" href="StyleAddEm.css">
    <!--Favicon-->
    <link rel="shortcut icon" href="../Img/LogoCarpFavicon.png" type="image/x-icon">
    <!--Iconos de fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- Modal de confirmación -->
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
                    El trabajador se ha registrado correctamente!!
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
                <span id="Titulo">Sesión de trabajador: dar de alta trabajador</span>
            </td>
            <td class="head" id="ContentBtn">
                <button id="Regresar">
                    <i class="fa-solid fa-arrow-left"></i>
                    <a href="PanelT.php">Volver</a>
                </button>
            </td>
        </tr>
    </table>
    <section id="ContentPrimary">
        <div id="ContentTitle"><span id="TittleBody">Registro de nuevo trabajador</span></div>
        <article id="ContentForm">
            <form action="AddEm.php" method="post" id="Form">
                <label for="NameEmp" class="TitleReq">Nombre: </label>
                <input type="text" name="Nombre" id="NameEmp" class="BreakRow" placeholder="Nombre del trabajador">
                <br>
                <label for="Phone" class="TitleReq">Teléfono: </label>
                <input type="text" name="Phone" id="Phone" class="BreakRow" placeholder="Teléfono del trabajador">
                <br>
                <label for="Mail" class="TitleReq">Correo: </label>
                <input type="text" name="Mail" id="Mail" class="BreakRow" placeholder="Correo del trabajador">
                <br>
                <label for="Address" class="TitleReq">Dirección: </label>
                <input type="text" name="Address" id="Address" class="BreakRow" placeholder="Dirección del trabajador">
                <br>
                <label for="" class="TitleReq">Rol:</label>
                <select name="Rol" >
                    <option value="" selected disabled class="OptionRol">Seleccione un rol</option>
                    <option value="Admin" class="OptionRol">Admin</option>
                    <option value="Empleado" class="OptionRol">Empleado</option>
                </select>
                <br>
                <br>
                <label for="Username" class="TitleReq">Nombre de usuario: </label>
                <input type="text" name="Username" id="Username" class="BreakRow" placeholder="Nombre de usuario del trabajador">
                <br>
                <label for="Pwd" class="TitleReq">Contraseña: </label>
                <input type="text" name="Password" id="Pwd" class="BreakRow" placeholder="Contraseña del trabajador">
                <br>
                <section id="ContentBtnForm">
                    <button type="submit" class="BtnForm" id="BtnA"><i class="fa-regular fa-circle-check"></i> Aceptar</button>    
                    <button type="reset" class="BtnForm" id="BtnB"><i class="fa-solid fa-rotate-left"></i> Reiniciar</button>
                </section>
            <!-- Registro de nuevo trabajador -->
            </form>
        </article>
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
                    }, 2000);
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
    </script>
</body>
</html>