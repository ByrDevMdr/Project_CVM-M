<?php
// Inicia la sesión si no está iniciada
session_start();

// Elimina las variables de sesión específicas
unset($_SESSION['Name']);
unset($_SESSION['Apellido']);
unset($_SESSION['Username']);

// También puedes usar session_unset() para eliminar todas las variables de sesión
// session_unset();

// Envía una respuesta (puedes personalizar según tus necesidades)
echo 'Variables de sesión eliminadas con éxito.';
?>
