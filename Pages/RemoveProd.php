<?php
$Server = "localhost";
$User = "root";
$Pwd = "";
$BD = "Almacen";
$Conexion = mysqli_connect($Server, $User, $Pwd, $BD);
$Id = $_POST['IdProd'];
$Delete = "Delete from Articulos where Id_Art = '$Id'";
$Execute = mysqli_query($Conexion,$Delete);
if($Execute){
    header("Location: GestionProd.php");
}
?>