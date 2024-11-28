<?php
session_start(); // Asegúrate de iniciar la sesión al principio

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Directorio donde se guardarán las imágenes
    $targetDir = "../Pages/Comprobantes/";

    // Verificar si la carpeta existe, si no, crearla
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    // Configurar la zona horaria a la hora del centro de México
    date_default_timezone_set('America/Mexico_City');
    $maxFileSize = 2 * 1024 * 1024; // 2MB

    // Verificar si se subió el archivo sin errores
    if (isset($_FILES["comprobante"]) && $_FILES["comprobante"]["error"] == 0) {
        // Obtenemos el nombre del archivo original
        $originalFileName = basename($_FILES["comprobante"]["name"]);
        $fileType = pathinfo($originalFileName, PATHINFO_EXTENSION);

        // Verificamos el tamaño del archivo
        if ($_FILES["comprobante"]["size"] > $maxFileSize) {
            echo "El archivo es demasiado grande. El tamaño máximo permitido es de 2MB.";
            exit;
        }

        // Verificamos el tipo de archivo
        $allowTypes = array('jpg', 'png', 'jpeg', 'pdf');
        if (in_array(strtolower($fileType), $allowTypes)) {
            // Obtener la fecha actual y la variable de sesión
            $currentDate = date('Y-m-d_H-i'); // Formato: YYYY-MM-DD_HH-MM-SS
            $sessionName = isset($_SESSION['Name']) ? $_SESSION['Name'] : 'Name'; // Usa una variable de sesión, ajusta según tu aplicación
            $sessionSurname = isset($_SESSION['Surname']) ? $_SESSION['Surname'] : 'Surname'; // Agregamos la variable surname
            $sesssionId = isset($_SESSION['IdUser']) ? $_SESSION['IdUser'] : 'IdUser'; // Agregamos la variable surname

            // Crear un nuevo nombre de archivo único
            $newFileName = $sessionName . "_" . $sessionSurname . "_" . $currentDate . "_" . $sesssionId. "." . $fileType;
            $targetFilePath = $targetDir . $newFileName;

            // Mover el archivo subido a la carpeta "Comprobantes" con el nuevo nombre
            if (move_uploaded_file($_FILES["comprobante"]["tmp_name"], $targetFilePath)) {
                echo "El archivo " . htmlspecialchars($newFileName) . " ha sido subido con éxito.";
            } else {
                echo "Lo siento, hubo un error al subir tu archivo.";
            }
        } else {
            echo "Lo siento, solo se permiten archivos PDF, JPG, JPEG y PNG.";
        }
    } else {
        echo "No se ha enviado ningún archivo o hubo un error en la subida.";
    }
} else {
    echo "No se ha enviado ningún archivo.";
}
?>
