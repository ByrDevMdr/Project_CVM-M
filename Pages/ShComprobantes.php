<?php 
session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Link a la hoja de estilso -->
    <link rel="stylesheet" href="StyleShowComp.css">
    <!-- Enlace para fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revsión de comprobantes</title>
</head>
<body>
<table id="Encabezado" style="width:100%;">
        <tr>
          <td class="Content" id="ContentLogo">
            <img src="../Img/Logo.png" alt="LogoCarp">
          </td>
          <td class="Content" id="ContentTitulo">
            <span id="Titulo">Evidencia de pago</span>
          </td>
          <td class="Content" id="ContentBtn">
        <button id="Regresar">
                <i class="fa-solid fa-caret-left"></i>
                <a href="../index.php">Volver</a>
            </button>
          </td>
        </tr>
      </table>
      <ul class="file-list" id="file-list">
      <?php
// session_start();

// Simulando el ID del usuario en la sesión para este ejemplo
// $_SESSION['IdUser'] = 2; // Puedes cambiar esto dinámicamente según tu aplicación

$directory = './Comprobantes'; // Directorio "Comprobantes"
$userId = $_SESSION['IdUser']; // ID de usuario desde la sesión

// Abre el directorio
if (is_dir($directory)) {
    if ($dh = opendir($directory)) {
        echo '<ul>';
        while (($file = readdir($dh)) !== false) {
            if ($file != '.' && $file != '..') {
                $filePath = $directory . '/' . $file;
                if (is_file($filePath)) {
                    // Extrae la extensión del archivo
                    $fileExt = pathinfo($filePath, PATHINFO_EXTENSION);
                    
                    // Suponemos que el formato del nombre del archivo es Andyy_Surname_2024-05-25_05-53_Validated_ID.ext
                    $fileParts = explode('_', $file);
                    $fileNameWithoutExt = pathinfo($file, PATHINFO_FILENAME);

                    // Si el archivo está validado, avanzamos dos espacios a la derecha para encontrar el ID de usuario,
                    // de lo contrario, avanzamos solo un espacio.
                    $fileUserIdIndex = strpos($fileNameWithoutExt, 'Validated') != false ? (count($fileParts) - 2) : (count($fileParts) - 1);

                    // El ID del usuario es el segmento correspondiente en el nombre del archivo
                    $fileUserId = intval($fileParts[$fileUserIdIndex]);

                    if ($fileUserId == $userId) { // Verifica si el ID del archivo coincide con el ID del usuario
                        echo '<li class="ContentLi">';
                        echo '<section id="ContentFile">';
                        echo '<span id="NameFile">Nombre de archivo: <span id="File">'.$file.'</span></span>';
                        echo '<br class="BreakRow">';
                        echo '<br class="BreakRow">';
                        echo '<button id="BtnOpen"><a href="' . $filePath . '" target="_blank" class="ContentRef"><i class="fa-regular fa-folder-open"></i> Abrir</a></button>';
                        if (strpos($fileNameWithoutExt, 'Validated') !== false) {
                        echo '<br class="BreakRow">';
                        echo '<br class="BreakRow">';
                        echo ' <span id="Seg">----</span> <span id="Message"><i class="fa-regular fa-circle-check"></i>  Validado</span>';
                        }
                        echo '<br class="BreakRow">';
                        echo '<br class="BreakRow">';
                        echo'<hr>';
                        echo '</section>';
                        echo '</li>';
                    }
                }
            }
        }
        echo '</ul>';
        closedir($dh);
    }
} else {
    echo 'No se pudo abrir el directorio.';
}
?>


    </ul>
</body>
</html>