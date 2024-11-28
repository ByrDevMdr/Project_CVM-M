<?php
$Server = "localhost";
$User = "root";
$Pwd = "";
$BD = "Almacen";
$Conexion = mysqli_connect($Server, $User, $Pwd, $BD);
$Username = $_POST['Username'];
$Nombre = $_POST['Nombre'];
$Teléfono =$_POST['Phone'];
$Mail = $_POST['Mail'];
$Address = $_POST['Address'];
$Rol = $_POST['Rol'];
$Pwd = $_POST['Password'];
$PwdH = password_hash($Pwd, PASSWORD_DEFAULT); #Contraseña hasheada.
$Insert = "Insert into Usuarios values('','$Nombre','$Teléfono','$Mail','$Address','$Username','$PwdH','$Rol')";
$Execute = mysqli_query($Conexion,$Insert);
?>