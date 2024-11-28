<?php
$Server = "localhost";
$User = "root";
$Pwd = "";
$BD = "Almacen";
$Conexion = mysqli_connect($Server, $User, $Pwd, $BD);
$Id = $_POST['id'];
$Name = $_POST['name'];
$Surname = $_POST['surname'];
$Username = $_POST['username'];
$Mail = $_POST['mail'];
$Number = $_POST['number'];
$Due = $_POST['due'];
$Actualizar = "Update Clientes set Nombre = '".$Name."', Apellido = '".$Surname."', Nombre_Usuario= '".$Username."', Correo = '".$Mail."', Numero = '".$Number."', Deuda = '".$Due."' where Id_Cliente = '".$Id."'";
$Execute = mysqli_query($Conexion,$Actualizar);
if($Execute){
    header("Location:ClientList.php");
}
?>