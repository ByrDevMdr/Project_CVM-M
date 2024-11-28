<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de reportes</title>
    <!-- Enlace para la tipografía -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <!-- Link hacia la hoja de estilso -->
    <link rel="stylesheet" href="../StyleRH3.css">
    <!--Cambiar el icono de la página en la pestaña superior de búsqueda-->
    <link rel="shortcut icon" href="../../Img/LogoCarpFavicon.png" type="image/x-icon">
    <!--Enlace para iconos de fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Encabezado -->
    <table class="head" id="Head">
        <tr>
            <td class="head" id="Logo">
                <img src="../../Img/Logo.png" alt="Logo_Carp">
            </td>
            <td class="head" id="ContentTitulo">
                <span id="Titulo">Revisión de reportes generados</span>
            </td>
            <td class="head" id="ContentBtn">
                <button id="Regresar">
                    <i class="fa-solid fa-arrow-left"></i>
                    <a href="../PanelT.php">Volver</a>
                </button>
            </td>
        </tr>
    </table>
</head>
<body>
    <section id="ContentFormF">
        <form action="ReportHistory.php" method="post" id="FormFilter">
            <label for="Fecha">Selecciona una fecha:</label>
            <input type="date" id="Fecha" name="DateSel" placeholder="YYYY-MM-DD" pattern="\d{4}-\d{2}-\d{2}">
            <button type="submit" class="BtnOpc" id="BtnFilter"><i class="fa-solid fa-filter"></i> Filtrar</button>
            <button type="submit" class="BtnOpc" id="BtnQuit"><i class="fa-solid fa-ban"></i> Quitar filtro</button>
        </form> 
    </section>



<section id="Body">
    <article id="Panel">

        <div id="ContMsg">
            <span id="Msg">No hay reportes disponibles en esta fecha</span>
        </div>
        
        <?php
session_start();

$Id = $_SESSION['IdUser'];
$Doc = new DOMDocument();
$Doc->load('Reporte.xml');
$Reportes = $Doc->getElementsByTagName("Reporte");

$FechaFiltro = isset($_POST['DateSel']) ? $_POST['DateSel'] : null;

