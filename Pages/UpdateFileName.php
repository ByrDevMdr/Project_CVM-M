<?php
session_start();

// Verificar si el usuario tiene permisos
if (!isset($_SESSION['UserP'])) {
    echo 'error';
    exit();
}

// Verificar el rol del usuario
if ($_SESSION['Rol'] != "Administrador") {
    echo 'error';
    exit();
}

// Verificar si se reciben los datos necesarios
if (!isset($_POST['filePath']) || !isset($_POST['validatedFileName'])) {
    echo 'error';
    exit();
}

// Obtener la ruta del archivo y el nuevo nombre validado
$filePath = $_POST['filePath'];
$validatedFileName = $_POST['validatedFileName'];

// Verificar si el archivo existe
if (!file_exists($filePath)) {
    echo 'error';
    exit();
}

// Obtener la extensión del archivo
$fileExt = pathinfo($filePath, PATHINFO_EXTENSION);

// Construir el nuevo nombre de archivo con la leyenda "Validated"
$newFilePath = str_replace('.' . $fileExt, '_Validated.' . $fileExt, $filePath);

// Intentar renombrar el archivo
if (rename($filePath, $newFilePath)) {
    echo 'success';
} else {
    echo 'error';
}
?>
