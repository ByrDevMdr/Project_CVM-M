<?php
# Sacar los resultados de las consultas y guardarlos en variables de sesión.
session_start();
/*
$Conexion = mysqli_connect("Localhost", "root", "", "almacen");
$Query = "select * from Usuarios where Nombre_Usuario = '" . $_SESSION['User'] . "'";
$Result = mysqli_query($Conexion, $Query);

if ($Result) {

    // Se almacena el resultado con todos los camposde la tabla que se arrojaron.
    $fila = mysqli_fetch_assoc($Result);
    #Variable de sesión del id.
    $_SESSION['IdUs'] = $fila['Id'];
    echo $_SESSION['IdUs'];
    #Variable de sesión del nombre.
    $_SESSION['NombreUs'] = $fila['Nombre'];
    echo $_SESSION['NombreUs'];
    #Variable de ssesión del apellido.
    $_SESSION['ApellidoUs'] = $fila['Apellido'];
    echo $_SESSION['ApellidoUs'];
    #Variable de sesión de correo.
    $_SESSION['CorreoUs'] = $fila['Correo'];
    echo $_SESSION['CorreoUs'];
    #Variable de sesión del telefono.
    $_SESSION['TelefonoUs'] = $fila['Numero'];
    echo $_SESSION['TelefonoUs'];


} else {
    echo "Error en la consulta: " . mysqli_error($Conexion);
}*/
?>
