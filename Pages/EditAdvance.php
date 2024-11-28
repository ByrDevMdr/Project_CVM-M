<?php
session_start();
$ValueAdvance = $_POST['Advance'];
$Id = $_POST['IdOrder'];
$Server = "localhost";
$User = "root";
$Pwd = "";
$BD = "Almacen";
$Conexion = mysqli_connect($Server, $User, $Pwd, $BD);
$Actualizar = "Update Pedidos set Avance = '".$ValueAdvance."' where Id_Pedido = '".$Id."'";
$Execute = mysqli_query($Conexion,$Actualizar);
?>