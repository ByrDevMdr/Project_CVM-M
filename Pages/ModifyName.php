<?php
session_start();
$Server = "localhost";
$User = "root";
$Pwd = "";
$BD = "Almacen";
$Conexion = mysqli_connect($Server, $User, $Pwd, $BD);
$Valor = $_POST['ValueOculto'];
$ValorPost = $_POST['NameNew'];
if($Valor == "Nombre"){
$Update = "Update Clientes set Nombre = '".$ValorPost."' where Id_Cliente = '".$_SESSION['IdUs']."'";
$Execute = mysqli_query($Conexion,$Update);
if($Execute){
#    echo '
#    <script>
#       function mostrarModal() {
 #               var modal = document.getElementById("ModalMensaje");
  ##          modal.style.display = "block";
    #        // Redirigir después de 3 segundos
     #       setTimeout(function() {
      #          window.location.href = "ConfigUser.php";
       #     }, 3000);
        #}
        // Llamar a la función cuando se cargue la página
        #window.onload = mostrarModal;
 #   </script>';
 echo '<script>
 alert("Se ha modificado correctaente");
 </script>
 ';
 header("Location: ConfigUser.php");
}
}
if($Valor == "Apellido"){
$Update = "Update Clientes set Apellido = '".$ValorPost."' where Id_Cliente = '".$_SESSION['IdUs']."'";
$Execute = mysqli_query($Conexion,$Update);
if($Execute){
    header("Location: ConfigUser.php");

}
}
if($Valor == "Nombre_Usuario"){
$Update = "Update Clientes set Nombre_Usuario = '".$ValorPost."' where Id_Cliente = '".$_SESSION['IdUs']."'";
$Execute = mysqli_query($Conexion,$Update);
if($Execute){
header("Location: Inicio de sesion.php");
}
}
if($Valor == "Correo"){
$Update = "Update Clientes set Correo = '".$ValorPost."' where Id_Cliente = '".$_SESSION['IdUs']."'";
$Execute = mysqli_query($Conexion,$Update);
if($Execute){
 header("Location: ConfigUser.php");
}
}
if($Valor == "Telefono"){
$Update = "Update Clientes set Numero = '".$ValorPost."' where Id_Cliente = '".$_SESSION['IdUs']."'";
$Execute = mysqli_query($Conexion,$Update);
if($Execute){
 header("Location: ConfigUser.php");
}
}
?>