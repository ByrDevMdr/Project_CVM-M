<?php
session_start();
/* #Variables de sesión del formulario de Nombre.
$_SESSION['Name'];
$_SESSION['Apellido'];
$_SESSION['Username'];
#Variable de sesión del formulario de email.
$_SESSION['Email'];
#Variable de sesión del formulario de telefono.
$_SESSION['Number'];
#Variable de sesión para la contraseña hasheada.
$_SESSION['Pass'];
#Lineas de código para no mostrar los errores. */
error_reporting(0);
ini_set('display_errors', 0);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <!--Cambiar el icono de la página en la pestaña superior de búsqueda-->
    <link rel="shortcut icon" href="../Img/LogoCarpFavicon.png" type="image/x-icon">
    <!--Enlace con la hoja de estilos-->
    <link rel="stylesheet" href="StyleReg3.css">
    <!--Enlaces para las fuentes de texto-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz,wght@6..12,300&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@500&display=swap" rel="stylesheet">
    <!--Enlace para los iconos-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <!-- Link para jquery-->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
  <table id="Encabezado">
    <tr>
      <td id="ContLogo">
        <img src="../Img/Logo.png" alt="LogoCarp">
      </td>
      <td id="ContTitle">
        <h3>CVM.M</h3>
      </td>
      <td id="ContBtn">
    <button id="Regresar">
            <i class="fa-solid fa-caret-left"></i>
            <a href="Inicio de sesion.php">Volver</a>
        </button>
      </td>
    </tr>
  </table>
    <!-- Nota de infromación de la página -->
  <section id="ContMsg">
    <article id="MsgNote">
      <span id="Msg">Nota: Tendrá que rellenar todos los datos (no importa el orden) para pdoer ser dado de alta.</span>
    </article>
  </section>
  <!-- <button id="Abrir" onclick="OpenModal()">Abrir</button> -->
    <dialog id="ModalError">
      <!-- <span id="closeBtn" onclick="closeModal()">&times;</span> -->
      <p>Información sobre la operación</p>
      <hr>
      <i class="fa-regular fa-circle-check"></i>
      <br>
      <span id="State">El usuario se ha registrado correctamente</span>
    </dialog>
    <?php
    echo '<style>
    .DatoN{
      font-family: sans-serif;
      font-size:13px;
      color:blue;
    }
    .DM{
      font-size:13px;
      font-family: sans-serif;
      color:green;
    }
    #Panel{
      height: 600px
    }
    .ErrorP{
      display:none;
    }
    #PassC.errorBorder {
      border: solid rgba(172, 13, 13, 0.432);
    }
    #PassConfirm{
      color:black;
    }
    </style>
    ';
    #Validación de las variables de sesión del modal de Nombre.
    if(isset($_SESSION['Name'],$_SESSION['Apellido'],$_SESSION['Username'])){
      echo '
      <style>
      #DescripcionName{
        display:none;
      }
      #NombreUsuarioM{
        display:block;
      }
      #NombreM{
        display:block;
      }
      #ApellidoM{
        display:block;
      }
      #IU{
        display:none;
      }
       #AddName{
          display: none;
        }
      </style>
      ';
    }else{
      echo ' <style>
      #QuitN{
        display:none;
      }
      #ICh{
        display:none;
      }
      #NombreM{
        display:none;
      }
      #ApellidoM{
        display:none;
      }     
      #NombreUsuarioM{
        display:none;
      }
      </style> ';
    }
    #Validación de la variable de sesión del modal de Email.
    if(isset($_SESSION['Email'])){
      echo '
      <style>
        #AddEmail{
          display: none;
        }
       #email{
          display:block;
       }  
        #ICE{
          display:none;
        }
        #DescripcionEl{
          display:none;
        }
      </style>
      ';
    }else{
      echo '
      <style>
      #QuitE{
        display:none;
      }
      #IChE{
        display:none;
      } 
      #Email{
        display:none;
      } 
      </style>
      ';
    }
    #Validación de la variable de sesión del modal de Telefono.
    if(isset($_SESSION['Number'])){
      echo '
      <style>
        #AddNumber{
          display: none;
        }
        #telefono{
          display:block;
        }
        #ICT{
          display:none;
        }
        #DescripciónNum{
          display:none;
        }
      </style>
      ';
    }else{
      echo '
      <style>
      #telefono{
        display:none;
      }
      #QuitTel{
        display:none;
      }
      #IChT{
        display:none;
      }
      </style>
      ';
    }      
    // Validaciones para la sesión de la dirección
    if(isset($_SESSION['Dirección'])){
      echo '
      <style>
        #AddDir{
          display: none;
        }
        #direccion{
          display:block;
        }
        #ICD{
          display:none;
        }
        #DescripciónNum{
          display:none;
        }
      </style>
      ';
    }else{
      echo '
      <style>
      #direccion{
        display:none;
      }
      #QD{
        display:none;
      }
      #IChD{
        display:none;
      }
      </style>
      ';
    }      
    #Validación de la variable de sesión del modal de Contraseña.
    if(isset($_SESSION['Pass'])){
        echo '
        <style>
        #AddPassword{
          display:none;
        }
        #ICP{
          display:none;
        }       
        #DescripciónPass{
          display:none;
        }
        #PasswordM{
          display:block;
        }
        </style>
        ';
      }else{
        echo '
        <style>
        #IChP{
          display:none;
        }
        #QP{
          display:none;
        }
        #PasswordM{
          display:none;
        }
        </style>
        ';
      }
      if(isset($_SESSION['Name'],$_SESSION['Apellido'],$_SESSION['Username'],$_SESSION['Email'],$_SESSION['Number'],$_SESSION['Pass'],$_SESSION['Dirección'])){
        echo '
        <style>
        .CheckTerms{
          display:inline-block;
        }
        #Panel{
          height: 650px
        }
        #FootC{
          padding:.7em;
          width:50%;
          border-radius: .9em;
          background:navy;
        }
        .BtnF{
          padding:.4em;
        }
        </style>
        ';
      }else{
        echo '
        <style>
        .CheckTerms{
          display:none;
        }
        .DatoN{
          display:none;
        }
        #FootC{
          display:none;
        }  
        .BtnF{
          display: none;
        }
        </style>
        ';
      }
    ?>
    <section id="ContentP">
        <span id="Title">Datos para crear la cuenta
        </span>
        <article class="Steps" id="Name">
            <i class="fa-regular fa-user" id="IU"></i>
            <i class="fa-solid fa-circle-check" style="color:green;"id="ICh"></i>
            <span class="StepD" id="DescripcionName">Ingrese su nombre de usuario</span>
            <button type="submit" class="Add" id="AddName">Agregar</button>
            <button class="Add" id="QuitN">Remover datos</button>
            <p>De esta manera podremos identificarlo</p>
            <div id="DatosN">  
            <span class="DatoN" id="NombreM">Nombre: </span>
            <?php
            echo '<span class="DM">', $_SESSION['Name'], '</span><br>';
            ?>
            <span class="DatoN" id="ApellidoM">Apellido:</span>
            <?php
            echo '<span class="DM">', $_SESSION['Apellido'], '</span><br>';
             
            ?>
            <span class="DatoN" id="NombreUsuarioM">Nombre de usuario: </span>
            <?php
            echo '<span class="DM">', $_SESSION['Username'], '</span>';
            ?>
          </div>
          
        </article>
        <article class="Steps">
            <i class="fa-regular fa-envelope" id="ICE"></i>
            <i class="fa-solid fa-circle-check" style="color:green;"id="IChE"></i>
            <span class="StepD" id="DescripcionEl">Ingrese su correo electrónico</span>
            <button type="submit" class="Add" id="AddEmail">Agregar</button>
            <button class="Add" id="QuitE">Remover datos</button>
            <p>Recbirá información periodicamente a su cuenta</p>
            <div id="DatoN">  
            <span class="DatoN" id="email">Correo: </span>
            <span class="DM" id="Date">
            <?php
            echo $_SESSION['Email'], '</span><br>';
            ?>
          </div>
        </article>
        <article class="Steps">
            <i class="fa-solid fa-mobile-screen-button" id="ICT"></i>
            <i class="fa-solid fa-circle-check" style="color:green;"id="IChT"></i>
            <span class="StepD" id="DescripciónNum">Agregue su número de teléfono</span>
            <button type="submit" class="Add" id="AddNumber">Agregar</button>
            <button class="Add" id="QuitTel">Remover datos</button>
            <p>Existirá una mejor comunicación entre nosotros</p>
            <div id="DatoN">  
            <span class="DatoN" id="telefono">Telefóno: </span>
            <?php
            echo '<span class="DM">', $_SESSION['Number'], '</span><br>';
            ?>
          </div>
        </article>
        <article class="Steps">
            <i class="fa-solid fa-location-dot" id="ICD"></i>
            <!-- <i class="fa-solid fa-mobile-screen-button" id="ICD"></i> -->
            <i class="fa-solid fa-circle-check" style="color:green;"id="IChD"></i>
            <span class="StepD" id="DescripciónNum">Agregue su dirección</span>
            <button type="submit" class="Add" id="AddDir">Agregar</button>
            <button class="Add" id="QD">Remover datos</button>
            <p>Extenderá la fluiez del proceso de ventas</p>
            <div id="DatoN">  
            <span class="DatoN" id="direccion">Dirección: </span>
            <?php
            echo '<span class="DM">', $_SESSION['Dirección'], '</span><br>';
            ?>
          </div>
        </article>
        <article class="Steps">
            <i class="fa-solid fa-key" id="ICP"></i>
            <i class="fa-solid fa-circle-check" style="color:green;"id="IChP"></i>
            <span class="StepD" id="DescripciónPass">Cree su contraseña</span>
            <button type="submit" class="Add" id="AddPassword">Agregar</button>
            <button class="Add" id="QP">Remover datos</button>
            <p>Manten segura tu cuenta configurando una contraseña</p>
            <div id="DatoN">  
            <span class="DatoN" id="PasswordM">Contraseña: </span>
            <?php
            echo '<span class="DM">', $_SESSION['PWD'], '</span><br>';
            ?>
          </div>
        </article>
        <form action="Acuerdo.php" method="post" id="FormTerm" style="margin:10px;";>
             <input type="checkbox" name="Terms" id="CheckTerms" class="CheckTerms"> <label for="CheckTerms" class="CheckTerms">He leído y estoy de acuerdo con los <a href="Terminos/Terminos.pdf" target="_blank">terminos y condiciones</a></label>
               <!--<button type="submit">LL</button> -->
        </form> 
        <!-- Add -->
        <div id="ContentButtonReady">
          <form action="Conexion.php" method="post">
            <input type="hidden" value="<?php echo $_SESSION['Name']; ?>" name="Name">
            <input type="hidden" value="<?php echo $_SESSION['Apellido']?>" name="Surname">
            <input type="hidden" value="<?php echo $_SESSION['Username']?>" name="Username">
            <input type="hidden" value="<?php echo $_SESSION['Email']?>" name="Mail">
            <input type="hidden" value="<?php echo $_SESSION['Number']?>" name="Number">
            <input type="hidden" value="<?php echo $_SESSION['Pass']?>" name="Pass">
            <input type="hidden" value="<?php echo $_SESSION['Term']?>" name="Termino">
            <input type="hidden" value="<?php echo $_SESSION['Dirección']?>" name="Dirección">
            <button class="BtnF" id="BtnReady" type="submit"><i class="fa-solid fa-arrow-up"></i>Registrarse</button>
          </form>
         </div>

    </section>
