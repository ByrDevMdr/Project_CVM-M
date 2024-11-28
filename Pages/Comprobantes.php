<?php
session_start();
if (!isset($_SESSION['UserP'])) {
    header("location: Sesión trabajador.html");
    exit();
}
if ($_SESSION['Rol'] != "Administrador") {
    header("location: PanelT.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!--enlace para la hoja de estilos-->
    <link rel="stylesheet" href="StyleComprobanteP4.css">
    <!--Enlace para iconos de fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Archivos</title>
</head>

<body>
        <div id="Modal">
            <section class="ModalBack">
                <article class="ModalContent">
                    <span class="MessageCorrect">
                        Mensaje sobre la operación
                    </span>
                    <div class="ModalBody">
                    <span class="ContentModalBoy">
                        <i class="fa-regular fa-circle-check" id="Correct"></i>
                        <hr>
                        <br>
                        <span class="MessageModalBody">
                            El pago se ha realizado correctamente!!
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
                <span id="Titulo">Revisión de comprobantes</span>
            </td>
            <td class="head" id="ContentBtn">
                <button id="Regresar">
                    <i class="fa-solid fa-arrow-left"></i>
                    <a href="PanelT.php">Volver</a>
                </button>
            </td>
        </tr>
    </table>

    <!-- Lista de archivos -->
    <ul class="file-list" id="file-list">
        <?php
        $directory = './Comprobantes'; // Directorio "Comprobantes"

        // Abre el directorio
        if (is_dir($directory)) {
            if ($dh = opendir($directory)) {
                while (($file = readdir($dh)) !== false) {
                    if ($file != '.' && $file != '..') {
                        $filePath = $directory . '/' . $file;
                        if (is_file($filePath)) {
                            $fileExt = pathinfo($filePath, PATHINFO_EXTENSION);
                            echo '<li class="Content">';
                            if (in_array(strtolower($fileExt), ['jpg', 'jpeg', 'png', 'gif'])) {
                                // Mostrar imagen
                                echo "<img src=\"$filePath\" alt=\"$file\" style=\"max-width: 100px; display: block;\">";
                            } elseif (strtolower($fileExt) == 'pdf') {
                                // Mostrar vista previa de PDF
                                echo "<iframe id=\"PdfVist\" src=\"$filePath\" style=\"max-width: 100px; height: 100px;\" frameborder=\"0\"></iframe>";
                            }
                            echo '<br>';
                            echo '<span id="Name">Nombre de archivo: ' . $file . '</span>';
                            echo '<br>';
                            // Enlace al archivo
                            echo "<button id=\"OpenFile\"><a href=\"$filePath\" target=\"_blank\"><i class=\"fa-regular fa-folder-open\"></i> Abrir</a></button>";

                            // Botón de eliminación
                            echo "<button class=\"delete-btn\" data-file=\"$filePath\" id=\"BtnDelete\"><i class=\"fa-solid fa-trash\"></i> Eliminar</button>";

                            // Botón de validación
                            echo "<button id=\"BtnValidate\" class=\"validate-btn\" data-file=\"$filePath\" id=\"BtnValidate\"><i class=\"fa-solid fa-check\"></i> Validar</button>";
                            echo '</li>';
                        }
                    }
                }
                closedir($dh);
            }
        } else {
            echo 'No se pudo abrir el directorio.';
        }
        ?>
    </ul>

    <!-- Script de jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Script de JavaScript -->
    <script>
$(document).ready(function() {
    // Evento click para el botón de eliminación
    $('.delete-btn').on('click', function() {
        // Tu código de eliminación aquí
    });

    // Evento click para el botón de validación
    $('.validate-btn').click(function() {
        var $validateBtn = $(this);
        var filePath = $validateBtn.data('file');
        var fileName = filePath.split('/').pop();
        var fileExt = fileName.split('.').pop();

        if (fileName.indexOf('Validated') === -1) {
            // Agregar la leyenda "Validated" al nombre del archivo
            var validatedFileName = fileName.replace('.' + fileExt, '_Validated.' + fileExt);
            
            // Actualizar el nombre del archivo en el servidor
            $.ajax({
                url: 'UpdateFileName.php',
                type: 'POST',
                data: {
                    filePath: filePath,
                    validatedFileName: validatedFileName
                },
                success: function(response) {
                    if (response === 'success') {
                        // Actualizar el nombre del archivo en la interfaz
                        $validateBtn.siblings('a').html(validatedFileName);
                        // Ocultar el botón de validar
                        $validateBtn.hide();
                        window.location.reload();

                    } else {
                        alert('Hubo un error al actualizar el nombre del archivo en el servidor.');
                    }
                },
                error: function() {
                    alert('Hubo un error al comunicarse con el servidor.');
                }
            });
        } else {
            alert('El archivo ya está validado.');
        }
    });
    $('.delete-btn').on('click', function() {
                var fileToDelete = $(this).data('file');
                console.log('Archivo a eliminar:', fileToDelete); // Depuración
                $.ajax({
                    url: 'DeleteCmp.php',
                    type: 'POST',
                    data: { fileToDelete: fileToDelete },
                    success: function(response) {
                        alert(response);
                        // Recargar la lista de archivos
                        $('#file-list').load(location.href + " #file-list > *");
                        window.location.reload();
                    },
                    error: function() {
                        alert('Hubo un error al intentar eliminar el archivo.');
                    }
                });
            });

    // Ocultar botones de validar para archivos ya validados
    $('.validate-btn').each(function() {
        var fileName = $(this).data('file').split('/').pop();
        if (fileName.indexOf('Validated') !== -1) {
            $(this).hide();
        }
    });
});


    </script>

</body>

</html>
