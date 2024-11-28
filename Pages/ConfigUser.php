<?php
# Sacar los resultados de las consultas y guardarlos en variables de sesión.
session_start();
$Server = "localhost";
$User = "root";
$Pwd = "";
$BD = "Almacen";
$Conexion = mysqli_connect($Server, $User, $Pwd, $BD);
$Query = "select * from Clientes where Nombre_Usuario = '" . $_SESSION['User'] . "'";
$Result = mysqli_query($Conexion, $Query);

if ($Result) {
    // Se almacena el resultado con todos los campos de la tabla que se arrojaron.
    $fila = mysqli_fetch_assoc($Result);
    #Variable de sesión del Id.
    $_SESSION['IdUs'] = $fila['Id_Cliente'];
    #Variable de sesión del nombre.
    $_SESSION['NombreUs'] = $fila['Nombre'];
    #Variable de sesión del apellido.
    $_SESSION['ApellidoUs'] = $fila['Apellido'];
    #Variable de sesión de correo.
    $_SESSION['CorreoUs'] = $fila['Correo'];
    #Variable de sesión del telefono.
    $_SESSION['TelefonoUs'] = $fila['Numero'];
} else {
    echo "Error en la consulta: " . mysqli_error($Conexion);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link de jquery para relaizar peticiones de javascript asincronas con AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!--Enlace para los iconos de fontawesoe-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--Enlace para cambiar el icono del navegador-->
    <link rel="shortcut icon" href="../Img/LogoCarpFavicon.png" type="image/x-icon">
    <!--Enlace para la hoja de estilos-->
    <link rel="stylesheet" href="StyleCoUser.css">
    <!--Enlace para fuentes de texto-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&display=swap" rel="stylesheet">

    <title>Configurar datos</title>
</head>
<style>
    /*
    #ModalScure {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); 
    justify-content: center;
    align-items: center;
}

#ContenidoModalSecure {
    background-color: #fff; 
    padding: 20px;
    border-radius: 10px;
    text-align: center;
    max-width: 400px;
}

#ModalHead {
    font-size: 1.5em;
    font-weight: bold;
    margin-bottom: 10px;
}

#Msj {
    font-size: 1.2em;
    color: #333;
}
*/
    </style>
<body>
    <table id="Encabezado" style="width:100%;">
        <tr>
          <td class="Content" id="ContentLogo">
            <img src="../Img/Logo.png" alt="LogoCarp">
          </td>
          <td class="Content" id="ContentTitulo">
            <span id="Titulo" style="text-align: start; ">Ajustes de perfil</span>
          </td>
          <td class="Content" id="ContentBtn">
        <button id="Regresar">
                <i class="fa-solid fa-caret-left"></i>
                <a href="../index.php">Volver</a>
            </button>
          </td>
        </tr>
      </table>

      <section class="Panel">
        <div class="Tittle">
        <span class="TituloAr">Datos personales</span>
       <!-- <button class="BtnModify" id="ModifyDp"><i class="fa-solid fa-pen"></i><a href="Modificar"></a>Modificar</button>-->
        </div>
        <hr>
        
            <!--Modal de 'Seguridad'-->
<!-- Modal de Mensaje -->
<div id="ModalMensaje" class="modal">
    <div class="modal-content">
        <!-- <span class="close" onclick="cerrarModal()">&times;</span> -->
        <span id="TitleModalMessage">Información de la operación</span>
        <br>
        <i class="fa-regular fa-circle-check"></i>
        <br>
        <span id="MessageModal">Se ha modificado el nombre de usuario. Serás redirigido a la página de inicio de sesión en 3 segundos.</span>
    </div>
</div>



                     <!--Modal del nombre-->
<div class="Modal" id="ModalN">
    <div class="ModalHeader">
        <span class="CerrarModal" id="CerrarModal" onclick="cerrarModal()">&times;</span>
    </div>
    <div class="ModalContent">
        <span class="TituloM">Modificar Nombre</span>
        <div class="ContenedorOld">
            <label for="" class="ValueOld">Nombre:</label>
            <span id="Ni" class="V"><?php echo $_SESSION['NombreUs'];?></span>
        </div>
        <div class="ContenedorInput">
            <form action="ModifyName.php" method="POST">
            <label for="" class="ValueNew">Nombre nuevo:</label>
            <input type="text" id="NameNew" class="ValueNew" name="NameNew" placeholder="Nombre" required>
            <input type="text" value="Nombre" name="ValueOculto" class="ValorOculto">
        </div>
        <div class="BtnContainer">
            <button type="submit" class="BtnM"><a href="ModifyName.php"></a><i class="fa-regular fa-circle-check"></i>Hecho</button>
        </div></form>
    </div>
</div>                   
<!--Modal del apellido-->
            <div class="Modal" id="ModalA">
                <div class="ModalContent">
                <div class="ModalHeader">
                    <span class="CerrarModal" id="CerrarModalA" onclick="cerrarModal()">&times;</span>
                </div>
                    <span class="TituloM">Modificar Apellido</span>
                    <div class="ContenedorOld">
                        <label for="" class="ValueOld">Apellido:</label>
                        <span id="Surname" class="V"><?php echo $_SESSION['ApellidoUs'];?></span>
                        
                    </div>
                    <div class="ContenedorInput">
                    <form action="ModifyName.php" method="POST">
                        <label for="" class="ValueNew">Apellido nuevo:</label>
                        <input type="text" id="NameNew" class="ValueNew" name="NameNew" placeholder="Apellido" required>
                        <input type="text" value="Apellido" name="ValueOculto" class="ValorOculto">
                    </div>
                    <div class="BtnContainer">
                        <button type="submit" class="BtnM"><a href="ModifyName.php"></a><i class="fa-regular fa-circle-check"></i>Hecho</button>
                    </div></form>
                </div>
            </div>
               <!--Modal del telefono-->
            <div class="Modal" id="ModalT">
                <div class="ModalHeader">
                    <span class="CerrarModal" id="CerrarModalT" onclick="cerrarModal()">&times;</span>
                </div>
                <div class="ModalContent">
                    <span class="TituloM">Modificar Teléfono</span>
                    <div class="ContenedorOld">
                        <label for="" class="ValueOld">Teléfono:</label>
                        <span id="Num" class="V"><?php echo $_SESSION['TelefonoUs'];?></span>
                    </div>
                    <div class="ContenedorInput">
                    <form action="ModifyName.php" method="POST">

                        <label for="" class="ValueNew">Teléfono nuevo:</label>
                        <input type="text" id="NameNew" class="ValueNew" name="NameNew" placeholder="Telefóno" required>
                        <input type="text" value="Telefono" name="ValueOculto" class="ValorOculto">

                    </div>
                    <div class="BtnContainer">
                        <button type="submit" class="BtnM"><a href="ModifyName.php"></a><i class="fa-regular fa-circle-check"></i>Hecho</button>
                    </div></form>
                </div>
            </div>
<!--Modal del correo electrónico-->
            <div class="Modal" id="ModalEm">
                <div class="ModalHeader">
                    <span class="CerrarModal" id="CerrarModalE" onclick="cerrarModal()">&times;</span>
                </div>
                <div class="ModalContent">
                    <span class="TituloM">Modificar correo elecrtrónico</span>
                    <div class="ContenedorOld">
                        <label for="" class="ValueOld">E-mail:</label>
                        <span id="CorreoUs" class="V"><?php echo $_SESSION['CorreoUs'];?></span>
                    </div>
                    <div class="ContenedorInput">
                    <form action="ModifyName.php" method="POST">
                        <label for="" class="ValueNew">E-mail nuevo:</label>
                        <input type="email" id="NameNew" class="ValueNew" name="NameNew" placeholder="E-mail" required>
                        <input type="text" value="Correo" name="ValueOculto" class="ValorOculto">
                    </div>
                    <div class="BtnContainer">
                        <button type="submit" class="BtnM"><a href="ModifyName.php"></a><i class="fa-regular fa-circle-check"></i>Hecho</button>
                    </div></form>
                </div>
            </div>
            <!--Modal del nombre de usuario-->
<div class="Modal" id="ModalUs">
    <div class="ModalHeader">
        <span class="CerrarModal" id="CerrarModalUs" onclick="cerrarModal()">&times;</span>
    </div>
    <div class="ModalContent">
        <span class="TituloM">Modificar Nombre de usuario</span>
        <div class="ContenedorOld">
            <label for="" class="ValueOld">Nombre de usuario:</label>
            <span id="Name" class="V"><?php echo $_SESSION['User'];?></span>
        </div>
        <div class="ContenedorInput">
        <form action="ModifyName.php" method="POST" id="FormUserName">
            <label for="" class="ValueNew">Nombre de usuario nuevo:</label>
            <input type="text" id="NameNew" class="ValueNew" name="NameNew" placeholder="Nombre de usuario" required>
            <input type="text" value="Nombre_Usuario" name="ValueOculto" class="ValorOculto"> 
        </div>
        <div class="BtnContainer">
            <button type="submit" class="BtnM"><a href="ModifyName.php"></a><i class="fa-regular fa-circle-check"></i>Hecho</button>
        </div>
    </form>
    </div>
</div>
    <article class="Dato">
        <span  class="TitleSection">Nombre <i class="fa-solid fa-signature" style="font-size:19px;"></i></span><div class="Ico"><i class="fa-solid fa-pen-to-square" id="DName" title="Modificar"></i></div>
        </article>
            <br>
            <span class="Value"><?php echo $_SESSION['NombreUs'];?></span>
        <article class="Dato">

        <span  class="TitleSection">Apellido <i class="fa-solid fa-address-card" style="font-size:19px;"></i></span><div class="Ico"><i class="fa-solid fa-pen-to-square" id="DSurname" title="Modificar"></i></div>
        </article>
            <br>
            <span class="Value"><?php echo $_SESSION['ApellidoUs'];?></span>
        <article class="Dato">

        <span  class="TitleSection">Teléfono <i class="fa-solid fa-phone" style="font-size:19px;"></i></span><div class="Ico"><i class="fa-solid fa-pen-to-square" id="DNumber" title="Modificar"></i></div>
            </article>
            <span class="Value"><?php echo $_SESSION['TelefonoUs'];?></span>
            <br>
            <div class="Tittle">
                <span class="TituloAr">Datos de la cuenta</span>
            </div> 
               <!-- <button class="BtnModify" id="ModifyDc"><i class="fa-solid fa-pen"></i>Modificar</button>-->
            <hr>
        <article class="Dato">           
    
        <span  class="TitleSection">Correo electrónico <i class="fa-solid fa-envelope" style="font-size: 19px;"></i></span><div class="Ico"><i class="fa-solid fa-pen-to-square" id="DEmail" title="Modificar"></i> </div>
            </article>
            <br>
            <span class="Value"><?php echo $_SESSION['CorreoUs'];?></span>
       
        <article class="Dato">
        <span  class="TitleSection">Nombre de usuario <i class="fa-regular fa-id-badge" style="font-size: 19px;"></i></span><div class="Ico"><i class="fa-solid fa-pen-to-square" id="DUsername" title="Modificar"></i></div>
            </article>
            <br>
            <span class="Value"><?php echo $_SESSION['User'];?></span>
      </section>
      <script src="ScriptConfigUser.js"></script>
      <script>
    $(document).ready(function() {
        $("#FormUserName").submit(function(event) {
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
                    $("#ModalMensaje").show();

                    // Cierra el modal después de 2 segundos
                    setTimeout(function() {
                    $("#ModalMensaje").hide();
                    window.location.href = "Inicio de sesion.php"; // Se recarga la página
                }, 3000);
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });
    });
</script>
</body>
</html>