<div id="ModalN" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <form action="ModalN.php" id="nameForm"  method="POST">
        <label for="Nombre">Nombre(s):</label>
        <input type="text" id="Nombre" name="N" placeholder="Nombre(s)" required>

        <label for="Apellido">Apellidos:</label>
        <input type="text" id="Apellido" name="A" placeholder="Apellidos" required>

        <label for="Username">Nombre de usuario:</label>
        <input type="text" id="Username" name="Username" placeholder="Nombre de máximo 8 caracteres" required>

        <button type="reset">Limpiar formulario</button>
        <button type="submit" class="Add">Agregar</button>
      </form>
    </div>
  </div>
  <div id="ModalEm" class="modal">
    <div class="modal-content">
      <span class="closeM">&times;</span>
      <form id="nameForm" action="ModalEm.php" method="POST">
        <label for="Nombre">Correo electrónico:</label>
        <input type="email" id="Nombre" name="Email" placeholder="Ejemplo@gmail.com" required>

        <button type="reset">Limpiar formulario</button>
        <button type="submit" class="Add">Agregar</button>
      </form>
    </div>
  </div>
  <div id="ModalNum" class="modal">
    <div class="modal-content">
      <span class="closeN">&times;</span>
      <form id="nameForm" action="ModalTel.php" method="POST">
        <label for="Number">Número telefónico:</label>
        <input type="tel"pattern="[0-9]{10}" id="Number" name="Number" placeholder="###-###-####" required>

        <button type="reset">Limpiar formulario</button>
        <button type="submit" class="Add">Agregar</button>
      </form>
    </div>
  </div>
  <div id="ModalDir" class="modal">
    <div class="modal-content">
      <span class="closeD">&times;</span>
      <form id="nameForm" action="ModalDir.php" method="POST">
        <label for="Dirección">Dirección:</label>
        <input type="text" id="Dirección" name="Dirección" placeholder="Loma verde #345" required>

        <button type="reset">Limpiar formulario</button>
        <button type="submit" class="Add">Agregar</button>
      </form>
    </div>
  </div>
  <div id="ModalPass" class="modal">
    <div class="modal-content">
      <span class="closeP">&times;</span>
      <form id="nameForm" action="ModalPass.php" method="POST">

        <label for="Pass">Contraseña:</label>
        <input type="password" id="Pass" name="Pass" placeholder="Use mayusculas, minusculas y caracteres especiales" required>

        <label for="Pass" id="PassConfirm">Confirme su contraseña:</label>
        <input type="password" id="PassC" name="PassC" placeholder="Vuelva a introducir su contraseña" required>

        <section class="ErrorP">
        <span>Error, las contraseñas no coinciden.</span>
        <i class="fa-solid fa-circle-exclamation"></i>
        </section>
        
        <button type="reset" id="Reset">Limpiar formulario</button>
        <button type="submit" class="Add" id="BtnEnviar">Agregar</button>
      </form>
    </div>
  </div>
