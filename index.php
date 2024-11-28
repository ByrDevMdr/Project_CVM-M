<?php
session_start();
#$Usuario = $_SESSION['User'];
#Conexión al servidor ****
/* $Server = "127.0.0.1:3306";
$User = "u989560779_Byron";
$Pwd = "Medrano122005";
$BD = "u989560779_CVM";
$Conexion = mysqli_connect($Server, $User, $Pwd, $BD); */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <!--Librería de estilos de Font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--Link de estilos-->
    <link rel="stylesheet" href="StyleIn5.css">
    <!--Cambiar el icono de la página en la pestaña superior de búsqueda-->
    <link rel="shortcut icon" href="Img/LogoCarpFavicon.png" type="image/x-icon">
    <!--Enlaces para las fuentes de texto-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@200&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Caveat:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@1,300&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Vast+Shadow&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@100&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@1,100&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <title>Vista de compras</title>
</head>
<body style="width:100%;">   
   
    <?php
            if(isset($_SESSION['User'])){
            echo '
            <style>
                #InicioSesion{
                    display:none;
                }
                .fa-chart-bar{
                    background:rgba(0, 0, 0, 0.3);
                    padding: 10px 10px;
                    border-radius:.3em;
                    transition: all 100ms ease;
                }
                .fa-chart-bar:hover{
                    transition: all 100ms ease;
                    background:rgba(0, 0, 0, 0.1);
                    color: rgb(102, 102, 102);
                    cursor:pointer;
                }
                #Sesiones{
                    display:none;   
                }
        </style>
        ';
    }else{
        echo '
        <style>
        #Bienvenido{
            display:none;
        }
        #CerrarSesion{
            display:none;
        }
        #Menu{
            display:none;
        }
        #MenuOpc{
            display:none;
        }
        </style>
        ';
    }
    ?>



    <div id="encabezado">
    <table id="Enc">
        <tr style="width: 100%;">
            <div class="Encabezadoo">
                <svg id="EncabezadoDown" viewBox="0 0 500 150" preserveAspectRatio="none"> 
                <path id="Wave" d="M0.00,49.98 C48.24,99.00 277.36,15.13 500.00,49.98 L500.00,0.00 L0.00,0.00 Z">
               
            <td class="ContenidoE" id="ContentLogo">
                <span id="Titulo"><span id="LogoC"><img id="LogoEnc" src="Img/Logo.png" alt="Logotipo"></span></span>
            </td>
            <td class="ContenidoE" id="ContentTitle"> 
               <span class="T">CVM.M</span>
               
            </td>
            <td class="ContenidoE" id="ContentBtnIn">
                <aside class="InicioS" >
                <!--<button id="CerrarSesion"><a href="CerrarSesión.php">Cerrar sesión</a></button>-->
                
            <div id="Menu">
                <i class="fa-solid fa-chart-bar" id="IconoM"></i>
            </div>
        <div id="MenuOpc">
            <ul id="UlList">
                <!-- <li id="Icono"><i class="fas fa-user"></i></li>  -->
                <li id="IconoUser"><i class="fas fa-user"></i></li>  
                <li id="ConfigUser"><a href="Pages/ConfigUser.php">Perfil</a> <i class="fa-solid fa-pen-to-square" style="color:white;"></i></li>
                <li id="UploadPay"><a href="UploadPay/UploadPay.php">Subir comprobante</a> <i class="fa-solid fa-file-invoice" style="color:white;"></i></li>
                <li id="ShComp"><a href="Pages/ShComprobantes.php">Comprobantes</a> <i class="fa-solid fa-clipboard-check" style="color:white;"></i></li>
                <li id="OpCloseS"><a href="CerrarSesión.php">Cerrar Sesión</a> <i class="fa-solid fa-person-walking-arrow-right" style="color:white;"></i></li>

            </ul>
        </div>
        <span id="Bienvenido">Bienvenid@,
         <?php
         if(isset($_SESSION['User'])){
            echo '
            <style>

            #Bienvenido{
                display:block;
            }
            </style>
            ';
            echo $_SESSION['User'];
         }else{
            echo '
            <style>
            .contenedorr{
                display:none;
            }
            #Bienvenido{
                display:none;
            }
            </style>
            ';
         }          
            ?></span>
                    <button id="InicioSesion"><a style="text-decoration: none; color: black;" href="Pages/Inicio de sesion.php">Inicie sesión!!</a></button>
                    
                    </aside>
            </td>
        </path></svg>
    </div>
        </tr>
    </table>

    </div>
    <section id="Sesiones">
        <span id="TituloSesiones">Si usted es trabajador, ingrese aquí: </span>
        <button type="button" id="Btn_Sesión"><i class="fa-solid fa-user-tie"></i><a href="Pages/Sesión trabajador.html">Sesión de trabajador</a></button>
    </section>
    <section id="ContentT"> 

        <div class="ContenidoT">
             <img class="Texturas" src="Img/Cr.png" alt="Madera de pino">
             <img class="Texturas" src="Img/R.png" alt="Madera de encino">
             <img class="Texturas" src="Img/B.png" alt="Madera de parota">
             <img class="Texturas" src="Img/C.png" alt="Madera de roble">
             <div id="TexturaVeta"></div>
             <section id="TextoRight">Ofrecemos todo tipo de muebles para tu hogar!!
            </section>
        <aside id="AsI">
            <img src="Img/Talla.jpg">
        </aside>
            </div>
    </section>
       <!-- <nav class="Busqueda">
            <label for="Busqueda" style="height: 40px; width: 90px; margin-left: 20px;"><i class="fa-solid fa-magnifying-glass"></i></label>
            <input id="Busqueda" name="Busqueda" type="text" placeholder="    Busqueda general">
        </nav> -->

        <div class="contenedor">
