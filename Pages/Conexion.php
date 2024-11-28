<?php
session_start();
$Server = "localhost";
$User = "root";
$Pwd = "";
$BD = "Almacen";
$conexion = mysqli_connect($Server, $User, $Pwd, $BD);
// $conexion = mysqli_connect("127.0.0.1:3306", "u989560779_Byron", "Medrano122005", "u989560779_CVM");

$Name = $_POST['Name'];
$Surname = $_POST['Surname'];
$Username = $_POST['Username'];
$Email = $_POST['Mail'];
$Numero = $_POST['Number'];
$Pass = $_POST['Pass'];
$Term = $_POST['Termino'];
$Dir = $_POST['Dirección'];
// $Insert = "Insert into Usuarios values('','$Name','$Surname','$Username','$Email','$Numero','$Pass',' ','$Term')";

$Insert = "Insert into Clientes values('','$Name','$Surname','$Username','$Email','$Numero','$Pass',' ','$Term', '$Dir')";
$Execute = mysqli_query($conexion, $Insert);
if($Execute){
    header("Location: Inicio de sesion.php");
    unset($_SESSION['Name']);
    unset($_SESSION['Apellido']);
    unset($_SESSION['Username']);
    unset($_SESSION['Email']);
    unset($_SESSION['Number']);
    unset($_SESSION['Pass']);
    unset($_SESSION['PWD']);
    unset($_SESSION['Term']);
    unset($_SESSION['Dirección']);
    exit();
}
/*
$conexion = mysqli_connect("proyectosinformaticatnl.ceti.mx","mueblesmdr","99d382a22","mueblesmdr");
$Nombre = $_POST['Usuario'];
$Clave = $_POST['Clave'];
#$Contra = hash('sha512',$Clave);

$comprobacion = "Select * from Usuarios where Nombre = '".$Nombre."' And Clave = '".$Clave."'";
$Execute = mysqli_query($conexion,$comprobacion);
if($Execute = mysqli_fetch_array($Execute)){
    $_SESSION['User'] = $Nombre;
   header("Location: ../index.php");
}else{
    echo '<script>
    alert("Favor de revisar sus credenciales.");
    window.history.back();
    </script>
    ';
}*/

 ?>