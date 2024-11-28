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

$UserPrivilege = $_POST['UserP'];
$Clave = $_POST['ClaveP'];

// Preparar la consulta SQL
$consulta = $Conexion->prepare("SELECT * FROM Usuarios WHERE Username = ?");
$consulta->bind_param("s", $UserPrivilege);

// Ejecutar la consulta
$consulta->execute();
$resultado = $consulta->get_result();

if ($resultado && $fila = $resultado->fetch_assoc()) {
    $ClaveAlmacenada = $fila['Clave'];
    
    // Verificar la contraseña utilizando password_verify
    if (password_verify($Clave, $ClaveAlmacenada)) {
        $_SESSION['UserP'] = $fila['Username'];
        $_SESSION['Nombre'] = $fila['Nombre'];
        $_SESSION['Direccion'] = $fila['Direccion']; // Variable de sesión para la dirección.
        $_SESSION['Telefono'] = $fila['Telefono']; // Variable de sesión para el teléfono.
        $_SESSION['Correo'] = $fila['Correo']; // Variable de sesión para el correo.
        $_SESSION['Rol'] = $fila['Rol'];
        $_SESSION['IdUser'] = $fila['Id_Usuario']; // Variable de sesión para el Id.
        
        header("Location: PanelT.php");
        exit(); // Es importante salir después de redirigir para evitar que se ejecute más código.
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