// Si no se aplica ningún filtro, mostrar todos los reportes
if($_SESSION['Rol']=="Empleado"){
if (empty($FechaFiltro)) {
    echo "<table id='ListReport' class='TableR'>";
    echo "<tr>
            <th class='TilteApart'>Fecha</th>
            <th class='TilteApart'>Nombre</th>
            <th class='TilteApart'>Pedidos</th>
            <th class='TilteApart'>Ganancias</th>
            <th class='TilteApart'>Dirección</th>
            <th class='TilteApart'>Teléfono</th>
            <th class='TilteApart'>Correo</th>        
          </tr>";

    foreach ($Reportes as $Reporte) {
        if ($Id == $Reporte->getElementsByTagName("Id")->item(0)->nodeValue) {
            echo "<tr class='Reporte'>";
            echo "<td class='ReportRow'>" . $Reporte->getElementsByTagName("Fecha")->item(0)->nodeValue . "</td>";
            echo "<td class='ReportRow'>" . $Reporte->getElementsByTagName("Nombre")->item(0)->nodeValue . "</td>";
            echo "<td class='ReportRow'>" . $Reporte->getElementsByTagName("Pedidos")->item(0)->nodeValue . "</td>";
            echo "<td class='ReportRow'>" . $Reporte->getElementsByTagName("Ganancias")->item(0)->nodeValue . "</td>";
            echo "<td class='ReportRow'>" . $Reporte->getElementsByTagName("Direccion")->item(0)->nodeValue . "</td>";
            echo "<td class='ReportRow'>" . $Reporte->getElementsByTagName("Telefono")->item(0)->nodeValue . "</td>";
            echo "<td class='ReportRow'>" . $Reporte->getElementsByTagName("Correo")->item(0)->nodeValue . "</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
} else {
    // Si se aplica un filtro, verificar si hay reportes para esa fecha
    $reporteEncontrado = false;
    foreach ($Reportes as $Reporte) {
        $FechaReporte = $Reporte->getElementsByTagName("Fecha")->item(0)->nodeValue;

        if ($FechaReporte == $FechaFiltro && $Id == $Reporte->getElementsByTagName("Id")->item(0)->nodeValue) {
            $reporteEncontrado = true;
            echo "<table id='ListReport' class='TableR'>";
            echo "<tr>
                    <th class='TilteApart'>Fecha</th>
                    <th class='TilteApart'>Nombre</th>
                    <th class='TilteApart'>Pedidos</th>
                    <th class='TilteApart'>Ganancias</th>
                    <th class='TilteApart'>Dirección</th>
                    <th class='TilteApart'>Teléfono</th>
                    <th class='TilteApart'>Correo</th>        
                  </tr>";
            echo "<tr class='Reporte'>";
            echo "<td class='ReportRow'>" . $Reporte->getElementsByTagName("Fecha")->item(0)->nodeValue . "</td>";
            echo "<td class='ReportRow'>" . $Reporte->getElementsByTagName("Nombre")->item(0)->nodeValue . "</td>";
            echo "<td class='ReportRow'>" . $Reporte->getElementsByTagName("Pedidos")->item(0)->nodeValue . "</td>";
            echo "<td class='ReportRow'>" . $Reporte->getElementsByTagName("Ganancias")->item(0)->nodeValue . "</td>";
            echo "<td class='ReportRow'>" . $Reporte->getElementsByTagName("Direccion")->item(0)->nodeValue . "</td>";
            echo "<td class='ReportRow'>" . $Reporte->getElementsByTagName("Telefono")->item(0)->nodeValue . "</td>";
            echo "<td class='ReportRow'>" . $Reporte->getElementsByTagName("Correo")->item(0)->nodeValue . "</td>";
            echo "</tr>";
            echo "</table>";
            break;
        }
    }

    // Si no se encontraron reportes para la fecha filtrada, mostrar un mensaje
    if (!$reporteEncontrado) {
        echo "<style>
            #ContMsg{
                display:block;
            }
        </style>";
    }
}
}else{  
    if (empty($FechaFiltro)) {
        echo "<table id='ListReport' class='TableR'>";
        echo "<tr>
                <th class='TilteApart'>Fecha</th>
                <th class='TilteApart'>Nombre</th>
                <th class='TilteApart'>Pedidos</th>
                <th class='TilteApart'>Ganancias</th>
                <th class='TilteApart'>Dirección</th>
                <th class='TilteApart'>Teléfono</th>
                <th class='TilteApart'>Correo</th>        
              </tr>";
    
        foreach ($Reportes as $Reporte) {
            // if ($Id == $Reporte->getElementsByTagName("Id")->item(0)->nodeValue) {
                echo "<tr class='Reporte'>";
                echo "<td class='ReportRow'>" . $Reporte->getElementsByTagName("Fecha")->item(0)->nodeValue . "</td>";
                echo "<td class='ReportRow'>" . $Reporte->getElementsByTagName("Nombre")->item(0)->nodeValue . "</td>";
                echo "<td class='ReportRow'>" . $Reporte->getElementsByTagName("Pedidos")->item(0)->nodeValue . "</td>";
                echo "<td class='ReportRow'>" . $Reporte->getElementsByTagName("Ganancias")->item(0)->nodeValue . "</td>";
                echo "<td class='ReportRow'>" . $Reporte->getElementsByTagName("Direccion")->item(0)->nodeValue . "</td>";
                echo "<td class='ReportRow'>" . $Reporte->getElementsByTagName("Telefono")->item(0)->nodeValue . "</td>";
                echo "<td class='ReportRow'>" . $Reporte->getElementsByTagName("Correo")->item(0)->nodeValue . "</td>";
                echo "</tr>";
            // }
        }
        echo "</table>";
    } else {
        // Si se aplica un filtro, verificar si hay reportes para esa fecha
        $reporteEncontrado = false;
        foreach ($Reportes as $Reporte) {
            $FechaReporte = $Reporte->getElementsByTagName("Fecha")->item(0)->nodeValue;
    
            if ($FechaReporte == $FechaFiltro/*  && $Id == $Reporte->getElementsByTagName("Id")->item(0)->nodeValue */) {
                $reporteEncontrado = true;
                echo "<table id='ListReport' class='TableR'>";
                echo "<tr>
                        <th class='TilteApart'>Fecha</th>
                        <th class='TilteApart'>Nombre</th>
                        <th class='TilteApart'>Pedidos</th>
                        <th class='TilteApart'>Ganancias</th>
                        <th class='TilteApart'>Dirección</th>
                        <th class='TilteApart'>Teléfono</th>
                        <th class='TilteApart'>Correo</th>        
                      </tr>";
                echo "<tr class='Reporte'>";
                echo "<td class='ReportRow'>" . $Reporte->getElementsByTagName("Fecha")->item(0)->nodeValue . "</td>";
                echo "<td class='ReportRow'>" . $Reporte->getElementsByTagName("Nombre")->item(0)->nodeValue . "</td>";
                echo "<td class='ReportRow'>" . $Reporte->getElementsByTagName("Pedidos")->item(0)->nodeValue . "</td>";
                echo "<td class='ReportRow'>" . $Reporte->getElementsByTagName("Ganancias")->item(0)->nodeValue . "</td>";
                echo "<td class='ReportRow'>" . $Reporte->getElementsByTagName("Direccion")->item(0)->nodeValue . "</td>";
                echo "<td class='ReportRow'>" . $Reporte->getElementsByTagName("Telefono")->item(0)->nodeValue . "</td>";
                echo "<td class='ReportRow'>" . $Reporte->getElementsByTagName("Correo")->item(0)->nodeValue . "</td>";
                echo "</tr>";
                echo "</table>";
                break;
            }
        }
    
        // Si no se encontraron reportes para la fecha filtrada, mostrar un mensaje
        if (!$reporteEncontrado) {
            echo "<style>
                #ContMsg{
                    display:block;
                }
            </style>";
        }
    }   
}
?>


    </article>
</section>
</body>
</html>