<script src="ScriptRegister1.js"></script>
<script>
    function OpenModal() {
      let Modal = document.getElementById('ModalError');
      Modal.showModal();
      document.addEventListener('click', closeModalOutside);

    }
    function closeModal(){
      // document.addEventListener("click",closeModal);
      let Modal = document.getElementById('ModalError');
      Modal.close();
      document.removeEventListener('click', closeModalOutside);

    }
  document.addEventListener("DOMContentLoaded", function () { 

    // Evento para cuando se retrocede
// window.addEventListener('popstate', function(event) {
//     <php #unset($_SESSION['Name'],$_SESSION['Apellido'],$_SESSION['Username'],$_SESSION['Email'],$_SESSION['Number'],$_SESSION['Pass'],$_SESSION['PWD'])?>
// });

    // Obtener referencias a los elementos del formulario
    var passInput = document.getElementById("Pass");
    var passCInput = document.getElementById("PassC");
    var errorSection = document.querySelector(".ErrorP");
    var icono = document.querySelector(".fa-circle-exclamation");
    var reiniciar = document.getElementById("Reset");
    var lblR = document.getElementById("PassConfirm");
    let BtnE = document.getElementById("BtnEnviar");
    // Agregar eventos input a ambos campos de contraseña
    passInput.addEventListener("input", validarCoincidencia);
    passCInput.addEventListener("input", validarCoincidencia);
    reiniciar.addEventListener("click", function() {
    // Ocultar el mensaje de error
    errorSection.style.display = "none";
    // Eliminar estilos de borde
    passCInput.classList.remove("errorBorder");
    lblR.style.color = "black";
    BtnE.type = "submit";
    BtnE.style.background = "#afa04c";
    BtnE.style.color =  "#fff";
});
// Add
        // Deshabilitar el botón y el enlace al cargar la página
        // document.getElementById("BtnReady").disabled = true;
        // document.getElementById("registrationLink").style.pointerEvents = "none"; // Evitar que se pueda hacer clic en el enlace

        // // Agregar evento al checkbox
        // document.getElementById("CheckTerms").addEventListener('change', function() {

        //     if (this.checked) {
        //         document.getElementById("BtnReady").disabled = false;
        //         document.getElementById("registrationLink").style.pointerEvents = "auto"; // Habilitar el clic en el enlace
        //     } else { // Deshabilitar el botón y el enlace si el checkbox no está marcado
        //         document.getElementById("BtnReady").disabled = true;
        //         document.getElementById("registrationLink").style.pointerEvents = "none"; // Evitar que se pueda hacer clic en el enlace
        //     }
        // });
        var checkbox = document.getElementById('CheckTerms');
        var form = document.getElementById('FormTerm');
        // Agregar un evento de clic al checkbox
        checkbox.addEventListener('click', function() {
    if (checkbox.checked) {
        var formData = new FormData(form);
        // Imprimir el contenido del formulario en la consola
        for (var pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'Acuerdo.php', true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                console.log('Formulario enviado exitosamente.');
            } else {
                console.error('Error al enviar el formulario:', xhr.statusText);
            }
        };

        // Enviar el formulario usando AJAX
        xhr.send(formData);
    }
});
        // Add
    function validarCoincidencia() {
      // Obtener valores de las contraseñas
      var password = passInput.value;
      var confirmPassword = passCInput.value;

      // Verificar si ambos campos están vacíos
            if (confirmPassword === "" && password === "" || confirmPassword === "") {
        lblR.style.color = "black";
        errorSection.style.display = "none";
        passCInput.classList.remove("errorBorder");
        icono.style.display = "none";
        BtnE.type = "submit";
        BtnE.style.background = "#afa04c";
        BtnE.style.color =  "#fff";
      } else {
        // Verificar si las contraseñas coinciden
        if ( confirmPassword === password) {
          // Ocultar el mensaje de error y quitar estilos si coinciden
          errorSection.style.display = "none";
          passCInput.classList.remove("errorBorder");
          icono.style.display = "none"; // También puedes ocultar el icono
          lblR.style.color = "black";
          BtnE.type = "submit";
          BtnE.style.background = "#afa04c";
          BtnE.style.color =  "#fff";
        } else {
          // Mostrar el mensaje de error y aplicar estilos si no coinciden
          errorSection.style.display = "inline";
          errorSection.style.background = "rgba(172, 13, 13, 0.712)";
          errorSection.style.color = "black";
          errorSection.style.position = "relative";
          errorSection.style.top="-10px";
          //Estilo para el input.
          passCInput.classList.add("errorBorder");
          //Estilos para el icono.
          icono.style.display = "inline"; // Mostrar el icono
          icono.style.color = "orange";
          icono.style.top = "-30px";
          icono.style.position="absolute"
          icono.style.right = "100px";
          //Estilos para el label de confirmar contraseña.
          lblR.style.color = "orange";
          //Estilos para el botón de enviar.
          BtnE.style.background = "gray";
          BtnE.style.color =  "rgb(68, 68, 68)";
          BtnE.type = "button";
        }
      }
    }
      passInput.addEventListener("keyup", validarCoincidencia);
      passCInput.addEventListener("keyup", validarCoincidencia);
  });


