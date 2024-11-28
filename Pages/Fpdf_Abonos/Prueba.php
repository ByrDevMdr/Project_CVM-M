<?php
$Server = "localhost";
$User = "root";
$Pwd = "";
$BD = "Almacen";
$Conexion = mysqli_connect($Server, $User, $Pwd, $BD);
$consulta = "Select Abonos.*, Clientes.Nombre AS NombreCliente, Clientes.Apellido as ApellidoCliente, Pedidos.Estado AS EstadoPedido from Abonos join Clientes on  Abonos.Id_Cliente = Clientes.Id_Cliente join Pedidos ON Abonos.Id_Pedido = Pedidos.Id_Pedido";
#Con consultas y un JOIN, se puede unir una tabla con otra teniendo un valor como referencia (Las llaves foraneas).
$resultado = mysqli_query($Conexion, $consulta);

if ($resultado->num_rows > 0) {
    $Abono = [];

    while ($row = $resultado->fetch_assoc()) {
        $Abono[] = [
            'id' => $row['Id_Abono'],
            'idC' => $row['Id_Cliente'],
            'orderId' => $row['Id_Pedido'],
            'date' => $row['Fecha'],
            'amount' => $row['Cantidad'],
            'clientName' => $row['NombreCliente'],
            'clientSurname' => $row['ApellidoCliente'],
            'orderState' => $row['EstadoPedido'],
        ];
    }
}
// $pedidoId = $IntAbono['orderId'];
// $consultaDetallesPedido = "SELECT * FROM Pedidos WHERE Id_Pedido = $pedidoId";
// $resultadoDetallesPedido = mysqli_query($Conexion, $consultaDetallesPedido);
// $detallesPedido = mysqli_fetch_assoc($resultadoDetallesPedido);
foreach ($Abono as $Abonos){

    // echo $Abonos['id'];
    // echo '<br>';
    // echo $Abonos['idC'];
    // echo '<br>';
    // echo $Abonos['orderId'];
    // echo '<br>';
    // echo $Abonos['amount'];
    // echo '<br>';
    // echo $Abonos['clientName'];
    // echo '<br>';
    // echo $Abonos['clientSurname'];
    // echo '<br>';
    // echo $Abonos['orderState'];
    // echo '<br>';
    $pedidoId = $Abonos['orderId'];
    $consultaDetallesPedido = "Select * from Pedidos where Id_Pedido = $pedidoId";
    $resultadoDetallesPedido = mysqli_query($Conexion, $consultaDetallesPedido);
    $detallesPedido = mysqli_fetch_assoc($resultadoDetallesPedido);
    // echo $detallesPedido['Id_Pedido'];
    // echo '<br>';
    // echo $detallesPedido['Pedido'];
    // echo '<br>';
    // echo $detallesPedido['Estado'];
    // echo '<br>';
    // echo $detallesPedido['Avance'];
    // echo '<br>';
    // echo $detallesPedido['Total'];
    // echo '<br>';
    // echo $detallesPedido['Fecha'];
    // echo '<br>';

}
?>