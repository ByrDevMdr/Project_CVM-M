<?php
$Server = "localhost";
$User = "root";
$Pwd = "";
$BD = "Almacen";
$Conexion = mysqli_connect($Server, $User, $Pwd, $BD);
$Nombre = $_POST['Nombre'];
$Categoria = $_POST['Categoria'];
$Alto = $_POST['Alto'];
$Largo = $_POST['Largo'];
$Fondo = $_POST['Fondo'];
$Material = $_POST['Material'];
$Precio = $_POST['Precio'];
$NombreFoto = $_FILES['Imagen']['name'];
$RutaFoto = $_FILES['Imagen']['tmp_name'];

$explode = explode('.', $NombreFoto);
$Ext = "png";
$NombreNuevoFoto  = $Nombre.'.'.$Ext;

$dirLocal = "../Img";
if (!file_exists($dirLocal)) {
    mkdir($dirLocal, 0777, true);
}

$miDir         = opendir($dirLocal); //Aabro el directorio
$ImgProd = $dirLocal.'/'.$NombreNuevoFoto;
if(move_uploaded_file($RutaFoto, $ImgProd)){
    // Insertar datos en la base de datos
    $Insert = "Insert into Articulos values (' ','$Nombre', ' $Alto', '$Largo', '$Fondo', '$Material', '$Categoria', '$NombreNuevoFoto', '$Precio','1')";

    if (mysqli_query($Conexion, $Insert)) {

    } else {
        echo "Error al insertar datos: " . mysqli_error($Conexion);
    }
} else {
    echo "Error al mover la imagen.";
}
?>