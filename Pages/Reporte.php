<?php
session_start();
date_default_timezone_set('America/Mexico_City');
#Verifica si la sesión del rol existe para que en caso contrario, lo mande a la vista de productos.
if(!isset($_SESSION['Rol'])){
    header("Location: VistaProductos.php");
}
#Doble factor de verificación de las variables de sesión de 'Rol' para que solo el empleado pueda entrar a este apartado.
if($_SESSION['Rol']!="Empleado"){
    header("location: PanelT.php");
}
// Sustracción de todos los pedidos que tengan el status de "Terminado"
$Fecha = date("Y-m-d");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generación de reporte</title>
    <!-- Enlace para la tipografía -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <!-- Link de jquery para relaizar peticiones de javascript asincronas con AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Enlace para la hoja de estilos -->
    <link rel="stylesheet" href="StyleR1.css">
    <!-- Favicon -->
    <link rel="shortcut icon" href="../Img/LogoCarpFavicon.png" type="image/x-icon">
    <!--Iconos de fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- Encabezado -->
<table class="head" id="Head">
        <tr>
            <td class="head" id="Logo">
                <img src="../Img/Logo.png" alt="Logo_Carp">
            </td>
            <td class="head" id="ContentTitulo">
                <span id="Titulo">Sesión de trabajador: Generación de reportes</span>
            </td>
            <td class="head" id="ContentBtn">
                <button id="Regresar">
                    <i class="fa-solid fa-arrow-left"></i>
                    <a href="PanelT.php">Volver</a>
                </button>
            </td>
        </tr>
    </table>
    <!-- Contenido de aviso -->
    <section id="Message">
        <span id="Msg">Usted se registro como: <?php echo $_SESSION['Nombre'];?></span>
    </section>
    <!-- Cuerpo principal -->
    <section id="ContentPrimary">
        <div id="ContentTitle"><span id="TittleBody">Registro de nuevo reporte</span></div>
        <article id="ContentForm">
            <form action="GenerateXML.php" method="post" id="Form">
                <label for="">Id: </label>
                <input type="text" value="<?php echo $_SESSION['IdUser'];?>" disabled>
                <input type="hidden" value="<?php echo $_SESSION['IdUser'];?>" name="Id">
                <input type="hidden" value="<?php echo $_SESSION['Direccion'];?>" name="Direccion_P">
                <input type="hidden" value="<?php echo $_SESSION['Telefono'];?>" name="Telefono_P"> 
                <input type="hidden" value="<?php echo $_SESSION['Correo'];?>" name="Correo_P"> 
                <input type="hidden" value="<?php echo $Fecha; ?>" name="Date">
                <br>
                <br>
                <label for="Pedidos">Pedidos terminados:</label>
                <input type="number" name="Pedidos" id="Pedidos" required>
                <br>
                <br>
                <label for="Ganancias">Ganancias aproximadas:</label>
                <input type="number" name="Ganancias" id="Ganancias" required>
                <br>
                <br>
                <input type="hidden" value="<?php echo $_SESSION['Nombre'];?>" name="Nombre">
                <section id="ContentBtnForm">
                    <button type="submit" class="BtnForm" id="BtnA"><i class="fa-regular fa-circle-check"></i> Aceptar</button>    
                    <button type="reset" class="BtnForm" id="BtnB"><i class="fa-solid fa-rotate-left"></i> Reiniciar</button>
                    <button class="BtnForm" id="BtnXML"><i class="fas fa-file-code"></i> <a href="https://cvm-m.com/Pages/XML/Reporte.xml">Revisar XML generado</a></button>
                </section>
            </form>
        </article>
    </section>
    <script>
        $(document).ready(function() {
        $("#Form").submit(function(event) {
            event.preventDefault(); // Evitar el envío 'tradicional' del formulario.

            // Petición AJAX asíncrona para egragar contacto.
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: new FormData($(this)[0]),
                contentType: false,
                processData: false,
                success: function(response) {
                    alert("Reporte generado");
                    DelValues();
                    // window.location.reload();
                    window.open("Fpdf/Reporte.php", "_blank");
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });
    });
    function DelValues(){
        document.getElementById("Pedidos").value="";
        document.getElementById("Ganancias").value="";
    }
    </script>

</body>
</html>