<!--             <div class="card" id="Nuevo">
                <figure>
                    <img src="Img/Nuevo.png" alt="Lo nuevo">
                </figure>
                <div class="contenido">
                    <h3>Lo nuevo</h3>
                    <p>Revise los nuevos articulos!!</p>
                    <a class="Btn" href="">Ir</a>
                </div>
            </div> -->
            <div class="card" id="Categorias">
                <figure>
                    <img src="Img/Categoría.png" alt="Categorías">
                </figure>
                <div class="contenido">
                    <h3>Tipos</h3>
                    <p class="DescripcionCard">Dé un vistazo a los tipos de muebles que ofrecemos.
                    </p>
                    <a href="Pages/Categorías.html">Explorar</a>
                </div>
            </div>
            <div class="card" id="VistaProductos">
                        <figure>
                            <img src="Img/General.png" alt="Vista general">
                        </figure>
                        <div class="contenido">
                            <h3>Vista de productos</h3>
                            <p class="DescripcionCard">Tenga una vista general de todos nuestros productos!
                            </p>
                            <a href="Pages/VistaProductos.php">Explorar</a>
                        </div>
                    </div>
<!--             <div class="card" id="Elaboración">
                <figure>
                    <img id="Elaboracion" src="Img/Elaboracion.png" alt="Elaboración">
                </figure>

                <div class="contenido">
                    <h3>Sobre la elaboración</h3>
                    <p>Explore el proceso de elaboración...
                    </p>
                    <a href="">Ir</a>
                </div>
                </div> -->
        </div>
        <div id="Intersección">¨</div>
                <div class="contenedorr">

                    <div class="card" id="Pedidos">
                        <figure>
                            <img src="Img/Pedido.png" alt="Pedidos">
                        </figure>
                        <div class="contenido">
                            <h3>Pedidos</h3>
                            <p class="DescripcionCard">Revise el historial de pedidos que ha llevado.
                            </p>
                            <a href="Pages/Pedidos.php">Explorar</a>
                        </div>
                    </div>

                    <div class="card" id="Elaboración">
                        <figure>
                            <img src="Img/Cuenta.png" alt="Pedidos">
                        </figure>
                        <div class="contenido">
                            <h3>Cuentas pendientes</h3>
                            <p class="DescripcionCard">Revise las cuentas que tiene pendientes por liquidar.
                            </p>
                            <a href="Pages/Cuentas.php">Explorar</a>
                        </div>
                    </div>
                </div>

                <span id="TitleRC">Redes sociales: </span>
                <footer class="footer">
                    <span id="Contactos"><i class="fas fa-phone-volume" id="PhoneI"></i> Redes sociales y contactos: <i class="fas fa-sort-down" id="Desplegable"></i><i class="fas fa-sort-up" id="Hide"></i></span>
                    <div id="ContentRedesS">
                    <div class="contact">Facebook:</div> <a id="Fb" href="http://facebook.com"><i class="fa-brands fa-facebook"></i></a>
                    <div class="contact">Whatsapp:</div> <a id="Wpp" href="https://wa.me/3335052057"><i class="fab fa-whatsapp"></i></a>
                    <div class="contact">Correo:</div> <a id="Correo" href="https://mail.google.com/mail/u/0/?subject=Cuesti%C3%B3n&body=Contenido+del+mensaje#inbox?compose=CllgCJNsMRSWjrMHtrKbVwKdSXRCCjbhXBXRJfPVHjcWNcTmMpfkBCqJcpzNtCQZrXmSHzqvZlV"><i class="fas fa-envelope-open-text"></i></a>
                    <div class="contact">Teléfono:</div> <a id="Num" href="tel:3336911882">3336911882</a>
                </div>
                </footer>
                    <section id="Term">
        <a href="Pages/Terminos/Terminos.pdf" target="_blank">Terminos y condiciones</a>
    </section>
                <footer id="Down">-</footer>
                <!-- Agrega esto justo antes de cerrar la etiqueta </body> -->
