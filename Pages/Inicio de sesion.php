<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <!--Librería de iconos en FontAwesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--Link de fuentes-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@1,300&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@800&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Martian+Mono:wght@500&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Martian+Mono:wght@200&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Text&family=Kanit:wght@300&display=swap" rel="stylesheet">
    <!--Link de estilos-->
    <link rel="stylesheet" href="StyleLo4.css">
    <!--Cambiar el icono de la página en la pestaña superior de búsqueda-->
    <link rel="shortcut icon" href="../Img/LogoCarpFavicon.png" type="image/x-icon">
    <meta charset="UTF-8">
    <title>CVM-M</title>
</head>
<body class="Content">
    <section id="BarraH">
        <table id="ContentBarraH">
            <tr>
                <td id="ContentIcon">
                    <i class="fa-solid fa-hammer"></i> 
                    <i class="fa-solid fa-screwdriver-wrench"></i>
                    <i class="fa-solid fa-code-branch"></i>
                 </td>
                 <td id="ContentTitulo">
                     <span id="Titulo">Compra y venta de muebles - Medrano <label></label></span> 
                 </td>
            </tr>

</table>
            
    </section>
    <section id="Sesiones">
        <span id="TituloSesiones">Si usted es trabajador, ingrese aquí: </span>
        <button type="button" id="Btn_Sesión"><i class="fa-solid fa-user-tie"></i><a href="Sesión trabajador.html">Sesión de trabajador</a></button>
    </section>
<aside class="Content_Right">
    Facebook: <a id="Fb" href="http://facebook.com"><i class="fa-brands fa-facebook"></i></a>
    Whatsapp: <a id="Wpp" href="https://wa.me/3310748691"><i class="fab fa-whatsapp"></i></a>
    Correo: <a id="Correo" href="https://mail.google.com/mail/u/0/?subject=Cuesti%C3%B3n&body=Contenido+del+mensaje#inbox?compose=CllgCJNsMRSWjrMHtrKbVwKdSXRCCjbhXBXRJfPVHjcWNcTmMpfkBCqJcpzNtCQZrXmSHzqvZlV">byronjavier23007@gmail.com</a>
    Teléfono: <a id="Num" href="tel:3336911882">3336911882</a>
    </aside>
    <h2>Inicio de sesión</h2>
    <form action="VerifyUser.php" method="post">
        <table>
            <tr>
                <td>
                    <section class="Usuario">
                        <label for="Usuario">Usuario:</label>
                        <input type="text" name="Usuario" id="Usuario" required>
                    </section>
                    <section class="Contraseña">
                        <label for="Contraseña">Contraseña:</label>
                        <input type = "password" name="Clave" id="Contraseña" required>
                    </section>
                    <!--<section style="display:flex;">-->
                    <!--<span class="Forgot" style="margin-top:10px;">-->
                    <!--        <a href="">Ha olvidado sus credenciales?</a> -->
                    <!--    </span>-->

                    <!--    </section>-->
                        <br>
                        <br>
                        <section class="Botón">
                            <button id="Btn_Ingresar" type="submit">
                                <i class="fas fa-solid fa-check" style="margin-right: 9px; margin-top: 3px;"></i> 
                                Ingresar
                            </button>
                            <button id="Btn_Registrarse" type="button">
                                <i class="fa-solid fa-database"></i>
                                <a style="text-decoration: none; color: black;" href="Registro.php">Registrarse</a>
                            </button>
                            <button id="BtnR" type="button">
                                <i class="fa-solid fa-store"></i>
                                <a href="../index.php">Regresar</a>
                           </button>
                        </section>
                        <td>
                            <img id="Logotipo" title="CVM-M / LOGO" src="../Img/Logo.png" alt="Logotipo">
                         </td>
                </td>
            </tr>
    </form>
    </table>
</body>
<footer class="footer">
    <p>Domicilio: Zapopan | N.1231 | Col:El rosal</p>
</footer>
</html>