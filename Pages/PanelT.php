<?php
session_start();
#Aplicando estilo cuando el rol es Empleado.
if($_SESSION['Rol']=="Empleado"){
    echo '
    <style>
        #Abonos{
            display:none;
        }
        #Cuentas{
            display:none;
        }
        #AddT{
            display:none;
        }
        #InfoC{
            display:none;
        }
        #BtnComp{
            display:none;
        }
    </style>
    ';
}
#Aplicando estilo cuando el rol es Admin.
if($_SESSION['Rol']=="Administrador"){
    echo '
    <style>
    #Report{
        display:none;
    }
    </style>
    ';
}
if(!isset($_SESSION['UserP'])){
    header("location: Sesión trabajador.html");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de trabajador</title>
     <!--Cambiar el icono de la página en la pestaña superior de búsqueda-->
    <link rel="shortcut icon" href="../Img/LogoCarpFavicon.png" type="image/x-icon">
    <!--enlace para la hoja de estilos-->
    <link rel="stylesheet" href="StylePanelTrab1.css"> 
    <!--Enlace para la tipografía-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Afacad&display=swap" rel="stylesheet">
<!--Enlace para iconos de fontawesome-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <table class="head" id="Head">
        <tr>
            <td class="head" id="Logo">
                <img src="../Img/Logo.png" alt="Logo_Carp">
            </td>
            <td class="head" id="ContentTitulo">
                <span id="Titulo">Sesión de trabajador para <?php echo $_SESSION['Rol'];?></span>
            </td>

        </tr>
    </table>

    <section id="ContenidoRol">
         <article id="ContentRol">    
            <span id="Rol">Bienvenido, <?php echo $_SESSION['Nombre']; ?>, usted es <?php echo $_SESSION['Rol']; ?></span>
        </article>
        <article id="ContentMenu"  title="Menú">
            <i class="fa-solid fa-bars-staggered" id="Menú"></i>
        </article>
        <div id="MenuOpc">
            <ul style="list-style: none; text-align: start; padding: 15px 10px; margin: 4px; ">
                <li id="Icono" style="color: black; font-size: 20px;"><i class="fas fa-user"></i></li> 
                <!--<li style="margin:10px 0;"><a href="Pages/ConfigUserP.php" style="color:#000D3B; ; text-decoration: none; font-family: 'Josefin Sans', sans-serif; font-weight: 600;">Perfil</a> <i class="fa-solid fa-pen-to-square" style="color:white;"></i></li>-->
                <li style="margin:10px 0;" id="Report"><a href="Reporte.php" style="color:#000D3B; ; text-decoration: none; font-family: 'Josefin Sans', sans-serif; font-weight: 600;">Generar reporte</a> <i class="fas fa-file-pdf" style="color:white;"></i></li>
                <li style="margin:10px 0;" id="History"><a href="XML/ReportHistory.php" style="color:#000D3B; ; text-decoration: none; font-family: 'Josefin Sans', sans-serif; font-weight: 600;">Historial de reportes</a> <i class="fas fa-history" style="color:white;"></i></li>
                <li style="margin:10px 0;" id="AddT"><a href="AddEmp.php" style="color:#000D3B; ; text-decoration: none; font-family: 'Josefin Sans', sans-serif; font-weight: 600;">Dar de alta trabajador</a> <i class="fa-solid fa-user-plus" style="color:white;"></i></li>
                <li style="margin:10px 0;" id="InfoC"><a href="ClientList.php" style="color:#000D3B; ; text-decoration: none; font-family: 'Josefin Sans', sans-serif; font-weight: 600;">Información de clientes</a> <i class="fa-solid fa-address-book" style="color:white;"></i></li>
                <li id="OpCloseS"><a href="../CerrarSesión.php" style="text-decoration: none;  font-family: 'Josefin Sans', sans-serif; font-weight:bold; color:#630000;">Cerrar Sesión</a> <i class="fa-solid fa-person-walking-arrow-right" style="color:white;"></i></li>
            </ul>
        </div>
    </section>
    <div id="ContainerBtn">
        <button id="BtnComp"><i class="fa-regular fa-folder-open"></i><a href="Comprobantes.php"> Comprobantes de pago</a></button>
    </div>
    <section id="Contenido">    
        <article id="ContentTitulo">
            <span id="TituloP">Panel de administración</span>
        </article>
    </section>

    <section id="ContentTable">    
        <table id="ContenidoP">
        <tr>
            <td class="ContCard">
            <div class="contenedor">
            <div class="card" id="Pedidos">
                <figure>
                    <img src="../Img/Pedido.png" alt="Lo nuevo">
                </figure>
                <div class="contenido">
                    <h3>Pedidos</h3>
                    <p class="DescripciónCardPrivilege">Revise los pedidos pendientes...</p>
                    <a class="Btn" href="PedidosP.php">Ir</a>
                </div>
            </div>
            </td>
            <td class="ContCard">
            <div class="contenedor">
            <div class="card" id="Productos">
                <figure>
                    <img src="../Img/General.png" alt="Lo nuevo">
                </figure>
                <div class="contenido">
                    <h3>Productos</h3>
                    <p class="DescripciónCardPrivilege">Administre los productoso revisando sus caracteristicas</p>
                    <a class="Btn" href="GestionProd.php">Ir</a>
                </div>
            </div>
            </td>
        </tr>
        <tr id="SecondCard">
            <td class="ContCard" id="Abonos">
            <div class="contenedor">
            <div class="card" id="Nuevo">
                <figure>
                    <img src="../Img/Abono.png" alt="Lo nuevo">
                </figure>
                <div class="contenido">
                    <h3>Abonos</h3>
                    <p class="DescripciónCardPrivilege">Revise los abonos que ha hecho cada cliente</p>
                    <a class="Btn" href="AbonosP.php">Ir</a>
                </div>
            </div>
            </td>
            <td class="ContCard" id="Cuentas">
            <div class="contenedor">
            <div class="card" id="Nuevo">
                <figure>
                    <img src="../Img/Cuenta.png" alt="Lo nuevo">
                </figure>
                <div class="contenido">
                    <h3>Pagos pendientes</h3>
                    <p class="DescripciónCardPrivilege">Gestione las deudas pendientes que tiene cada cliente</p>
                    <a class="Btn" href="CuentasP.php">Ir</a>
                </div>
            </div>
            </td>
        </tr>
    </table>
</section>
<script src="ScriptPanelT.js"></script>
</body>
</html>