<script>
        var DesplegableRedSocial=document.getElementById('Desplegable');
        var Contactos=document.getElementById('ContentRedesS');
        var DesG=document.getElementById('Contactos');
        var Hide = document.getElementById('Hide');
        var isVisible = false; // Variable para rastrear el estado de Contactos
        var Bad = false;
        var menuDesplegable = document.getElementById('MenuOpc');
        var iconoMenu = document.getElementById('Menu');
        var icon = document.getElementById('Icono');
        // Variable que trae la tarjeta de 'Categorías'
        let CardCategorias = document.getElementById("Categorias");
        // Variable que trae la tarjeta de 'Vista productos'
        let CardVistaProducts = document.getElementById("VistaProductos");
        menuDesplegable.style.width = "1000px";
        var ultimoDesplazamiento = 0;
        // let Bandera = 1;
        document.addEventListener('DOMContentLoaded', function () {

            DesG.addEventListener('click', function () {
    if (!isVisible) { // Si Contactos no está visible, se muestra con fadeIn
        isVisible = true; // Actualiza el estado
        Contactos.style.display = "block";
        Contactos.style.animation = "fadeIn 1s forwards";
        DesplegableRedSocial.style.display = "none";
        Hide.style.display = "inline-block";
    } else { // Si Contactos está visible, se oculta con fadeOut
        Contactos.style.animation = "fadeOut 1s forwards";
        Hide.style.display = "none";
        // Restaura los otros elementos relacionados
        DesplegableRedSocial.style.display = "inline-block";

        // Escucha el evento de finalización de la animación de fadeOut
        Contactos.addEventListener('animationend', function () {
            // Oculta completamente el elemento Contactos y restaura su animación
            if(isVisible=false){
            Contactos.style.display = "none";
            Contactos.style.animation = "";
            isVisible = false; // Actualiza el estado
            }

        });
    }
});


        DesplegableRedSocial.addEventListener('click', function () {
        isVisible=true;
        Contactos.style.display = "block";
        Contactos.style.animation = "fadeIn 1s forwards"; // Aplica la animación de fadeIn
        DesplegableRedSocial.style.display = "none";
        Hide.style.display = "inline-block";
        });

        Hide.addEventListener('click', function () {
            isVisible=false;

            Contactos.style.animation = "fadeOut 1s forwards"; // Aplica la animación de fadeOu
          // Oculta el elemento después de que termine la animación

            Contactos.addEventListener('animationend', function () {
                if(isVisible=false){
                    Contactos.style.display = "none";
                }
            });
            DesplegableRedSocial.style.display = "inline-block";
            Hide.style.display = "none";
        });


        // Evento que lleva a la página de vista de productos
        CardVistaProducts.addEventListener("click",function(){
            window.location.href="Pages/VistaProductos.php";
        });
        // Evento que lleva a la página de categorias
        CardCategorias.addEventListener("click", function(){
            window.location.href="Pages/Categorías.html";
        });

        window.addEventListener("scroll", function() {
        var desplazamientoActual = window.pageYOffset;

        if (desplazamientoActual > ultimoDesplazamiento) {
        // Desplazándose hacia abajo
        // menuDesplegable.style.animation = "fadeOutMenuOpc 1s forwards";

        menuDesplegable.style.display = "none"; // Oculta el menú moviéndolo fuera de la pantalla
        Bad=false;
        } else {
        // Desplazándose hacia arriba
        //menuDesplegable.style.display = "0"; // Muestra el menú moviéndolo a la posición original
        }

        ultimoDesplazamiento = desplazamientoActual;
        });
        
        iconoMenu.addEventListener('click', function () {
        // Bad = true;
        if (!Bad) { // Si Contactos no está visible, se muestra con fadeIn
        Bad = true; // Actualiza el estado
        MenuOpc.style.display = "block";
        MenuOpc.style.animation = "fadeInMenuOpc 1s forwards";
    } else { // Si Contactos está visible, se oculta con fadeOut
        MenuOpc.style.animation = "fadeOutMenuOpc 1s forwards";
        // Escucha el evento de finalización de la animación de fadeOut
        MenuOpc.addEventListener('animationend', function () {
            // Oculta completamente el elemento Contactos y restaura su animación
            if(Bad=false){
            MenuOpc.style.display = "none";
            MenuOpc.style.animation = "";
            Bad = false; // Actualiza el estado
            }

        });
    }
});


        // Cierra el menú si se hace clic fuera de él
        window.addEventListener('click', function (event) {
            if (event.target !== iconoMenu && event.target.parentNode !== menuDesp) {
                // menuDesplegable.style.animation="fadeOutMenuOpc 1s forwards";
                menuDesplegable.style.display = 'none';
                icon.style.background="rgba(0, 0, 0, 0.3)";
                icon.style.padding= "10px 10px";
                icon.style.color="black";

            }
        });
    });
</script>

</body>
</html>