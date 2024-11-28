<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <!--Cambiar el icono de la página en la pestaña superior de búsqueda-->
    <link rel="shortcut icon" href="../Img/Logo_Carp.png" type="image/x-icon">
    <!--Link para la hoja de estilos-->
    <link rel="stylesheet" href="StyleRegister.css">
    <!--Link para las fuentes de texto-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Carrois+Gothic&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
    <!--Enlace para extraer iconos de FontAwesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <header>
        <table>
            <tr>
                <td id="Logo">
                    <img src="../Img/Logo.png" alt="LogoTipo">
                </td>
                <td class="Titulo">
                    <h2>Registrese en nuestra base de datos</h2>
                </td>
  
                  <td id="RegresarTd"> 
                    <button id="Regresar">  
                        <i class="fa-solid fa-left-long"></i>
                        <a href="Inicio de sesion.php">Regresar</a>
                    </button>
                </td>
            </tr>
        </table>
    </header>
    <section id="Container">
    <div id="ContF">
        <span id="TituloF" class="Titulo">Registre sus credenciales</span>
    </div>
    <div id="miModal" style="display: none;">
    <div id="contenidoModal">
        <p>Hola, este es un modal.</p>
    </div>
</div>
    <form action="Register.php" id="DatosUsuario" method="post">
       <!-- <label class="DatoReq" for="Name">Nombre(s): </label>
        <input class="Datos" id="Name" type="text" placeholder="Nombre" name="Nombre" required>
        <br>
        <label class="DatoReq" for="Surname">Apellido: </label>
        <input class="Datos" id="Surname" type="text" placeholder="Apellido" name="Apellido"required>
        <br> -->
        <label class="DatoReq" for="Username">Nombre de usuario: </label>
        <input class="Datos" id="Username" type="text" placeholder="¿Cómo quiere identificarse en el sistema?" name="Username" required>
        <br>
       <!-- <label class="DatoReq" for="Number">Telefono: </label>
        <input class="Datos" type="tel"pattern="[0-9]{10}" id="Number" name="Number" placeholder="###-###-####" required>
        <br> -->
      <!--  <label class="DatoReq" for="Mail">Correo electrónico: </label>
        <input class="Datos" id="Mail" type="email" placeholder="Su dirección de correo electrónico" name="Email" required>
        <br> -->
       <!-- <label class="DatoReq" for="Pass">Contraseña: </label>
        <input class="Datos" id="Pass" name="Clave" type="password">
        <br> -->
        <label class="DatoReq" for="PassC">Contraseña: </label>
        <input class="Datos" id="PassC" name="ClaveC" type="password" required>
        <br>
        <br>
        <br>
        <button class="BtnForm" type="reset">Reiniciar valores</button>
        <button class="BtnForm" type="submit">Enviar</button>
    </form>
</section>
<footer class="footer">
    <p>Domicilio: Zapopan | N.1231 | Col:El rosal</p>
</footer>
    <script src="ScriptRegisterF.js"></script>
</body>
</html>