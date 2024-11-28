<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['fileToDelete'])) {
        $fileToDelete = $_POST['fileToDelete'];
        echo 'Archivo recibido: ' . $fileToDelete; // Depuración
        if (is_file($fileToDelete)) {
            if (unlink($fileToDelete)) {
                echo "El archivo ha sido eliminado con éxito.";
            } else {
                echo "Hubo un error al intentar eliminar el archivo.";
            }
        } else {
            echo "El archivo no existe.";
        }
    } else {
        echo "No se ha especificado ningún archivo para eliminar.";
    }
} else {
    echo "Método no permitido.";
}
?>