$(document).ready(function() {
    $('#QuitN').on('click', function() {
        // Realizar la solicitud AJAX
        $.ajax({
            url: 'eliminar_sesion.php', // Ruta al script PHP
            type: 'POST',
            success: function(data) {
                // Manejar la respuesta si es necesario
                console.log(data);
                // Recargar la página para reflejar los cambios
                location.reload();
            },
            error: function(error) {
                console.error('Error en la solicitud AJAX', error);
            }
        });
    });
$(document).ready(function() {
    $('#QuitN').on('click', function() {
        // Realizar la solicitud AJAX
        $.ajax({
            url: 'eliminar_sesion.php', // Ruta al script PHP
            type: 'POST',
            success: function(data) {
                // Manejar la respuesta si es necesario
                console.log(data);
                // Recargar la página para reflejar los cambios
                location.reload();
            },
            error: function(error) {
                console.error('Error en la solicitud AJAX', error);
            }
        });
    });
    $('#QuitE').on('click', function() {
        // Realizar la solicitud AJAX
        $.ajax({
            url: 'eliminar_sesionE.php', // Ruta al script PHP
            type: 'POST',
            success: function(data) {
                // Manejar la respuesta si es necesario
                console.log(data);
                // Recargar la página para reflejar los cambios
                location.reload();
            },
            error: function(error) {
                console.error('Error en la solicitud AJAX', error);
            }
        });
    });
    $('#QuitTel').on('click', function() {
        // Realizar la solicitud AJAX
        $.ajax({
            url: 'eliminar_sesionT.php', // Ruta al script PHP
            type: 'POST',
            success: function(data) {
                // Manejar la respuesta si es necesario
                console.log(data);
                // Recargar la página para reflejar los cambios
                location.reload();
            },
            error: function(error) {
                console.error('Error en la solicitud AJAX', error);
            }
        });
    });
    $('#QD').on('click', function() {
        // Realizar la solicitud AJAX
        $.ajax({
            url: 'eliminar_sesionD.php', // Ruta al script PHP
            type: 'POST',
            success: function(data) {
                // Manejar la respuesta si es necesario
                console.log(data);
                // Recargar la página para reflejar los cambios
                location.reload();
            },
            error: function(error) {
                console.error('Error en la solicitud AJAX', error);
            }
        });
    });
    $('#QP').on('click', function() {
        // Realizar la solicitud AJAX
        $.ajax({
            url: 'eliminar_sesionP.php', // Ruta al script PHP
            type: 'POST',
            success: function(data) {
                // Manejar la respuesta si es necesario
                console.log(data);
                // Recargar la página para reflejar los cambios
                location.reload();
            },
            error: function(error) {
                console.error('Error en la solicitud AJAX', error);
            }
        });
    });
});
});

</script>
</body>
</html>