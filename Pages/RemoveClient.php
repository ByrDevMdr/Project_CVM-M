<?php
$Server = "localhost";
$User = "root";
$Pwd = "";
$BD = "Almacen";
$Conexion = mysqli_connect($Server, $User, $Pwd, $BD);
$Id = $_POST['IdClient'];
$Delete = "Delete from Clientes where Id_Cliente = '$Id'";
$ExecuteR = mysqli_query($Conexion,$Delete);
if($ExecuteR){
    header("Location:ClientList.php");
}
?>