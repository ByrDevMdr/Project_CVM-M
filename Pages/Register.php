<?php
$conexion = mysqli_connect("proyectosinformaticatnl.ceti.mx","mueblesmdr","99d382a22","mueblesmdr");
$Nombre = $_POST['Username'];
#$Apellido =$_POST['Apellido'];

#$NombreU = $_POST['NombreU'];
#$Telefono = $_POST['Number'];
#$Correo = $_POST['Email'];
if($conexion){
   header("Location: Inicio de sesion.php");
}
$ClaveC = $_POST['ClaveC'];
$Insertar = "Insert into Usuarios values('','$Nombre','$ClaveC')";
$Execute = mysqli_query($conexion, $Insertar);
if ($Execute) {
    echo '
    <script>
            // Muestra el modal después de que la consulta se haya ejecutado correctamente
            document.addEventListener("DOMContentLoaded", function() {
                // Obtén una referencia al modal por su ID
                var modal = document.getElementById("miModal");

                // Muestra el modal
                modal.style.display = "block";

                // Cierra el modal después de 5 segundos
                setTimeout(function() {
                    modal.style.display = "none";
                }, 5000);
            });
        </script>';
}
?>