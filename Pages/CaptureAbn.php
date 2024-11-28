<?php
session_start();
$Server = "localhost";
$User = "root";
$Pwd = "";
$BD = "Almacen";
$Conexion = mysqli_connect($Server, $User, $Pwd, $BD);

$DeudaCA = "Select Deuda from Clientes Where Id_Cliente = '".$_SESSION['IdUser']."'";
$Result = mysqli_query($Conexion, $DeudaCA);
$Field = mysqli_fetch_array($Result);
$Deuda = $Field['Deuda'];

$Json = file_get_contents('php://input');
$Datos = json_decode($Json,true);
if(is_array($Datos)){
    $Id = $Datos['detalles']['id'];
    $Monto = $Datos['detalles']['purchase_units'][0]['amount']['value'];
    $Fecha = $Datos['detalles']['update_time'];
    $Fecha_N = date('Y-m-d ', strtotime($Fecha));
    $Email = $Datos['detalles']['payer']['email_address'];
}
// Add
if (isset($_GET['amount'])) { #Se comprueba si hay algo en el GET que recibir para hacer las adiciones.
    $amount = $_GET['amount'];
    $Monto = $amount;
    $fecha = date('Y-m-d H:i:s');
    $Fecha_N = $fecha;
}
// Solo comprobación:
// echo $Id;
// echo '<br>';
// echo $Monto;
// echo '<br>';
// echo $Fecha_N;
// echo '<br>';
// echo $Email;
// echo '<br>';
// echo $NewDeuda;
$Insert = "Insert into Abonos values ('','".$_SESSION['IdUser']."','".$_SESSION['IdOrder']."','$Fecha_N',$Monto)";
$ExecuteIn = mysqli_query($Conexion, $Insert);
if($ExecuteIn){
    $NewDeuda = $Deuda - $Monto;
    $Update = "Update Clientes set Deuda = $NewDeuda where Id_Cliente = '".$_SESSION['IdUser']."'";
    $Execute = mysqli_query($Conexion,$Update);
    header("refresh:0;url=https://cvm-m.com/index.php");
}
$Select = "Select * from Abonos where Id_Pedido = '".$_SESSION['IdOrder']."'";
$resultado = mysqli_query($Conexion, $Select);
// exit;
while ($row = $resultado->fetch_assoc()) {
    $Pedidos[] = [
        'id' => $row['Id_Abono'],
        'client' => $row['Id_Cliente'],
        'order' => $row['Id_Pedido'],
        'date' => $row['Fecha'],
        'amount' => $row['Cantidad'],
    ];
}
$consultaPedidos = "Select
                        p.Id_Pedido,
                        p.Id_Cliente,
                        p.Pedido,
                        p.Estado,
                        p.Fecha,
                        p.Total,
                        COALESCE(SUM(a.Cantidad), 0) as total_abonos
                    from Pedidos p
                    left join Abonos a on p.Id_Pedido = a.Id_Pedido
                    group by p.Id_Pedido";

$resultadoPedidos = mysqli_query($Conexion, $consultaPedidos);

while ($row = mysqli_fetch_assoc($resultadoPedidos)) {
    // echo "ID Pedido: " . $row['Id_Pedido'] . "<br>";
    // echo "ID Cliente: " . $row['Id_Cliente'] . "<br>";
    // echo "Pedido: " . $row['Pedido'] . "<br>";
    // echo "Estado: " . $row['Estado'] . "<br>";
    // echo "Fecha: " . $row['Fecha'] . "<br>";
    // echo "Total: " . $row['Total'] . "<br>";
    // echo "Total de Abonos para el Pedido: " . $row['total_abonos'] . "<br>";
    // Variables para calcular el resto del pedido.
    $TotalAbn = $row['total_abonos'];
    $TotalPedido = $row['Total'];
    // Calcular el resto en el pedido del cliente.
    $Resto = $TotalPedido - $TotalAbn;
    // echo "<br>";
    // Consulta que actualizará el resto del pedido actual sobre el que se esté haciendo el abono.
    $UpdateRest = "Update Pedidos set Resto = $Resto where Id_Pedido = " . $row['Id_Pedido'] . " and Id_Pedido = '".$_SESSION['IdOrder']."'";
    $ExUpdateRest = mysqli_query($Conexion, $UpdateRest);
    // Verificar si la cantidad abonada es igual al total del pedido
    if ($Resto == 0.00) {
        // Actualizar el estado del pedido a "Liquidado"
        $actualizarEstado = "Update Pedidos set Estado = 'Liquidado' where Id_Pedido = " . $row['Id_Pedido'];
        mysqli_query($Conexion, $actualizarEstado);
        // echo "El pedido ha sido liquidado.<br>";
    } else {
        // echo "La cantidad abonada no coincide con el total del pedido.<br>";
    }

    // echo "<hr>";
}



?>