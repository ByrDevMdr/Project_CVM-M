<?php
$Server = "localhost";
$User = "root";
$Pwd = "";
$BD = "Almacen";
$Conexion = mysqli_connect($Server, $User, $Pwd, $BD);
$Id = $_POST['id'];
$Name = $_POST['name'];
$Price = $_POST['price'];
$Category = $_POST['category'];
$Alto = $_POST['alto'];
$Largo = $_POST['largo'];
$Fondo = $_POST['fondo'];
$Inventary = $_POST['inventary'];
    // Insertar datos en la base de datos
$Actualizaar = "Update Articulos set Nombre = '".$Name."', Alto = '".$Alto."', Largo = '".$Largo."', Fondo = '".$Fondo."', Categoria = '".$Category."', Precio = '".$Price."', Existencias = '".$Inventary."'  where Id_Art = '".$Id."'";
    $Execute = mysqli_query($Conexion,$Actualizaar);
    if($Conexion){
        header("Location: GestionProd.php");
    }
?>


