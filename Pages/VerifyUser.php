<?php
session_start();

$Server = "localhost";
$User = "root";
$Pwd = "";
$BD = "Almacen";

// Crear conexión
$Conexion = new mysqli($Server, $User, $Pwd, $BD);

// Verificar conexión
if ($Conexion->connect_error) {
    die("Connection failed: " . $Conexion->connect_error);
}

$NombreUsuario = $_POST['Usuario'];
$Clave = $_POST['Clave'];

// Preparar la consulta SQL
$consulta = $Conexion->prepare("SELECT `Nombre`, `Apellido`, `Numero`, `Direccion`, `Id_Cliente`, `Nombre_Usuario`, `Clave` FROM `Clientes` WHERE `Nombre_Usuario` = ?");
$consulta->bind_param("s", $NombreUsuario);

// Ejecutar la consulta
$consulta->execute();
$resultado = $consulta->get_result();

if ($resultado && $fila = $resultado->fetch_assoc()) {
    $_SESSION['IdUser'] = $fila['Id_Cliente'];
    // Verifica la contraseña proporcionada con la contraseña hasheada almacenada
    $claveAlmacenada = $fila['Clave'];
    if (password_verify($Clave, $claveAlmacenada)) {
        // Contraseña válida, inicia sesión
        $_SESSION['Number'] = $fila['Numero'];
        $_SESSION['Dir'] = $fila['Direccion'];
        $_SESSION['Name'] = $fila['Nombre'];
        $_SESSION['Surname'] = $fila['Apellido'];
        $_SESSION['User'] = $NombreUsuario;
        header("Location: ../index.php");
    } else {
        // Contraseña incorrecta
        echo '<script>
        alert("Favor de revisar sus credenciales.");
        window.history.back();
        </script>';
    }
} else {
    // Usuario no encontrado
    echo '<script>
    alert("Usuario no encontrado.");
    window.history.back();
    </script>';
}

// Cerrar la conexión
$consulta->close();
$Conexion->close();
?>
